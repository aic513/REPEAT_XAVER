{include file="header.tpl"}
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
                               value="{$new_ads.name}" name="name">
                    </div>
                </div>
                <div class="email form-group col-md-12">
                    <label class="col-sm-2" for="field_email">Почта</label>
                    <div class="col-sm-10">
                        <input placeholder="Введите адрес Вашей электронной почты" type="text" class="form-control" id="field_email" value="{$new_ads.email}" name="email">
                    </div>
                </div>
                <div class="allow_mails form-group col-md-12">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label for="allow_mails_field">
                                <input type="checkbox"  id="allow_mails_field" value="checked" {if isset($new_ads.allow_mails)}checked{/if} name="allow_mails">
                                <span>Я не хочу получать вопросы по объявлению по e-mail</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="phone form-group col-md-12">
                    <label class="col-sm-2" for="field_phone">Телефон</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Введите Ваш номер телефона" id="field_phone" type="text" value="{$new_ads.phone}" name="phone">
                    </div>
                </div>
                <div class="city form-group col-md-12">
                    <label for="field_region" class="col-sm-2">Город</label>
                    <div class="col-sm-10">
                        <select style="cursor:pointer; text-align-last: center;font-style:italic;" title="Выберите Ваш город" name="location" id="field_region" class="form-control">
                            <option>Выберите город</option>
                            {html_options options=$cities selected=$new_ads.location}
                        </select>
                    </div>
                </div>
                <div class="category form-group col-md-12 col-sm-6">
                    <label for="category_field" class="col-sm-2">Категория</label>
                    <div class="col-sm-10">
                        <select style="cursor:pointer; text-align-last: center;font-style:italic;" title="Выберите категорию объявления" name="category" id="category_field" class="form-control">
                            <option value="">-- Выберите категорию --</option>
                            {html_options options=$categories selected=$new_ads.category}
                        </select>
                    </div>
                </div>
                <div class="title form-group col-md-12">
                    <label class="col-sm-2" for="title_field">Название</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Введите название вашего объявления" id="title_field" type="text" maxlength="50" value="{$new_ads.title}" name="title">
                    </div>
                </div>
                <div class="description form-group col-md-12">
                    <label class="col-sm-2" for="description_field">Описание объявления</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="description_field" name="description" cols="100" placeholder="Введите информацию о товаре/услуге" rows="5" maxlength="3000">{$new_ads.description}</textarea>
                    </div>
                </div>
                <div class="price form-group col-md-12">
                    <label class="col-sm-2" for="price_field">Цена</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" id="price_field" placeholder="Введите цену в рублях" maxlength="9" value="{$new_ads.price}" name="price">
                    </div>
                </div>
                <div class="personal form-group col-md-12">
                    <div class="radio-inline">
                        <label for="field_private">
                            <input type="radio" id="field_private"   {if $new_ads.private eq 1}checked{/if}
                                   value="1" name="private">Частное лицо
                        </label>
                    </div>
                    <div class="radio-inline">
                        <label for="field_company">
                            <input type="radio" id="field_company" {if $new_ads.private eq 2}checked{/if}
                                   value="2"  name="private">Компания
                        </label>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-success" name="confirm"> {if isset($new_ads.id)}Сохранить {else}Добавить {/if}объявление</button>
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




{include file='footer.tpl'}