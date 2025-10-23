<div class="wrap">
    <h1>QR Code Manager</h1>

    <div id="col-container">
        <div id="col-right">
            <div class="col-wrap">
                <h2>Existing QR Codes</h2>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th style="width: 100px;">QR Code</th>
                            <th>Slug</th>
                            <th>Destination URL</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($qrcodes)) : ?>
                            <?php foreach ($qrcodes as $qrcode) : ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo esc_url(get_option('qrcode_manager_public_root', '/qrcode/') . $qrcode->slug . '/svg'); ?>" target="_blank">
                                            <img src="<?php echo esc_url(get_option('qrcode_manager_public_root', '/qrcode/') . $qrcode->slug . '/svg'); ?>" width="80" height="80" />
                                        </a>
                                    </td>
                                    <td><?php echo esc_html($qrcode->slug); ?></td>
                                    <td><a href="<?php echo esc_url($qrcode->destination_url); ?>" target="_blank"><?php echo esc_url($qrcode->destination_url); ?></a></td>
                                    <td><?php echo esc_html($qrcode->created_at); ?></td>
                                    <td>
                                        <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=qrcode-manager&action=delete&id=' . $qrcode->id), 'delete_qrcode_' . $qrcode->id); ?>" class="button button-danger delete-qrcode">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No QR codes found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="col-left">
            <div class="col-wrap">
                <h2>Add New QR Code</h2>
                <form method="post" action="">
                    <?php wp_nonce_field('add_qrcode_nonce'); ?>
                    <div class="form-field">
                        <label for="slug">Slug</label>
                        <input type="text" name="slug" id="slug" required>
                        <p>The short name for the QR code URL (e.g., "my-event").</p>
                    </div>
                    <div class="form-field">
                        <label for="destination_url">Destination URL</label>
                        <input type="url" name="destination_url" id="destination_url" required>
                        <p>The URL the QR code will redirect to.</p>
                    </div>
                    <input type="submit" name="add_qrcode" class="button button-primary" value="Add QR Code">
                </form>
                
                <hr style="margin: 20px 0;">

                <h2>Settings</h2>
                <form method="post" action="">
                    <?php wp_nonce_field('update_settings_nonce'); ?>
                    <div class="form-field">
                        <label for="public_root">Public Root</label>
                        <input type="text" name="public_root" id="public_root" value="<?php echo esc_attr(get_option('qrcode_manager_public_root', '/qrcode/')); ?>">
                        <p>The root path for public QR code URLs.</p>
                    </div>
                    <input type="submit" name="update_settings" class="button button-secondary" value="Save Settings">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteLinks = document.querySelectorAll('.delete-qrcode');
    deleteLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            if (!confirm('Are you sure you want to delete this QR code?')) {
                event.preventDefault();
            }
        });
    });
});
</script>
