<?php

function get_gallery() {
    $images = array();
    $handle = opendir('img_small');

    if ($handle != FALSE) {
        while (FALSE !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $images[] = $file;
            }
        }
        closedir($handle);
    }
    return $images;
}

function upload_image($file) {
    if (!check_upload($file)) {
        return FALSE;
    } else {
        copy($file['tmp_name'], 'img_big/' . $file['name']);
    } img_resize($file['tmp_name'], 'img_small/' . $file['name'], 250, 250);
}

function check_upload($file) {
    if ($file['name'] == '') {
        echo 'Вы хотите загрузить безымянный или не существующий файл ';
        return FALSE;
    }
    if ($file['size'] > 1000000) {
        echo 'Размер файла больше, чем 1 мб';
        return FALSE;
    }

    $types = array('image/jpg', 'image/gif', 'image/jpeg', 'image/png',);

    if (!in_array($file['type'], $types)) {
        echo 'Тип файла не соответствует gif,png,jpg,jpeg';
        return FALSE;
    }

    return TRUE;
}

function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
  if (!file_exists($src)) return false;

  $size = getimagesize($src);

  if ($size === false) return false;

  $format = strtolower(substr($size['mime'], strpos($size['mime'], '/')+1));
  $icfunc = "imagecreatefrom" . $format;
  if (!function_exists($icfunc)) return false;

  $x_ratio = $width / $size[0];
  $y_ratio = $height / $size[1];

  $ratio       = min($x_ratio, $y_ratio);
  $use_x_ratio = ($x_ratio == $ratio);

  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
  $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width) / 2);
  $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);

  $isrc = $icfunc($src);
  $idest = imagecreatetruecolor($width, $height);

  imagefill($idest, 0, 0, $rgb);
  imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0,
    $new_width, $new_height, $size[0], $size[1]);

  imagejpeg($idest, $dest, $quality);

  imagedestroy($isrc);
  imagedestroy($idest);

  return true;
}

function show_gallery(){
    $images = get_gallery();
if (!empty($images)) {
    foreach ($images as $key => $image) {
        echo '<a target="_blank" href="img_big/' . $image . '"><img style="display:inline-block" class="img-responsive" src="img_small/' . $image . '" alt="picture"></a>';
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

