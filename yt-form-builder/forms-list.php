     <?php   global $wpdb;

        $url = get_site_url();
        $url .= '/wp-admin/admin.php?page=';

        $table_name = $wpdb->prefix.'yfb_forms';

        $query = "SELECT * FROM $table_name";
        $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
        $total = $wpdb->get_var( $total_query );
        $items_per_page = 2;
        $page = isset( $_GET['fl_page'] ) ? abs( (int) $_GET['fl_page'] ) : 1;
        $offset = ( $page * $items_per_page ) - $items_per_page;

        $get_results = $wpdb->get_results($wpdb->prepare( $query . " ORDER BY id LIMIT %d, %d",$offset,$items_per_page ));


echo "<table id='table_fb'>";

echo "    <tr>
        <th>Forms Name</th>
        <th>Delete Form</th>
        <th>Show Entry</th>
    </tr>";

        foreach( $get_results as $forms){

         echo "<tr><td>" . $forms->form_title . "</td>";
        $IDs = $forms->ID;
        echo  "<td><a href='{$url}form_list&action=del_f&ids=$IDs'>Delete Form </a></td>";
        echo  "<td><a href='{$url}form_list&action=get_data&ids=$IDs'>Form Entry </a></td></tr>";

        }

     if($total > $items_per_page){

    echo '<tr><td><div class="navigation_fb">' .  paginate_links( array(
        'base' => add_query_arg( 'fl_page', '%#%' ),
        'format' => '',
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'total' => ceil($total / $items_per_page),
        'current' => $page
    )) . '</div></td></tr>';

    }

    echo "</table>";