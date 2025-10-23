# Installation and Configuration

This guide will walk you through installing and configuring the QR Code Manager plugin.

## Installation

1.  **Download the Plugin**: Download the latest version of the plugin as a `.zip` file from the [releases page](https://github.com/your-repo/qrcode-manager/releases) (replace with your actual repository link).
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

```
[qrcode id="..."]
```

Replace `...` with the ID of the QR code you want to display. You can find the ID in the QR code list table in the admin area.

### Example

To display the QR code with an ID of `123`:

```
[qrcode id="123"]
```

This will render the QR code image directly in your content.
