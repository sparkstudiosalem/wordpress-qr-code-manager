# Build script for the QR Code Manager plugin

# Variables
PLUGIN_SLUG="qrcode-manager"
DIST_DIR="dist"
BUILD_DIR_BASE="$DIST_DIR"
BUILD_DIR="$BUILD_DIR_BASE/$PLUGIN_SLUG"
ZIP_FILE="$PLUGIN_SLUG.zip"

# 1. Create build directory
echo "Creating build directory..."
rm -rf $BUILD_DIR_BASE
mkdir -p $BUILD_DIR

# 2. Install composer dependencies
echo "Installing composer dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Copy plugin files
echo "Copying plugin files..."
cp -r admin "$BUILD_DIR/"
cp -r includes "$BUILD_DIR/"
cp -r vendor "$BUILD_DIR/"
cp "$PLUGIN_SLUG.php" "$BUILD_DIR/"
cp index.php "$BUILD_DIR/"

# 4. Create zip file
echo "Creating zip file: $ZIP_FILE"
cd "$BUILD_DIR_BASE"
zip -r "../$DIST_DIR/$ZIP_FILE" "$PLUGIN_SLUG"
cd ..

# 5. Clean up
echo "Cleaning up..."
rm -rf "$BUILD_DIR"

echo "Done. Plugin packaged as $DIST_DIR/$ZIP_FILE"

