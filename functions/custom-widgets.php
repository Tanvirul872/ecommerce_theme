<?php
// custom dashboard widgets  

function add_custom_dashboard_widget()
{
    wp_add_dashboard_widget(
        'custom_dashboard_widget',
        'Today Sold',
        'custom_dashboard_widget_content'
    );


    wp_add_dashboard_widget(
        'custom_dashboard_widget_2',
        'Today Expense',
        'custom_dashboard_widget_content2'
    );

    wp_add_dashboard_widget(
        'custom_dashboard_widget_3',
        'Today Purchase Cost',
        'custom_dashboard_widget_content3'
    );


    wp_add_dashboard_widget(
        'custom_dashboard_widget_4',
        'Today Sell Profit',
        'custom_dashboard_widget_content_4'
    );


    wp_add_dashboard_widget(
        'custom_dashboard_widget_5',
        'Total Receivable',
        'custom_dashboard_widget_content_5'
    );

    wp_add_dashboard_widget(
        'custom_dashboard_widget_6',
        'Total Payable',
        'custom_dashboard_widget_content6'
    );

    wp_add_dashboard_widget(
        'custom_dashboard_widget_7',
        'Stock-Purchase Value',
        'custom_dashboard_widget_content7'
    );

    wp_add_dashboard_widget(
        'custom_dashboard_widget_8',
        ' Stock - Sell Value',
        'custom_dashboard_widget_content8'
    );

    wp_add_dashboard_widget(
        'custom_dashboard_widget_9',
        'Assets Value',
        'custom_dashboard_widget_content9'
    );



    // Remove other default dashboard widgets
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');     // Activity
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');    // Quick Press
    remove_meta_box('dashboard_primary', 'dashboard', 'side');        // WordPress News
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');      // Other WordPress News
    remove_meta_box('dashboard_site_health', 'dashboard', 'normal');   //Site Health
    remove_meta_box('wc_admin_dashboard_setup', 'dashboard', 'normal');   // Other WordPress News



}
add_action('wp_dashboard_setup', 'add_custom_dashboard_widget');


// dashboard widget  add and remove 

function custom_dashboard_widget_content()
{
    ?>
     <!-- dashboard widget 1 -->
     <div class="custom_widget_box widget_today_sold">
          <h2> Today Sold </h2>
          <p> <?php echo strip_tags( wc_price(get_order_sales_by_date() ) ) ; ?>  </p>
     </div>
    <?php
}


function custom_dashboard_widget_content2()
{
    ?>
     <!-- dashboard widget 1 -->
     <div class="custom_widget_box widget_today_expense">
          <h2>  Today Expense  </h2>
          <p><?php echo strip_tags( wc_price(calculate_total_expense_today() ) ) ; ?> </p>
     </div>
    <?php
}

function custom_dashboard_widget_content3()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_today_purchse">
         <h2> Today Purchase Cost  </h2>
         <p><?php echo strip_tags( wc_price(get_todays_purchase_cost() ) ) ; ?></p>
    </div>
   <?php
}



function custom_dashboard_widget_content_4()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_today_sell_prft">
         <h2> Today Sell Profit </h2>
         <p> <?php echo strip_tags( wc_price(get_todays_sell_profit() ) ) ; ?> </p>
    </div>
   <?php
}


function custom_dashboard_widget_content_5()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_today_rcvble">
         <h2> Total Receivable </h2>
         <p>0</p>
    </div>
   <?php
}


function custom_dashboard_widget_content6()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_today_payble">
         <h2> Total Payable </h2>
         <p>0</p>
    </div>
   <?php
}


function custom_dashboard_widget_content7()
{ ?>


    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_stck_prchase">
         <h2>Stock-Purchase Value</h2>
         <p>
            <?php echo strip_tags( wc_price(total_stock_purchase_value() ) ) ; ?>
        </p>
    </div>
   <?php
}

function custom_dashboard_widget_content8()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_stck_sell">
         <h2> Stock - Sell Value </h2>
         <p><?php echo strip_tags( wc_price(total_stock_sell_value() ) ) ; ?></p>
    </div>
   <?php

}

function custom_dashboard_widget_content9()
{
    ?>
    <!-- dashboard widget 1 -->
    <div class="custom_widget_box widget_stck_sell">
         <h2> Total Assets Value </h2>
         <p><?php echo strip_tags( wc_price(total_asets_value() ) ) ; ?></p>
    </div>
   <?php

}



