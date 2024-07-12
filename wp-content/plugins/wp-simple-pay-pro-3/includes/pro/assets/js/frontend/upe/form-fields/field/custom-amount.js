/**
 * Determines if the payment form's "Custom Amount" custom field is valid.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 */
export function isValid( paymentForm ) {
	const { cart } = paymentForm;
	const { price } = cart.getLineItem( 'base' );

	// Don't validated if selected price option is not custom.
	if ( ! price.id.startsWith( 'simpay_' ) ) {
		return true;
	}

	const customAmountInput = paymentForm.querySelector(
		'input[name="simpay_custom_price_amount"]'
	);

	if ( ! customAmountInput ) {
		return true;
	}

	return '' !== customAmountInput.value;
}

/**
 * Displays an inline error under the custom amount.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 * @param {string} _errorMessage Error message override.
 */
export function showError( paymentForm, _errorMessage = null ) {
	const errorEl = paymentForm.querySelector( '.simpay-custom-amount-error' );

	if ( ! errorEl ) {
		return;
	}

	const { cart, convertToDollars, formatCurrency, i18n, state } = paymentForm;
	const {
		price: { unit_amount_min: unitAmountMin },
	} = state;
	const errorMessage = i18n.emptyCustomAmountError.replace(
		'%s',
		formatCurrency(
			cart.isZeroDecimal()
				? unitAmountMin
				: convertToDollars( unitAmountMin ),
			true,
			cart.getCurrencySymbol(),
			cart.isZeroDecimal()
		)
	);

	errorEl.innerText = _errorMessage || errorMessage;
	errorEl.style.display = 'block';
	wp.a11y.speak( errorMessage, 'assertive' );

	paymentForm
		.querySelector( '.simpay-custom-amount-container' )
		.classList.add( 'is-error' );

	paymentForm
		.querySelector( 'input[name="simpay_custom_price_amount"]' )
		.focus();
}

/**
 * Hides an inline error under the custom amount.
 *
 * @since 4.7.0
 *
 * @param {Object} paymentForm Payment form.
 */
export function hideError( paymentForm ) {
	const errorEl = paymentForm.querySelector( '.simpay-custom-amount-error' );

	if ( ! errorEl ) {
		return;
	}

	errorEl.innerText = '';
	errorEl.style.display = 'none';
}

/**
 * Show/hides the Custom Amount field depending on the selected price.
 *
 * @param {jQuery} $paymentForm Form element jQuery object.
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function onChangePrice( { paymentForm } ) {
	const { cart, convertToDollars, formatCurrency } = paymentForm;
	const { price } = cart.getLineItem( 'base' );
	const {
		id,
		unit_amount: unitAmount,
		currency_symbol: currencySymbol,
	} = price;

	const customAmountInputWrapper = paymentForm.querySelector(
		'.simpay-custom-amount-container'
	);

	if ( ! customAmountInputWrapper ) {
		return;
	}

	const customAmountCurrencySymbolEl = customAmountInputWrapper.querySelector(
		'.simpay-currency-symbol'
	);

	const customAmountInput = paymentForm.querySelector(
		'input[name="simpay_custom_price_amount"]'
	);

	// Show/hide element.
	customAmountInputWrapper.style.display = id.startsWith( 'simpay_' )
		? 'block'
		: 'none';

	// Update currency symbol.
	customAmountCurrencySymbolEl.innerHTML = currencySymbol;

	// Update cart.
	const item = cart.getLineItem( 'base' );

	item.update( {
		...item,
		amount: parseInt( unitAmount ),
	} );

	const { prefillDefault } = customAmountInput.dataset;

	// Update prefilled value or placeholder.
	const amount = cart.isZeroDecimal()
		? unitAmount
		: convertToDollars( unitAmount );

	const amountToFill = id.startsWith( 'simpay_' )
		? formatCurrency(
				amount,
				false,
				cart.getCurrencySymbol(),
				cart.isZeroDecimal()
		  )
		: '';

	if ( '' !== prefillDefault ) {
		customAmountInput.value = amountToFill;
	} else {
		customAmountInput.placeholder = amountToFill;
		customAmountInput.value = '';
	}
}

/**
 * Updates the amount when the value of the Custom Amount input changes.
 *
 * @param {string} amount Input value.
 * @param {jQuery} $paymentForm Form element jQuery object.
 */
function onChangeAmount( amount, $paymentForm ) {
	// Save validation for submission.
	if ( '' === amount ) {
		return;
	}

	const { paymentForm } = $paymentForm;
	const {
		cart,
		convertToCents,
		convertToDollars,
		formatCurrency,
		i18n,
		unformatCurrency,
	} = paymentForm;

	const item = cart.getLineItem( 'base' );
	const { price } = item;
	const { unit_amount_min: unitAmountMin } = price;
	let validCustomAmount;

	const customAmount = cart.isZeroDecimal()
		? unformatCurrency( amount )
		: convertToCents( unformatCurrency( amount ) );

	const customAmountInputEl = paymentForm.querySelector(
		'input[name="simpay_custom_price_amount"]'
	);
	const unitAmountMinCurrency = formatCurrency(
		cart.isZeroDecimal()
			? unitAmountMin
			: convertToDollars( unitAmountMin ),
		true,
		cart.getCurrencySymbol(),
		cart.isZeroDecimal()
	);

	// Amount is too low.
	if ( customAmount < unitAmountMin ) {
		paymentForm.setState( {
			customAmount: unitAmountMin,
		} );

		customAmountInputEl.parentNode.classList.add( 'is-error' );
		customAmountInputEl.value = '';
		customAmountInputEl.focus();

		const errorMessage = i18n.minCustomAmountError.replace(
			'%s',
			unitAmountMinCurrency
		);

		showError( paymentForm, errorMessage );

		// Amount is valid.
	} else {
		hideError( paymentForm );

		paymentForm.setState( {
			customAmount,
		} );

		item.update( {
			...item,
			amount: customAmount,
		} );

		customAmountInputEl.parentNode.classList.remove( 'is-error' );
		customAmountInputEl.value = formatCurrency(
			cart.isZeroDecimal()
				? validCustomAmount
				: convertToDollars( customAmount ),
			false,
			cart.getCurrencySymbol(),
			cart.isZeroDecimal()
		);
	}

	// Alert the rest of the components they need to update.
	$paymentForm.trigger( 'totalChanged', [ $paymentForm ] );
}

/**
 * Binds events to the Custom Amount input.
 *
 * @param {jQuery} $paymentForm Form element jQuery object.
 */
function bindAmountInput( $paymentForm ) {
	const { paymentForm } = $paymentForm;
	const customAmountInput = paymentForm.querySelector(
		'input[name="simpay_custom_price_amount"]'
	);

	if ( ! customAmountInput ) {
		return;
	}

	customAmountInput.addEventListener( 'blur', ( { target } ) => {
		onChangeAmount( target.value, $paymentForm );
	} );
}

/**
 * Sets up the "Custom Amount" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupCustomAmount( $paymentForm ) {
	// Update amount when a price option selection changes.
	$paymentForm.on( 'simpayMultiPlanChanged', () => {
		hideError( $paymentForm.paymentForm );
		onChangePrice( $paymentForm );
	} );

	// Update amount when the input changes.
	bindAmountInput( $paymentForm );
}

export default setupCustomAmount;
