<?php

        global $wpdb;
        $table_name = $wpdb->prefix.'yfb_forms';

        $set_id = $atts['id'];

        $test_result = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE ID = %d ",$set_id) );

        $form = stripslashes($test_result->form_data);

        // create form id
        $form_id = 'yfb_form'.$set_id;

        $form_email = $test_result->send_email;
        $form_admin = $test_result->save_admin;

        echo "<input type='hidden' class='get_form_id' value=$form_id />";
        echo "<input type='hidden' class='get_form_email' value='$form_email' />";
        echo "<input type='hidden' class='get_form_admin' value='$form_admin' />";

        // generat user form
        echo "<form method='post' action='#' id=$form_id>" ;
        echo  $form;
        echo "</form>";

        // run captcha
            ob_start();

            $_SESSION = array();

            include("simple-php-captcha.php");
            $_SESSION['captcha'] = simple_php_captcha();

            echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA code">';
            $captcha = $_SESSION['captcha']['code'];
            echo "<input type='hidden' id='captcha' value=$captcha />";
            echo "<input type='text' id='captcha-check' />";

       echo  ob_get_clean();

       echo "<div id='ajax-responseu' > </div>";



