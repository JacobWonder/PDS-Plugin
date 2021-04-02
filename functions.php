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

//function wpb_custom_billing_fields( $fields = array() ) {
//	unset($fields['billing_address_2']);
//	return $fields;
//}
add_filter('woocommerce_billing_fields','wpb_custom_billing_fields');

//custom trigger for amelia paymentComplete on order status partially-paid 
add_action('woocommerce_order_status_partially-paid','wcdp_custom_trigger_amelia_payment_complete');
function wcdp_custom_trigger_amelia_payment_complete($order_id){
    if(method_exists('AmeliaBooking\Infrastructure\WP\Integrations\WooCommerce\WooCommerceService','paymentComplete')){
        AmeliaBooking\Infrastructure\WP\Integrations\WooCommerce\WooCommerceService::paymentComplete($order_id);
    }
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
		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
 		'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
 		'orders'             => __( 'Your Payments', 'woocommerce' ),
 		'edit-address'       => __( 'Addresses', 'woocommerce' ),
 		'customer-logout'    => __( 'Log out', 'woocommerce' )
 	);
 	return $menuOrder;
 }
 add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


include('login-editor.php');

?>
