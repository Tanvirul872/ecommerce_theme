<?php


add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');


function filter_products()
{
    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
    ];

    $cat_type = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';


    if (!empty($cat_type)) {
        $args['tax_query'][] = [
            'taxonomy' => 'product_cat',
            'field'    => 'slug',
            'terms'    => $cat_type,
        ];
    }

    $products = new WP_Query($args);

    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            $product = wc_get_product();
?>
            <div class="product-item">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                <p class="product-name"><?php the_title(); ?></p>
                <p class="product-sku">SKU: <?php echo esc_html($product->get_sku()); ?></p>
                <p class="product-price"><?php echo get_post_meta(get_the_ID(), '_price', true) . ' $'; ?></p>
            </div>

        <?php


        }
        wp_reset_postdata();
    } else {
        echo "Product Not Found";
    }


    wp_die();
}




add_action('wp_ajax_add_products', 'add_products');
add_action('wp_ajax_nopriv_add_products', 'add_products');

function add_products()
{


    $productSku = isset($_REQUEST['productSku']) ? sanitize_text_field($_REQUEST['productSku']) : '';
    $customarName = isset($_REQUEST['customarName']) ? sanitize_text_field($_REQUEST['customarName']) : '';
    $orderDate = isset($_REQUEST['orderDate']) ? sanitize_text_field($_REQUEST['orderDate']) : '';


    $productId = wc_get_product_id_by_sku($productSku);
    $product = wc_get_product($productId);

    if ($product) {
        ?>

        <tr class="product-row" data-product-id="<?php echo $productId; ?>">
            <td>1</td>
            <td> <img src="<?php echo get_the_post_thumbnail_url($productId); ?>" alt="<?php echo get_the_title($productId); ?>"></td>
            <td><?php echo get_the_title($productId); ?></td>
            <td>
                <input type="number" name="product_quantity" class="product-quantity[]" value="1" min="1" data-product-price="<?php echo $product->get_price(); ?>">
            </td>
            <td>
              <input type="number" name="product_price" class="product-price[]" value="<?php echo $product->get_price(); ?>" >
            </td>
            <td class="total_price">
                 <?php echo wc_price($product->get_price() * 1); ?>
                 <input type="hidden" class="total_prices" name="total_price[]">
            </td> 
            
        </tr>

<?php
    }

    wp_die();
}


// add_action('wp_ajax_update_total_price', 'update_total_price');
// add_action('wp_ajax_nopriv_update_total_price', 'update_total_price');

// function update_total_price() {
//     $productId = isset($_REQUEST['productId']) ? sanitize_text_field($_REQUEST['productId']) : '';
//     $totalPrice = isset($_REQUEST['totalPrice']) ? sanitize_text_field($_REQUEST['totalPrice']) : '';

//     echo wc_price($totalPrice);

//     wp_die();
// }




add_action('wp_ajax_search_product_for_purchase', 'search_product_for_purchase');
add_action('wp_ajax_nopriv_search_product_for_purchase', 'search_product_for_purchase');

function search_product_for_purchase() {
    $product_sku = isset($_REQUEST['product_sku']) ? sanitize_text_field($_REQUEST['product_sku']) : '';

    $product_id = wc_get_product_id_by_sku($product_sku);
    $product_name = get_the_title($product_id);
    $purchase_price = get_post_meta($product_id, '_purchase_price', true);

    $response = array();

    if ($product_name) {
        $response['product_name'] = $product_name;
        $response['purchase_price'] = $purchase_price;
        $response['product_id'] = $product_id;
        wp_send_json($response);
    } else {
        wp_send_json(array('error' => 'No Product Found'));
    }

    wp_die();
}


// search_product_for_order start 

add_action('wp_ajax_search_product_for_order', 'search_product_for_order');
add_action('wp_ajax_nopriv_search_product_for_order', 'search_product_for_order');

function search_product_for_order() {
    $product_sku = isset($_REQUEST['product_sku']) ? sanitize_text_field($_REQUEST['product_sku']) : '';


    // print_r($product_sku) ;
    // exit ; 
    
    $product_id = wc_get_product_id_by_sku($product_sku);
    $product = wc_get_product($product_id);
    $product_name = get_the_title($product_id);
    $sale_price = $product->get_sale_price();
    $price = $sale_price ? $sale_price : $product->get_regular_price();

    $response = array();

    if ($product_name) {
        $response['product_name'] = $product_name;
        $response['sale_price'] = $price;
        $response['product_id'] = $product_id;
        wp_send_json($response);
    } else {
        wp_send_json(array('error' => 'No Product Found'));
    }

    wp_die();
}


