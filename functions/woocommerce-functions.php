<?php

// custom catalog woocommerce 
function custom_woocommerce_catalog_orderby($options)
{
  // Customize the sorting options as needed
  $options['custom_option'] = 'Custom Option';
  return $options;
}

add_filter('woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby');


// custom title for shop product 
function custom_shop_loop_product_title()
{
?>
  <h6 class="pc__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
  <?php
}


function custom_shop_loop_price()
{
  global $product;

  // Get the product object
  $product = wc_get_product(get_the_ID());
  $currency_symbol = get_woocommerce_currency_symbol();
  // Check if the product is on sale
  if ($product->is_on_sale()) {
    // Product is on sale, show both regular and sale prices
  ?>
    <div class="product-card__price d-flex">
      <span class="money price price-old"><?php echo $currency_symbol; ?><?php echo $product->get_regular_price(); ?></span>
      <span class="money price price-sale"><?php echo $currency_symbol; ?><?php echo $product->get_sale_price(); ?></span>
    </div>
  <?php
  } else {
    // Product is not on sale, show regular price only
  ?>
    <div class="product-card__price d-flex">
      <span class="money price"><?php echo $currency_symbol; ?><?php echo $product->get_regular_price(); ?></span>
    </div>
  <?php
  }
}


// custom shop loop thumbnail 

function custom_shop_loop_product_thumbnail()
{ ?>
  <div class="product-card-wrapper">
    <div class="product-card mb-3 mb-md-4 mb-xxl-5">

      <div class="pc__img-wrapper">
        <div class="swiper-container background-img js-swiper-slider swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" data-settings="{&quot;resizeObserver&quot;: true}">
          <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-330px, 0px, 0px);" id="swiper-wrapper-b8933e101a96b4a25" aria-live="polite">
            <div class="swiper-slide swiper-slide-duplicate swiper-slide-prev swiper-slide-duplicate-next" data-swiper-slide-index="1" style="width: 330px;" role="group" aria-label="1 / 4">
              <a href="product1_simple.html"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/products/product_1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
            </div>
            <div class="swiper-slide swiper-slide-active" data-swiper-slide-index="0" style="width: 330px;" role="group" aria-label="2 / 4">
              <a href="product1_simple.html"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/products/product_1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
            </div><!-- /.pc__img-wrapper -->
            <div class="swiper-slide swiper-slide-next swiper-slide-duplicate-prev" data-swiper-slide-index="1" style="width: 330px;" role="group" aria-label="3 / 4">
              <a href="product1_simple.html"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/products/product_1-1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
            </div><!-- /.pc__img-wrapper -->
            <div class="swiper-slide swiper-slide-duplicate swiper-slide-duplicate-active" data-swiper-slide-index="0" style="width: 330px;" role="group" aria-label="4 / 4">
              <a href="product1_simple.html"><img loading="lazy" src="<?php echo get_template_directory_uri(); ?>/images/products/product_1.jpg" width="330" height="400" alt="Cropped Faux leather Jacket" class="pc__img"></a>
            </div>
          </div>
          <span class="pc__img-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-b8933e101a96b4a25"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_prev_sm"></use>
            </svg></span>
          <span class="pc__img-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-b8933e101a96b4a25"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_next_sm"></use>
            </svg></span>
          <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        </div>

        <?php



        global $product;
        $product = wc_get_product(get_the_ID());

        ?>
        <a class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" href="<?php home_url(); ?>?add-to-cart=<?php echo $product->get_id(); ?>&quantity=1" data-aside="cartDrawer" title="Add To Cart" data-product_id="<?php echo esc_attr($product->get_id()); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>" data-quantity="1">
          Add To Cart
        </a>




      </div>


      <div class="pc__info position-relative">

        <?php
        $categories = get_the_terms(get_the_ID(), 'product_cat');
        if ($categories && is_array($categories)) {
          $category = reset($categories);  ?>
          <p class="pc__category"><?php echo esc_html($category->name); ?></p>
        <?php } ?>



        <?php
        custom_shop_loop_product_title();
        custom_shop_loop_price();

        ?>




        <div class="product-card__review d-flex align-items-center">
          <div class="reviews-group d-flex">
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star"></use>
            </svg>
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star"></use>
            </svg>
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star"></use>
            </svg>
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star"></use>
            </svg>
            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
              <use href="#icon_star"></use>
            </svg>
          </div>
          <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
        </div>

        <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
          <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_heart"></use>
          </svg>
        </button>
      </div>


      <a href="http://localhost/ecommerce_theme/?add-to-cart=42&quantity=1"> add to cart </a>

    </div>
  </div>


