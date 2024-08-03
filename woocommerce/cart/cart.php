<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined("ABSPATH") || exit();

do_action("woocommerce_before_cart");
?>

<form class="woocommerce-cart-form" action="<?php echo esc_url(
    wc_get_cart_url()
); ?>" method="post">
	<?php do_action("woocommerce_before_cart_table"); ?>

  <style>
    .woocommerce a.remove {
      color: #919191 !important;
      text-decoration: none;
      font-weight: normal !important;
  }
    .woocommerce a.remove:hover {
      background: transparent !important;
      color: #919191 !important;
    }
    .cs_btn {
      border-radius: 0 !important;
      padding: 10px 60px !important;
      font-weight: normal !important;
      color: #000;
      text-transform: uppercase !important;
    }
  </style>
  <main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
        <h2 class="page-title">Cart</h2>
        
        <div class="shopping-cart">
            <div class="cart-table__wrapper">
                <table class="cart-table" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Product</th>
                      <th></th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php do_action("woocommerce_before_cart_contents"); ?>

                    <?php foreach (
                        WC()->cart->get_cart()
                        as $cart_item_key => $cart_item
                    ) {
                        $_product = apply_filters(
                            "woocommerce_cart_item_product",
                            $cart_item["data"],
                            $cart_item,
                            $cart_item_key
                        );
                        $product_id = apply_filters(
                            "woocommerce_cart_item_product_id",
                            $cart_item["product_id"],
                            $cart_item,
                            $cart_item_key
                        );
                        /**
                         * Filter the product name.
                         *
                         * @since 2.1.0
                         * @param string $product_name Name of the product in the cart.
                         * @param array $cart_item The product in the cart.
                         * @param string $cart_item_key Key for the product in the cart.
                         */
                        $product_name = apply_filters(
                            "woocommerce_cart_item_name",
                            $_product->get_name(),
                            $cart_item,
                            $cart_item_key
                        );

                        if (
                            $_product &&
                            $_product->exists() &&
                            $cart_item["quantity"] > 0 &&
                            apply_filters(
                                "woocommerce_cart_item_visible",
                                true,
                                $cart_item,
                                $cart_item_key
                            )
                        ) {
                            $product_permalink = apply_filters(
                                "woocommerce_cart_item_permalink",
                                $_product->is_visible()
                                    ? $_product->get_permalink($cart_item)
                                    : "",
                                $cart_item,
                                $cart_item_key
                            ); ?>
                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(
                            apply_filters(
                                "woocommerce_cart_item_class",
                                "cart_item",
                                $cart_item,
                                $cart_item_key
                            )
                        ); ?>">

                          <td class="product-thumbnail">
                            <?php
                            // Set the desired thumbnail size
                            $thumbnail_size = [120, 120];

                            // Get the thumbnail with the specified size
                            $thumbnail = apply_filters(
                                "woocommerce_cart_item_thumbnail",
                                $_product->get_image($thumbnail_size),
                                $cart_item,
                                $cart_item_key
                            );

                            if (!$product_permalink) {
                                echo $thumbnail; // PHPCS: XSS ok.
                            } else {
                                printf(
                                    '<a href="%s">%s</a>',
                                    esc_url($product_permalink),
                                    $thumbnail
                                ); // PHPCS: XSS ok.
                            }
                            ?>
                          </td>

                          <td class="product-name" data-title="<?php esc_attr_e(
                              "Product",
                              "woocommerce"
                          ); ?>">
                            <?php
                            if (!$product_permalink) {
                                echo wp_kses_post($product_name . "&nbsp;");
                            } else {
                                /**
                                 * This filter is documented above.
                                 *
                                 * @since 2.1.0
                                 */
                                echo wp_kses_post(
                                    apply_filters(
                                        "woocommerce_cart_item_name",
                                        sprintf(
                                            '<a href="%s">%s</a>',
                                            esc_url($product_permalink),
                                            $_product->get_name()
                                        ),
                                        $cart_item,
                                        $cart_item_key
                                    )
                                );
                            }

                            do_action(
                                "woocommerce_after_cart_item_name",
                                $cart_item,
                                $cart_item_key
                            );

                            // Meta data.
                            echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                            // Backorder notification.
                            if (
                                $_product->backorders_require_notification() &&
                                $_product->is_on_backorder(
                                    $cart_item["quantity"]
                                )
                            ) {
                                echo wp_kses_post(
                                    apply_filters(
                                        "woocommerce_cart_item_backorder_notification",
                                        '<p class="backorder_notification">' .
                                            esc_html__(
                                                "Available on backorder",
                                                "woocommerce"
                                            ) .
                                            "</p>",
                                        $product_id
                                    )
                                );
                            }
                            ?>
                          </td>

                          <td class="product-price" data-title="<?php esc_attr_e(
                              "Price",
                              "woocommerce"
                          ); ?>">
                            <?php echo apply_filters(
                                "woocommerce_cart_item_price",
                                WC()->cart->get_product_price($_product),
                                $cart_item,
                                $cart_item_key
                            );
                            // PHPCS: XSS ok.
                            ?>
                          </td>

                          <td class="product-quantity" data-title="<?php esc_attr_e(
                              "Quantity",
                              "woocommerce"
                          ); ?>">
                            <?php if ($_product->is_sold_individually()) {
                                $min_quantity = 1;
                                $max_quantity = 1;
                            } else {
                                $min_quantity = 0;
                                $max_quantity = $_product->get_max_purchase_quantity();
                            } ?>
                            <div class="qty-control position-relative">
                                <?php $product_quantity = woocommerce_quantity_input(
                                    [
                                        "input_name" => "cart[{$cart_item_key}][qty]",
                                        "input_value" => $cart_item["quantity"],
                                        "max_value" => $max_quantity,
                                        "min_value" => $min_quantity,
                                        "product_name" => $product_name,
                                        "classes" =>
                                            "qty-control__number text-center", // Add classes for styling
                                    ],
                                    $_product,
                                    false
                                ); ?>
                                <?php echo apply_filters(
                                    "woocommerce_cart_item_quantity",
                                    $product_quantity,
                                    $cart_item_key,
                                    $cart_item
                                );
                            // PHPCS: XSS ok.
                            ?>
                                <div class="qty-control__reduce">-</div>
                                <div class="qty-control__increase">+</div>
                            </div>
                            <!-- .qty-control -->
                          </td>


                          <td class="product-subtotal" data-title="<?php esc_attr_e(
                              "Subtotal",
                              "woocommerce"
                          ); ?>">
                            <?php echo apply_filters(
                                "woocommerce_cart_item_subtotal",
                                WC()->cart->get_product_subtotal(
                                    $_product,
                                    $cart_item["quantity"]
                                ),
                                $cart_item,
                                $cart_item_key
                            );
                            // PHPCS: XSS ok.
                            ?>
                          </td>

                          <td class="product-remove">
                            <?php echo apply_filters(
                                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                "woocommerce_cart_item_remove_link",
                                sprintf(
                                    '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                    esc_url(
                                        wc_get_cart_remove_url($cart_item_key)
                                    ),
                                    /* translators: %s is the product name */
                                    esc_attr(
                                        sprintf(
                                            __(
                                                "Remove %s from cart",
                                                "woocommerce"
                                            ),
                                            wp_strip_all_tags($product_name)
                                        )
                                    ),
                                    esc_attr($product_id),
                                    esc_attr($_product->get_sku())
                                ),
                                $cart_item_key
                            ); ?>
                          </td>
                        </tr>
                        <?php
                        }
                    } ?>

                    <?php do_action("woocommerce_cart_contents"); ?>

                    <tr>
                      <td colspan="6" class="actions">

                        <?php if (wc_coupons_enabled()) { ?>
                            <style>
                                .coupon {
                                    display: flex;
                                    max-width: 400px;
                                }
                                .coupon button {
                                    min-width: 155px;
                                }
                                .cart-table-footer {
                                    margin-top: -60px;
                                }
                                @media (max-width: 991px) {
                                    .cart-table-footer {
                                        margin-top: 10px;
                                        width: calc(100% + 80px);
                                    }
                                    .cart-table-footer button {
                                        width: 100%;
                                    }
                                    #coupon_code {
                                        width: calc(100% + 175px);
                                    }
                                }
                            </style>
                          <div class="coupon">
                            <label for="coupon_code" class="screen-reader-text"><?php esc_html_e(
                                "Coupon:",
                                "woocommerce"
                            ); ?></label> <input type="text" name="coupon_code" class="input-text form-control" id="coupon_code" value="" placeholder="<?php esc_attr_e(
                                "Coupon code",
                                "woocommerce"
                            ); ?>" /> <button type="submit" class="button<?php echo esc_attr(
                                wc_wp_theme_get_element_class_name("button")
                                    ? " " . wc_wp_theme_get_element_class_name("button")
                                    : ""
                            ); ?>" name="apply_coupon" value="<?php esc_attr_e(
                                "Apply coupon",
                                "woocommerce"
                            ); ?>"><?php esc_html_e("Apply coupon", "woocommerce"); ?></button>
                            <?php do_action("woocommerce_cart_coupon"); ?>
                          </div>
                        <?php } ?>

                        <div class="cart-table-footer pt-0 justify-content-end">
                          <button type="submit" class="cs_btn btn btn-light button<?php echo esc_attr(
                              wc_wp_theme_get_element_class_name("button")
                                  ? " " .
                                      wc_wp_theme_get_element_class_name(
                                          "button"
                                      )
                                  : ""
                          ); ?>" name="update_cart" value="<?php esc_attr_e(
                              "Update cart",
                              "woocommerce"
                          ); ?>"><?php esc_html_e("Update cart", "woocommerce"); ?></button>
                        </div>
                        
                        <script>
                            jQuery('.qty-control__increase, .qty-control__reduce').on('click', function(){
                                jQuery('.cs_btn').removeAttr('disabled');
                            });
                        </script>

                        <?php do_action("woocommerce_cart_actions"); ?>

                        <?php wp_nonce_field(
                            "woocommerce-cart",
                            "woocommerce-cart-nonce"
                        ); ?>
                      </td>
                    </tr>

                    <?php do_action("woocommerce_after_cart_contents"); ?>
                  </tbody>
                </table>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>Cart Totals</h3>
                        <table class="cart-totals">
                            <tbody>
                              <?php
                              $total = 0;

                              foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                                  $_product = $cart_item['data'];
                                  $subtotal = $_product->get_price() * $cart_item['quantity'];
                                  $total += $subtotal;
                              }
                              ?>
                                <tr>
                                    <th>Total</th>
                                    <td><?php echo wc_price($total); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="<?= home_url('checkout');?>" class="btn btn-primary btn-checkout d-flex justify-content-center align-items-center">PROCEED TO CHECKOUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </main>

  <div class="mb-5 pb-xl-5"></div>

	<?php do_action("woocommerce_after_cart_table"); ?>
</form>