// search_product_for_order end  

// pos_order


add_action('wp_ajax_pos_order', 'pos_order');
add_action('wp_ajax_nopriv_pos_order', 'pos_order');

function pos_order()
{

    $formFields = [];
    wp_parse_str($_POST['pos_order'], $formFields); 
    $originalArray = $formFields ;
    require_once(ABSPATH . 'wp-load.php');


    echo '<pre>' ; 
    print_r($originalArray) ;
    exit; 

    wp_die() ; 
}


// purchase order 

add_action('wp_ajax_purchase_product', 'purchase_product');
add_action('wp_ajax_nopriv_purchase_product', 'purchase_product');
function purchase_product()
{
    $formFields = [];
    wp_parse_str($_POST['purchase_product'], $formFields); 
    $originalArray = $formFields ;
    require_once(ABSPATH . 'wp-load.php');
    global $wpdb;
    
$last_bill_no = $wpdb->get_var("SELECT MAX(CAST(bill_no AS UNSIGNED)) FROM {$wpdb->prefix}woo_purchase_orders");
if(!empty($last_bill_no)){
    $new_bill_no = $last_bill_no + 1;
}else{
    $new_bill_no = '00000001';
}
// Increment the last bill_no by 1
    // Table name
    $table_name = $wpdb->prefix . 'woo_purchase_order_items';
    $data_to_insert = array();
    for ($i = 0; $i < count($originalArray['productid']); $i++) {
        $data_to_insert[] = array(
            'product_id' => $originalArray['productid'][$i],
            'rate' => $originalArray['rate'][$i],
            'quantity' => $originalArray['quantity'][$i],
            'subtotal' => $originalArray['subtotal'][$i],
            'date' => $originalArray['purchase_date'],
            'bill_no' => $new_bill_no ,
        );
    }
    
    // Insert data into the database
    foreach ($data_to_insert as $data) {

        $wpdb->insert($table_name, $data);
        $product_id = $data['product_id'] ;
        $quantity_to_add = $data['quantity'] ;
        $product = wc_get_product($product_id);
        $current_stock = $product->get_stock_quantity();
        $new_stock = $current_stock + $quantity_to_add;   
        
        // Update the stock quantity meta field
        update_post_meta($product_id, '_stock', $new_stock);

    }
        $table_name_2 =  $wpdb->prefix . 'woo_purchase_orders';  
        $purchase_order_data = array( 
            'bill_no' => $new_bill_no,
            'payable' => $originalArray['payable'], 
            'paid' => $originalArray['paid'], 
            'due' => $originalArray['due'], 
            'note' => $originalArray['note'], // You can set note if needed
            'supplier_id' => $originalArray['supplier'], 
            'date' => $originalArray['purchase_date'], // Assuming same purchase date for all products
        );
    

    $wpdb->insert($table_name_2, $purchase_order_data); 
    if ($wpdb->last_error) {
        echo "Error: " . $wpdb->last_error;
    } 
    wp_die() ; 
}





// pos_add_product order 

add_action('wp_ajax_pos_add_product', 'pos_add_product');
add_action('wp_ajax_nopriv_pos_add_product', 'pos_add_product');
function pos_add_product()
{ 

    $formFields = [];
    wp_parse_str($_POST['pos_add_product'], $formFields); 
    $originalArray = $formFields ;

//     echo '<pre>' ; 
//     print_r($originalArray) ; 
//     exit ;

    $data_to_insert = array();
    for ($i = 0; $i < count($originalArray['productid']); $i++) {
        $data_to_insert[] = array(
            'product_id' => $originalArray['productid'][$i],
            'rate' => $originalArray['rate'][$i],
            'quantity' => $originalArray['quantity'][$i],
            'subtotal' => $originalArray['subtotal'][$i],
            'date' => $originalArray['purchase_date'],
        );
    }
    
    
    $order = wc_create_order();
    $order_total = 0;
    // Add products to the order
    foreach ($data_to_insert as $order_data) {
        $product_id = $order_data['product_id'];
        $quantity = $order_data['quantity'];
        $product = wc_get_product($product_id);
        if ($product) {
            $order->add_product($product, $quantity);
            $order_total += $order_data['subtotal']; // Calculate the total using the subtotal
        }
    }

    $shipping_charge = ($originalArray['_billing_state'] == 'BD-13') ? 80 : 130;
    $order_total += $shipping_charge;
    print_r($order_total) ; 
    exit ; 
    
    // Add a shipping line item to the order
    $shipping_item = new WC_Order_Item_Shipping();
    $shipping_item->set_method_title('Custom Shipping'); // Name your shipping method
    $shipping_item->set_total($shipping_charge);
    $order->add_item($shipping_item);     

      // Set the billing details
      $order->set_billing_first_name($originalArray['customer_name']);
      $order->set_billing_address_1($originalArray['customer_address']);
      $order->set_billing_phone($originalArray['customer_number']);
      $order->set_billing_state($originalArray['_billing_state']);
      $order->set_customer_note($originalArray['note']);
    //   $order->set_date_created($originalArray['purchase_date']);
    if(!empty($originalArray['paid'])){
      $order->set_total($originalArray['paid']);
    }else{
        $order->set_total($order_total); 
    }

    $order->save();

    wp_die() ; 

}



