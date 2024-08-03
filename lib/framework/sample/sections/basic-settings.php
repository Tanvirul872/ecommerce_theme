<?php
	defined( 'ABSPATH' ) || exit;
	
	// Basic Settings //

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Header Settings', 'bongotheme-limited' ),
        'id'               => 'web-basic',
        'icon'             => 'fa fa-cog',
		'fields'           => array(

            array(
                'id' => 'header-logo',
                'type' => 'media',
                'title' => __('Logo Image Uploader', 'bongotheme-limited'),
                'subtitle' => __('Upload Your image', 'bongotheme-limited'),
                'compiler' => true,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/logo.png',
                )
            ), 

            array(
                'id' => 'favicon-img',
                'type' => 'media',
                'title' => __('Favicon Image', 'bongotheme-limited'),
                'subtitle' => __('Upload Your favicon', 'bongotheme-limited'),
                'compiler' => true,
                'default' => array(
                    'url' => get_template_directory_uri() . '/assets/img/favicon.png',
                )
            ), 

            array( 
                'id' => 'header-number',
                'type' => 'text',
                'title' => __('Mobile Number', 'bongotheme'),
                'subtitle' => __('Write number', 'bongotheme'),
                'default' => '01900000000', 
            ), 

            array( 
                'id' => 'header-mail',
                'type' => 'text',
                'title' => __('Mobile Number', 'bongotheme'),
                'subtitle' => __('Write number', 'bongotheme'),
                'default' => 'example@gmail.com', 
            ), 

            array( 
                'id' => 'header-address',
                'type' => 'textarea',
                'title' => __('Address', 'bongotheme'),
                'subtitle' => __('Write address', 'bongotheme'),
                'default' => '259 HGS, Hotland, USA', 
            ), 
          

            array(
                'id' => 'header_custom_code',
                'type' => 'ace_editor',
                'title' => __('Custom Header Section Code', 'bongotheme-limited'),
                'subtitle' => __('Paste your code here.', 'bongotheme-limited'),
                'mode' => 'javascript',
                'theme' => 'monokai',
                'default' => ""
            ),
		   
        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'            => __( 'Top Header', 'bongotheme' ),
        'id'               => 'web-basic-tophead',
        'subsection'             => 'true',
        'icon'             => 'fa fa-cog',
		'fields'           => array(

          array( 
                'id' => 'tophead-title',
                'type' => 'text',
                'title' => __('Left text', 'bongotheme'),
                'subtitle' => __('Write text', 'bongotheme'),
                'default' => 'Now Hiring: Are you a driven and motivated 1st Line IT Support Engineer?', 
            ), 

            array( 
                'id' => 'tophead-fb',
                'type' => 'text',
                'title' => __('Facebook Link', 'bongotheme'),
                'subtitle' => __('Write your fb link', 'bongotheme'),
                'default' => '#', 
             ), 

             array( 
                'id' => 'tophead-twitter',
                'type' => 'text',
                'title' => __('Twitter Link', 'bongotheme'),
                'subtitle' => __('Write your twitter link', 'bongotheme'),
                'default' => '#', 
             ), 
      

             array( 
                'id' => 'tophead-linkedin',
                'type' => 'text',
                'title' => __('Linkedin Link', 'bongotheme'),
                'subtitle' => __('Write your linkedin link', 'bongotheme'),
                'default' => '#', 
             ),  

             array( 
                'id' => 'tophead-instagram',
                'type' => 'text',
                'title' => __('Instagram Link', 'bongotheme'),
                'subtitle' => __('Write your instagram link', 'bongotheme'),
                'default' => '#', 
             ), 

             array( 
                'id' => 'tophead-youtube',
                'type' => 'text',
                'title' => __('Youtube Link', 'bongotheme'),
                'subtitle' => __('Write your youtube link', 'bongotheme'),
                'default' => '#', 
             ), 
      

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'Footer Section', 'bongotheme' ),
        'id'               => 'footer-section',
        'icon'             => 'fa fa-cog',
		'fields'           => array(
		   

            array(
                'id' => 'footer-desc',
                'type' => 'textarea',
                'title' => __('Footer Short Info', 'bongotheme'),
                'subtitle' => __('Write Footer Short Info', 'bongotheme'),
                'default' => ' Intrinsicly evisculate emerging cutting edge scenarios redefine future-proof e-markets demand line.', 
             ), 

            array(
                'id' => 'foot_facebook_link', 
                'type' => 'text',
                'title' => 'Facebook',
                'subtitle' => 'Enter your Facebook page URL',
            ),
            array(
                'id' => 'foot_twitter_link',
                'type' => 'text',
                'title' => 'Twitter',
                'subtitle' => 'Enter your Twitter page URL',
            ),
            array(
                'id' => 'foot_linkedin_link',
                'type' => 'text',
                'title' => 'LinkedIn',
                'subtitle' => 'Enter your LinkedIn page URL',
            ),
            array(
                'id' => 'foot_instagram_link',
                'type' => 'text',
                'title' => 'Instagram',
                'subtitle' => 'Enter your Instagram page URL',
            ),
            array(
                'id' => 'foot_youtube_link',
                'type' => 'text',
                'title' => 'YouTube',
                'subtitle' => 'Enter your YouTube channel URL',
            ),


            array(
                'id' => 'footer-map',
                'type' => 'text',
                'title' => __('Footer Google Map', 'bongotheme'),
                'subtitle' => __('Google Map Link', 'bongotheme'),
                'default' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2645344.0674847416!2d8.870023472656253!3d49.64782076502192!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd096f477096c5%3A0x422435029b0c600!2sFrankfurt%2C%20Germany!5e0!3m2!1sen!2sbd!4v1681532723959!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>', 
             ), 


            array(
                'id' => 'foot_copyright',
                'type' => 'textarea',
                'title' => 'Copyright Text',
                'default' => '© 2023 <a href="#">Domain</a>. All rights reserved.',
            ),

            array(
                'id' => 'footer_custom_code',
                'type' => 'ace_editor',
                'title' => __('Custom Footer Section Code', 'bongotheme'),
                'subtitle' => __('Paste your code here.', 'bongotheme'),
                'mode' => 'javascript',
                'theme' => 'monokai',
                'default' => ""
            ),


            


        )
    ) );


     //contact info 
     Redux::setSection( $opt_name, array(
        'title' => 'Top Footer ',
        'subsection' => 'true',
        'id' => 'top-footer',
        'fields' => array( 

            array(
                'id' => 'tfoot-address',
                'type' => 'textarea',
                'title' => __('Address text', 'bongotheme'),
                'subtitle' => __('Write here the address', 'bongotheme'),
                'default' => '259 Hilton Street, MK 256 North, United State'
            ),  

            array(
                'id' => 'tfoot-woriking-hour',
                'type' => 'editor',
                'title' => __('Working Hour', 'bongotheme'),
                'subtitle' => __('Write here the Working Hour', 'bongotheme'),
                'default' => 'Weekdays 8am - 22pm ,Weekend 10am - 12pm'
            ),  

            array(
                'id' => 'tfoot-contact',
                'type' => 'editor',
                'title' => __('Address Contact', 'bongotheme'),
                'subtitle' => __('Write here the contact info', 'bongotheme'),
                'default' => ' <a href="mailto:info@techbiz.com">info@techbiz.com</a>
                <br><a href="tel:+2597462153">(+259) 746 2153</a>'
            ),  
            
          

        ),
    ) );

    //contact info 
    Redux::setSection( $opt_name, array(
        'title' => 'Contact Info ',
        'id' => 'contact-info',
        'fields' => array(
            array(
                'id' => 'contact-phone',
                'type' => 'text',
                'title' => __('Contact Phone', 'bongotheme'),
                'subtitle' => __('Write here the phone number', 'bongotheme'),
                'default' => '0190000000'
            ),  
            
            array(
                'id' => 'contact-email',
                'type' => 'text',
                'title' => __('Contact email', 'bongotheme'),
                'subtitle' => __('Write here the email address', 'bongotheme'),
                'default' => 'example@gmail.com'
            ),

            array(
                'id' => 'contact-location',
                'type' => 'text',
                'title' => __('Contact location', 'bongotheme'),
                'subtitle' => __('Write here the location address', 'bongotheme'),
                'default' => 'Test address'
            ), 

        ),
    ) );



?>