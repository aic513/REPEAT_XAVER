<?php
header('Content-type: text/html; charset=utf-8');
?>
<title>!!!!!КАПЕЦ COOKIES!!!!!!</title>
<h1 align="center"><strong>Доска объявлений</strong></h1>
<form style="margin-left:20%;" method="post">
    <font size="4">
        <div class="personal">
            <label for="field_private">
                <input type="radio" id="field_private" <?php echo $new_ads['private'] == 1 ? 'checked':'';?> value="1" name="private">Частное лицо</label>
            <label for="field_company">
                <input type="radio" id="field_company" <?php echo $new_ads['private'] == 2 ? 'checked':'';?> value="2"  name="private">Компания</label>
        </div>
        <div class="name">
            <label for="field_name"><b>Ваше имя </b></label>
            <input type="text" id="field_name" maxlength="40" value="<?php echo $new_ads['name'];?>" name="name">
        </div>
        <div class="email">
            <label for="field_email">Электронная почта</label>
            <input type="text" id="field_email" value="<?php echo $new_ads['email'];?>" name="email">
        </div>
        <div class="allow_mails">
            <label for="allow_mails_field">
                <input type="checkbox"  id="allow_mails_field" value="checked" <?php echo $new_ads['allow_mails'];?> name="allow_mails"><span>Я не хочу получать вопросы по объявлению по e-mail</span>
            </label>
        </div>
        <div class="phone">
            <label for="field_phone">Номер телефона</label>
            <input id="field_phone" type="text" value="<?php echo $new_ads['phone'];?>" name="phone">
        </div>
        <div class="city">
            <label for="field_region" class="col-sm-2 control-label">Город</label>
            <select title="Выберите Ваш город" name="location" id="field_region" class="form-control">
                <option value="">-- Выберите город --</option>
                <option disabled="disabled">-- Города --</option>
                <?php echo show_city_block($new_ads['location']);?>
            </select>
        </div>
        <div class="category">
            <label for="category_field" class="form-label">Категория</label>
            <select title="Выберите категорию объявления" name="category" id="category_field" class="form-input-select">
                <option value="">-- Выберите категорию --</option>
                    <?php echo show_category_block($new_ads['category']); ?>
            </select>
        </div>
        <div class="title">
            <label for="title_field">Название объявления</label>
            <input id="title_field" type="text" maxlength="50" value="<?php echo $new_ads['title'];?>" name="title">
        </div>
        <div class="description">
            <label for="description_field">Описание объявления</label>
            <br>
            <textarea id="description_field" name="description" cols="80" rows="5" maxlength="3000"><?php echo $new_ads['description'];?></textarea>
        </div>
        <div class="price">
            <label for="price_field">Цена</label>
            <input type="text" id="price_field" maxlength="9" value="<?php echo $new_ads['price'];?>" name="price">&nbsp;<span>руб.</span>
        </div>
        <input type="submit" value="<?php echo $save_ads;?> объявление" id="form_submit" name="confirm">
        <input type="submit" value="Очистить форму" name="clear_form">
        <div class="buttons">
            <input type="submit" <?php echo $back;?> value="Назад" name="back">
            <input type="submit" value="Очистить базу объявлений" name="clear_base">
        </div>
        <input type=hidden name=id_ads value="<?php echo $new_ads['id'];?>">
</form>

