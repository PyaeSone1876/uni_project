<?php
function compress_directory($source, $destination) {
    $dir = opendir($source);
    $zip = new ZipArchive();

    if ($zip->open($destination, ZipArchive::CREATE) !== true) {
        return false;
    }

    while (($file = readdir($dir)) !== false) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        $file_path = $source . '/' . $file;

        if (is_dir($file_path)) {
            compress_directory($file_path, $destination . '/' . $file);
            continue;
        }

        $zip->addFile($file_path, $file);
    }

    $zip->close();
    return true;
}

$source = '../userfiles'; // Replace with your desired directory

$zip_filename = 'UsersUploadedDoc.zip';
$zip_path = './' . $zip_filename;

if (compress_directory($source, $zip_path)) {
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
    header('Content-Length: ' . filesize($zip_path));
    readfile($zip_path);

    unlink($zip_path); // Delete the zip file after sending it to the user.
} else {
    echo 'An error occurred while compressing files.';
}
?>