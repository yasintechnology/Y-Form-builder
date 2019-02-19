     <?php   global $wpdb;

        $url = get_site_url();
        $url .= '/wp-admin/admin.php?page=';

	   $g_id = intval($_GET['ids']);
       $table_data = $wpdb->prefix.'yfb_form'.$g_id;

        $p_query = "SELECT * FROM $table_data";
        $total_query = "SELECT COUNT(1) FROM (${p_query}) AS combined_table";
        $total = $wpdb->get_var( $total_query );
        $items_per_page = 8;
        $page = isset( $_GET['fl_page'] ) ? abs( (int) $_GET['fl_page'] ) : 1;
        $offset = ( $page * $items_per_page ) - $items_per_page;

        $get_results = $wpdb->get_results($wpdb->prepare( $p_query . " ORDER BY id LIMIT %d, %d",$offset,$items_per_page ));

     echo "<table id='table_fb'>";


        echo '<tr>';
        $i = 0;
        foreach( $get_results as $keye=>$forms){

            foreach( $forms as $key=>$val){
			echo  '<th>'. $key . '</th>';
                 $i++;
            }

              echo  '<th> Action </th>';

              if($i >1) break;
		}
        echo '</tr>';




         echo '<tr>';
        foreach( $get_results as $keye=>$form){

                foreach( $form as $key=>$val){
		    	echo  '<td>' . $val . '</td>';
                 }
                 $ID = $form->id ;

                 echo  "<td><a href='{$url}form_list&action=del_user_data&id=$ID&f-id=$g_id'> Delete </a></td>";
                 echo '</tr>';

		}

    if($total > $items_per_page){

    echo '<tr><td> <div class="navigation_fb">' .  paginate_links( array(
        'base' => add_query_arg( 'fl_page', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => ceil($total / $items_per_page),
        'current' => $page
    )) . '</div></td></tr>';

    }

       echo '</table>';