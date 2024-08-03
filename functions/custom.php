<?php

// Register Custom Post Type
function custom_supplier_post_type() {

    $labels = array(
        'name'                  => _x( 'Suppliers', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Supplier', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Suppliers', 'text_domain' ),
        'name_admin_bar'        => __( 'Supplier', 'text_domain' ),
        'archives'              => __( 'Supplier Archives', 'text_domain' ),
        'attributes'            => __( 'Supplier Attributes', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Supplier:', 'text_domain' ),
        'all_items'             => __( 'All Suppliers', 'text_domain' ),
        'add_new_item'          => __( 'Add New Supplier', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Supplier', 'text_domain' ),
        'edit_item'             => __( 'Edit Supplier', 'text_domain' ),
        'update_item'           => __( 'Update Supplier', 'text_domain' ),
        'view_item'             => __( 'View Supplier', 'text_domain' ),
        'view_items'            => __( 'View Suppliers', 'text_domain' ),
        'search_items'          => __( 'Search Supplier', 'text_domain' ),
        'not_found'             => __( 'Supplier Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Supplier Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into supplier', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this supplier', 'text_domain' ),
        'items_list'            => __( 'Suppliers list', 'text_domain' ),
        'items_list_navigation' => __( 'Suppliers list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter suppliers list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'Supplier', 'text_domain' ),
        'description'           => __( 'Supplier Description', 'text_domain' ),
        'supports'              => array( 'title', 'thumbnail' ),
        'labels'                => $labels,
        
        // 'taxonomies'            => array( 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'show_in_rest'          => true,
        'menu_icon' => 'dashicons-businessman' // Dashicon class for icon
    );
    register_post_type( 'supplier', $args ); 

}
add_action( 'init', 'custom_supplier_post_type', 0 );



// brands taxonomy function  

function create_product_brand_taxonomy()
{
    $labels = array(
        'name'              => _x('Brands', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Brand', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Brands', 'textdomain'),
        'all_items'         => __('All Brands', 'textdomain'),
        'parent_item'       => __('Parent Brand', 'textdomain'),
        'parent_item_colon' => __('Parent Brand:', 'textdomain'),
        'edit_item'         => __('Edit Brand', 'textdomain'),
        'update_item'       => __('Update Brand', 'textdomain'),
        'add_new_item'      => __('Add New Brand', 'textdomain'),
        'new_item_name'     => __('New Brand Name', 'textdomain'),
        'menu_name'         => __('Brands', 'textdomain'),
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,  // Set this to true if you want a hierarchical taxonomy like categories
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'product_brand'),  // Change 'product_brand' to your desired slug
    );

    register_taxonomy('product_brand', 'product', $args);
}

add_action('init', 'create_product_brand_taxonomy');





// Register Custom Post Type
function register_expense_post_type()
{
    $labels = array(
        'name'               => _x('Expenses', 'post type general name', 'textdomain'),
        'singular_name'      => _x('Expense', 'post type singular name', 'textdomain'),
        'menu_name'          => _x('Expenses', 'admin menu', 'textdomain'),
        'name_admin_bar'     => _x('Expense', 'add new on admin bar', 'textdomain'),
        'add_new'            => _x('Add New', 'expense', 'textdomain'),
        'add_new_item'       => __('Add New Expense', 'textdomain'),
        'new_item'           => __('New Expense', 'textdomain'),
        'edit_item'          => __('Edit Expense', 'textdomain'),
        'view_item'          => __('View Expense', 'textdomain'),
        'all_items'          => __('All Expenses', 'textdomain'),
        'search_items'       => __('Search Expenses', 'textdomain'),
        'parent_item_colon'  => __('Parent Expenses:', 'textdomain'),
        'not_found'          => __('No expenses found.', 'textdomain'),
        'not_found_in_trash' => __('No expenses found in Trash.', 'textdomain'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'textdomain'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'expense'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 11,
        'supports'           => array('title'),
        'menu_icon' => 'dashicons-money' // Dashicon class for icon
    );

    register_post_type('expense', $args);
}
add_action('init', 'register_expense_post_type');

// Register Custom Taxonomy
function register_expense_category_taxonomy()
{
    $labels = array(
        'name'                       => _x('Expense Categories', 'taxonomy general name', 'textdomain'),
        'singular_name'              => _x('Expense Category', 'taxonomy singular name', 'textdomain'),
        'search_items'               => __('Search Expense Categories', 'textdomain'),
        'popular_items'              => __('Popular Expense Categories', 'textdomain'),
        'all_items'                  => __('All Expense Categories', 'textdomain'),
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => __('Edit Expense Category', 'textdomain'),
        'update_item'                => __('Update Expense Category', 'textdomain'),
        'add_new_item'               => __('Add New Expense Category', 'textdomain'),
        'new_item_name'              => __('New Expense Category Name', 'textdomain'),
        'separate_items_with_commas' => __('Separate expense categories with commas', 'textdomain'),
        'add_or_remove_items'        => __('Add or remove expense categories', 'textdomain'),
        'choose_from_most_used'      => __('Choose from the most used expense categories', 'textdomain'),
        'not_found'                  => __('No expense categories found.', 'textdomain'),
        'menu_name'                  => __('Expense Categories', 'textdomain'),
    );

    $args = array(
        'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array('slug' => 'expense-category'),
    );

    register_taxonomy('expense_category', 'expense', $args);
}
add_action('init', 'register_expense_category_taxonomy');



// facebook page message 

function create_fbmessage_post_type() {
    $labels = array(
        'name'                  => _x( 'FB Messages', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'FB Message', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'FB Messages', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'FB Message', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New FB Message', 'textdomain' ),
        'new_item'              => __( 'New FB Message', 'textdomain' ),
        'edit_item'             => __( 'Edit FB Message', 'textdomain' ),
        'view_item'             => __( 'View FB Message', 'textdomain' ),
        'all_items'             => __( 'All FB Messages', 'textdomain' ),
        'search_items'          => __( 'Search FB Messages', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent FB Messages:', 'textdomain' ),
        'not_found'             => __( 'No FB Messages found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No FB Messages found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'FB Message Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'FB Message archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into FB Message', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this FB Message', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter FB Messages list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'FB Messages list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'FB Messages list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'fbmessage' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 12,
        'supports'           => array( 'title' , 'thumbnail'),
        'menu_icon' => 'dashicons-facebook' // Dashicon class for icon
    );

    register_post_type( 'fbmessage', $args );
}

add_action( 'init', 'create_fbmessage_post_type' );




// Add a custom column to the 'fbmessage' post type list view
function add_fbmessage_columns($columns) {
    $new_columns = array();

    foreach ($columns as $key => $value) {
        if ($key == 'title') { // Insert the new column after the title column
            $new_columns[$key] = $value;
            $new_columns['message_link'] = __('Message Link', 'textdomain');
        } else {
            $new_columns[$key] = $value;
        }
    }

    return $new_columns;
}
add_filter('manage_fbmessage_posts_columns', 'add_fbmessage_columns');

// Display the content of the custom column
function display_fbmessage_custom_column($column, $post_id) {
    if ($column == 'message_link') {
        $link_msg = get_post_meta($post_id, 'link-msg', true);
         ?>
            <a target="_blank" href="<?php echo $link_msg; ?>"> Message Link </a>
        <?php 
    }
}
add_action('manage_fbmessage_posts_custom_column', 'display_fbmessage_custom_column', 10, 2);


// Make the custom column sortable
function fbmessage_sortable_columns($columns) {
    $columns['message_link'] = 'message_link';
    return $columns;
}
add_filter('manage_edit-fbmessage_sortable_columns', 'fbmessage_sortable_columns');



// custom  post type for assets 

function create_assets_post_type() {
    $labels = array(
        'name'                  => _x('Assets', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Asset', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Assets', 'text_domain'),
        'name_admin_bar'        => __('Asset', 'text_domain'),
        'archives'              => __('Asset Archives', 'text_domain'),
        'attributes'            => __('Asset Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Asset:', 'text_domain'),
        'all_items'             => __('All Assets', 'text_domain'),
        'add_new_item'          => __('Add New Asset', 'text_domain'),
        'add_new'               => __('Add New', 'text_domain'),
        'new_item'              => __('New Asset', 'text_domain'),
        'edit_item'             => __('Edit Asset', 'text_domain'),
        'update_item'           => __('Update Asset', 'text_domain'),
        'view_item'             => __('View Asset', 'text_domain'),
        'view_items'            => __('View Assets', 'text_domain'),
        'search_items'          => __('Search Asset', 'text_domain'),
        'not_found'             => __('Not found', 'text_domain'),
        'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
        'featured_image'        => __('Featured Image', 'text_domain'),
        'set_featured_image'    => __('Set featured image', 'text_domain'),
        'remove_featured_image' => __('Remove featured image', 'text_domain'),
        'use_featured_image'    => __('Use as featured image', 'text_domain'),
        'insert_into_item'      => __('Insert into asset', 'text_domain'),
        'uploaded_to_this_item' => __('Uploaded to this asset', 'text_domain'),
        'items_list'            => __('Assets list', 'text_domain'),
        'items_list_navigation' => __('Assets list navigation', 'text_domain'),
        'filter_items_list'     => __('Filter assets list', 'text_domain'),
    );

    $args = array(
        'label'                 => __('Asset', 'text_domain'),
        'description'           => __('Assets for your website', 'text_domain'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail'),
        'taxonomies'            => array(),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 13,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );

    register_post_type('assets', $args);
}

add_action('init', 'create_assets_post_type', 0);
