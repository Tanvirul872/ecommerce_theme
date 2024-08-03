<?php 

//create database for review options 
function create_db_for_suppliers() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'product_suppliers';

    $sql = "CREATE TABLE $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        supplier_name VARCHAR(255) NOT NULL,
        supplier_address VARCHAR(255) NOT NULL,
        supplier_email VARCHAR(255) NOT NULL,
        supplier_phone INT(11) NOT NULL,
        PRIMARY KEY (id)
    )";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

add_action( 'after_switch_theme', 'create_db_for_suppliers' );


// Register activation hook
register_activation_hook( __FILE__, 'woo_product_profit_create_table' );
add_action( 'after_switch_theme', 'woo_product_profit_create_table' ); 
function woo_product_profit_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'woo_product_profit';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        profit decimal(10, 2) NOT NULL,
        profit_cat varchar(255) NOT NULL,
        date datetime NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}





// Register activation hook
register_activation_hook( __FILE__, 'woo_product_purchase_order_table' );
add_action( 'after_switch_theme', 'woo_product_purchase_order_table' ); 
function woo_product_purchase_order_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'woo_purchase_orders';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        bill_no varchar(255) NOT NULL,
        payable varchar(255) NOT NULL,
        paid varchar(255) NOT NULL,
        due varchar(255) NOT NULL,
        note varchar(255)  NULL,
        supplier_id int(11) NOT NULL,
        date datetime NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}



// Register activation hook
register_activation_hook( __FILE__, 'woo_product_purchase_order_items' );
add_action( 'after_switch_theme', 'woo_product_purchase_order_items' ); 
function woo_product_purchase_order_items() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'woo_purchase_order_items';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        product_id INT(11) NOT NULL,
        rate varchar(255) NOT NULL,
        bill_no varchar(255) NOT NULL,
        quantity INT(11) NOT NULL,
        subtotal INT(11) NOT NULL,
        date datetime NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}







// Add a new field to the wp_woocommerce_order_items table
function add_product_profit_field() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'woocommerce_order_items'; // Get the table name with the proper prefix
  
    // Check if the field already exists
    $column_exists = $wpdb->get_results("SHOW COLUMNS FROM $table_name LIKE 'product_profit'");
    if (!$column_exists) {
        $wpdb->query("ALTER TABLE $table_name ADD product_profit BIGINT(20) NOT NULL DEFAULT AFTER order_item_type");
    }
  }
  
  // Hook into theme activation
  function theme_activation_hook() {
    add_product_profit_field();
  }
  register_activation_hook( __FILE__, 'theme_activation_hook' );
  add_action( 'after_switch_theme', 'add_product_profit_field' );    
?>