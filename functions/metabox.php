<?php

// Add Supplier Meta Box start 
function custom_supplier_meta_box() {
    add_meta_box(
        'custom_supplier_meta_box',
        __('Supplier Meta Box', 'text_domain'),
        'custom_supplier_meta_box_callback',
        'supplier', // Custom post type name
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_supplier_meta_box');

// Meta Box Callback Function
function custom_supplier_meta_box_callback($post) {
    // Retrieve existing meta values if they exist
    $field1_value = get_post_meta($post->ID, '_custom_supplier_email', true);
    $field2_value = get_post_meta($post->ID, '_custom_supplier_phone', true);
    $field3_value = get_post_meta($post->ID, '_custom_supplier_address', true);

    // Output fields
    ?>
    <p>

        <label for="custom_supplier_email"><?php _e('Supplier Mail:', 'text_domain'); ?></label><br>
        <input type="email" id="custom_supplier_email" name="custom_supplier_email" value="<?php echo esc_attr($field1_value); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="custom_supplier_phone"><?php _e('Supplier Phone:', 'text_domain'); ?></label><br>
        <input type="number" id="custom_supplier_phone" name="custom_supplier_phone" value="<?php echo esc_attr($field2_value); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="custom_supplier_address"><?php _e('Supplier Address:', 'text_domain'); ?></label><br>
        <textarea name="custom_supplier_address" id="" cols="30" rows="10" style="width: 100%;">
             <?php echo esc_attr($field3_value); ?>
        </textarea>
    </p>
    <?php
}

// Save Meta Box Data
function save_custom_supplier_meta_box_data($post_id) {

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // Save field data
    if (isset($_POST['custom_supplier_email'])) {
        update_post_meta($post_id, '_custom_supplier_email', sanitize_text_field($_POST['custom_supplier_email']));
    }
    if (isset($_POST['custom_supplier_phone'])) {
        update_post_meta($post_id, '_custom_supplier_phone', sanitize_text_field($_POST['custom_supplier_phone']));
    }
    if (isset($_POST['custom_supplier_address'])) {
        update_post_meta($post_id, '_custom_supplier_address', sanitize_text_field($_POST['custom_supplier_address']));
    }
}
add_action('save_post', 'save_custom_supplier_meta_box_data'); 


// Add Supplier Meta Box End 


// Add Expense Meta Box start 
function custom_expense_meta_box() {
    add_meta_box(
        'custom_expense_meta_box',
        __('Add Expense', 'text_domain'),
        'custom_expense_meta_box_callback',
        'expense', // Custom post type name
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'custom_expense_meta_box');

// Meta Box Callback Function
function custom_expense_meta_box_callback($post) {
    // Retrieve existing meta values if they exist
    $field1_value = get_post_meta($post->ID, 'expense-title', true);
    $field2_value = get_post_meta($post->ID, 'expense-amount', true);
    $field3_value = get_post_meta($post->ID, 'expense-date', true);
    $field4_value = get_post_meta($post->ID, 'expense-note', true);
    $formatted_date = date('Y-m-d', strtotime($field3_value));

    ?>
    <p> 
        <label for="expense-title"><?php _e('Expense Name:', 'text_domain'); ?></label><br>
        <input type="text" id="expense-title" name="expense-title" value="<?php echo esc_attr($field1_value); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="expense-amount"><?php _e('Expense Amount:', 'text_domain'); ?></label><br>
        <input type="text" id="expense-amount" name="expense-amount" value="<?php echo esc_attr($field2_value); ?>" style="width: 100%;">
    </p>

    <p>
        <label for="expense-date"><?php _e('Expense Date:', 'text_domain'); ?></label><br>
        <input type="date" id="expense-date" name="expense-date" value="<?php echo $formatted_date; ?>" style="width: 100%;">
    </p> 


  

    <p>
        <label for="expense-note"><?php _e('Expense Note:', 'text_domain'); ?></label><br>
        <textarea name="expense-note" id="" cols="30" rows="10" style="width: 100%;">
             <?php echo esc_attr($field4_value); ?>
        </textarea>
    </p>
    <?php
}

// Save Meta Box Data
function save_custom_expense_meta_box_data($post_id) {

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    // Save field data
    if (isset($_POST['custom_supplier_email'])) {
        update_post_meta($post_id, '_custom_supplier_email', sanitize_text_field($_POST['custom_supplier_email']));
    }
    if (isset($_POST['custom_supplier_phone'])) {
        update_post_meta($post_id, '_custom_supplier_phone', sanitize_text_field($_POST['custom_supplier_phone']));
    }
    if (isset($_POST['custom_supplier_address'])) {
        update_post_meta($post_id, '_custom_supplier_address', sanitize_text_field($_POST['custom_supplier_address']));
    }
}
add_action('save_post', 'save_custom_expense_meta_box_data'); 

// Add Expense Meta Box End 




// add assets metabox start 

function assets_add_meta_box() {
    add_meta_box(
        'assets_price_meta_box',      // ID of the meta box
        'Assets Price',               // Title of the meta box
        'assets_price_meta_box_callback',  // Callback function to render the meta box
        'assets',                     // Post type where the meta box should appear
        'side',                       // Context (normal, side, advanced)
        'high'                        // Priority (default, high, low)
    );
}
add_action('add_meta_boxes', 'assets_add_meta_box');

// Render the meta box
function assets_price_meta_box_callback($post) {
    // Add a nonce field for security
    wp_nonce_field('save_assets_price_meta_box_data', 'assets_price_meta_box_nonce');

    // Get the current value of the meta field
    $value = get_post_meta($post->ID, '_assets_price', true);

    // Render the input field
    echo '<label for="assets_price_field">Price: </label>';
    echo '<input type="text" id="assets_price_field" name="assets_price_field" value="' . esc_attr($value) . '" size="100" />';
}

// Save the meta box data
function save_assets_price_meta_box_data($post_id) {
    // Check if our nonce is set
    if (!isset($_POST['assets_price_meta_box_nonce'])) {
        return;
    }

    // Verify that the nonce is valid
    if (!wp_verify_nonce($_POST['assets_price_meta_box_nonce'], 'save_assets_price_meta_box_data')) {
        return;
    }

    // Check if this is an autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (isset($_POST['post_type']) && 'assets' == $_POST['post_type']) {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    } else {
        return;
    }

    // Sanitize user input
    if (!isset($_POST['assets_price_field'])) {
        return;
    }

    $price = sanitize_text_field($_POST['assets_price_field']);

    // Update the meta field in the database
    update_post_meta($post_id, '_assets_price', $price);
}
add_action('save_post', 'save_assets_price_meta_box_data');


// add assets metabox end  








