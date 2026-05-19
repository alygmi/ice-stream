<?php
// This file ensures the admin directory structure exists
$adminPath = __DIR__ . '/admin';
if (!is_dir($adminPath)) {
    mkdir($adminPath, 0755, true);
}
echo "✓ Admin directory structure created at: " . realpath($adminPath) . "\n";
echo "Directory exists: " . (is_dir($adminPath) ? "Yes" : "No") . "\n";
?>