<?php
}


// add_action('woocommerce_shop_loop_item_title','custom_shop_loop_product_title',10) ;  
// add_action('woocommerce_before_shop_loop_item_title','custom_shop_loop_product_thumbnail',10) ;  
// add_action('woocommerce_after_shop_loop_item_title','custom_shop_loop_price',10) ; 





remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10); 





function add_new_damage() {

  if (isset($_POST['submit_product_damage'])) {
      $product_id = sanitize_text_field($_POST['select']);
      $date = sanitize_text_field($_POST['date']);
      $note = sanitize_text_field($_POST['note']);
      $number = $_POST['number'];

      // Save data to the product_damage table
      global $wpdb;
      $table_name = $wpdb->prefix . 'product_damage';
      $data = array(
          'product_id' => $product_id,
          'date' => $date,
          'note' => $note,
          'number' => $number,
      );
      $wpdb->insert($table_name, $data);

      // Get current stock
      $current_stock = get_post_meta($product_id, '_stock', true);

      // Update stock in WooCommerce by subtracting $number
      if ($current_stock >= $number) {
           $update_stock = $current_stock- $number ; 
           wc_update_product_stock($product_id, $update_stock);
      } else {
          // Handle the case where the stock is less than $number, maybe set it to 0 or log an error
          wc_update_product_stock($product_id, 0);
      }
  }
}

add_action('init', 'add_new_damage');



function add_new_purchase() {

  if (isset($_POST['submit_product_purchase'])) {
      $product_id = sanitize_text_field($_POST['select']);
      $date = sanitize_text_field($_POST['date']);
      $note = sanitize_text_field($_POST['note']);
      $number = $_POST['number'];

      // Save data to the product_damage table
      global $wpdb;
      $table_name = $wpdb->prefix . 'product_damage';
      $data = array(
          'product_id' => $product_id,
          'date' => $date,
          'note' => $note,
          'number' => $number,
      );
      $wpdb->insert($table_name, $data);
      // Get current stock
      $current_stock = get_post_meta($product_id, '_stock', true);
      // Update stock in WooCommerce by subtracting $number
      if ($current_stock >= $number) {
           $update_stock = $current_stock + $number ; 
           wc_update_product_stock($product_id, $update_stock);
      } else {
          // Handle the case where the stock is less than $number, maybe set it to 0 or log an error
          wc_update_product_stock($product_id, 0);
      }
  }
}

add_action('init', 'add_new_purchase'); 





/**
 * Add a new input field for Purchase Price in variable product variations
 */
function add_variation_purchase_price_field( $loop, $variation_data, $variation ) {
  woocommerce_wp_text_input( array(
      'id'          => '_purchase_price[' . $loop . ']',
      'label'       => __('Purchase Price', 'woocommerce'),
      'placeholder' => __('Enter Purchase Price', 'woocommerce'),
      'desc_tip'    => 'true',
      'description' => __('Enter the purchase price for this variation.', 'woocommerce'),
      'value'       => get_post_meta( $variation->ID, '_purchase_price', true ),
      'wrapper_class' => 'form-row form-row-full',
  ));
}
add_action( 'woocommerce_variation_options_pricing', 'add_variation_purchase_price_field', 10, 3 );

/**
* Save the purchase price value when the product is saved
*/
function save_variation_purchase_price_field( $variation_id, $i ) {
  $purchase_price = $_POST['_purchase_price'][$i];
  if (isset($purchase_price)) {
      update_post_meta( $variation_id, '_purchase_price', esc_attr( $purchase_price ) );
  }
}
add_action( 'woocommerce_save_product_variation', 'save_variation_purchase_price_field', 10, 2 );


