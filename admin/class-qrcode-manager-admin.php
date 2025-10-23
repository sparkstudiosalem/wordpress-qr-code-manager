<?php

class QRCode_Manager_Admin {

    public static function add_admin_menu() {
        add_menu_page(
            'QR Code Manager',
            'QR Codes',
            'manage_options',
            'qrcode-manager',
            [self::class, 'create_admin_page'],
            'dashicons-camera',
            20
        );
    }

    public static function create_admin_page() {
        // Handle form submissions for adding/deleting QR codes
        self::handle_form_actions();

        // Get all QR codes from the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'qrcodes';
        $qrcodes = $wpdb->get_results("SELECT * FROM $table_name ORDER BY created_at DESC");

        require_once QRCODE_MANAGER_PLUGIN_DIR . 'admin/partials/qrcode-manager-admin-display.php';
    }

    private static function handle_form_actions() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'qrcodes';

        // Handle adding a new QR code
        if (isset($_POST['add_qrcode']) && check_admin_referer('add_qrcode_nonce')) {
            $slug = sanitize_title($_POST['slug']);
            $destination_url = esc_url_raw($_POST['destination_url']);

            if (!empty($slug) && !empty($destination_url)) {
                $wpdb->insert(
                    $table_name,
                    [
                        'created_at' => current_time('mysql'),
                        'slug' => $slug,
                        'destination_url' => $destination_url,
                    ]
                );
            }
        }

        // Handle deleting a QR code
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && check_admin_referer('delete_qrcode_' . $_GET['id'])) {
            $id = intval($_GET['id']);
            $wpdb->delete($table_name, ['id' => $id]);
        }
        
        // Handle updating settings
        if (isset($_POST['update_settings']) && check_admin_referer('update_settings_nonce')) {
            update_option('qrcode_manager_public_root', sanitize_text_field($_POST['public_root']));
        }
    }
}
