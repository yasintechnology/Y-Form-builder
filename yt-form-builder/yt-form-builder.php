<?php
/*
Plugin Name: 1yt form builder
Plugin URI: https://www.yasin.com/
Description: yt form builder in upgrade
Version: 1.0
Author: yasin
Author URI: https://www.yasin.com/
*/


ytfb_main::init();

CLASS ytfb_main {
	
	
		public static function init(){
		
    	    register_activation_hook(__FILE__, array(__CLASS__, 'install'));

    	    add_action('init',array(__CLASS__,'wp_session'));

            // add admin ajax file
            add_action('admin_enqueue_scripts', array(__CLASS__, 'yfb_admin_script_file'));

    		// add user ajax file
    	   add_action('wp_enqueue_scripts',array(__CLASS__,'yfb_user_script_file'));

    		// call function user data process
    		add_action('wp_ajax_yfb_user_ajax',array(__CLASS__,'yfb_user_ajax_func'));
    		add_action('wp_ajax_nopriv_yfb_user_ajax',array(__CLASS__,'yfb_user_ajax_func'));

    		// call function admin data process
    	   add_action('wp_ajax_yfb_admin_ajax',array(__CLASS__,'yfb_admin_ajax_func'));
    	   add_action('wp_ajax_nopriv_yfb_admin_ajax',array(__CLASS__,'yfb_admin_ajax_func'));


          // add admin menu
          add_action('admin_menu', array(__CLASS__, 'admin_menus'));

	      add_shortcode('f_builder',array(__CLASS__,'f_builder_func'));

		}


		    public static function install() {

                global $wpdb, $table_prefix;

				$table_forms = $table_prefix."yfb_forms";

				//Check table already exists
				if($wpdb->get_var("show tables like $table_forms") != $table_forms){

					$sql = "CREATE TABLE IF NOT EXISTS $table_forms (
							  `ID` int(255) NOT NULL AUTO_INCREMENT,
							  `form_title` text NOT NULL,
							  `form_data` varchar(10000) NOT NULL,
							  `send_email` int(1) NOT NULL,
							  `save_admin` int(1) NOT NULL,
							  PRIMARY KEY (`ID`)
							) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44";

			require_once(ABSPATH.'wp-admin/includes/upgrade.php');
			dbDelta($sql);
			}
			
	}

		public static function yfb_user_script_file() {

		wp_enqueue_script('yfb-user-ajax',plugins_url('/js/ajax.js',__FILE__),array('jquery'),true);
		wp_localize_script( 'yfb-user-ajax', 'uyfb_url', array(
		'yfb_ajax_url' => admin_url( 'admin-ajax.php' ),
        'uyfb_security_nonce' => wp_create_nonce('ayfb-user-nonce')
		));

	}

		public static function yfb_admin_script_file($hook) {

      //  global $settings;

               //	if ( $hook != $settings)
	            //	return;



        wp_enqueue_script('yfb_js_main', plugins_url('js/main-js.js',__FILE__),array('jquery'),null,true);
        wp_enqueue_style('yfb_style', plugins_url('style/admin-form-builder.css',__FILE__));

		wp_enqueue_script('yfb-admin-ajax',plugins_url('/js/ajax.js',__FILE__),array('jquery'),true);
		wp_localize_script( 'yfb-admin-ajax', 'ayfb_url', array(
		'ayfb_ajax_url' => admin_url( 'admin-ajax.php' ),
        'ayfb_security_nonce' => wp_create_nonce('ayfb-admin-nonce')
		));

	}

		// add admin menu
		public static function admin_menus()
		{
           // global $settings;

			  $settings = add_menu_page('form builder', 'Y Form Builder', 'manage_options', 'newform', array(__CLASS__, 'yfb_create_new'));
		   	  add_submenu_page('newform', 'new form', 'New Form', 'manage_options', 'newform', array(__CLASS__, 'yfb_create_new'));
		  	  add_submenu_page('newform', 'Forms List', 'Forms List', 'manage_options', 'form_list', array(__CLASS__, 'forms_list'));
		  	 

		}

     public static function forms_list() {


        if(!empty($_REQUEST['action']) && $_REQUEST['action']=='del_f'){


        self::delete_form();

        }
		

        if(!empty($_REQUEST['action']) && $_REQUEST['action']=='del_user_data'){


        self::delete_form();

        }

        if(!empty($_REQUEST['action']) && $_REQUEST['action']=='get_data'){


        self::form_data();

        }else{

        // after request to fix list
          require_once "forms-list.php";

         }
         

        }


     public static function form_data() {


        require_once "form-data.php";

         }

     public static function delete_form() {

        require_once "delete-form.php";

         }


		 
	public static function yfb_create_new() {



        ob_start();
        require_once "admin/admin-form-builder.php";
        echo  ob_get_clean();

    }


	public static function wp_session() {

			if(!session_id()) {
					session_start();
				}

			}

	public static function f_builder_func($atts) {

      require_once "inc/shortcode.php";

	}


	public static function yfb_user_ajax_func() {

                    // check_ajax_referer dies if nonce can not been verified
            check_ajax_referer( 'ayfb-user-nonce', 'yfb_user_nonce' );

    require_once "user-process.php";

		wp_die();
	}

	public static function yfb_admin_ajax_func() {
                     // check_ajax_referer dies if nonce can not been verified
            check_ajax_referer( 'ayfb-admin-nonce', 'yfb_admin_nonce' );

                require_once "admin/admin-process.php";

	    	wp_die();
    	}


	}




?>