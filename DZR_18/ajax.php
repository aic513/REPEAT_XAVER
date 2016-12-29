<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
require_once ('startup.php');
require_once('smarty_connect.php');

spl_autoload_register(function ($class) {
    $class_path = 'classes/' . $class . '.class.php';
    if (file_exists($class_path)) {
        require_once $class_path;
    }
});

$ads_store = ads_store::instance();
$ads_store->get_all_ads_from_db();
$pic = new photo();
$errors = new errors(array('name','phone','title','description','price'));
$smarty->assign('cities', $ads_store->get_location());
$smarty->assign('categories', $ads_store->get_category());

switch ($_GET['action']){
    case 'delete':
        if($ads_store->del_ads((int) $_GET['delete_ads'])){
            $result['status'] = "success";
            $result['message'] = "Позиция № {$_GET['delete_ads']} удалена успешно";
        }
        else{
            $result['status'] = "error";
            $result['message'] = "Ошибка удаления позиции";
        }
        echo json_encode($result);
        break;

    case 'clear_base':
        if($ads_store->clear_base()){
            $result['status'] = "success";
            $result['message'] = "База данных с объявлениями очищена успешно";
        }
        else{
            $result['status'] = "error";
            $result['message'] = "Ошибка очистки с объявлениями базы данных";
        }
        echo json_encode($result);
        break;

    case 'submit_add':
        $new_ads = new ads($_POST);
        if ($_POST['private']) {
            $new_ads = new ads_company($_POST);
        } else {
            $new_ads = new ads_private($_POST);
        }
        foreach ($_POST as $key => $value) {
            if (($key == 'id') || ($key == 'name') ||
                    ($key == 'phone') || ($key == 'title') ||
                    ($key == 'description') || ($key == 'price')) {
                $result[$key] = $value;
            }
        }

        $err = $errors->show_error($new_ads, $smarty);
        if ($err['status']) {
            $result['status'] = 'error';
            $result['message'] = 'Пожалуйста,заполните поле';
            $result['fields'] = $err['fields'];
            $result['all_fields'] = $err['all_fields'];
        } else {
            $result['status'] = 'success';
            $result['all_fields'] = $err['all_fields'];
            $ajax_ads = $ads_store->save_post($_POST);
            $result['actions'] = $_GET['addEdit'];
            $result['id'] = $ajax_ads->get_last_ads_id();
            $result['message'] = 'Объявление № '.$result['id'].' успешно добавлено';

        }
        echo json_encode($result);
        break;

    case 'edit_add':
        $result = $ads_store->get_ads_from_db($_POST['id']);
        echo json_encode($result->get_vars());
        break;

    case 'clear_photos':
        $pic = new photo();
        if (isset($_POST)) {
            $pic->delete_all_img();
            $pic->clear_dirs(array("img_big/", "img_small/"));
            $result['status'] = "success";
            $result['message'] = "Все фотографии удалены успешно";
        }
        else{
            $result['status'] = "error";
            $result['message'] = "Ошибка при удалении фотографий";
        }
        echo json_encode($result);
        break;

    case 'upload_img':
        $pic = new photo();
        if (isset($_POST['download_file'])) {
            if (isset($_FILES['fupload'])) {
                $number = $pic->upload_image($_FILES['fupload']);
                $result['status'] = 'success';
                $result['message'] = 'Фотография № ' . $number . ' успешно добавлена';
                $result['file_name'] = $number;
            } else {
                $result['status'] = 'error';
                $result['message'] = 'Вы не добавили файл';
            }
        }
        echo json_encode($result);
        break;

    default:
        break;
}