/**
 * Add a new input field for Purchase Price in product variations (simple and variable)
 */
function add_purchase_price_field() {
  woocommerce_wp_text_input( array(
      'id'          => '_purchase_price',
      'label'       => __('Purchase Price', 'woocommerce'),
      'placeholder' => __('Enter Purchase Price', 'woocommerce'),
      'desc_tip'    => 'true',
      'description' => __('Enter the purchase price for this product.', 'woocommerce'),
      'wrapper_class' => 'form-row form-row-full',
      'value'       => get_post_meta( get_the_ID(), '_purchase_price', true ),
  ));
}
add_action( 'woocommerce_product_options_pricing', 'add_purchase_price_field' );

/**
* Save the purchase price value when the product is saved
*/
function save_purchase_price_field( $product_id ) {
  $purchase_price = isset( $_POST['_purchase_price'] ) ? sanitize_text_field( $_POST['_purchase_price'] ) : '';
  update_post_meta( $product_id, '_purchase_price', $purchase_price );
}
add_action( 'woocommerce_process_product_meta', 'save_purchase_price_field' );


function enqueue_dataTables_scripts() {
  // jQuery
  wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, true);

  // DataTables CSS and JS
  wp_enqueue_style('datatables-css', 'https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css');
  wp_enqueue_script('datatables-js', 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js', array('jquery'), null, true);

  // DataTables Buttons CSS and JS
  wp_enqueue_style('datatables-buttons-css', 'https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css');
  wp_enqueue_script('datatables-buttons-js', 'https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js', array('jquery'), null, true);
  wp_enqueue_script('jszip', 'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js', array(), null, true);
  wp_enqueue_script('datatables-buttons-html5', 'https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js', array('jquery', 'jszip'), null, true);
}

add_action('admin_footer', 'enqueue_dataTables_scripts');

function custom_admin_css(){  ?> 

<style> 



.purchase_bottom {
	display: flex;
	justify-content: space-between;
}
.purchase_bottom_lft {
	display: flex;
	justify-content: center;
	align-items: center;
}
.payble_due {
	display: flex;
	gap: 18px;
	align-items: center;
  float:left;
}
.purchase_btn input {
	background: #3cbb86;
	border: none;
	padding: 5px 20px;
	border-radius: 5px;
	color: #fff;
	font-weight: bold;
	cursor: pointer;
}
.grand-subtotal {
	display: flex;
	justify-content: center;
	align-items: center;
	gap: 10px;
}
.delete-row {
	color: red !important;
	cursor: pointer;
}
.widget_today_payble {
	background: #57c7d4 !important;
}
.widget_today_rcvble {
	background: #465161 !important;
}
.widget_stck_prchase {
	background: #fcc525 !important;
}
.widget_stck_sell {
	background: #15c377 !important;
}
.widget_today_sell_prft {
	background: #48b0f7 !important;
}
.widget_today_purchse {
	background: #f96197 !important;
}
.widget_today_expense {
	background: #f96868 !important;
}

.widget_today_sold {
	background: #465161 !important;
}
.custom_widget_box{
  background:red;
  padding:30px 50px ; 
}
.custom_widget_box h2 {
	color: #fff !important;
	font-size: 28px !important;
	font-weight: 700 !important;
  margin-bottom: -20px !important;
}
.custom_widget_box p {
	color: #fff !important;
	font-size: 20px !important; 
}   

/* style for top 10 products  */

.get_top_10_pro{ margin-top: 20px; } 

</style>

<?php
}
add_action('admin_footer','custom_admin_css') ; 



// function set_default_product_profit( $order_id ) {
//   // Get the order object
//   $order = wc_get_order( $order_id );

//   if ( !$order || $order->get_date_created() === null ) {
//       return;
//   }

//   // Get order items
//   $items = $order->get_items();

