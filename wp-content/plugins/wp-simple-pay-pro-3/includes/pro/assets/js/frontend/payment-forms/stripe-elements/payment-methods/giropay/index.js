/**
 * Internal dependencies.
 */
import { default as setup } from './setup.js';
import { default as submit } from './submit.js';

const { registerPaymentMethod } = window.wpsp.paymentForms;

registerPaymentMethod( 'giropay', {
	setup,
	submit,
} );