// AJAX handler for search 
function ajax_search_products() { 

    $search_keyword = sanitize_text_field($_GET['search_keyword']);
    // Perform your search query here, customize as per your product data structure
    $args = array(
        'post_type' => 'product', // Adjust post type as needed
        's' => $search_keyword,
        'posts_per_page' => -1
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post(); ?>
            <li class="sub-menu__item">
                <img class="ajax_search_img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                <a href="<?php the_permalink(); ?>" class="menu-link menu-link_us-s">
                    <?php echo get_the_title(); ?>
                </a>
            </li>
       <?php }
    } else {
        echo '<p>No products found.</p>';
    }

    wp_die();
}
add_action('wp_ajax_nopriv_ajax_search_products', 'ajax_search_products'); // For users not logged in
add_action('wp_ajax_ajax_search_products', 'ajax_search_products'); // For users logged in





add_action('wp_ajax_got_measurement', 'got_measurement');
add_action('wp_ajax_nopriv_got_measurement', 'got_measurement');


function got_measurement()
{ 

    $formdata = [];
    wp_parse_str($_REQUEST['got_measurement'], $formdata);



$product_link = $formdata['product_link'] ; 
$font_size = $formdata['font_size'] ; 
$left_right = $formdata['left_right'] ; 
$top_bottom = $formdata['top_bottom'] ; 


$sku_font_size = $formdata['sku_font_size'] ; 
$sku_left_right = $formdata['sku_left_right'] ; 
$sku_top_bottom = $formdata['sku_top_bottom'] ; 

//   ob_start();


$product_url = $product_link ;

// Parse the URL to get the query string
$url_parts = parse_url($product_url);
$path = isset($url_parts['path']) ? trim($url_parts['path'], '/') : '';

// Extract the product slug from the path
$product_slug = basename($path);
$product_obj = new WC_Product(get_page_by_path( $product_slug, OBJECT, 'product' )->ID);
$product_id = $product_obj->id ;  

// Get product SKU (Product ID)
$product_sku = get_post_meta($product_id, '_sku', true);

// Get product price
$product_price = get_post_meta($product_id, '_price', true);

// Get featured image URL
$image_id = get_post_thumbnail_id($product_id);
$image_url = wp_get_attachment_image_src($image_id, 'full');
$featured_image_url = $image_url[0];
    
// print_r($featured_image_url); 
// exit; 

  $image_url = $featured_image_url ; 
  $image = imagecreatefromjpeg($image_url);

  // Check if the image is loaded successfully
  if ($image === false) {
      return "Failed to load image.";
  }


  // (B) Write text
  $text = $product_price.' BDT';
  $fontFile = "C:/Windows/Fonts/arial.ttf"; // Path to your font file
  $fontSize = $font_size;
  $fontColor = imagecolorallocate($image, 0, 0, 0); // black color
  $posX =  $left_right  ;
  $posY =  $top_bottom ; // Adjusted position to account for font size
  $angle = 0;



  $text2 = $product_sku;
  $fontFile2 = "C:/Windows/Fonts/arial.ttf"; // Path to your font file
  $fontSize2 = $sku_font_size;
  $fontColor2 = imagecolorallocate($image, 0, 0, 0); // black color
  $posX2 = $sku_left_right;
  $posY2 = $sku_top_bottom; // Adjusted position to account for font size
  $angle2 = 0;

  // Check if the font file exists
  if (!file_exists($fontFile)) {
      return "Font file not found.";
  }

  $offset = 2; // Offset for bold effect

 
  imagettftext($image, $fontSize, $angle, $posX + $offset, $posY + $offset, $fontColor, $fontFile, $text);
  imagettftext($image, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $text);
  imagettftext($image, $fontSize2, $angle2, $posX2, $posY2, $fontColor2, $fontFile2, $text2);

  
  

  $output_file = get_stylesheet_directory() . '/custom-image-with-text.jpg'; // Adjust path and filename as needed
  imagejpeg($image, $output_file, 100);

  $image_url = get_stylesheet_directory_uri() . '/custom-image-with-text.jpg'; // URL to the saved 
  
  echo '<div class="hello_clss"><img src="' . esc_url($image_url) . '" alt="Image with Text"></div>';


    wp_die();
}