//   // Loop through order items
//   foreach ( $items as $item_id => $item ) {  
//       // Update product_profit field with default value (20)
//       $product_id = $item->get_product_id();
//       // $product_profit = 20; // Your default value
//       $purchase_price = get_post_meta( $product_id, '_purchase_price', true );

//       // Get the regular price of the product
//       $regular_price = get_post_meta( $product_id, '_regular_price', true );

//       // Get the sale price of the product
//       $sale_price = get_post_meta( $product_id, '_sale_price', true );

//       // Determine the price to use based on whether the product is on sale or not
//       $price_to_use = $sale_price ? $sale_price : $regular_price;

//       // Calculate profit
//       $product_profit = $price_to_use - $purchase_price;
//       $number_of_items_ordered = $item->get_quantity();
      

//       global $wpdb;
//       $wpdb->update(
//           $wpdb->prefix . 'woocommerce_order_items',
//           array(
//             'product_profit' => $product_profit ,
//             'quantity_orderd' => $number_of_items_ordered 
//           ),
//           array( 'order_item_id' => $item_id ),
//           array( '%d' ,'%d' ),
//           array( '%d' )
//       );
//   }
// }

// // Hook into order creation event
// add_action( 'woocommerce_new_order', 'set_default_product_profit' );



// function set_default_product_profit($order_id) {
//     global $wpdb;

//     // Get the order object
//     $order = wc_get_order($order_id);
//     if (!$order) {
//         return;
//     }

//     // Loop through each order item
//     foreach ($order->get_items() as $item_id => $item) {
//         $product = $item->get_product();
//         $regular_price = (float) $product->get_regular_price();
//         $sale_price = (float) $product->get_sale_price();
//         $purchase_price = (float) get_post_meta($product->get_id(), '_purchase_price', true);

//         // Use sale price if available, otherwise regular price
//         $price_to_use = !empty($sale_price) ? $sale_price : $regular_price;

//         // Calculate profit
//         $product_profit = $price_to_use - $purchase_price;
//         $number_of_items_ordered = $item->get_quantity();

//         // Update order item meta
//         wc_update_order_item_meta($item_id, 'product_profit', $product_profit);
//         wc_update_order_item_meta($item_id, 'quantity_ordered', $number_of_items_ordered);
//     }
// }

// // Hook into order creation event
// add_action('woocommerce_checkout_create_order_line_item', 'set_default_product_profit', 10, 4);


function get_order_sales_by_date() {  

  $orders = wc_get_orders( array(
      'date_paid' => date( 'Y-m-d' )
  ) );
  $total_of_all=0;
    foreach($orders as $order){
      $total = $order->get_total() ;
      $total_of_all+= $total;
    }
    
  return $total_of_all ; 

}




// get todays purchase cost   
function get_todays_purchase_cost() {  

  global $wpdb;
  $table_name = $wpdb->prefix . 'woo_purchase_orders';
  $today_date = date( 'Y-m-d');
  $query = $wpdb->prepare(
      "SELECT * FROM $table_name WHERE DATE(date) = %s",
      $today_date
  );
  $results = $wpdb->get_results( $query );

  $total_payable =0 ; 
  if ( $results ) {
      foreach ( $results as $result ) {
          $payable = $result->payable;
          $total_payable+= $payable;
      }
  } 

  return $total_payable ;
 }

