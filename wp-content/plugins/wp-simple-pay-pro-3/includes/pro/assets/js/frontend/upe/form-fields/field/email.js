/**
 * Internal dependencices
 */
import { debounce } from '../../utils';

/**
 * Displays an inline error under the email (Link Authentication Element).
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 * @param {string} _errorMessage Error message override.
 */
export function showError( paymentForm, _errorMessage ) {
	const errorEl = paymentForm.querySelector( '.simpay-email-error' );

	if ( ! errorEl ) {
		return;
	}

	const { i18n } = paymentForm;
	const errorMessage = i18n.emptyEmailError;

	errorEl.innerText = _errorMessage || errorMessage;
	errorEl.style.display = 'block';
	wp.a11y.speak( errorMessage, 'assertive' );
}

/**
 * Hides an inline error under the payment method.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 */
export function hideError( paymentForm ) {
	const errorEl = paymentForm.querySelector( '.simpay-email-error' );

	if ( ! errorEl ) {
		return;
	}

	errorEl.innerText = '';
	errorEl.style.display = 'none';
}

/**
 * Determines if the payment form has valid payment method data to attempt to
 * confirm a payment.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 */
export function isValid( paymentForm ) {
	const { state } = paymentForm;
	const { linkAuthenticationElement } = state;

	if ( ! linkAuthenticationElement ) {
		return true;
	}

	if ( ! linkAuthenticationElement.complete ) {
		linkAuthenticationElement.focus();

		return false;
	}

	return true;
}

/**
 * Sets up the "Email" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupEmail( $paymentForm ) {
	const { paymentForm } = $paymentForm;
	const { setState, state, stripeElements } = paymentForm;
	const { paymentElement } = state;
	const emailWrapEl = paymentForm.querySelector(
		'.simpay-link-authentication-container'
	);

	if ( ! emailWrapEl ) {
		return;
	}

	const linkAuthenticationElement = stripeElements.create(
		'linkAuthentication'
	);

	setState( {
		linkAuthenticationElement,
	} );

	const hiddenEmailEl = paymentForm.querySelector( '.simpay-email' );

	const debouncedChange = debounce( ( { complete, value } ) => {
		setState( {
			email: value.email,
			linkAuthenticationElement: {
				...linkAuthenticationElement,
				complete,
			},
		} );

		if ( complete ) {
			paymentElement.update( {
				defaultValues: {
					billingDetails: {
						email: value.email,
					},
				},
			} );
		}
	}, 500 );

	linkAuthenticationElement.on( 'change', ( { complete, value } ) => {
		hiddenEmailEl.value = value.email;

		debouncedChange( { complete, value } );
	} );

	linkAuthenticationElement.mount( emailWrapEl );
}

export default setupEmail;
