<?php
/*
	* Page Name: 		functions.php
	* Version:			1.0.0
*/
// Functions //



/* -------------- theme support -------------- */
add_theme_support('automatic-feed-links');
add_theme_support('title-tag');
load_theme_textdomain('mp', get_template_directory() . '/languages');
add_theme_support('post-formats', array('aside', 'gallery', 'quote', 'image', 'video'));

/* --------------Post Thumbnails Add-------------- */

add_theme_support('post-thumbnails');
set_post_thumbnail_size(600, 337, true);
add_image_size('single-thumbnail', 600, 337, true);


// // register menu  
// function register_my_menus()
// {
//     register_nav_menus(
//         array(
//             'header-menu' => __('Header Menu'),
//             'footer-menu-1' => __('Footer Menu 1'),
//             'footer-menu-2' => __('Footer Menu 2'),
//             // Add more menus here
//         )
//     );
// }
// add_action('after_setup_theme', 'register_my_menus');






function mytheme_enqueue_scripts()
{
    // Enqueue CSS files
    // wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.min.css');
    // wp_enqueue_style('basic', get_template_directory_uri() . '/assets/css/basic.min.css');
    // wp_enqueue_style('nav', get_template_directory_uri() . '/assets/css/nav.min.css');
    // wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');
    // wp_enqueue_style('custom', get_template_directory_uri() . '/assets/css/custom-css.css');

    // Enqueue JavaScript files
    // wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.1.0', true);
    // wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), '5.1.0', true);
    // wp_enqueue_script('basic', get_template_directory_uri() . '/assets/js/basic.min.js', array(), '1.0.0', true);
    // wp_enqueue_script('range', get_template_directory_uri() . '/assets/js/range.min.js', array(), '1.0.0', true);
    // wp_enqueue_script('nav', get_template_directory_uri() . '/assets/js/nav.min.js', array(), '1.0.0', true);
    // wp_enqueue_script('custom', get_template_directory_uri() . '/assets/js/custom.js', array(), '1.0.0', true);
    // wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array(), '1.0.0', true);
    // wp_enqueue_script('sweetalert', get_template_directory_uri() . '/assets/js/sweetalert.min.js', array(), '1.0.0', true);
    wp_enqueue_script('frontend-scripts', get_template_directory_uri() . '/js/frontend-scripts.js', array(), '1.0.0', true);
	// Localize script with ajax_url
	wp_localize_script('frontend-scripts', 'ajax_object', [
		'ajax_url' => admin_url('admin-ajax.php'),
	]);

}

add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');


// woocommerce support 

function customtheme_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'customtheme_add_woocommerce_support');



//custom post types
require_once('functions/custom.php'); 
require_once('functions/custom-widgets.php'); 
require_once('functions/admin-dashboard-menu.php'); 
require_once('functions/metabox.php');
require_once('functions/ajax-actions.php');
require_once('functions/create-database.php');
require_once('functions/woocommerce-functions.php');
require_once('functions/woocommerce-functions-kamrul.php');



require_once get_theme_file_path('/dynamic-pdf/config.php');
require_once get_theme_file_path('/dynamic-pdf/vendor/autoload.php');
require_once get_theme_file_path('/dynamic-pdf/class.pdf.php');
require_once get_theme_file_path('/dynamic-pdf/product-pdf.php');



add_action('admin_enqueue_scripts', 'my_admin_enqueue_styles');
function my_admin_enqueue_styles()
{
	// Get the current theme
	$theme = wp_get_theme();

	// Enqueue custom JavaScript
	wp_enqueue_script(
		'scripts-js',
		get_stylesheet_directory_uri() . '/functions/scripts.js',
		array('jquery'),
		$theme->get('Version'),
		true
	);

	// Localize script with ajax_url
	wp_localize_script('scripts-js', 'variables', [
		'ajax_url' => admin_url('admin-ajax.php'),
	]);


	// Enqueue Select2 styles
	wp_enqueue_style(
		'select2-css',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
	);

	// Enqueue Select2 script
	wp_enqueue_script(
		'select2-js',
		'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
		array('jquery'),
		$theme->get('Version'),
		true
	);
}


// require_once('functions/add-image-taxonomy.php');


// Framework //
require_once('lib/framework/ReduxCore/framework.php');
require_once('lib/framework/sample/config.php');

//cmb2
include('metabox/init.php');
include('metabox/functions.php');

add_theme_support('title-tags');  



