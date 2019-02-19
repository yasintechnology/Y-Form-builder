<?php


 $form_data = wp_specialchars_decode($_POST['form_data']);

 echo $check_admin = sanitize_text_field($_POST['check_admin']);
 echo $check_email = sanitize_text_field($_POST['check-email']);

 $form_title = sanitize_text_field($_POST['form_title']);

    global $wpdb;

    $table_name = $wpdb->prefix.'yfb_forms';

        $wpdb->insert($table_name,array(
            'ID'           => '',
            'form_title'   => $form_title,
            'form_data'    => $form_data,
            'send_email'   => '1' ,
            'save_admin'   => '1'
         ),
         array(
         'ID'           =>'%d',
         'form_title'   =>'%s',
         'form_data'    =>'%s',
         'send_email'   =>'%s',
         'save_admin'   =>'%s'
         ));

    $my_id = $wpdb->insert_id;




       $test_result =$wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d",$my_id));

       $short = stripslashes($test_result->ID);

	   echo "Your Shortcode: " . "[f_builder id=$short]";


