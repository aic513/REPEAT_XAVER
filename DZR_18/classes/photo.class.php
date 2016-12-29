<?php

class photo {

    public function upload_image($file) {
        if (!$this->check_upload($file)) { //сюда,если вернет FALSE
            return FALSE;
        } else {
            $type = explode('/', $file['type']);
            $this->send_img($type[1]);
            $images = $this->get_last_img();
            $file_name = $images[0]['id_image'] . '.' . $images[0]['mime_type'];
            copy($file['tmp_name'], 'img_big/' . $file_name);
            $this->img_resize($file['tmp_name'], 'img_small/' . $file_name, 250, 250);
            return $file_name;
        }
    }

    public function check_upload($file) { //проверки файла
        $result = array();
        if ($file['name'] == '') {  // если загружаем пустой файл-у него пустое имя
            $result = array("answer" => "Вы хотите загрузить безымянный файл");
            exit(json_encode($result));
        }
        if ($file['size'] > 1000000) { // если файл > 1мб-слишком большой размер
            $result = array("answer" => "Размер файла больше, чем 1 мб<br>Выберите файл меньшего размера");
            exit(json_encode($result));
        }

        $types = array('image/jpg', 'image/gif', 'image/jpeg', 'image/png',);

        if (!in_array($file['type'], $types)) { //если тип не соответсвует тому,который есть в массиве
            $result = array("answer" => "Тип файла не соответствует gif,png,jpg,jpeg");
            exit(json_encode($result));
        }

        return TRUE;
    }

    public function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {
        if (!file_exists($src)) {
            return false;
        }

        $size = getimagesize($src);

        if ($size === false) {
            return false;
        }

        // Определяем исходный формат по MIME-информации, предоставленной
        // функцией getimagesize, и выбираем соответствующую формату
        // imagecreatefrom-функцию.
        $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
        $icfunc = "imagecreatefrom" . $format;
        if (!function_exists($icfunc)) {
            return false;
        }

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

    public function show_gallery() {
        $images = $this->get_img();
        if (!empty($images)) {
            ?>
            <?='<div class="container">'
             . '<div class="row">'
             . '<div class="col-md-10 col-md-offset-1 all_photo">'
             . '<h3 class="text-center title-photos">Загруженные фотографии</h3>'?>
            <?php

            foreach ($images as $value) {
                echo '<div class="photo-block">'
                . '<a class="photo img-responsive text-center" target="_blank" href="photo.php?id=' . $value['id_image'] .
                '.' . $value['mime_type'] . '">'
                . '<img src="img_small/' . $value['id_image'] .
                '.' . $value['mime_type'] . '" alt="picture">'
                . '</a></div>';
            }
            ?>
            <?='</div>'
             . '</div>'
             . '</div>'?>
            <?php

        } else {
            echo <<<END
            <div class="info-img"><h3 class="text-center" style="color:purple;">Загруженных изображений не найдено</h3></div>
END;
        }
    }

    public function clear_dirs($directories) {
        foreach ($directories as $directory) {
            if ($handle = opendir($directory)) {
                while (false !== ($file = readdir($handle)))
                    if ($file != "." && $file != "..")
                        unlink($directory . $file);
                closedir($handle);
            }
        }
    }

    public function get_img() {
        $db = db::instance();
        return $db->select("SELECT * FROM `photo`");
    }

    public function send_img($type) {
        $db = db::instance();
        $db->query("INSERT INTO `photo` (mime_type) VALUES('$type')");
    }

    public function get_last_img() {
        $db = db::instance();
        return $db->query("SELECT * FROM `photo` ORDER BY id_image DESC LIMIT 1");
    }

    public function delete_all_img() {
        $db = db::instance();
        return $db->query("DELETE FROM `photo` WHERE id_image>0");
    }

}