// get todays sell profit 
 function get_todays_sell_profit() {  

  $orders = wc_get_orders( array(
      'date_paid' => date( 'Y-m-d' )
  ) );

  $total_sell_profit =0 ;
  $total_purchase_price = 0 ; 
  $total_ordered_amount = 0; 

  
  foreach ($orders as $order){

    global $wpdb; 
    $table_name = $wpdb->prefix . 'wc_orders';
    $order_id =   $order->id ;  
    global $wpdb;
    // Get the order object
    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    foreach ($order->get_items() as $item_id => $item) {

        $product = $item->get_product();   
        $purchase_price = (float) get_post_meta($product->get_id(), '_purchase_price', true) * $item['quantity'];
        $total_purchase_price += $purchase_price;  
    }

    $query = $wpdb->prepare(
        "SELECT * FROM $table_name WHERE id = %d",
        $order_id
    ); 

    $results = $wpdb->get_results( $query ); 
    if ( $results ) {
        foreach ( $results as $result ) {
          // echo '<pre>' ; 
          // print_r($result) ;
          $total_ordered_amount += $result->total_amount;
        }
    } 
} 

$total_sell_profit = $total_ordered_amount - $total_purchase_price ;
return $total_sell_profit ; 
 }




 // Function to calculate total expense amount for today
 function calculate_total_expense_today() {
     // Get today's date
     $today = date('m/d/Y');
     // Query expenses for today
     $args = array(
         'post_type'      => 'expense',
         'posts_per_page' => -1, 
     );
 
     $query = new WP_Query($args);
 
     // Initialize total expense amount
     $total_expense_amount = 0;
 
     // Loop through each expense and calculate total amount
     if ($query->have_posts()) {
         while ($query->have_posts()) {
             $query->the_post();
             $expense_amount = get_post_meta(get_the_ID(), 'expense-amount', true);
             $expense_date = get_post_meta(get_the_ID(), 'expense-date', true);
             if($expense_date == $today){
                $total_expense_amount += floatval($expense_amount);
             }

         }
     }

      wp_reset_postdata();
      return $total_expense_amount;

 }
 

//  total product stock sell value 
 function total_stock_sell_value(){

  $args = array(
      'post_type'      => 'product',
      'posts_per_page' => -1,
  );

  $total_stock_sale_value = 0 ; 
  $products = new WP_Query($args);

      if ($products->have_posts()) :
          while ($products->have_posts()) : $products->the_post();
              $product_id = get_the_ID();
              $available_stock = get_post_meta(get_the_ID(), '_stock', true);
              $product_price = get_post_meta($product_id, '_price', true);
              $available_stock = isset($available_stock) ? intval($available_stock) : 0; // Convert to integer and set to 0 if not set
              $product_price = isset($product_price) ? floatval($product_price) : 0.0; // Convert to float and set to 0.0 if not set

              // Perform the calculation
              $total_sale_value = $available_stock * $product_price;
              $total_stock_sale_value += $total_sale_value ;

          endwhile;
          wp_reset_postdata();

      endif;
      return $total_stock_sale_value; 

}


//  total assets value 
function total_asets_value(){

  $args = array(
      'post_type'      => 'assets',
      'posts_per_page' => -1,
  );

  $total_asset_price = 0 ; 
  $assets = new WP_Query($args);

      if ($assets->have_posts()) :
          while ($assets->have_posts()) : $assets->the_post();
              $asset_id = get_the_ID();
              $asset_price = get_post_meta($asset_id, '_assets_price', true);
              // Perform the calculation
              $total_asset_price += $asset_price ;

          endwhile;
          wp_reset_postdata();

      endif;
      return $total_asset_price; 

}


//  total product stock sell value 
function total_stock_purchase_value(){

  $args = array(
      'post_type'      => 'product',
      'posts_per_page' => -1,
  );

  $total_stock_purchase_value = 0 ; 
  $products = new WP_Query($args);

      if ($products->have_posts()) :
          while ($products->have_posts()) : $products->the_post();
              $product_id = get_the_ID();
              $available_stock = get_post_meta(get_the_ID(), '_stock', true);
              $purchase_price = get_post_meta(get_the_ID(), '_purchase_price', true) ; 
              $available_stock = isset($available_stock) ? intval($available_stock) : 0; // Convert to integer and set to 0 if not set
              $purchase_price = isset($purchase_price) ? floatval($purchase_price) : 0.0; // Convert to float and set to 0.0 if not set

              // Perform the calculation
              $total_purchase_value = $available_stock * $purchase_price;

              $total_stock_purchase_value += $total_purchase_value ;

          endwhile;
          wp_reset_postdata();

      endif;

      return $total_stock_purchase_value; 

}







// current month calculation starts  




