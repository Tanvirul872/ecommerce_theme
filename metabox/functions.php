<?php



// function metabox_for_expense(array $product_meta)
// {



//     // home blog section 
//     $product_meta[] = array(

//         'id' => 'post-expense',
//         'title' => 'Add Expense',
//         'object_types' => array('expense'),
//         'fields' => array(

//             array(
//                 'id' => 'expense-title',
//                 'name' => 'Expense Name:',
//                 'desc' => 'Write Expense Name',
//                 'type' => 'text',
//             ),


//             array(
//                 'id' => 'expense-amount',
//                 'name' => 'Expense Amount:',
//                 'desc' => ' Expense Amount',
//                 'type' => 'text',
//             ),

        
//             array(
//                 'id' => 'expense-date',
//                 'name' => 'Expense Date',
//                 'desc' => 'Write Expense Date',
//                 'type' => 'text_date',
//             ),

//             array(
//                 'id'      => 'expense-note',
//                 'type'    => 'textarea',
//                 'name'    => 'Expense Note',
//                 'desc'    => 'Select Expense Category',


//             ),

//         )
//     );

//     return $product_meta;
// }

// add_filter('cmb2_meta_boxes', 'metabox_for_expense');


// Metabox for taxonomy term (pa_color in this case)

function metabox_fbmessage(array $taxonomy_meta)
{
    $taxonomy_meta[] = array(
        'id'            => 'link-fbmessage',
        'title'         => 'Extra Section',
        'object_types'  => array('fbmessage'), // Specify 'term' here for taxonomy
        'fields'        => array(
            array(
                'id'   => 'link-msg',
                'name' => 'Message link',
                'desc' => 'put the link here',
                'type' => 'text',
                'default' => '',
            ),
        )
    );

    return $taxonomy_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_fbmessage');





function metabox_sreview_color(array $taxonomy_meta)
{
    $taxonomy_meta[] = array(
        'id'            => 'term-review-position',
        'title'         => 'Extra Section',
        'object_types'  => array('term'), // Specify 'term' here for taxonomy
        'taxonomies'    => array('pa_color'), // Specify your taxonomy name here
        'fields'        => array(
            array(
                'id'   => 'color-attribute',
                'name' => 'Select color',
                'desc' => 'Select the color',
                'type' => 'colorpicker',
                'default' => '#ffffff',


            ),


        )
    );

    return $taxonomy_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_sreview_color');






//metabox for homepage

function metabox_homepage(array $product_meta)
{

    $product_meta[] = array(

        'id' => 'home-showroom',
        'title' => 'Home About Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(
            array(
                'id' => 'habout-utitle',
                'name' => 'Upper title',
                'desc' => 'Write here the title',
                'type' => 'text',
            ),
            array(
                'id' => 'habout-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the main title',
                'type' => 'textarea',
            ),

            array(
                'id' => 'habout-desc',
                'name' => 'Description',
                'desc' => 'Write here the description',
                'type' => 'textarea',
            ),

            array(
                'id' => 'habout-cboxtitle',
                'name' => 'Call box title',
                'desc' => 'Write here the text',
                'type' => 'text',
            ),

            array(
                'id' => 'habout-cboxno',
                'name' => 'Call box number',
                'desc' => 'Write here the number',
                'type' => 'wysiwyg',
            ),

            array(
                'id' => 'habout-btnlink',
                'name' => 'Call box button link',
                'desc' => 'Write here the link',
                'type' => 'wysiwyg',
            ),
            array(
                'id' => 'habout-img1',
                'name' => 'Left Image 1',
                'desc' => 'Upload Image',
                'type' => 'file',
            ),

            array(
                'id' => 'habout-img2',
                'name' => 'Left Image 2',
                'desc' => 'Upload Image',
                'type' => 'file',
            ),

        )

    );



    $product_meta[] = array(

        'id' => 'home-services',
        'title' => 'Home Services Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(


            array(
                'id' => 'hservice-utitle',
                'name' => 'Upper title',
                'desc' => 'Write here the title',
                'type' => 'text',
            ),

            array(
                'id' => 'hservice-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the main title',
                'type' => 'text',
            ),


        )

    );


    $product_meta[] = array(

        'id' => 'home-achieve-number',
        'title' => 'Achivement Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'hachieve-bg',
                'name' => 'Background Image',
                'desc' => 'Upload the image',
                'type' => 'file',
            ),

        )

    );



    $product_meta[] = array(

        'id' => 'home-whychoseus',
        'title' => 'Why choose us Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'whychs-stitle',
                'name' => 'Subtitle',
                'desc' => 'Write here the Subtitle',
                'type' => 'text',
            ),

            array(
                'id' => 'whychs-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the Main title',
                'type' => 'text',
            ),

            array(
                'id' => 'whychs-limg',
                'name' => 'Left Side Image',
                'desc' => 'Upload image here',
                'type' => 'file',
            ),

        )

    );


    // home skill section 
    $product_meta[] = array(

        'id' => 'home-skillsection',
        'title' => 'Skill Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'skill-stitle',
                'name' => 'Subtitle',
                'desc' => 'Write here the Subtitle',
                'type' => 'text',
            ),

            array(
                'id' => 'skill-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the Main title',
                'type' => 'text',
            ),

            array(
                'id' => 'skill-desc',
                'name' => 'Description',
                'desc' => 'Write here the description',
                'type' => 'textarea',
            ),


            array(
                'id' => 'skill-img1',
                'name' => 'Right Side Image 1',
                'desc' => 'Upload image here',
                'type' => 'file',
            ),

        )

    );




    // home blog section 
    $product_meta[] = array(

        'id' => 'home-blogsection',
        'title' => 'Blog Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'hblog-stitle',
                'name' => 'Subtitle',
                'desc' => 'Write here the Subtitle',
                'type' => 'text',
            ),


            array(
                'id' => 'hblog-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the Main title',
                'type' => 'text',
            ),

        )

    );


    // home consultation section 
    $product_meta[] = array(

        'id' => 'home-consultsec',
        'title' => 'Consultation Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'hconsult-stitle',
                'name' => 'Subtitle',
                'desc' => 'Write here the Subtitle',
                'type' => 'text',
            ),


            array(
                'id' => 'hconsult-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the Main title',
                'type' => 'text',
            ),

            array(
                'id' => 'hconsult-link',
                'name' => 'Button Link',
                'desc' => 'Write here the link url',
                'type' => 'text',
            ),


            array(
                'id' => 'hconsult-bgimg',
                'name' => 'Image',
                'desc' => 'Upload the image',
                'type' => 'file',
            ),

        )

    );



    // home consultation section 
    $product_meta[] = array(

        'id' => 'home-consultsec',
        'title' => 'Consultation Section',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'fields' => array(

            array(
                'id' => 'hconsult-stitle',
                'name' => 'Subtitle',
                'desc' => 'Write here the Subtitle',
                'type' => 'text',
            ),


            array(
                'id' => 'hconsult-mtitle',
                'name' => 'Main title',
                'desc' => 'Write here the Main title',
                'type' => 'text',
            ),

            array(
                'id' => 'hconsult-link',
                'name' => 'Button Link',
                'desc' => 'Write here the link url',
                'type' => 'text',
            ),


            array(
                'id' => 'hconsult-bgimg',
                'name' => 'Image',
                'desc' => 'Upload the image',
                'type' => 'file',
            ),

        )

    );





    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_homepage');