use BinaryIT\Invoice\PDF;






// add_action('wp_ajax_download_wholesale_ordersheet', 'download_wholesale_ordersheet');
// add_action('wp_ajax_nopriv_download_wholesale_ordersheet', 'download_wholesale_ordersheet');


// function download_wholesale_ordersheet()
// { 

//     $formdata = [];
//     wp_parse_str($_REQUEST['download_wholesale_ordersheet'], $formdata);

//     echo '<pre>' ; 
//     print_r($formdata) ; 
//     exit ; 


    
//     // $data_to_insert = array();
//     // for ($i = 0; $i < count($originalArray['productid']); $i++) {
//     //     $data_to_insert[] = array(
//     //         'product_id' => $originalArray['productid'][$i],
//     //         'rate' => $originalArray['rate'][$i],
//     //         'quantity' => $originalArray['quantity'][$i],
//     //         'subtotal' => $originalArray['subtotal'][$i],
//     //         'date' => $originalArray['purchase_date'],
//     //         'bill_no' => $new_bill_no ,
       
//     //     );
//     // }
 





//     $product_id 		= $_POST['product_id'] ?? '';
// 	$product_title 		= $_POST['product_title'] ?? '';
// 	$is_en_available 	= $_POST['is_en_available'] ?? '';



// 	// Top text
// 	$final_top_text = 'final_top_text';
	
// 	// Table 1 header title
// 	$final_tv_table_1_head_title = 'final_tv_table_1_head_title';


// ?>
<?php
// 	$pdf = new PDF();

// 	// $font_path = __DIR__ . '/Poppins-Light.ttf';
// 	// $font_name = $pdf->covertFont($font_path);

// 	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 48, PDF_MARGIN_RIGHT);
// 	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM + 8);


// 	$header = <<<DOC
// 		<table>
// 	    <tr>
// 		  	<td style="width: 30%;">
// 		    	<img src="https://saro.red-apple.it/wp-content/uploads/2023/07/red-line.jpg" height="200px" width="auto">  
// 			</td>
// 	        <td style="text-align:right; width: 65%;">
// 			   <span style="line-height:20px"></span><br><br>
// 	           <img src="https://saro.red-apple.it/wp-content/uploads/2023/07/logo-black.jpg" height="30px" width="170px">  
// 			   <span></span> <br><br>
// 			   <h2 style="color:#CD151D;font-size:22px; font-family: poppinsb; line-height: 35px; "> {$final_product_title}</h2>
// 	        </td>
// 			<td style="width: 5%;"></td>
// 	    </tr>
// 	</table>
// DOC;

// 	$footer = <<<DOC
// 	<table>
// 	<tr>
// 		<td style="width:5%;"></td>
// 		<td style="width: 25%; ">
// 			<span style="color:#CD151D; font-size:10px; font-family: poppinssemib; ">SARO SRL <br></span> 
// 			<span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;">Sede legale <br></span>  
// 			<span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">Viale San Gimignano, 35 <br></span>
// 			<span style="color:#5a5a5a; font-size:9px; font-family: poppinslight;">20146 Milano (MI)</span>
// 		</td>
// 		<td style="width: 25%; ">
// 			<span style="color:#5a5a5a; font-size:10px; font-family: poppinssemib;"><br>Sede operativa<br></span> 
// 			<span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">Via G. Di Vittorio, 5<br></span> 
// 			<span style="color:#5a5a5a;font-size:10px; font-size:9px; font-family: poppinslight;">20020 Arconate (MI)</span>   
// 		</td>
// 		<td style="width: 40%; ">
// 			<span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;"><br><br>T.0331 453794 - F.0331 574495</span>  <br>
// 			<span style="color:#5a5a5a;font-size:9px; font-family: poppinslight;">info@sa.ro.it - <b><span style="font-family: poppinsb;">www.sa.ro.it</span></b> </span> 
// 			<br>
// 		</td>
// 		<td style="width:5%;"></td>
// 	</tr>
// 	<tr>
// 		<td style="width:5%;"></td> 
// 		<td style="width:90%;">
// 			<div style="width:100%;background-color:#CD151D;line-height:3px;"></div>
// 		</td>
// 		<td style="width:5%;"></td>
// 	</tr>
// </table>
// DOC;

