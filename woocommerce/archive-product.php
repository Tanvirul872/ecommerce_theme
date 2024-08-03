<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

$banner_img = get_template_directory_uri().'/images/shop/shop_banner_2.png';

$get_cat =  get_queried_object();

$product_categories = get_terms(array(
  'taxonomy'   => 'product_cat',
  'hide_empty' => false,
));

function page_heading() {
  if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
    return woocommerce_page_title();
  }
}


// product attribute get 

$attribute_size = array();
$attribute_color = array();

$product_args = array(
    'post_type' => 'product',
    'posts_per_page' => -1,
);
$product_query = new WP_Query($product_args);
if ($product_query->have_posts()) {
    while ($product_query->have_posts()) {
        $product_query->the_post();
        $product_attributes = wc_get_product(get_the_ID())->get_attributes();
        
        if(!empty($product_attributes)) {
            $pa_size = $product_attributes['pa_size'];
            $attribute_values = $pa_size->get_terms();
            foreach ($attribute_values as $attribute_value) {
                $attribute_size[] = array(
                    'name' => $attribute_value->name,
                    'slug' => $attribute_value->slug,
                    'tax' => $attribute_value->taxonomy,
                );
            }
        }

        if(!empty($product_attributes)) {
            $pa_color = $product_attributes['pa_color'];
            $attribute_values = $pa_color->get_terms();
            foreach ($attribute_values as $attribute_value) {
                $attribute_color[] = array(
                    'name' => $attribute_value->name,
                    'slug' => $attribute_value->slug,
                    'tax' => $attribute_value->taxonomy,
                );
            }
        }
    }
}
?>
<main style="padding-top: 90px;">
    <section class="full-width_padding">
        <div class="full-width_border border-2" style="border-color: #f5e6e0;">
            <div class="shop-banner position-relative">
                <div class="background-img" style="background-color: #f5e6e0;">
                    <img loading="lazy" src="<?= $banner_img;?>" width="1759" height="420" alt="Pattern" class="slideshow-bg__img object-fit-cover" />
                </div>

                <div class="shop-banner__content container position-absolute start-50 top-50 translate-middle">
                  <h2 class="h1 text-uppercase text-center fw-bold mb-3 mb-xl-4 mb-xl-5">
                    <?php 
                      page_heading();
                    ?>
                  </h2>
                  
                  <?php 
                  if (!empty($product_categories) && !is_wp_error($product_categories)) {
                    ?>
                    <ul class="d-flex justify-content-center flex-wrap list-unstyled text-uppercase h6">
                      <?php
                      foreach ($product_categories as $key=>$category) {
                        $category_link = get_term_link($category);
                        if($category->slug == 'uncategorized') {
                          continue;
                        }

                        $is_active = '';
                        if( !empty($get_cat->slug) && $get_cat->slug == $category->slug ) {
                          $is_active = 'menu-link_active';
                        }
                        ?>
                          <li class="me-3 me-xl-4 pe-1"><a href="<?= esc_url($category_link);?>" class="menu-link menu-link_us-s <?= $is_active;?>"><?= esc_html($category->name);?></a></li>
                        <?php
                      }
                      ?>
                    </ul>
                    <?php
                  } else {
                    ?>
                    <p class="text-center">No product categories found.</p>
                    <?php
                  }
                  ?>
                    
                </div>
                <!-- /.shop-banner__content -->
            </div>
            <!-- /.shop-banner position-relative -->
        </div>
        <!-- /.full-width_border -->
    </section>
    <!-- /.full-width_padding-->

    <div class="mb-4 pb-lg-3"></div>

    <section class="shop-main container d-flex">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter" style="top: -0.444458px;">
            <div class="aside-header d-flex d-lg-none align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div>
            <!-- /.aside-header -->

            <div class="pt-4 pt-lg-0"></div>

            <?php 
            if (!empty($product_categories) && !is_wp_error($product_categories)) {
                ?>
                <div class="accordion" id="categories-list">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-11">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true" aria-controls="accordion-filter-1">
                                Product Categories
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        ></path>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-11" data-bs-parent="#categories-list">
                            <div class="accordion-body px-0 pb-0 pt-3">
                                <ul class="list list-inline mb-0">
                                    <?php 
                                    foreach ($product_categories as $key=>$category) {

                                        $category_link = get_term_link($category);
                                        if($category->slug == 'uncategorized') {
                                            continue;
                                        }

                                        $is_active = '';
                                        if( !empty($get_cat->slug) && $get_cat->slug == $category->slug ) {
                                        $is_active = 'menu-link_active';
                                        }
                                        ?>
                                        <li class="list-item active">
                                            <a href="<?= $category_link;?>" class="menu-link py-1 menu-link_us-s <?= $is_active;?>"><?= esc_html($category->name);?></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.accordion-item -->
                </div>
                <?php
            }
            ?>
            <!-- /.accordion-item -->

            <?php 
            if(!empty($attribute_color)) {
                ?>
                <div class="accordion filter_click" id="color-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-2" aria-expanded="true" aria-controls="accordion-filter-2">
                                Color
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        ></path>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-2" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-1" data-bs-parent="#color-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap">
                                    <?php 
                                    foreach($attribute_color as $color) {
                                        ?>
                                        <label>
                                            <input type="radio" name="attr_slug" value="<?= $color['slug'];?>" style="position:absolute;visibility:hidden">
                                            <input type="hidden" name="attr_tax" value="<?= $color['tax'];?>">
                                            <span class="swatch-color" style="color: <?= $color['name'];?>;"></span>
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.accordion-item -->
                </div>
                <!-- /.accordion -->
                <?php
            }
            ?>
            
            <?php 
            if(!empty($attribute_size)) {
                ?>
                <div class="accordion filter_click" id="size-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-size">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-filter-size" aria-expanded="true" aria-controls="accordion-filter-size">
                                Sizes
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"
                                        ></path>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-size" class="accordion-collapse collapse show border-0" aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap">
                                    <?php
                                    foreach($attribute_size as $size) {
                                        ?>
                                        <label>
                                            <input type="radio" name="attr_slug" value="<?= $size['slug']?>" style="position:absolute;visibility:hidden">
                                            <input type="hidden" name="attr_tax" value="<?= $size['tax'];?>">
                                            <span class="swatch-size btn btn-sm btn-outline-light mb-3 me-3"><?= $size['name']?></span>
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.accordion-item -->
                </div>
                <!-- /.accordion -->
                <?php
            } 
            ?>
        
        </div>
        <!-- /.shop-sidebar -->

        <div class="shop-list flex-grow-1">
            <div class="d-flex justify-content-between mb-4 pb-md-2">
                <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                    <a href="<?= home_url();?>" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                    <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                    <span class="menu-link menu-link_us-s text-uppercase fw-medium">
                      <?php 
                        page_heading();
                      ?>
                    </span>
                </div>
                <!-- /.breadcrumb -->

            </div>
            <!-- /.d-flex justify-content-between -->

            <div class="filter_wrap position-relative">
                <span class="spinner spinner3" style="z-index:999;"></span>
                <?php 
                if ( have_posts() ) {
                ?>
                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    <?php 
                    while ( have_posts() ) {
                        the_post();

                        $product_id = get_the_id();
                        $product = wc_get_product( $product_id );

                        $main_image = home_url('/wp-content/plugins/core-field/assets/img/woocommerce-placeholder.png');
                        $gallery_image_id = $product->get_gallery_image_ids();
                        if(!empty(get_the_post_thumbnail_url())){
                            $main_image = get_the_post_thumbnail_url();
                        } else if (!empty($gallery_image_id)){
                            $main_image = wp_get_attachment_url($gallery_image_id[0]);
                        }

                        $gallery_image_url = $main_image;
                        if(!empty($gallery_image_id)) {
                            $gallery_image_url = wp_get_attachment_url($gallery_image_id[0]);
                        }
                    ?>
                    <div class="product-card-wrapper">
                        <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                            <div class="pc__img-wrapper">
                                <a href="<?= get_the_permalink();?>">
                                    <img loading="lazy" src="<?= $main_image;?>" alt="product_img" class="pc__img" style="height:100%;">
                                    <img loading="lazy" src="<?= $gallery_image_url;?>" alt="product_img" class="pc__img pc__img-second" style="height:100%;">
                                </a>
                                
                                <form action="" method="post" class="add_cart_handler">
                                    <input type="hidden" name="product_id" value="<?= $product_id;?>">
                                    <input type="number" name="quantity" value="1">
                                    <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" title="Add To Cart">
                                        <span class="cart_text">Add To Cart</span>
                                        <span class="spinner"></span>
                                    </button>
                                </form>
                            </div>

                            <div class="pc__info position-relative">
                                <h6 class="pc__title"><a href="<?= get_the_permalink();?>"><?= get_the_title();?></a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price price-sale"><?= wc_price($product->get_price());?></span>
                                </div>

                                <div class="wishlist_wrapper">
                                    <?php 
                                    $user_id = '';
                                    $wishlist_id = '';
                                    $has_wishlisted = false;
                                    if(is_user_logged_in()) {
                                        $user_id = get_current_user_id();
                                        $wishlist_args = array(
                                            'post_type' => 'wishlists',
                                            'posts_per_page' => -1,
                                            'author' => $user_id,
                                        );
                                        $wishlist_query = new WP_Query($wishlist_args);
                                        if ($wishlist_query->have_posts()) {
                                            while ($wishlist_query->have_posts()) {
                                                $wishlist_query->the_post();
                                                $wishlisted_product_id = get_field('product_id');
                                                if($wishlisted_product_id == $product_id) {
                                                    $has_wishlisted = true;
                                                    $wishlist_id = get_the_id();
                                                }
                                            }
                                        }
                                        wp_reset_postdata();
                                        $icon1 = home_url('/wp-content/plugins/core-field/assets/img/heart-1.png');
                                        $icon2 = home_url('/wp-content/plugins/core-field/assets/img/heart-2.png');
                                    }
                                    ?>
                                    <form action="" class="add_wishlist <?= $has_wishlisted ? 'd-none' : '' ?>">
                                        <input type="hidden" name="w_product_id" value="<?= $product_id;?>">
                                        <input type="hidden" name="user_id" value="<?= $user_id;?>">
                                        <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0">
                                            <img src="<?= $icon1;?>" alt="">
                                        </button>
                                        <span class="spinner spinner2"></span>
                                    </form>
                                    <form action="" class="remove_wishlist <?= $has_wishlisted ? '' : 'd-none' ?>">
                                        <input type="hidden" name="wishlist_id" value="<?= $wishlist_id;?>">
                                        <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 active">
                                            <img src="<?= $icon2;?>" alt="">
                                        </button>
                                        <span class="spinner spinner2"></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                } else {
                ?>
                <p>No Products found.</p>
                <?php
                }
                ?>
                <!-- /.products-grid row -->
            </div>
            
        </div>
    </section>
    <!-- /.shop-main container -->
</main>
<div class="mb-5 pb-xl-5"></div>
<?php
get_footer( 'shop' );
