#!/bin/bash

# Simple development server using PHP's built-in server
# This is for previewing the admin interface without a full WordPress installation.
# Note: This is a very basic simulation and does not include the full WordPress environment.

# Define a mock WordPress environment
cat > index.php <<'EOD'
<?php
// Mock WordPress environment for development
define('ABSPATH', __DIR__ . '/');
define('QRCODE_MANAGER_PLUGIN_DIR', __DIR__ . '/');

// Mock WordPress functions
function add_action($hook, $callback) {
    // No-op
}
function add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position) {
    // No-op
}
function register_activation_hook($file, $function) {
    // No-op
}
function check_admin_referer($action, $query_arg = '_wpnonce') {
    return true; // Always pass for dev
}
function wp_nonce_field($action, $name = "_wpnonce", $referer = true , $echo = true) {
    // No-op
}
function wp_nonce_url($actionurl, $action = -1, $name = '_wpnonce') {
    return $actionurl;
}
function admin_url($path = '', $scheme = 'admin') {
    return '/' . $path;
}
function sanitize_title($title) {
    return preg_replace('/[^a-zA-Z0-9-]/', '', str_replace(' ', '-', strtolower($title)));
}
function esc_url_raw($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
}
function esc_url($url) {
    return filter_var($url, FILTER_SANITIZE_URL);
}
function esc_html($text) {
    return htmlspecialchars($text);
}
function esc_attr($text) {
    return htmlspecialchars($text);
}
function current_time($type, $gmt = 0) {
    return date('Y-m-d H:i:s');
}
function get_option($option, $default = false) {
    if ($option === 'qrcode_manager_public_root') {
        return '/qrcode/';
    }
    return $default;
}
function update_option($option, $value) {
    // No-op
}
function home_url($path = '', $scheme = null) {
    return 'http://localhost:8080' . $path;
}
function status_header($code) {
    http_response_code($code);
}
function wp_redirect($location, $status = 302) {
    header("Location: $location", true, $status);
    exit;
}

// Mock WPDB
class Mock_WPDB {
    private $db;
    public $prefix;

    public function __construct() {
        $this->prefix = 'wp_';
        try {
            $this->db = new PDO('sqlite:qrcodes.db');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("CREATE TABLE IF NOT EXISTS wp_qrcodes (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                created_at TEXT,
                slug TEXT UNIQUE,
                destination_url TEXT
            )");
        } catch (PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }
    }

    public function get_results($query) {
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function get_row($query) {
        $stmt = $this->db->query($query);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function prepare($query, ...$args) {
        // This is a very naive implementation and not secure for production
        $query = preg_replace_callback('/\?|%s|%d/', function($matches) use (&$args) {
            $arg = array_shift($args);
            if ($matches[0] === '%d') {
                return intval($arg);
            }
            return "'" . $this->db->quote($arg) . "'";
        }, $query);
        return $query;
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $stmt = $this->db->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        return $stmt->execute(array_values($data));
    }

    public function delete($table, $where) {
        $key = key($where);
        $value = current($where);
        $stmt = $this->db->prepare("DELETE FROM $table WHERE $key = ?");
        return $stmt->execute([$value]);
    }
}
$wpdb = new Mock_WPDB();

// Include the admin class
require_once 'admin/class-qrcode-manager-admin.php';

// Render the admin page
QRCode_Manager_Admin::create_admin_page();

?>
EOD

echo "Starting development server at http://localhost:8080"
php -S localhost:8080
