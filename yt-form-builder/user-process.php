<?php

 $data = sanitize_text_field($_POST['user_form_data']);

 $tbl_name = sanitize_text_field($_POST['form-name']);

 parse_str($data, $f_values);



  table($f_values,$tbl_name);

    function table($create,$tbl_name) {

            	global $wpdb, $table_prefix;

            $track_table = $table_prefix . "$tbl_name";



    if($wpdb->get_var( "show tables like '$track_table'" ) != $track_table)
    {

        $sql = "CREATE TABLE `". $track_table . "` ( ";
        $sql .= "  `id`  int(11)   NOT NULL auto_increment, ";

		foreach ( $create as $id=>$field ) {
			if(intval($field)){
				$sql .= "  `$id`  int(11)   NOT NULL, ";
			} else {
				$sql .= "  `$id`  varchar(255)   NOT NULL, ";
			}

		}

        $sql .= "  PRIMARY KEY `order_id` (`id`) ";
        $sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci AUTO_INCREMENT=1 ; ";
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
        dbDelta($sql);


    }

}


        if($email == 1){

         $email = "y@y.com";
         wp_mail($email,"Form Entery", $data);

         }


    if($admin == 2) {
        global $table_prefix, $wpdb;

        $table_name = $table_prefix. "$tbl_name";

        $place_holders = array();
        $value = array();
        $query = "";
        $query .= "INSERT INTO {$table_name} (";

		foreach($f_values as $key=>$val){
	    $value[] = $val;
		$key_val .=",".$key;
		}

		$query .= substr($key_val,1);

		$query .= ") VALUES ";


		foreach($f_values as $val){

		if(intval($val)){
			$place_h .= ",'%d'";
		}else {
			$place_h .= ",'%s'";
			}
		}


		$place_holders[] = "(".substr($place_h,1).")" ;

         $query .= implode(', ', $place_holders);

        if($wpdb->query($wpdb->prepare($query, $value))){
            echo 'true';
        } else {
            echo 'false';
        }
        }