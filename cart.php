<?php 
  
  /**

* Template Name: Cart

**/
get_header(); 
?>

  <main>
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Cart</h2>
      <div class="checkout-steps">
        <a href="shop_cart.html" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="shop_checkout.html" class="checkout-steps__item">
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
      <div class="shopping-cart">
        <div class="cart-table__wrapper">
          <table class="cart-table">
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



            <?php 
            
            global $woocommerce;

// Get the cart items
$cart_items = $woocommerce->cart->get_cart();

// Loop through each cart item
foreach ($cart_items as $cart_item_key => $cart_item) {
    // Get the product ID
    $product_id = $cart_item['product_id'];

    // Now you can use $product_id as needed
    echo 'Product ID: ' . $product_id . '<br>';
}

?>


            <?php
// Assuming you are inside the WordPress loop
global $woocommerce;

// Get the cart items
$cart_items = $woocommerce->cart->get_cart();




// echo '<pre>' ; 
// print_r($cart_items) ;  


// Loop through each cart item
foreach ($cart_items as $cart_item_key => $cart_item) {


  
  
    // Get product data
    $product_id = $cart_item['product_id'];
    $variation_id = $cart_item['variation_id'];
    $product = wc_get_product($product_id);
    $attributes = $product->get_attributes();
    $product_name = $product->get_name();
    $product_image = get_the_post_thumbnail_url($product_id, 'full');
    // $product_color = $cart_item['variation']['attribute_pa_color']; // Adjust as needed
    // $product_size = $attributes['pa_size']['options']; // Adjust as needed
    $product_price = wc_price($product->get_price());
    $quantity = $cart_item['quantity'];
    $subtotal = wc_price($product->get_price() * $quantity);
    

    $sizes = get_the_terms(56, 'pa_size');


  
    ?>

    <tr>
        <td>
            <div class="shopping-cart__product-item">
                <img loading="lazy" src="<?php echo $product_image; ?>" width="120" height="120" alt="" />
            </div>
        </td>
        <td>
            <div class="shopping-cart__product-item__detail">
                <h4><?php echo $product_name; ?></h4>
                <ul class="shopping-cart__product-item__options">
                    <li>Size: 
                       <?php 
                      //  print_r($product_size) ; 
                      //  foreach($product_size as $size_id){
                      //   $selected_size =  get_term_by('term_id', $size_id, 'pa_size'); 
                      //    echo $selected_size->name ; 
                      //  } 
                       ?>
                   </li>
                    <li><?php // echo 'Size: ' . $product_size; ?></li>
                </ul>
            </div>
        </td>
        <td>
            <span class="shopping-cart__product-price"><?php echo $product_price; ?></span>
        </td>
        <td>
            <div class="qty-control position-relative">
                <input type="number" name="quantity" value="<?php echo $quantity; ?>" min="1" class="qty-control__number text-center">
                <div class="qty-control__reduce">-</div>
                <div class="qty-control__increase">+</div>
            </div><!-- .qty-control -->
        </td>
        <td>
            <span class="shopping-cart__subtotal"><?php echo $subtotal; ?></span>
        </td>
        <td>
            <a href="#" class="remove-cart">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z"/>
                    <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z"/>
                </svg>                  
            </a>
        </td>
    </tr>

<?php
}
?>

          


              



            </tbody>
          </table>
          <div class="cart-table-footer">
            <form action="#" class="position-relative bg-body">
              <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
              <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="APPLY COUPON">
            </form>
            <button class="btn btn-light">UPDATE CART</button>
          </div>
        </div>
        <div class="shopping-cart__totals-wrapper">
          <div class="sticky-content">
            <div class="shopping-cart__totals">
              <h3>Cart Totals</h3>
              <table class="cart-totals">
                <tbody>
                  <tr>
                    <th>Subtotal</th>
                    <td>$1300</td>
                  </tr>
                  <tr>
                    <th>Shipping</th>
                    <td>
                      <div class="form-check">
                        <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="free_shipping">
                        <label class="form-check-label" for="free_shipping">Free shipping</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="flat_rate">
                        <label class="form-check-label" for="flat_rate">Flat rate: $49</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="local_pickup">
                        <label class="form-check-label" for="local_pickup">Local pickup: $8</label>
                      </div>
                      <div>Shipping to AL.</div>
                      <div>
                        <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <th>VAT</th>
                    <td>$19</td>
                  </tr>
                  <tr>
                    <th>Total</th>
                    <td>$1319</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="mobile_fixed-btn_wrapper">
              <div class="button-wrapper container">
                <button class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <div class="mb-5 pb-xl-5"></div> 


  <?php get_footer(); ?>