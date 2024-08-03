<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); 

function page_heading() {
  if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
    return woocommerce_page_title();
  }
}

if ( class_exists( 'WC_Product' ) ) {
    $product_id = get_the_id();
    $product = wc_get_product( $product_id );
    $price = $product->get_price();
    $gallery_image_ids = $product->get_gallery_image_ids();
    $short_des = $product->get_short_description();
    $full_des = $product->get_description();
    $product_categories = $product->get_categories();

    // Get attributes
    $attributes = $product->get_attributes();
}

?>

<main>
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-single__media" data-media-type="vertical-thumbnail">
                    <div class="product-single__image">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-single__image-item">
                                    <?php 
                                    $main_image = home_url('/wp-content/plugins/core-field/assets/img/woocommerce-placeholder.png');
                                    $gallery_image_id = $product->get_gallery_image_ids();
                                    if(!empty(get_the_post_thumbnail_url())){
                                        $main_image = get_the_post_thumbnail_url();
                                    } else if (!empty($gallery_image_id)){
                                        $main_image = wp_get_attachment_url($gallery_image_id[0]);
                                    }
                                    ?>
                                    <img loading="lazy" class="h-100 w-100 object-fit-cover object-position-top" src="<?= $main_image;?>" alt="" />
                                    <a data-fancybox="gallery" href="<?= $main_image;?>" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_zoom" /></svg>
                                    </a>
                                </div>

                                <?php
                                foreach($gallery_image_ids as $gallery_image) {
                                    $gallery_image_url = wp_get_attachment_url($gallery_image);
                                    ?>
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-100 w-100 object-fit-cover object-position-top" src="<?= $gallery_image_url;?>" alt="" style="max-height:674px"/>
                                        
                                        <a data-fancybox="gallery" href="<?= $gallery_image_url;?>" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_zoom" /></svg>
                                        </a>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="swiper-button-prev">
                                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_sm" /></svg>
                            </div>
                            <div class="swiper-button-next">
                                <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_sm" /></svg>
                            </div>
                        </div>
                    </div>
                    <div class="product-single__thumbnail">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide product-single__image-item">
                                    <img class="h-100 w-100 object-fit-cover object-position-top" src="<?= $main_image;?>" alt="" />
                                </div>

                                <?php
                                foreach($gallery_image_ids as $gallery_image) {
                                    $gallery_image_url = wp_get_attachment_url($gallery_image);
                                    ?>
                                    <div class="swiper-slide product-single__image-item">
                                        <img class="h-100 w-100 object-fit-cover object-position-top" src="<?= $gallery_image_url;?>" alt="" />
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="<?= home_url('/');?>" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="<?= home_url('/shop');?>" class="menu-link menu-link_us-s text-uppercase fw-medium"><?= page_heading();?></a>
                    </div>
                    <!-- /.breadcrumb -->

                </div>
                <h1 class="product-single__name"><?= get_the_title();?></h1>
                
                <div class="product-single__price">
                    <span class="current-price"><?= $price;?> ৳</span>
                </div>
                <div class="product-single__short-desc">
                    <p><?= $short_des;?></p>
                </div>
                <form class="single_add_to_cart" method="post">
                    <div class="product-single__swatches">
                        <?php
                        if( !empty($attributes) ) {
                            $pa_size = $attributes['pa_size'];
                            $attribute_values = $pa_size->get_terms();
                            $attribute_value_names = array();
                            foreach ($attribute_values as $attribute_value) {
                                $attribute_value_names[] = $attribute_value->name;
                            }
                            ?>
                            <div class="product-swatch text-swatches">
                                <label>Sizes</label>
                                <div class="swatch-list">
                                    <?php 
                                    foreach($attribute_value_names as $attribute_value) {
                                        ?>
                                        <span class="position-relative">
                                            <input type="radio" name="size" value="<?= $attribute_value;?>" required style="display:inline-block; position:absolute; opacity:0;" id="swatch-<?= $attribute_value?>"/>
                                            <label for="swatch-<?= $attribute_value?>" class="swatch js-swatch"><?= $attribute_value?></label>
                                        </span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        

                        <?php
                        if( !empty($attributes) ) {
                            $pa_color = $attributes['pa_color'];
                            $attribute_values = $pa_color->get_terms();
                            $attribute_value_names = array();
                            foreach ($attribute_values as $attribute_value) {
                                $attribute_value_names[] = $attribute_value->name;
                            }
                            ?>
                            <div class="product-swatch color-swatches">
                                <label>Color</label>
                                <div class="swatch-list">
                                    <?php 
                                    foreach($attribute_value_names as $attribute_value) {
                                        ?>
                                            <span class="position-relative">
                                                <input type="radio" name="color" id="swatch-<?= $attribute_value;?>" value="<?= $attribute_value;?>" required  style="display:inline-block; position:absolute; opacity:0;"/>
                                                <label class="swatch swatch-color js-swatch" for="swatch-<?= $attribute_value;?>" style="color: <?= $attribute_value;?>;"></label>
                                            </span>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="product-single__addtocart">
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center" />
                            <div class="qty-control__reduce">-</div>
                            <div class="qty-control__increase">+</div>
                        </div>
                        <!-- .qty-control -->
                        <div class="d-inline-block position-relative">
                            <input type="hidden" name="product_id" value="<?= $product_id;?>">
                            <button type="submit" class="btn btn-primary btn-addtocart">Add to Cart</button>
                            <span class="spinner" style="left: calc(100% + 10px);"></span>
                        </div>
                    </div>
                </form>
                <div class="product-single__addtolinks">
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
                        <form action="" class="add_wishlist position-relative <?= $has_wishlisted ? 'd-none' : '' ?>">
                            <input type="hidden" name="w_product_id" value="<?= $product_id;?>">
                            <input type="hidden" name="user_id" value="<?= $user_id;?>">
                            <button class="menu-link menu-link_us-s add-to-wishlist border-0 bg-transparent d-flex align-items-center gap-2">
                                <img src="<?= $icon1;?>" alt="">
                                <span>Add to Wishlist</span>
                            </button>
                            <span class="spinner spinner2"></span>
                        </form>
                        <form action="" class="remove_wishlist position-relative <?= $has_wishlisted ? '' : 'd-none' ?>">
                            <input type="hidden" name="wishlist_id" value="<?= $wishlist_id;?>">
                            <button class="menu-link menu-link_us-s add-to-wishlist border-0 bg-transparent d-flex align-items-center gap-2">
                                <img src="<?= $icon2;?>" alt="">
                                <span>Remove from Wishlist</span>
                            </button>
                            <span class="spinner spinner2"></span>
                        </form>
                    </div>

                </div>
                <div class="product-single__meta-info">
                    <div class="meta-item">
                        <label>Categories:</label>
                        <span>
                            <?= $product_categories;?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-single__details-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab" href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab" href="#tab-additional-info" role="tab" aria-controls="tab-additional-info" aria-selected="false">Additional Information</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-description" role="tabpanel" aria-labelledby="tab-description-tab">
                    <div class="product-single__description">
                        <?= $full_des;?>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                    <div class="product-single__addtional-info">
                        <div class="item">
                            <label class="h6">Weight</label>
                            <span>1.25 kg</span>
                        </div>
                        <div class="item">
                            <label class="h6">Dimensions</label>
                            <span>90 x 60 x 90 cm</span>
                        </div>
                        <div class="item">
                            <label class="h6">Size</label>
                            <span>XS, S, M, L, XL</span>
                        </div>
                        <div class="item">
                            <label class="h6">Color</label>
                            <span>Black, Orange, White</span>
                        </div>
                        <div class="item">
                            <label class="h6">Storage</label>
                            <span>Relaxed fit shirt-style dress with a rugged</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products-carousel container">
        <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

        <div id="related_products" class="position-relative">
            <div
                class="swiper-container js-swiper-slider"
                data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'
            >
                <div class="swiper-wrapper">
                    <?php 
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 12,
                        'orderby' => 'rand',
                    );

                    $query = new WP_Query($args);
                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();

                            $r_product_id = get_the_id();

                            if($product_id == $r_product_id) {
                                continue;
                            }

                            $product = wc_get_product($r_product_id);
                            $sale_price = $product->get_regular_price();

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
                        <div class="swiper-slide product-card">
                            <div class="pc__img-wrapper">
                                <a href="<?= get_the_permalink();?>">
                                    <img loading="lazy" src="<?= $main_image;?>" alt="product_img" class="pc__img" style="height:100%;">
                                    <img loading="lazy" src="<?= $gallery_image_url;?>" alt="product_img" class="pc__img pc__img-second" style="height:100%;">
                                </a>

                                <form action="" method="post" class="add_cart_handler">
                                    <input type="hidden" name="product_id" value="<?= $r_product_id;?>">
                                    <input type="number" name="quantity" value="1">
                                    <button class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" title="Add To Cart">
                                        <span class="cart_text">Add To Cart</span>
                                        <span class="spinner"></span>
                                    </button>
                                </form>
                            </div>

                            <div class="pc__info position-relative">
                                <h6 class="pc__title"><a href="<?= get_the_permalink();?>"><?= get_the_title();   ?></a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price"><?= wc_price($sale_price);?></span>
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
                                                if($wishlisted_product_id == $r_product_id) {
                                                    $has_wishlisted = true;
                                                    $wishlist_id = get_the_id();
                                                }
                                            }
                                        }
                                        wp_reset_postdata();
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
                        <?php
                        }

                        wp_reset_postdata();
                    }
                    ?>
                </div>
                <!-- /.swiper-wrapper -->
            </div>
            <!-- /.swiper-container js-swiper-slider -->

            <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_md" /></svg>
            </div>
            <!-- /.products-carousel__prev -->
            <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_md" /></svg>
            </div>
            <!-- /.products-carousel__next -->

            <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
            <!-- /.products-pagination -->
        </div>
        <!-- /.position-relative -->
    </section>
    <!-- /.products-carousel container -->
</main>

<div class="mb-5 pb-xl-5"></div>


<?php  
get_footer( 'shop' );
