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

<h2>Return Information</h2>
<?php 
    // Get cancelled orders
    $cancelled_orders = wc_get_orders(array(
        'status' => 'cancelled',
        'limit'  => -1,
    ));
?>

<table class="admin_stock_page">
    <thead>
        <tr>
            <th>No</th>
            <th>Sell Date</th>
            <th>Selling Price</th>
            <th>Items</th>

        </tr>
    </thead>
    <tbody>
     
        <?php 
            foreach ($cancelled_orders as $order) {
                echo '<tr>' ; 
                echo '<td>' . $order->get_id() . '</td>';
                echo '<td>' . wc_format_datetime($order->get_date_created()) . '</td>';
                echo '<td>' . wc_price($order->get_total()) . '</td>';
                echo '<td><ul>';
                foreach ($order->get_items() as $item_id => $item) {
                    echo '<li>' . $item->get_name() . ' - Quantity: ' . $item->get_quantity() . '</li>';
                }
                echo '</ul></td>';
                echo '</tr>' ; 
            }
        ?>
   </tbody>
</table>