// Register Menus
function register_my_menus() {
    register_nav_menus(
        array(
            'primary-menu' => __( 'Primary Menu' ),
            'footer-menu'  => __( 'Footer Menu 1' ),
			'footer-menu-2'  => __( 'Footer Menu 2' ),
			'footer-menu-3'  => __( 'Footer Menu 3' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );


// Register a custom shortcode for displaying images with text
function custom_image_with_text_shortcode() {
    ob_start();
    
    // (A) Open image from URL
    $image_url = "http://choruighor.com/wp-content/uploads/2024/05/271961738_339040448147477_6806160434943246973_n.jpg";
    $image = imagecreatefromjpeg($image_url);

    // Check if the image is loaded successfully
    if ($image === false) {
        return "Failed to load image.";
    }

    // (B) Write text
    $text = "BDT-200";
    $fontFile = "C:/Windows/Fonts/arial.ttf"; // Path to your font file
    $fontSize = 50;
    $fontColor = imagecolorallocate($image, 0, 0, 0); // black color
    $posX = 30;
    $posY = 70; // Adjusted position to account for font size
    $angle = 0;

    $text2 = "CHB-100";
    $fontFile2 = "C:/Windows/Fonts/arial.ttf"; // Path to your font file
    $fontSize2 = 20;
    $fontColor2 = imagecolorallocate($image, 0, 0, 0); // black color
    $posX2 = 30;
    $posY2 = 100; // Adjusted position to account for font size
    $angle2 = 0;

    // Check if the font file exists
    if (!file_exists($fontFile)) {
        return "Font file not found.";
    }

    // Simulate bold effect by drawing the text twice with slight offsets
    $offset = 2; // Offset for bold effect

    imagettftext($image, $fontSize, $angle, $posX + $offset, $posY + $offset, $fontColor, $fontFile, $text);
    imagettftext($image, $fontSize, $angle, $posX, $posY, $fontColor, $fontFile, $text);

    imagettftext($image, $fontSize2, $angle2, $posX2, $posY2, $fontColor2, $fontFile2, $text2);

    // (C) Save image to a file
    $output_file = get_stylesheet_directory() . '/custom-image-with-text.jpg'; // Adjust path and filename as needed
    imagejpeg($image, $output_file, 100);

    // (D) Return the HTML code to display the image
    $image_url = get_stylesheet_directory_uri() . '/custom-image-with-text.jpg'; // URL to the saved image
    return '<img src="' . esc_url($image_url) . '" alt="Image with Text">';
}
add_shortcode('image_with_text', 'custom_image_with_text_shortcode');





add_action('admin_post_nopriv_print_product_info2', 'print_product_info2');
add_action('admin_post_print_product_info2', 'print_product_info2');

function print_product_info2()
{ 

    
    // Extract form data
    $rates = isset($_POST['rate']) ? $_POST['rate'] : [];
    $quantities = isset($_POST['quantity']) ? $_POST['quantity'] : [];
    $subtotals = isset($_POST['subtotal']) ? $_POST['subtotal'] : [];
    $product_ids = isset($_POST['productid']) ? $_POST['productid'] : [];
    // $product_images = isset($_POST['product_image']) ? $_POST['product_image'] : []; // Add this
    // $product_names = isset($_POST['product_name']) ? $_POST['product_name'] : []; // Add this

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('Product Purchase Information');
    $pdf->SetSubject('Product Purchase Details');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

    // // set default header data
    // $pdf->SetHeaderData('http://choruighor.com/wp-content/uploads/2024/06/294573027_573926607510647_3966863238920335690_n.jpg', PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE , PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
    // $pdf->setFooterData(array(0,64,0), array(0,64,128));

    // // set header and footer fonts
    // $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    // ---------------------------------------------------------

    // set default font subsetting mode
    $pdf->setFontSubsetting(true);

    // Set font
    $pdf->SetFont('dejavusans', '', 14, '', true);




    // Add a page
    $pdf->AddPage();

    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

      // Start generating the HTML content for the PDF
      $html = '<h1>Product Purchase Information</h1>';
      $html .= '<table border="1" cellpadding="5">';
      $html .= '<thead>
                  <tr>
                      <th>No</th>
                      <th>Product Image</th>
                      <th>Product Name</th>
                      <th>Rate</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                  </tr>
                </thead>';
      $html .= '<tbody>';
  
      // Iterate over the data arrays and add rows to the table
      for ($i = 0; $i < count($rates); $i++) { 
     
    
          $product_name = get_the_title($product_ids[$i]);
          $image_url = get_the_post_thumbnail_url($product_ids[$i], 'full'); 
        //   $product_name = $product-get_name(); 
          $html .= '<tr>';
          $html .= '<td>' . ($i + 1) . '</td>';
          $html .= '<td><img src="' . htmlspecialchars($image_url) . '" alt="Product Image" style="width: 50px; height: auto;"></td>';
          $html .= '<td>' . htmlspecialchars($product_name) . '</td>';
          $html .= '<td>' . htmlspecialchars($rates[$i]) . '</td>';
          $html .= '<td>' . htmlspecialchars($quantities[$i]) . '</td>';
          $html .= '<td>' . htmlspecialchars($subtotals[$i]) . '</td>';
          $html .= '</tr>';
      }
  
      $html .= '</tbody>';
      $html .= '</table>';

    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

    // Close and output PDF document
    $pdf->Output('purchase_info.pdf', 'I');
}

