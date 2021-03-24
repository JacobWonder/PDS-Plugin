<?php

/**

 * @author Jacob The Web Dev

 * @copyright 2021

 */

if (!defined('ABSPATH')) die();



function ds_ct_enqueue_parent() { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); }



function ds_ct_loadjs() {

	wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/ds-script.js',

        array( 'jquery' )

    );

}

add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );

add_action( 'wp_enqueue_scripts', 'ds_ct_loadjs' );

    global $woocommerce;

    $post_id = get_the_ID(); //you can directly use get_the_ID() as you are on single product page or you can also make use of global $product object and then $product->ID

    if( isset($_POST['checkout_now']) ){      //assuming the form method is 'post'
        $woocommerce->cart->add_to_cart( $post_id );
        $checkout_url = $woocommerce->cart->get_checkout_url();
        wp_redirect($checkout_url);
        exit;
    }

add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
 
	//unset( $menu_links['edit-address'] ); // Addresses
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	//unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
 
	return $menu_links;
 
}

function my_account_menu_order() {
 	$menuOrder = array(
 		'orders'             => __( 'Your Payments', 'woocommerce' ),
 		'edit-address'       => __( 'Addresses', 'woocommerce' ),
 		'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
 		'customer-logout'    => __( 'Log out', 'woocommerce' ),
		'dashboard'          => __( 'Dashboard', 'woocommerce' )
 	);
 	return $menuOrder;
 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


include('login-editor.php');

?>