//metabox for service

function metabox_service(array $product_meta)
{
    $product_meta[] = array(
        'id' => 'post-services',
        'title' => 'Extra Section',
        'object_types' => array('service'),
        'fields' => array(
            array(
                'id' => 'service-jobs',
                'name' => 'Jobs done',
                'desc' => 'Write here the jobs done text',
                'type' => 'text',
            ),

            array(
                'id' => 'service-image',
                'name' => 'Upload box image',
                'desc' => 'Upload the image',
                'type' => 'file',
            ),
        )

    );

    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_service');


//metabox for contact page
function metabox_contact(array $contact_meta)
{
    $contact_meta[] = array(
        'id' => 'contact-meta',
        'title' => 'Extra Section For Contact',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',
            'value' => 'contact.php',
        ),
        'fields' => array(
            array(
                'id' => 'contact-title',
                'name' => 'Contact Title',
                'default' => 'Contact Us',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-address-title',
                'name' => 'Office Address Title',
                'default' => 'Office Address',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-address-desc',
                'name' => 'Office Address Description',
                'default' => 'Completely recaptiualize 24/7 communities via standards compliant metrics whereas web-enabled content',
                'type' => 'wysiwyg',
            ),

            array(
                'id' => 'contact-office-number',
                'name' => 'Office Contact Number',
                'default' => '+(310) 2591 21563',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-email',
                'name' => 'Office Contact Email',
                'default' => 'info@example.com',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-address',
                'name' => 'Office Contact Address',
                'default' => '258 Dancing Street, Miland Line, HUYI 21563, FrankFrut',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-time',
                'name' => 'Office Time',
                'default' => '7:00am - 6:00pm ( Mon - Fri ) Sat, Sun & Holiday Closed',
                'type' => 'text',
            ),

            array(
                'id' => 'contact-office-form-title',
                'name' => 'Contact Form Title',
                'default' => 'Leave a Message',
                'type' => 'text',
            ),
            array(
                'id' => 'contact-office-form-sub-title',
                'name' => 'Contact Form Sub-Title',
                'default' => 'We re Ready To Help You',
                'type' => 'text',
            ),

        )

    );

    return $contact_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_contact');


//metabox for contact page
function metabox_buy_product_form(array $buy_product_meta)
{
    $buy_product_meta[] = array(
        'id' => 'buy-product-meta',
        'title' => 'Extra Section For Buy Product',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',
            'value' => 'buy-product.php',
        ),
        'fields' => array(
            array(
                'id' => 'buy-product-title',
                'name' => 'Buy Product Title',
                'default' => 'Buy Product',
                'type' => 'text',
            ),
            array(
                'id' => 'buy-product-form-title',
                'name' => 'Buy Product Form Title',
                'default' => 'Buy Product Form Title',
                'type' => 'text',
            ),
            array(
                'id' => 'buy-product-form-sub-title',
                'name' => 'Buy Product Form Sub Title',
                'default' => 'Buy Product Form Sub Title',
                'type' => 'text',
            ),
        )

    );

    return $buy_product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_buy_product_form');




//metabox for review post type 

function metabox_sreview(array $product_meta)
{
    $product_meta[] = array(
        'id' => 'post-review',
        'title' => 'Extra Section',
        'object_types' => array('review'),
        'fields' => array(

            array(
                'id' => 'review-position',
                'name' => 'Client Position',
                'desc' => 'Write here the position text',
                'type' => 'text',
            ),

        )

    );

    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_sreview');




//metabox for slider post type 

function metabox_slider_home(array $product_meta)
{
    $product_meta[] = array(
        'id' => 'post-slider',
        'title' => 'Extra Section',
        'object_types' => array('slider'),
        'fields' => array(


            array(
                'id' => 'slider-desc',
                'name' => 'Slider Descrption',
                'desc' => 'Write here the descrption text',
                'type' => 'textarea',
            ),

            array(
                'id' => 'slider-titleup',
                'name' => 'Upper title text',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),

            array(
                'id' => 'slider-titlebottom',
                'name' => 'Bottom title text',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),

            array(
                'id' => 'slider-titleborderd',
                'name' => 'Bordered title text',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),


            array(
                'id' => 'slider-titlebottom',
                'name' => 'Bottom title text',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),


            array(
                'id' => 'slider-btntxt1',
                'name' => 'Button 1 title',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),

            array(
                'id' => 'slider-btnlink1',
                'name' => 'Button 1 Link',
                'desc' => 'Write here the link url',
                'type' => 'text',
            ),


            array(
                'id' => 'slider-btntxt2',
                'name' => 'Button 2 title',
                'desc' => 'Write here the title text',
                'type' => 'text',
            ),

            array(
                'id' => 'slider-btnlink2',
                'name' => 'Button 2 Link',
                'desc' => 'Write here the link url',
                'type' => 'text',
            ),

        )

    );

    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_slider_home');





//metabox for ourproducts post type 

function metabox_slider_products(array $product_meta)
{
    $product_meta[] = array(
        'id' => 'product-slider',
        'title' => 'Extra Section',
        'object_types' => array('ourproduct'),
        'fields' => array(


            array(
                'id' => 'opro-btnlink1',
                'name' => 'Button 1 link',
                'desc' => 'Write here the link',
                'type' => 'text',
            ),
            array(
                'id' => 'opro-btnlink2',
                'name' => 'Button 2 link',
                'desc' => 'Write here the link',
                'type' => 'text',
            ),

        )
    );
    return $product_meta;
}

add_filter('cmb2_meta_boxes', 'metabox_slider_products');



// repeater add more option for home achivement number            
add_action('cmb2_admin_init', 'home_achivement_metaboxes');
function home_achivement_metaboxes()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_home',  // Belgrove Bouncing Castles
        'title' => 'Achievement Number',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));

    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_home_number',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More Field {#}',
            'add_button' => 'Add Another Field',
            'remove_button' => 'Remove Field',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Number',
        'desc' => 'Enter the number',
        'id' => 'home-achive-num',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Subtitle',
        'desc' => 'Enter the Subtitle',
        'id' => 'home-achive-subtitle',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Image',
        'desc' => 'Upload the Image',
        'id' => 'home-achive-img',
        'type' => 'file',
    ));
}



