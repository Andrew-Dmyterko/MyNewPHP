
<pre><?php

print_r($_FILES);
//if (isset($_FILES['pictures'])){
//
//
//
//        $error_flag = ""; // флаг ошибок
//        if (isset($_FILES[$tegFileName]) && $_FILES[$tegFileName]['error'] === UPLOAD_ERR_OK) {
//
//            $fileTmpPath = $_FILES[$tegFileName]['tmp_name']; //временый путь
//            $fileName = $_FILES[$tegFileName]['name'];
//            $fileSize = $_FILES[$tegFileName]['size'];
//            $fileType = $_FILES[$tegFileName]['type'];
//            $fileNameCmps = explode(".", $fileName);
//            $fileExtension = strtolower(end($fileNameCmps));
//            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
//
//            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
//
//            if (in_array($fileExtension, $allowedfileExtensions)) {
//                // directory in which the uploaded file will be moved
//                $uploadFileDir = self::$uploadFileDir;
//                $dest_path = $uploadFileDir . $newFileName;
//
//                if (move_uploaded_file($fileTmpPath, $dest_path)) {
//                    $message = 'Файл успешно загружен.';
//                } else {
//                    $message = 'Возникла проблема при загрузке.';
//                    $error_flag = true;
//                }
//                //  echo $message;
//            } else {
//                $error_flag = true;
//                $message = "Не загружен не то расширение.";
//            }
//
//        } else {$error_flag = true; $message = "Ошибка загрузки.";}
//
//        return ['error_flag' => $error_flag,
//            'error_code' => $_FILES['uploadedFile']['error'],
//            'message'    => $message,
//            'file_name'  => $fileName,
//            'file_size'  => $fileSize,
//            'file_type'  => $fileType,
//            'dest_path'  => $dest_path
//        ];
//    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <p>Изображения:
        <input type="file" name="pictures[]" multiple />
        <input type="submit" value="Отправить" />
    </p>
</form>

<?php