// 	$pdf->headerHTML($header);
// 	$pdf->footerHTML($footer);

// 	$pdf->AddPage();
// 	$html = '';
// 	$html .= <<<DOC
// 	<table>
// 		<tr>
// 			<td style="width: 5%"></td>
// 			<td style="width: 90%; text-align: right; ">
// 				<span style="font-family: poppinssemib; color: #b70202; text-transform: uppercase; font-size: 10px; ">DESCRIZIONE PRODOTTO <br></span>
// 				<span style="font-family: poppins; font-size: 9px; "> {$final_top_text} </span>
// 			</td>
// 			<td style="width: 5%"></td>
// 		</tr>
// 	</table>
// 	<br>
// 	<br>
// DOC;
//     $final_tv_table_1_head_title ='$final_tv_table_1_head_title' ;  
// 	if ($final_tv_table_1_head_title) {
// 		$html .= <<<DOC
// 	<table>
// 		<tr>
// 			<td style="width: 5%"></td>
// 			<td style="width: 90%; text-align: center; font-family: poppinsb; background-color: #B80103; color: #fff;  text-transform: uppercase; line-height: 23px; font-size: 9px; ">
// 				<span style="">{$final_tv_table_1_head_title}</span>
// 			</td>
// 			<td style="width: 5%"></td>
// 		</tr>
// 	</table>
// DOC;
// 	}

// 	/**
// 	 * start table 1
// 	 * how_many_columns_need
// 	 */

// 	$html .= <<<DOC
// <table cellmargin="0" cellpadding="2" style="">

// </table>
// DOC;

// 	/**
// 	 * Start 2nd page 
// 	 */

	
// 	// start product description
//     $final_tv_post_title_text = 'text title' ; 
//     $final_tv_post_pro_desc =  'text decription' ; 

// 	$html .= <<<DOC
// 	<p style="page-break-before: always"></p>
// 	<table cellmargin="0" cellpadding="2" style="">
// 		<tr> 
// 			<td style="width: 5%"></td>
// 			<td style="width: 90%">
// 				<span style="line-height: 18px; font-family: poppinssemib; color: #b70202; text-transform: uppercase; font-size: 10px;">{$final_tv_post_title_text}<br></span>
// 				<span style="font-family: poppins; font-size: 9px; color: #5a5a5a; text-align: justify; display: block;  ">{$final_tv_post_pro_desc}</span>
// 			</td>
// 			<td style="width: 5%"></td>
// 		</tr>
// 	</table>
// 	<br/>
// 	<br/>
// DOC;



// 	/**
// 	 * start table 2
// 	 * how_many_columns_need
// 	 */



// 	$html .= <<<DOC
//    <table cellmargin="0" cellpadding="2" style="">
// 	   {$table_two_row}
//    </table>
// DOC;


	

//      $final_tv_table_3_head_title ='$final_tv_table_3_head_title' ; 

// 		$html .= <<<DOC
// 	  <table>
// 		  <tr>
// 			  <td style="width: 5%"></td>
// 			  <td style="width: 90%; text-align: center; font-family: poppinsb; background-color: #B80103; color: #fff;  text-transform: uppercase; line-height: 25px; font-size: 10px; ">
// 				  <span style="">{$final_tv_table_3_head_title}</span>
// 			  </td>
// 			  <td style="width: 5%"></td>
// 		  </tr>
// 	  </table>
// DOC;
	


// 	$html .= <<<DOC
//    <table cellmargin="0" cellpadding="2" style="">
// 	   {$table_three_row}
//    </table>
// DOC;


// 	/**
// 	 * start bottom description
// 	 */

// 	$html .= <<<DOC
// 	<br/>
// 	<br/>
//  <table cellmargin="0" cellpadding="2" style="">
// 	{$table_desc_row}
//  </table>
// DOC;


// 	$pdf->writeHTML($html);
// 	/**
// 	 * @param string filename
// 	 * @param string mode (I/D/F/S/FI/FD/E)
// 	 * 			I: show PDF in brower
// 	 * 			D: Download pdf
// 	 * 			F: Store in server
// 	 * 			S: return as string, recommended for sending mail attachment
// 	 * 			FI: F + I
// 	 * 			FD: F + D
// 	 * 			E: return the document as base64 mime multi-part email attachment
// 	 */

// 	$file_name =  '_Scheda_Prodotto' . '.pdf';
// 	$pdf->Output($file_name, 'I');

// 	die;



// }