// repeater add more option for device

add_action('cmb2_admin_init', 'service_ptypes_metaboxes');
function service_ptypes_metaboxes()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo',  // Belgrove Bouncing Castles
        'title' => 'Add More Field',
        'object_types' => array('service'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));

    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_service',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More Field {#}',
            'add_button' => 'Add Another Field',
            'remove_button' => 'Remove Field',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Field Title',
        'desc' => 'Enter the field title',
        'id' => 'service-field-title',
        'type' => 'text',
    ));
}




// repeater add more option for home why choose us section 

add_action('cmb2_admin_init', 'service_home_whychoose');
function service_home_whychoose()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_whychoose',  // Belgrove Bouncing Castles
        'title' => 'Why choose us Tab',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));



    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_hwhychoose',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More Tab {#}',
            'add_button' => 'Add Another Tab',
            'remove_button' => 'Remove Tab',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Tab Title',
        'desc' => 'Enter the Tab title',
        'id' => 'whychoose-title',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Tab Descrption',
        'desc' => 'Enter the Tab descrption',
        'id' => 'whychoose-desc',
        'type' => 'textarea',
    ));
}




// repeater add more option for home skill section 

add_action('cmb2_admin_init', 'service_home_skill');
function service_home_skill()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_hskill',  // Belgrove Bouncing Castles
        'title' => 'Skill Section Skills',
        'object_types' => array('page'),
        'show_on' => array(
            'key' => 'page-template',  // This sets the display condition to only show the metabox on pages using the Homepage template
            'value' => 'index.php',  //page file name
        ),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));



    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_hskills',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More skill {#}',
            'add_button' => 'Add Another skill',
            'remove_button' => 'Remove skill',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'skill Title',
        'desc' => 'Enter the skill title',
        'id' => 'hskill-title',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Number Percentage',
        'desc' => 'Enter the Tab Number',
        'id' => 'hskill-number',
        'type' => 'text',
    ));
}





