
<style>
    /* Add your custom styles here */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .admin_stock_page img {
        height: 50px;
        width: 50px;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 1px solid #ddd;
        }

        th,
        td {
            display: block;
            width: 100%;
            box-sizing: border-box;
        }

        th {
            text-align: left;
        }
    }
</style>
<!-- </head>
<body> -->



<?php 
 
 $product_code = isset($_GET['product_code']) ? sanitize_text_field($_GET['product_code']) : '';
 $product_name = isset($_GET['product_name']) ? sanitize_text_field($_GET['product_name']) : '';
 $category_id = isset($_GET['select_product_cat']) ? intval($_GET['select_product_cat']) : '';
 $brand_id = isset($_GET['select_product_brand']) ? intval($_GET['select_product_brand']) : '';

?>

<h2>Stock Information</h2>

<form class="search_filter_box" action="<?php echo admin_url('admin.php?page=stocks_page');?>" method="get">
    <input type="hidden" name="page" value="stocks_page">
    <input type="text" name="product_code" placeholder="Enter the code" value="<?php echo $product_code; ?>"> 
    <input type="text" name="product_name" placeholder="Enter the product name" value="<?php echo $product_name; ?>"> 

    <select name="select_product_cat">
        <option value="">Select Category</option>
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        ));
        foreach ($categories as $category) {
            echo '<option value="' . $category->term_id . '"' . selected(isset($_GET['select_product_cat']) ? $_GET['select_product_cat'] : '', $category->term_id, false) . '>' . $category->name . '</option>';
        }
        ?>
    </select>

  
    <select name="select_product_brand">
        <option value="">Select Brand</option>
        <?php
        $brands = get_terms(array(
            'taxonomy' => 'product_brand',
            'hide_empty' => false,
        ));
        foreach ($brands as $brand) {
            echo '<option value="' . $brand->term_id . '"' . selected(isset($_GET['select_product_brand']) ? $_GET['select_product_brand'] : '', $brand->term_id, false) . '>' . $brand->name . '</option>';
        }
        ?>
    </select>

    <input type="submit" value="Submit">
    <a href="<?php echo admin_url('admin.php?page=stocks_page'); ?>">Reset</a>
</form>


<table class="admin_stock_page">
    <thead>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Available Stock</th>
            <th>Price</th>
            <th>Purchased Price</th>
            <th>Sold</th>
            <th>Damage</th>
            <th>Sell Value</th>
        </tr>
    </thead>
    <tbody>

        <?php

        $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;
        $product_code = isset($_GET['product_code']) ? sanitize_text_field($_GET['product_code']) : '';
        $product_name = isset($_GET['product_name']) ? sanitize_text_field($_GET['product_name']) : '';
        $category_id = isset($_GET['select_product_cat']) ? intval($_GET['select_product_cat']) : '';
        $brand_id = isset($_GET['select_product_brand']) ? intval($_GET['select_product_brand']) : '';

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10,
            'paged'          => $paged,
        );

        if (!empty($product_code)) {
            $args['meta_query'][] = array(
                'key'     => '_sku',
                'value'   => $product_code,
                'compare' => 'LIKE',
            );
        }

        if (!empty($product_name)) {
            $args['s'] = $product_name;
        }

        if (!empty($category_id)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $category_id,
            );
        }

        if (!empty($brand_id)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field'    => 'term_id',
                'terms'    => $brand_id,
            );
        }

        $products = new WP_Query($args);

        if ($products->have_posts()) :

            $counter = 1;
            while ($products->have_posts()) : $products->the_post();
                $product_id = get_the_ID();
                $categories = get_the_terms(get_the_ID(), 'product_cat');
                $available_stock = get_post_meta(get_the_ID(), '_stock', true);
                $total_sales = get_post_meta(get_the_ID(), 'total_sales', true);
                $product_price = get_post_meta($product_id, '_price', true);
             
             
                $available_stock = isset($available_stock) ? intval($available_stock) : 0; // Convert to integer and set to 0 if not set
                $product_price = isset($product_price) ? floatval($product_price) : 0.0; // Convert to float and set to 0.0 if not set

                // Perform the calculation
                $total_sale_value = $available_stock * $product_price;

                // total damage 
                global $wpdb;
                $table_name = $wpdb->prefix . 'product_damage';
                $query = $wpdb->prepare("SELECT SUM(number) as total_amount FROM $table_name WHERE product_id = %d", $product_id);
                $total_damage = $wpdb->get_var($query);

        ?>

                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title() ?>"></td>
                    <td><?php the_title() ?></td>

                    <td>

                        <?php
                        $categoryNames = [];

                        if ($categories) {
                            foreach ($categories as $category) {
                                if ($category->name !== 'Uncategorized') {
                                    $categoryNames[] = $category->name;
                                }
                            }
                        }

                        echo implode(' | ', $categoryNames);
                        ?>
                    </td>
                
                    <td><?php echo $available_stock; ?> </td>
                    <td> 
                        <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo get_post_meta(get_the_ID(), '_price', true); ?>
                    </td>
                    <td>
                        <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo get_post_meta(get_the_ID(), '_purchase_price', true) ?>
                   </td>
                    <td><?php echo $total_sales; ?></td>
                    <td><?php echo $total_damage; ?></td>
                    <td>
                       <?php echo get_woocommerce_currency_symbol();  ?>
                        <?php echo $total_sale_value; ?>
                    </td>
                </tr>


        <?php
            $counter++;
            endwhile;
            wp_reset_postdata();
        else :
            echo 'No products found';
        endif;
        ?>     
    </tbody>
</table>

<?php 

    // Pagination start
    $pagination_args = array(
        'base' => add_query_arg('paged', '%#%'),
        'format' => '',
        'current' => max(1, $paged),
        'total' => $products->max_num_pages,
      );
  
      echo paginate_links($pagination_args);
    // Pagination end
    
    
?>


