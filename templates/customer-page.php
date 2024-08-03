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

<h2> All Customer </h2>

<table class="admin_stock_page">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Receivale</th>
            <th>Paid</th>
            <th>Sale Due</th>
            <th>Personal Balance</th>
            <th>Total Due</th>
        </tr>
    </thead>
    <tbody>


        <?php
        $customers = get_users(array(
            'role'    => 'customer',
            'orderby' => 'user_registered',
            'order'   => 'DESC',
        ));

        $counter = 0;
        foreach ($customers as $customer) {
            $customer_data = get_userdata($customer->ID);
            $counter++;
        ?>
            <tr>
                <td><?php echo $counter; ?></td>
                <td><?php echo $customer_data->display_name; ?></td>
                <td><?php echo $customer_data->user_email; ?></td>
                <td>01960844035</td>
                <td>Bibir-Bagicha, Jatrabari</td>
                <td>6,000 Tk</td>
                <td>50 Tk</td>
                <td>5975 Tk</td>
                <td>11,000 <p>** কাস্টমারের টাকা আপনার কাছে জমা আছে</p>
                </td>
                <td>5,975 Tk</td>
            </tr>
        <?php
        }
        ?>



    </tbody>
</table>