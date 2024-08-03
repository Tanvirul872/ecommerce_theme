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
</style>

<h2> Add new purchase </h2>

<form method="post"  id="purchase_product">
<!-- Your HTML code with Select2 initialization -->
<div class="product">
    <label for="supplier">Select Supplier</label>
    <select name="supplier" style="width: 100%;">
        <?php
        // Get suppliers
        $args = array(
            'post_type' => 'supplier', // Assuming 'supplier' is your custom post type
            'posts_per_page' => -1, // Retrieve all suppliers
        );
        $suppliers = new WP_Query($args);

        // Check if there are any suppliers
        if ($suppliers->have_posts()) :
            while ($suppliers->have_posts()) : $suppliers->the_post(); ?>
                <option value="<?php the_ID(); ?>"><?php the_title(); ?></option>
        <?php
            endwhile;
            wp_reset_postdata(); // Reset the query
         endif; ?>
    </select>
</div>


        <div class="product">
            <label for="product"> Purchase Date </label>
            <input type="date" name="purchase_date">
        </div>

      

        <div class="product">
            <label for="product"> Purchase Note </label>
            <textarea name="note" id="" cols="30" rows="10"></textarea>
        </div>


        <div class="product product_tb">





        <div class="download_wholesale_ordersheet">
             <a href="#"> Download Pdf </a>
        </div>
           
        <div class="product_input">
            <label for="product"> Search Product </label>
            <input type="text" name="search_product" class="search_product_for_purchase" ajax_url="<?php echo admin_url('admin-ajax.php');?>">
        </div>

        </div>

   
        

<!-- product table  -->

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
            <input type="submit" value="Purchase">
        </div>
     </div>

    <div class="purchase_bottom_rght">
        <div class="grand-subtotal">
        <p>Subtotal : </p>
        <span class="grand-total"></span>
        </div>
    </div>


</div>

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