// repeater add more option for ourproduct post type 

add_action('cmb2_admin_init', 'service_ourproduct_details');
function service_ourproduct_details()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_opdetails',  // Belgrove Bouncing Castles
        'title' => 'Product details',
        'object_types' => array('ourproduct'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));



    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_opdetails',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More details {#}',
            'add_button' => 'Add Another details',
            'remove_button' => 'Remove details',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Details Title',
        'desc' => 'Enter the skill title',
        'id' => 'oprodetail-title',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Details Content',
        'desc' => 'Enter the content',
        'id' => 'oprodetail-content',
        'type' => 'wysiwyg',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Details Content',
        'desc' => 'Enter the content',
        'id' => 'oprodetail-img',
        'type' => 'file',
    ));
}



// repeater faq option for ourproduct post type 

add_action('cmb2_admin_init', 'service_ourproduct_faqs');
function service_ourproduct_faqs()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_opfaqs',  // Belgrove Bouncing Castles
        'title' => 'Product Faqs',
        'object_types' => array('ourproduct'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
    ));



    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_opfaqs',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More faq {#}',
            'add_button' => 'Add Another faq',
            'remove_button' => 'Remove faq',
            'closed' => true,  // Repeater fields closed by default - neat & compact.
            'sortable' => true,  // Allow changing the order of repeated groups.
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Faq Question',
        'desc' => 'Enter the Question',
        'id' => 'opfaqs-qustn',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Faq Answer',
        'desc' => 'Enter the Answer',
        'id' => 'opfaqs-answr',
        'type' => 'textarea',
    ));
}


// repeater reviews option for ourproduct post type 
add_action('cmb2_admin_init', 'service_ourproduct_review');
function service_ourproduct_review()
{

    $cmb = new_cmb2_box(array(
        'id' => 'repeater_demo_opreview',
        'title' => 'Product Reviews',
        'object_types' => array('ourproduct'),
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true,
    ));



    $add_more_option = $cmb->add_field(array(
        'id' => 'spost_group_opreview',
        'type' => 'group',
        'repeatable' => true,
        'options' => array(
            'group_title' => 'Add More Review {#}',
            'add_button' => 'Add Another Review',
            'remove_button' => 'Remove Review',
            'closed' => true,
            'sortable' => true,
        ),
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Reviewer name',
        'desc' => 'Enter the Reviewer name',
        'id' => 'opreview-name',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Reviewer designation',
        'desc' => 'Enter the Reviewer designation',
        'id' => 'opreview-desg',
        'type' => 'text',
    ));

    $cmb->add_group_field($add_more_option, array(
        'name' => 'Reviewer content',
        'desc' => 'Enter the Reviewer content',
        'id' => 'opreview-cntnt',
        'type' => 'textarea',
    ));
}



/*
Output=========
<?php echo get_post_meta(get_the_ID(),'developer', true); ?>
*/


