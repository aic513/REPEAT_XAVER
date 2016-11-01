<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>!!!!!КАПЕЦ SMARTY!!!!!!</title>

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-10 col-sm-8 col-md-10 col-md-offset-1 col-sm-offset-2">
                    <h1 class="text-center text-info"><strong>Доска объявлений</strong></h1>
                    <form method="post" class="form-horizontal" enctype="multipart/form-data">
                        <font size="4">
                        <div class="name form-group col-md-12">
                            <label for="field_name" class="col-sm-2"><b>Ваше имя </b></label>
                            <div class="col-sm-10">
                                <input placeholder="Введите Ваше имя" type="text" class="form-control" id="field_name" maxlength="40"
                                       value="<?php echo $new_ads['name']; ?>" name="name">
                            </div>
                        </div>
                        <div class="email form-group col-md-12">
                            <label class="col-sm-2" for="field_email">Почта</label>
                            <div class="col-sm-10">
                                <input placeholder="Введите адрес Вашей электронной почты" type="text" class="form-control" id="field_email" value="<?php echo $new_ads['email']; ?>" name="email">
                            </div>
                        </div>
                        <div class="allow_mails form-group col-md-12">
                            <div class="col-sm-12">
                                <div class="checkbox">
                                    <label for="allow_mails_field">
                                        <input type="checkbox"  id="allow_mails_field" value="checked" <?php echo $new_ads['allow_mails']; ?>name="allow_mails">
                                        <span>Я не хочу получать вопросы по объявлению по e-mail</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="phone form-group col-md-12">
                            <label class="col-sm-2" for="field_phone">Телефон</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Введите Ваш номер телефона" id="field_phone" type="text" value="<?php echo $new_ads['phone']; ?>" name="phone">
                            </div>
                        </div>
                        <div class="city form-group col-md-12 col-sm-6">
                            <label for="field_region" class="col-sm-2">Город</label>
                                <div class="col-sm-10">
                            <select style="cursor:pointer; text-align-last: center;font-style:italic;" title="Выберите Ваш город" name="location" id="field_region" class="form-control">
                                <option value="">-- Выберите город --</option>
                                <option disabled="disabled">-- Города --</option>
                                <?php echo show_city_block($new_ads['location']); ?>
                            </select>
                                </div>
                        </div>
                        <div class="category form-group col-md-12 col-sm-6">
                            <label for="category_field" class="col-sm-2">Категория</label>
                            <div class="col-sm-10">
                                <select style="cursor:pointer; text-align-last: center;font-style:italic;" title="Выберите категорию объявления" name="category" id="category_field" class="form-control">
                                    <option value="">-- Выберите категорию --</option>
                                    <?php echo show_category_block($new_ads['category']); ?>
                                </select>
                            </div>
                        </div>
                        <div class="title form-group col-md-12">
                            <label class="col-sm-2" for="title_field">Название</label>
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Введите название вашего объявления" id="title_field" type="text" maxlength="50" value="<?php echo $new_ads['title']; ?>" name="title">
                            </div>
                        </div>
                        <div class="description form-group col-md-12">
                            <label class="col-sm-2" for="description_field">Описание объявления</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="description_field" name="description" cols="100" placeholder="Введите информацию о товаре/услуге" rows="5" maxlength="3000"><?php echo $new_ads['description']; ?></textarea>
                            </div>
                        </div>
                        <div class="price form-group col-md-12">
                            <label class="col-sm-2" for="price_field">Цена</label>
                            <div class="col-sm-4">
                                <input class="form-control" type="text" id="price_field" placeholder="Введите цену в рублях" maxlength="9" value="<?php echo $new_ads['price']; ?>" name="price">
                            </div>
                        </div>
                        <div class="personal form-group col-md-12">
                            <div class="radio-inline">
                                <label for="field_private">
                                    <input type="radio" id="field_private" <?php echo $new_ads['private'] == 1 ? 'checked' : ''; ?>
                                           value="1" name="private">Частное лицо
                                </label>
                            </div>
                            <div class="radio-inline">
                                <label for="field_company">
                                    <input type="radio" id="field_company" <?php echo $new_ads['private'] == 2 ? 'checked' : ''; ?>
                                           value="2"  name="private">Компания
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                                <input style="display:inline-block" type="submit" value="<?php echo $save_ads ?> объявление" id="form_submit" name="confirm">
                                <button type="submit" class="btn btn-default" name="clear_form">Очистить форму</button>
                                <input type="submit" class="btn btn-primary" value="Удалить все фотографии" name="clear_photos">
                                <button type="submit" class="btn btn-primary" name="clear_base">Очистить базу объявлений</button>
                        </div>
                        <div class="buttons form-group col-sm-12">
                            <button type="submit" class="btn btn-default" type="submit" name="back">Назад</button>
                            <input style="display:inline-block" type="file" data-filename-placement="inside" name="fupload">
                            <button type="submit" class="btn btn-primary" name="download_file">Загрузить фото!</button>
                        </div>
                </div>
            </div>
        </div>
    </form>
</div>
 <!--jQuery (necessary for Bootstrap's JavaScript plugins)-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <!--Include all compiled plugins (below), or include individual files as needed-->
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.file-input.js"></script>
<script src="main_js/index.js"></script>
</body>
</html>
