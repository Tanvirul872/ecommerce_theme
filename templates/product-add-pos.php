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

<h2> Add new POS </h2>

<input type="text" class="search_products_frm_pos" placeholeder="Seach products">

<form method="post"  id="pos_add_product" class="pos_add_product">
<!-- Your HTML code with Select2 initialization -->

<?php 

     $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
     $args = array(
         'post_type' => 'product',
         'posts_per_page' => 10, // Adjust the number of products per page as needed
         'paged' => $paged
     );

    $products = new WP_Query($args);

    // print_r($paged) ; 

?>
<div class="left_side">
      
  <div class="product pos_product">

        <?php
            if ($products->have_posts()) :
            while ($products->have_posts()) : $products->the_post();
                $product = wc_get_product(get_the_ID());
            ?>
                <div class="product-item">
                    <?php if(has_post_thumbnail()){ ?>
                        <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php  } else { ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/No_Image_Available.jpg" alt="<?php the_title(); ?>">
                    <?php  } ?>
                    <p class="product-name"><?php the_title(); ?></p>
                    <p class="product-sku">SKU: <?php echo esc_html($product->get_sku()); ?></p>
                    <p class="product-price"><?php echo get_post_meta(get_the_ID(), '_price', true) . ' $'; ?></p>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
        ?>
        </div>
    
        <div class="pagination">
                <?php
                // Pagination links
                echo paginate_links(array(
                    'base' => add_query_arg('paged', '%#%'),
                    'format' => '',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $products->max_num_pages,
                    'prev_text' => __('&laquo; Prev'),
                    'next_text' => __('Next &raquo;'),
                ));
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
    <label for="product">  Customer Number </label>
    <input type="number" name="customer_number">
</div>

<div class="product">
    <label for="product">  City </label> 

    <!-- <select name="city_address" id="">
        <option value="">Select City</option>
        <option value="dhaka">Dhaka</option>
        <option value="out_dhaka">Outside Dhaka</option>
    </select> -->

    <select id="_billing_state" name="_billing_state" class="js_field-state select"  >
     <option value="">Select an option…</option>
     <option value="BD-05">Bagerhat</option>
     <option value="BD-01">Bandarban</option>
     <option value="BD-02">Barguna</option>
     <option value="BD-06">Barishal</option>
     <option value="BD-07">Bhola</option>
     <option value="BD-03">Bogura</option>
     <option value="BD-04">Brahmanbaria</option>
     <option value="BD-09">Chandpur</option>
     <option value="BD-10">Chattogram</option>
     <option value="BD-12">Chuadanga</option>
     <option value="BD-11">Cox's Bazar</option>
     <option value="BD-08">Cumilla</option>
     <option value="BD-13">Dhaka</option>
     <option value="BD-14">Dinajpur</option>
     <option value="BD-15">Faridpur </option>
     <option value="BD-16">Feni</option>
     <option value="BD-19">Gaibandha</option>
     <option value="BD-18">Gazipur</option>
     <option value="BD-17">Gopalganj</option>
     <option value="BD-20">Habiganj</option>
     <option value="BD-21">Jamalpur</option>
     <option value="BD-22">Jashore</option>
     <option value="BD-25">Jhalokati</option>
     <option value="BD-23">Jhenaidah</option>
     <option value="BD-24">Joypurhat</option>
     <option value="BD-29">Khagrachhari</option>
     <option value="BD-27">Khulna</option>
     <option value="BD-26">Kishoreganj</option>
     <option value="BD-28">Kurigram</option>
     <option value="BD-30">Kushtia</option>
     <option value="BD-31">Lakshmipur</option>
     <option value="BD-32">Lalmonirhat</option>
     <option value="BD-36">Madaripur</option>
     <option value="BD-37">Magura</option>
     <option value="BD-33">Manikganj </option>
     <option value="BD-39">Meherpur</option>
     <option value="BD-38">Moulvibazar</option>
     <option value="BD-35">Munshiganj</option>
     <option value="BD-34">Mymensingh</option>
     <option value="BD-48">Naogaon</option>
     <option value="BD-43">Narail</option>
     <option value="BD-40">Narayanganj</option>
     <option value="BD-42">Narsingdi</option>
     <option value="BD-44">Natore</option>
     <option value="BD-45">Nawabganj</option>
     <option value="BD-41">Netrakona</option>
     <option value="BD-46">Nilphamari</option>
     <option value="BD-47">Noakhali</option>
     <option value="BD-49">Pabna</option>
     <option value="BD-52">Panchagarh</option>
     <option value="BD-51">Patuakhali</option>
     <option value="BD-50">Pirojpur</option>
     <option value="BD-53">Rajbari</option>
     <option value="BD-54">Rajshahi</option>
     <option value="BD-56">Rangamati</option>
     <option value="BD-55">Rangpur</option>
     <option value="BD-58">Satkhira</option>
     <option value="BD-62">Shariatpur</option>
     <option value="BD-57">Sherpur</option>
     <option value="BD-59">Sirajganj</option>
     <option value="BD-61">Sunamganj</option>
     <option value="BD-60">Sylhet</option>
     <option value="BD-63">Tangail</option>
     <option value="BD-64">Thakurgaon</option>

</select>
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
        <label for="due">Discount</label>
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

