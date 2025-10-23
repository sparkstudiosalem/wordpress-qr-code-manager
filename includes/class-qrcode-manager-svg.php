<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\SvgWriter;

class QRCode_Manager_SVG {
    public static function generate_svg_from_slug($slug) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'qrcodes';
        $qrcode_data = $wpdb->get_row($wpdb->prepare("SELECT destination_url FROM $table_name WHERE slug = %s", $slug));

        if ($qrcode_data) {
            $qr_code_url = home_url(get_option('qrcode_manager_public_root', '/qrcode/') . $slug);
            $qrCode = QrCode::create($qr_code_url);
            $writer = new SvgWriter();
            $result = $writer->write($qrCode);

            header('Content-Type: ' . $result->getMimeType());
            echo $result->getString();
            exit;
        } else {
            // Handle case where slug is not found
            status_header(404);
            exit;
        }
    }
}
