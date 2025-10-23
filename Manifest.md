This repository represents a QR Code Manager implemented as a Wordpress plugin.
Any Wordpress site with support for SQLite3 should be able to install this plugin simply and begin managing QR codes and their Destination URLs.

The plugin can be configured with a "root" address (e.g. /qrcode/) under which public QR code URLs can be reached by their slug. (e.g. /qrcode/{slug}); for the purposes of this documentation this is called QRCODE_PUBLIC_ROOT

Each Managed QR code has the following properties:

- a Slug (a short string used to identify the QR code in the scan URL)
- a Destination URL (the destination the QR code points to)
- Created At timestamp (the time the QR code was created)

The plugin should provide admins with a view for managing QR codes.

The view should include a table listing all existing Managed QR codes with columns for:

- QR Code SVG Preview
- Slug
- Destination URL
- Created At timestamp
- Actions (Edit/Delete)

Admins should be able to remove existing Managed QR codes, but should be presented with a confirmation dialog before deletion.
Admins should be able to add new QR codes through a New QR Code button + form.

When a visitor accesses a QR code's slug, they should be redirected the QR codes's Destination URL. Eg a visitor accessing QRCODE_PUBLIC_ROOT/{slug} should be redirected to the Destination URL for the Managed QR code with the matching Slug.
A visitor may also access the SVG for the QR code directly at QRCODE_PUBLIC_ROOT/{slug}/svg which should return the SVG image for the QR code with the matching Slug. (eg QRCODE_PUBLIC_ROOT/{slug})

The project should allow previewing the admin interface prior to being installed as a plugin, or else a simple way of installing and testing, prior to being packaged for distribution.
The project should provide tooling to generate the packaged plugin for distribution.
The project should provide a facility for versioning the distributed plugin.
