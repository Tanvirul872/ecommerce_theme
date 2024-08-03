<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

 // Function to get the dynamic title
function get_my_account_page_title() {
    $endpoint = WC()->query->get_current_endpoint();
    if (empty($endpoint)) {
        return get_the_title();
    }
    
    $menu_items = wc_get_account_menu_items();
    
    foreach ($menu_items as $key => $label) {
        if ($endpoint === $key) {
            return $label;
        }
    }
    
    return get_the_title(); // Fallback to default title if no match is found
}

$dasboard_class = 'my-account__dashboard';
if(get_my_account_page_title() == 'Addresses') {
	$dasboard_class = 'my-account__address';
} else if(get_my_account_page_title() == 'Wishlist') {
	$dasboard_class = 'my-account__wishlist';
}
?>

<style>
	li.is-active a {
		pointer-events: none !important;
    	color: #c32929 !important;
	}
	li.is-active a:after {
		width: 2em !important;
	}
	.my-account__dashboard p {
		width: 100%;
	}
</style>
<div class="mb-4 pb-4"></div>
<div class="my-account container">
	<h2 class="page-title"><?= get_my_account_page_title(); ?></h2>
	<div class="row">
		<div class="col-lg-3">
			<?php do_action( 'woocommerce_account_navigation' );?>
		</div>
		<div class="col-lg-9">
			<div class="page-content <?= $dasboard_class;?>">
				<?php
					/**
					 * My Account content.
					 *
					 * @since 2.6.0
					 */
					do_action( 'woocommerce_account_content' );
				?>
			</div>
		</div>
	</div>
</div>
<div class="mb-5 pb-xl-5"></div>
