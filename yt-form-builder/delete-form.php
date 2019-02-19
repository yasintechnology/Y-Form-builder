     <?php   global $wpdb;


        if(intval($_GET['ids'])){

            $d_id = intval($_GET['ids']);

        $table_data = $wpdb->prefix.'yfb_form'.$d_id;
        $table_form = $wpdb->prefix.'yfb_forms';

     $sql_f = "DELETE FROM $table_form WHERE ID=$d_id ";

     $sql_d = "DROP TABLE IF EXISTS $table_data;";

     $wpdb->query($sql_f);
     $wpdb->query($sql_d);

     }

     if(intval($_GET['id'])){

        $ud_id = intval($_GET['id']);
        $f_id = intval($_GET['f-id']);

        $user_data = $wpdb->prefix.'yfb_form'.$f_id;

        $sql_u = "DELETE FROM $user_data WHERE id=$ud_id ";

        $wpdb->query($sql_u);

     }











