<?php
/**
 * Plugin Name: QR Code Manager
 * Description: A plugin to manage QR codes and their destination URLs.
 * Version: 1.0.0
 * Author: Spark Studio Salem
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('QRCODE_MANAGER_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Include the database setup and activation/deactivation hooks
require_once QRCODE_MANAGER_PLUGIN_DIR . 'includes/class-qrcode-manager-db.php';
register_activation_hook(__FILE__, ['QRCode_Manager_DB', 'activate']);

// Include the admin menu and page
require_once QRCODE_MANAGER_PLUGIN_DIR . 'admin/class-qrcode-manager-admin.php';
add_action('admin_menu', ['QRCode_Manager_Admin', 'add_admin_menu']);

// Handle redirects for QR codes
function qrcode_manager_handle_redirect() {
    $request_uri = $_SERVER['REQUEST_URI'];
    $public_root = get_option('qrcode_manager_public_root', '/qrcode/');

    if (strpos($request_uri, $public_root) === 0) {
        $slug_with_suffix = substr($request_uri, strlen($public_root));
        
        if (substr($slug_with_suffix, -4) === '/svg') {
            $slug = substr($slug_with_suffix, 0, -4);
            // Handle SVG generation
            require_once QRCODE_MANAGER_PLUGIN_DIR . 'includes/class-qrcode-manager-svg.php';
            QRCode_Manager_SVG::generate_svg_from_slug($slug);
            exit;
        } else {
            $slug = $slug_with_suffix;
            // Handle redirection
            global $wpdb;
            $table_name = $wpdb->prefix . 'qrcodes';
            $qrcode = $wpdb->get_row($wpdb->prepare("SELECT destination_url FROM $table_name WHERE slug = %s", $slug));

            if ($qrcode) {
                wp_redirect($qrcode->destination_url, 301);
                exit;
            }
        }
    }
}
add_action('init', 'qrcode_manager_handle_redirect');
