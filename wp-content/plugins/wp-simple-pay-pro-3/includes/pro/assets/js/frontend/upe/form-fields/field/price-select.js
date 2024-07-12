/**
 * Updates the cart when a price option changes.
 *
 * @param {HTMLElement} priceEl Selected price option.
 * @param {jQuery} $paymentForm Form element jQuery object.
 */
function onChangePrice( priceEl, $paymentForm ) {
	const { paymentForm } = $paymentForm;
	const { cart, error, setState } = paymentForm;
	const price = JSON.parse( priceEl.dataset.price );

	// Clear any previous error associated with the price.
	error( '' );

	const {
		id,
		can_recur: canRecur,
		recurring,
		line_items: lineItems,
		unit_amount: unitAmount,
	} = price;
	const { trial_period_days: trialPeriodDays = false } = recurring || {};

	// Update cart base item.
	const item = cart.getLineItem( 'base' );
	const args = {
		...item,
		amount: parseInt( unitAmount ),
		title: price.label || price.generated_label,
		price,
	};

	if ( recurring && false === canRecur ) {
		args.subscription = {
			isTrial: recurring.trial_period_days
				? parseInt( recurring.trial_period_days )
				: false,
			interval: recurring.interval,
			intervalCount: parseInt( recurring.interval_count ),
		};
	} else {
		args.subscription = false;
	}

	item.update( args );

	// Update fees.
	const setupFeeItem = cart.getLineItem( 'setup-fee' );
	const planSetupFeeItem = cart.getLineItem( 'plan-setup-fee' );

	setupFeeItem.update( {
		...setupFeeItem,
		amount:
			lineItems && lineItems[ 0 ] && false === canRecur
				? parseInt( lineItems[ 0 ].unit_amount )
				: 0,
	} );

	planSetupFeeItem.update( {
		...planSetupFeeItem,
		amount:
			lineItems && lineItems[ 1 ] && false === canRecur
				? parseInt( lineItems[ 1 ].unit_amount )
				: 0,
	} );

	const isCustomAmount = id.startsWith( 'simpay_' );

	setState( {
		price,
		isCustomAmount,
		customAmount: isCustomAmount ? unitAmount : null,
		isTrial: trialPeriodDays,
	} );

	// Alert the rest of components a price has changed.
	$paymentForm.trigger( 'simpayMultiPlanChanged', [ price, $paymentForm ] );

	// Alert the rest of the components they need to update.
	$paymentForm.trigger( 'totalChanged', [ $paymentForm ] );
}

/**
 * Sets up the "Price Select" custom field.
 *
 * @since 4.7.0
 *
 * @param {jQuery} $paymentForm Payment form
 * @param {Object} $paymentForm.paymentForm Payment form.
 */
function setupPriceSelect( $paymentForm ) {
	const { paymentForm } = $paymentForm;
	const priceOptions = paymentForm.querySelector(
		'.simpay-plan-select-container'
	);

	if ( ! priceOptions ) {
		return;
	}

	const { displayType } = priceOptions.dataset;
	let activeItemSelector;

	const priceListEls = paymentForm.querySelectorAll(
		'[name="simpay_price"]'
	);

	if ( 'dropdown' === displayType ) {
		activeItemSelector = ':selected';
	} else {
		activeItemSelector = ':checked';
	}

	// Use a jQuery selector for better :checked and :selected support.
	let activeItem = $paymentForm.find(
		`.simpay-plan-wrapper ${ activeItemSelector }`
	)[ 0 ];

	if ( ! activeItem ) {
		if ( 'dropdown' === displayType ) {
			activeItem = priceOptions.querySelector( 'option:not([disabled])' );
			activeItem.selected = true;
		} else {
			activeItem = priceOptions.querySelector( 'input:not([disabled])' );
			activeItem.checked = true;
		}
	}

	// Set on change.
	priceListEls.forEach( ( priceEl ) => {
		priceEl.addEventListener( 'change', ( { target } ) => {
			let _target;

			if ( 'dropdown' === displayType ) {
				_target = target.options[ target.selectedIndex ];
			} else {
				_target = target;
			}

			onChangePrice( _target, $paymentForm );
		} );
	} );

	// Set on page load.
	onChangePrice( activeItem, $paymentForm );
}

export default setupPriceSelect;
