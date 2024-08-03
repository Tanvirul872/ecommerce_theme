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
.download_wholesale_ordersheet {
	text-align: right;
}
.product-item img {
	height: 200px;
	width: 100%;
    object-fit: cover; 
}
.product.pos_product {
	width: auto;
}
.product-item {
	display: inline-block;
	width: 25%;
	margin: 10px;
	text-align: center;
	cursor: pointer;
}
.pos_add_product {
	display: flex;
	justify-content: center;
	align-items: ;
}
</style>

<h2> Add new purchase </h2>

<form method="post"  id="pos_add_product" class="pos_add_product">
<!-- Your HTML code with Select2 initialization -->

<?php
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 20,
        // 'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    );

    $products = new WP_Query($args);
?>
<div class="left_side">

<div class="product pos_product">

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
        </div>
   <?php
    else :
        echo 'No products found';
    endif;
    ?>



</div>

   
        

<div class="right_side">


<div class="product">
    <label for="product">  Customer Name </label>
    <input type="text" name="customer_name">
</div>
<div class="product">
    <label for="product">  Customer Address </label>
    <textarea name="customer_address" id="" cols="30" rows="10"></textarea>
</div>

<div class="product">
    <label for="product">  Date </label>
    <input type="date" name="purchase_date">
</div>
<div class="product">
    <label for="product">  Note </label>
    <textarea name="note" id="" cols="30" rows="10"></textarea>
</div>

<div class="product product_tb">
    <div class="product_input">
        <label for="product"> Search Product By Sku </label>
        <input type="text" name="search_product" class="search_product_for_order" ajax_url="<?php echo admin_url('admin-ajax.php');?>">
    </div>

</div>


<table class="widefat">
    <thead>

        <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Rate</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>

    </thead>
    <tbody>
        <!-- Add your table data here -->
       
        <!-- Add more rows as needed -->

   
    </tbody>
    
</table>


<div class="purchase_bottom">
     <div class="purchase_bottom_lft">
        <div class="payble_due"> 
        <label for="payable">Payable</label> 
        <input type="hidden" name="payable" value="" > <br>
        <p class="payable_amount"> </p>
        <label for="due">Due</label>
        <input type="hidden" name="due" value="" ><br>
        <p class="due_amount"> </p>

        <label for="paid">Pay Amounts</label> 
        <input type="number" name="paid" value="" ><br>
        </div>
        <div class="purchase_btn">
            <!-- <a href="#"> Purchase </a> -->
            <input type="submit" value="Order">
        </div>
     </div>

    <div class="purchase_bottom_rght">
        <div class="grand-subtotal">
        <p>Subtotal : </p>
        <span class="grand-total"></span>
        </div>
    </div>

</div>

</div>

<!-- product table  -->



</form>



<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">

<input type="hidden" name="action" value="print_product_info2">

<input type="hidden" name="product_id" value="<?php echo get_the_ID(); ?>">

<input type="hidden" name="product_title" value="<?php echo get_the_title(); ?>">

<input type="hidden" name="is_en_available" value="<?php echo $is_en_available; ?>">

<button type="submit" class="lbl-pdf-gen">

  <img src="/wp-content/uploads/2023/07/icona-stampa.png" alt="">

</button>

</form>