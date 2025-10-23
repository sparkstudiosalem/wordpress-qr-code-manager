# QR Code Manager

This WordPress plugin allows you to create, manage, and display QR codes on your website.

## Installation

1.  **Download the Plugin**: Download the latest version of the plugin as a `.zip` file from the [releases page](https://github.com/sparkstudiosalem/wordpress-qr-code-manager/releases).
2.  **Log in to WordPress**: Log in to your WordPress admin dashboard.
3.  **Navigate to Plugins**: Go to `Plugins > Add New`.
4.  **Upload Plugin**: Click the "Upload Plugin" button at the top of the page.
5.  **Choose File**: Select the `.zip` file you downloaded and click "Install Now".
6.  **Activate Plugin**: Once the installation is complete, click "Activate Plugin".

The "QR Codes" menu will now appear in your WordPress admin sidebar.

## Configuration

The QR Code Manager plugin works out of the box with no additional configuration required.

### Shortcode

To display a QR code on a page or post, you can use the `[qrcode]` shortcode.

**Usage:**

`[qrcode id="..."]`

Replace `...` with the ID of the QR code you want to display. You can find the ID in the QR code list table in the admin area.

### Example

To display the QR code with an ID of `123`:

`[qrcode id="123"]`

This will render the QR code image directly in your content.

## Development

To develop the plugin, you will need to have a local WordPress installation.

1.  **Clone the repository** into your `wp-content/plugins` directory.
2.  **Install dependencies** by running `composer install`.
3.  **Activate the plugin** in your WordPress admin area.

The plugin files are directly editable. Changes will be reflected in your local WordPress environment.

### Previewing

To preview the plugin, you can use the included `dev.sh` script. This script will watch for file changes and automatically sync them to a specified preview directory.

1.  **Set up a preview directory**: This can be a WordPress installation in your local development environment (e.g., a VVV site).
2.  **Run the `dev.sh` script**:
    ```bash
    ./dev.sh /path/to/your/wordpress/plugins/qrcode-manager
    ```
    Replace `/path/to/your/wordpress/plugins/qrcode-manager` with the actual path to your preview directory.

The script will continuously watch for changes and sync them, allowing you to see your updates in real-time.

### Building the Distributable

To build the distributable `.zip` file for the plugin, run the `build.sh` script:

```bash
./build.sh
```

This will create a `dist` directory containing the installable `qrcode-manager.zip` file with the version information.
