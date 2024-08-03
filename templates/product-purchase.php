<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
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

<h2>Purchase Information</h2> 


<form class="search_filter_box" action="<?php echo admin_url('admin.php?page=stocks_page');?>" method="get">
    <input type="hidden" name="page" value="purchase_page">
    <input type="date" name="start_date"> 
    <input type="date" name="end_date" > 
    <select name="select_supplier">
        <option value="">Select Supplier</option>
        <?php
        $suppliers = new WP_Query(array(
            'post_type' => 'supplier',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ));
        if ($suppliers->have_posts()) {
            while ($suppliers->have_posts()) {
                $suppliers->the_post();
                echo '<option value="' . get_the_ID() . '"' . selected(isset($_GET['select_supplier']) ? $_GET['select_supplier'] : '', get_the_ID(), false) . '>' . get_the_title() . '</option>';
            }
            wp_reset_postdata();
        }
        ?>
    </select>
    <input type="submit" value="Submit">
    <a href="<?php echo admin_url('admin.php?page=purchase_page'); ?>">Reset</a>
</form>


<table class="admin_stock_page">
    <thead>
        <tr>
            <th>Bill No</th>
            <th>Supplier</th>
            <th>Purchase Date</th>
            <th>Payable</th>
            <th>Paid</th>
            <th>Due</th>
            <th> Product Name (Quantity) </th>
            
        </tr>
    </thead>
    <tbody>
<!-- Add your table data here -->

<?php 

// Define the number of items per page
$items_per_page = 10;
$current_page = isset($_GET['paged']) ? $_GET['paged'] : 1;
$offset = ($current_page - 1) * $items_per_page;


            global $wpdb;
            $table_name = $wpdb->prefix . 'woo_purchase_orders'; // Assuming the table name is wp_product_purchase
            // $query = "SELECT * FROM $table_name";
            // $results = $wpdb->get_results($query); 

            $results = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM $table_name 
                    LIMIT %d OFFSET %d",
                    $items_per_page,
                    $offset
                ) ); 

            // echo '<pre>' ;
            // print_r($results) ; 
            foreach ($results as $result){ 


                $bill_no = $result->bill_no;
                $table_name_2 = $wpdb->prefix . 'woo_purchase_order_items';
                $get_items = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM $table_name_2 
                        WHERE bill_no = %s
                        LIMIT %d OFFSET %d",
                        $bill_no,
                        $items_per_page,
                        $offset
                    )
                );


    ?>

<tr>
    <td> <?php echo $result->id ; ?> </td>
    <td> <?php echo get_the_title($result->supplier_id); ?> </td>
    <td> <?php echo $result->date ; ?> </td>
    <td> <?php echo $result->payable ; ?> </td>
    <td> <?php echo $result->paid ; ?> </td>
    <td> <?php echo $result->due ; ?> </td>
    <td> 
        
       <?php 


         foreach($get_items as $item){ 
            $product = wc_get_product($item->product_id);
            // echo '<pre>' ; 
            // print_r($product) ;  
            echo $product->get_title().'('.$item->quantity.')'.'<br>'; 
         }

       ?>
    </td>
</tr>

<?php } ?>
      



      




        <!-- Add more rows as needed -->
    </tbody>
</table>
<!-- 
</body>
</html> -->





<?php 




// Calculate the total number of items
$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name");
// Calculate the total number of pages
$total_pages = ceil($total_items / $items_per_page);
// Define the pagination base URL
$pagination_base_url = 'http://localhost/ecommerce_theme/wp-admin/admin.php?page=purchase_page';
// Generate the pagination links
$pagination_links = paginate_links(array(
  'base'      => $pagination_base_url . '%_%',
  'format'    => '&paged=%#%',
  'current'   => $current_page,
  'total'     => $total_pages,
  'prev_text' => '&laquo;',
  'next_text' => '&raquo;',
));
// Display the pagination links
if ($pagination_links) {
  echo '<div class="pagination pagination_frontend">' . $pagination_links . '</div>';
}


// print_r($pagination_base_url) ;
// print_r($current_page) ;
// print_r($offset) ;

?>