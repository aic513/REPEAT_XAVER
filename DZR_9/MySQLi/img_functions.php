<?php

require_once ("img_model.php");

function upload_image($startup,$file) {
    if (!check_upload($file)) { //сюда,если вернет FALSE
        return FALSE;
    } else {
        $type = explode('/', $file['type']);
        send_img($startup,$type[1]);
        $images = get_last_img($startup);
        $file_name = $images['id_image'] . '.' . $images['mime_type'];
        copy($file['tmp_name'], 'img_big/' . $file_name);
        img_resize($file['tmp_name'], 'img_small/' . $file_name, 250, 250);
    }
}

function check_upload($file) { //проверки файла
    if ($file['name'] == '') {  // если загружаем пустой файл-у него пустое имя
        echo 'Вы хотите загрузить безымянный файл';
        return FALSE;
    }
    if ($file['size'] > 1000000) { // если файл > 1мб-слишком большой размер
        echo 'Размер файла больше, чем 1 мб';
        return FALSE;
    }

    $types = array('image/jpg', 'image/gif', 'image/jpeg', 'image/png',);

    if (!in_array($file['type'], $types)) { //если тип не соответсвует тому,который есть в массиве
        echo 'Тип файла не соответствует gif,png,jpg,jpeg';
        return FALSE;
    }

    return TRUE;
}

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
    if (!file_exists($src))
        return false;

    $size = getimagesize($src);

    if ($size === false)
        return false;

    // Определяем исходный формат по MIME-информации, предоставленной
    // функцией getimagesize, и выбираем соответствующую формату
    // imagecreatefrom-функцию.
    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
    $icfunc = "imagecreatefrom" . $format;
    if (!function_exists($icfunc))
        return false;

    $x_ratio = $width / $size[0];
    $y_ratio = $height / $size[1];

    $ratio = min($x_ratio, $y_ratio);
    $use_x_ratio = ($x_ratio == $ratio);

    $new_width = $use_x_ratio ? $width : floor($size[0] * $ratio);
    $new_height = !$use_x_ratio ? $height : floor($size[1] * $ratio);
    $new_left = $use_x_ratio ? 0 : floor(($width - $new_width) / 2);
    $new_top = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

    $isrc = $icfunc($src);
    $idest = imagecreatetruecolor($width, $height);

    imagefill($idest, 0, 0, $rgb);
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);

    imagejpeg($idest, $dest, $quality);

    imagedestroy($isrc);
    imagedestroy($idest);

    return true;
}

function show_gallery($startup) {
    $images = get_img($startup);
    if (!empty($images)) {
         foreach ($images as $value) {
                echo '<a target="_blank" href="photo.php?id=' . $value['id_image'] . '.' . $value['mime_type'] . '"><img src="img_small/' . $value['id_image'] . '.' . $value['mime_type'] . '" alt="picture"></a>';
            }
    } else {
        echo '<h3 style="color:purple;">Загруженных изображений не найдено</h5>';
    }
}


function clear_dirs($directories) {
    foreach ($directories as $directory) {
        if ($handle = opendir($directory)) {
            while (false !== ($file = readdir($handle)))
                if ($file != "." && $file != "..")
                    unlink($directory . $file);
            closedir($handle);
        }
    }
}

