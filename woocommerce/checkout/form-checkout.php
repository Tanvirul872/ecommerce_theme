<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<style>
		.shop-checkout * {
			font-family:"Rajdhani", "Jost", sans-serif;
		}
		#ship-to-different-address {
			font-size: 13px !important;
			font-weight: 400 !important;
			text-transform: uppercase !important;
			margin: 10px 0;
		}
		.select2-selection, 
		textarea {
			display: block !important;
			width: 100%;
			padding: 0.9375rem 0.9375rem 0.75rem;
			font-size: 0.875rem;
			font-weight: 400;
			line-height: 1.7143;
			color: #222222;
			background-color: #fff !important;
			background-clip: padding-box;
			border: 0.125rem solid #e4e4e4 !important;
			appearance: none;
			border-radius: 0 !important;
			box-shadow: none;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}
		textarea {
			min-height: 180px;
		}
		.select2-selection {
			height: auto !important;
		}
		.select2-container--default .select2-selection--single .select2-selection__arrow {
			top: 50%;
			transform: translateY(-50%);
		}
		.checkout-form {
			display: grid;
			grid-template-columns: 1.9fr 1fr;
		}
		@media (max-width:991px) {
			.checkout-form {
				grid-template-columns: 1fr;
			}
		}
	</style>
	<section class="shop-checkout container">
		<h2 class="page-title">Shipping and Checkout</h2>
		<div class="checkout-steps">
			<a href="shop_cart.html" class="checkout-steps__item active">
				<span class="checkout-steps__item-number">01</span>
				<span class="checkout-steps__item-title">
					<span>Shopping Bag</span>
					<em>Manage Your Items List</em>
				</span>
			</a>
			<a href="shop_checkout.html" class="checkout-steps__item active">
				<span class="checkout-steps__item-number">02</span>
				<span class="checkout-steps__item-title">
					<span>Shipping and Checkout</span>
					<em>Checkout Your Items List</em>
				</span>
			</a>
			<a href="shop_order_complete.html" class="checkout-steps__item">
				<span class="checkout-steps__item-number">03</span>
				<span class="checkout-steps__item-title">
					<span>Confirmation</span>
					<em>Review And Submit Your Order</em>
				</span>
			</a>
		</div>
		<form name="checkout-form" action="https://uomo-html.flexkitux.com/Demo1/shop_order_complete.html">
			<div class="checkout-form">
				<div class="billing-info__wrapper">
					<h4>BILLING DETAILS</h4>
					<div class="row">

						<?php if ( $checkout->get_checkout_fields() ) : ?>

						<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

						<div class="col2-set" id="customer_details">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
					
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>

						<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

						<?php endif; ?>
					</div>
				</div>
				<div class="checkout__totals-wrapper">
					<div class="sticky-content">

						<style>
							.woocommerce table.shop_table th {
								font-weight: 500;
								padding: 9px 0;
							}
							.woocommerce table.shop_table td {
								padding: 9px 0;
							}
							.cs_table {
								border-radius: 0 !important;
								padding: 25px !important;
								border: 1px solid #222 !important;
							}
							.woocommerce-checkout-payment {
								background: transparent !important;
								border-radius: 0 !important;
							}
							.wc_payment_methods {
								padding: 25px !important;
								border: 1px solid #e4e4e4 !important;
							}
							.payment_box {
								background-color: #f7f7f7 !important;
							}
							.payment_box::before {
								border-color: #f7f7f7 !important;
								border-right-color: transparent !important;
								border-left-color: transparent !important;
								border-top-color: transparent !important;
							}
							.woocommerce-terms-and-conditions-wrapper {
								margin-top: 20px;
							}
							.form-row.place-order {
								padding: 0 !important;
    							margin-top: 20px !important;
							}
							.cs_btn2 {
								border-radius: 0 !important;
								text-transform: uppercase !important;
								font-weight: 500 !important;
								background: #222222 !important;
							}
						</style>

						<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action( 'woocommerce_checkout_order_review' ); ?>
						</div>

						<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
					</div>
				</div>
			</div>
		</form>
	</section>
	<div class="mb-5 pb-xl-5"></div>


</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