function get_order_sales_by_this_month() {  

  // Get the current month and year
  $current_month = date('m');
  $current_year = date('Y');

  // Calculate the first and last day of the current month
  $first_day_of_month = date('Y-m-01', strtotime("$current_year-$current_month-01"));
  $last_day_of_month = date('Y-m-t', strtotime("$current_year-$current_month-01"));

  // Get orders for the current month
  $orders = wc_get_orders( array(
      'date_paid' => '>=' . $first_day_of_month,
      'date_paid' => '<=' . $last_day_of_month,
  ) );

  $total_of_all = 0;

  // Calculate total sales for the current month
  foreach($orders as $order) {
      $total = $order->get_total();
      $total_of_all += $total;
  }
  
  return $total_of_all; 
}





function get_monthly_purchase_cost() {  

  global $wpdb;
  $table_name = $wpdb->prefix . 'woo_purchase_orders';

  // Get the current month and year
  $current_month = date('m');
  $current_year = date('Y');

  // Calculate the first and last day of the current month
  $first_day_of_month = date('Y-m-01', strtotime("$current_year-$current_month-01"));
  $last_day_of_month = date('Y-m-t', strtotime("$current_year-$current_month-01"));

  $query = $wpdb->prepare(
      "SELECT * FROM $table_name WHERE date BETWEEN %s AND %s",
      $first_day_of_month,
      $last_day_of_month
  );
  $results = $wpdb->get_results( $query );

  // echo '<pre>'; 
  // print_r($results) ;

  $total_purchase_cost = 0; 

  if ( $results ) {
      foreach ( $results as $result ) {
          $payable = $result->payable;
          $total_purchase_cost += $payable;
      }
  } 

  return $total_purchase_cost;
}







function calculate_total_sellprofit_current_month() {
  

  // Get the current month and year
  $current_month = date('m');
  $current_year = date('Y');

  // Calculate the first and last day of the current month
  $first_day_of_month = date('Y-m-01', strtotime("$current_year-$current_month-01"));
  $last_day_of_month = date('Y-m-t', strtotime("$current_year-$current_month-01"));

  // Get orders for the current month
  $orders = wc_get_orders( array(
      'date_paid' => array(
          'after'     => $first_day_of_month,
          'before'    => $last_day_of_month,
          'inclusive' => true,
      ),
  ) );

  $total_sell_profit = 0;

  // Loop through each order and calculate sell profit
  foreach ($orders as $order) {
      global $wpdb; 
      $table_name = $wpdb->prefix . 'woocommerce_order_items';
      $order_id = $order->get_id(); // Updated from $order->id which is deprecated

      $query = $wpdb->prepare(
          "SELECT * FROM $table_name WHERE order_id = %d",
          $order_id
      ); 

      $results = $wpdb->get_results( $query );

      if ( $results ) {
          foreach ( $results as $result ) {
              $product_profit = $result->product_profit;
              $quantity_ordered = $result->quantity_ordered; // Corrected variable name
              $sell_profit = $product_profit * $quantity_ordered;
              $total_sell_profit += $sell_profit; 
          }
      } 
  }

  return $total_sell_profit; 


}




function calculate_total_expense_current_month() {
  // Get current month and year
  $current_month = date('m');
  $current_year = date('Y');

  // Calculate the first and last day of the current month
  $first_day_of_month = date('Y-m-01', strtotime("$current_year-$current_month-01"));
  $last_day_of_month = date('Y-m-t', strtotime("$current_year-$current_month-01"));

  // Query expenses for the current month
  $args = array(
      'post_type'      => 'expense',
      'posts_per_page' => -1,
      'meta_query'     => array(
          array(
              'key'     => 'expense-date',
              'value'   => array($first_day_of_month, $last_day_of_month),
              'compare' => 'BETWEEN',
              'type'    => 'DATE',
          ),
      ),
  );

  $query = new WP_Query($args);

  // Initialize total expense amount
  $total_expense_amount = 0;

  // Loop through each expense and calculate total amount
  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $expense_amount = get_post_meta(get_the_ID(), 'expense-amount', true);
          $total_expense_amount += floatval($expense_amount);
      }
  }

  // Reset post data
  wp_reset_postdata();

  return $total_expense_amount;
}










