# QR Code Manager

This WordPress plugin allows you to create, manage, and display QR codes on your website.

## Development

To develop the plugin, you will need to have a local WordPress installation.

1.  **Clone the repository** into your `wp-content/plugins` directory.
2.  **Install dependencies** by running `composer install`.
3.  **Activate the plugin** in your WordPress admin area.

The plugin files are directly editable. Changes will be reflected in your local WordPress environment.

## Previewing

To preview the plugin, you can use the included `dev.sh` script. This script will watch for file changes and automatically sync them to a specified preview directory.

1.  **Set up a preview directory**: This can be a WordPress installation in your local development environment (e.g., a VVV site).
2.  **Run the `dev.sh` script**:
    ```bash
    ./dev.sh /path/to/your/wordpress/plugins/qrcode-manager
    ```
    Replace `/path/to/your/wordpress/plugins/qrcode-manager` with the actual path to your preview directory.

The script will continuously watch for changes and sync them, allowing you to see your updates in real-time.

## Building the Distributable

To build the distributable `.zip` file for the plugin, run the `build.sh` script:

```bash
./build.sh
```

This will create a `dist` directory containing the installable `qrcode-manager.zip` file.
