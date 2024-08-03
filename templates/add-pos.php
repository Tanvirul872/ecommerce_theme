<style>
    .pos_page {
        display: flex;
        gap: 20px;
        min-height: 200px;
    }

    .pos_category h3 {
        margin-bottom: 30px;
    }

    .pos_left {
        width: 30%;
        padding-top: 25px;
    }

    .pos_right {}

    .pos_field input,
    .pos_field select {
        width: 100%;
        padding: 10px 20px;
        margin-bottom: 10px;
    }

    .pos_field {
        margin-bottom: 20px;
    }


    .pos_cart_table {
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

    .pos_cart_table img {
        height: 50px;
        width: 50px;
    }






    /* pos product list css start  */


    .pos_product {
        max-width: 800px;
        /* Adjust the maximum width as needed */
        margin: 0 auto;
    }

    .product-item {
        display: inline-block;
        width: 30%;
        /* Adjust the width to fit three columns */
        margin: 10px;
        text-align: center;
        cursor: pointer;
    }

    .product-item img {
        max-width: 100%;
        height: auto;
    }

    .product-name {
        font-size: 16px;
        margin-top: 5px;
    }

    .product-price {
        font-size: 14px;
        color: #555;
    }

    .pos_right {
        display: flex;
        gap: 20px;
    }

    .pos_category ul li {
        background: #33cabb;
        color: #fff;
        padding: 5px 15px;
        font-size: 16px;
        font-weight: bold;
    }


    /* pagination start kh */
    ul.pagination {
        display: flex;
    }

    a.page-link {
        background: #c3c4c7;
        margin: 2px;
        padding: 5px;
        text-decoration: none;
        color: black;
    }

    /* pagination start kh */
</style>


<h2> Pos Page </h2>

<div class="pos_page">

<form action="#" id="pos_order" method="post">
<div class="pos_left">

<div class="pos_field">
    <input type="text" name="product_sku" placeholder="Write the product sku">
</div>

<div class="pos_field">
    <input type="date" name="order_date">
</div>

<div class="pos_field">

    <select name="select_customer" id="select_customer">
        <option value="">Select Customer</option>

        <?php
        $customers = get_users(array('role' => 'customer'));
        foreach ($customers as $customer) {
            $customer_id = $customer->ID;
            $customer_name = $customer->display_name;
            echo '<option value="' . esc_attr($customer_id) . '">' . esc_html($customer_name) . '</option>';
        }
        ?>

    </select>

</div>




<table class="pos_cart_table">
    <thead>
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody class="pos_data_product" id="pos_data_product">

    </tbody>

    
</table>
    
<div class="price_calculation">
      <input type="text" name="dicount_amount" class="pos_discount" placeholder="Discount">
      <input type="text" name="pay_amount" class="pay_amount" placeholder="Pay amount">
      <label for="#"> Total amount </label>
      <input type="text" name="total_amount" class="total_amount" placeholder="Total amount">
      <textarea name="order_note" id="order_note"> Order note </textarea>
      <select name="select_payment_methor" id="pay_method">
          <option value=""> Select option </option>
          <option value="cash">Cash</option>
          <option value="bkash">Bkash</option>
          <option value="bank">Bank</option>
      </select>
      <input type="submit" value="order"> 
</div>

</div>
</form>



    <div class="pos_right">
        <div class="pos_category">
            <h3>Category list</h3>

            <select name="product_category" id="product_category">
                <option value="">Select Category</option>

                <?php
                $product_categories = get_terms(array(
                    'taxonomy' => 'product_cat',
                    'hide_empty' => false,
                ));

                foreach ($product_categories as $category) {
                    if ($category->name !== 'Uncategorized') {
                        echo '<option value="' . esc_attr($category->name) . '">' . esc_html($category->name) . '</option>';
                    }
                }
                ?>

            </select>
        </div>







        <div class="pos_product">
            <h3>Product List</h3>

            <?php
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => -1,
                // 'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
            );

            $products = new WP_Query($args);
            ?>
            <div class="js-products">
                <?php
                if ($products->have_posts()) :
                    while ($products->have_posts()) : $products->the_post();
                        $product = wc_get_product(get_the_ID());
                ?>
                        <div class="product-item">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <p class="product-name"><?php the_title(); ?></p>
                            <p class="product-sku">SKU: <?php echo esc_html($product->get_sku()); ?></p>
                            <p class="product-price"><?php echo get_post_meta(get_the_ID(), '_price', true) . ' $'; ?></p>
                        </div>
                    <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>

                    <div class="pagination">
                        <?php
                        // echo paginate_links(array(
                        //     'base'      => admin_url('admin.php?page=pos_page&paged=%#%'),
                        //     'total'     => $products->max_num_pages,
                        //     'current'   => max(1, get_query_var('paged')),
                        // ));
                        ?>
                    </div>

                <?php
                else :
                    echo 'No products found';
                endif;
                ?>
            </div>
        </div>


    </div>

</div>