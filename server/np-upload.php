<?php

// TODO: Make this script more secure

require_once 'controllers/class.upload.php';
require_once 'controllers/php-logger.php';

if (!empty($_FILES)) {

    $relativePath = 'assets' . DIRECTORY_SEPARATOR . 'files';
    $uploadFolder = '..' . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR . $relativePath;

    if (!file_exists($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    $handle = new upload($_FILES['file']);
    if ($handle->uploaded) {
        if ($handle->file_src_mime === 'application/pdf') {
            $handle->file_new_name_body = uniqid('pdf_');
        } else {
            $handle->file_new_name_body = uniqid('image_');
            $handle->image_resize = true;
            if (isset($_POST['width']) && $_POST['width'] !== 'undefined') {
                $handle->image_x = $_POST['width'];
                $handle->image_ratio_y = true;
            } else {
                $handle->image_x = $handle->image_src_x;
                $handle->image_y = $handle->image_src_y;
            }
        }

        $handle->process($uploadFolder);
        if ($handle->processed) {
            echo json_encode(array('file' => $relativePath . DIRECTORY_SEPARATOR . $handle->file_dst_name));
            $handle->clean();
        } else {
            echo 'error : ' . $handle->error;
        }
    }
}
