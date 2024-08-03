<style>
    .product {
        margin-bottom: 20px;
    }

    .product label {
        display: block;
        margin-bottom: 5px;
    }

    .product input[type="text"],
    .product input[type="date"],
    .product textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    /* Optional: Add some styling for better appearance */
    .product textarea {
        resize: vertical;
    }

    /* Optional: Add some spacing between elements */
    .product+.product {
        margin-top: 20px;
    }
</style>





<form method="post" action="">

<!-- Your HTML code with Select2 initialization -->

<div class="product">
    <label for="product"> Add product </label>
    <select name="select" id="product_select" class="select2_products">
        <?php 
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1,
        );
        $products = new WP_Query($args);
        if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();
                $product_id = get_the_ID();
                $product_title = get_the_title();
        ?>
                <option value="<?php echo esc_attr($product_id); ?>"><?php echo esc_html($product_title); ?></option>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<option value="">No products found</option>';
        endif;
        ?>
    </select>
</div>


        <div class="product">
            <label for="product"> Amount </label>
            <input type="number" name="number">
        </div>

        <div class="product">
            <label for="product"> Date </label>
            <input type="date" name="date">
        </div>

        <div class="product">
            <label for="product"> Add Note </label>
            <textarea name="note" id="" cols="30" rows="10"></textarea>
        </div>

        <input type="submit" name="submit_product_damage" value="Submit">
</form>

