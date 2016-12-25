<?php /* Smarty version 2.6.30, created on 2016-12-25 22:18:11
         compiled from form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'form.tpl', 49, false),)), $this); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-10 col-md-offset-1 col-sm-offset-2">
            <h1 class="text-center text-info"><strong>Доска объявлений</strong></h1>
            <font size="3">
            <form method="post" class="form-horizontal clearfix"  id="form" enctype="multipart/form-data">
                <div class="name form-group col-md-12">
                    <label for="field_name" class="col-sm-5"><b>Ваше имя </b></label>
                    <div class="col-sm-12">
                        <input placeholder="Введите Ваше имя" type="text" class="form-control" id="field_name" maxlength="40"
                               value="<?php echo $this->_tpl_vars['new_ads']->get_name(); ?>
"
                               name="name">
                    </div>
                </div>
                <div class="email form-group col-md-12">
                    <label class="col-sm-7" for="field_email">Электронная почта</label>
                    <div class="col-sm-12">
                        <input placeholder="Введите адрес почты" type="email" class="form-control" id="field_email"
                               value="<?php echo $this->_tpl_vars['new_ads']->get_email(); ?>
"
                               name="email">
                    </div>
                </div>
                <div class="allow_mails form-group col-md-12">
                    <div class="col-sm-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="check"  id="allow_mails_field" value="1" 
                                <?php if ($this->_tpl_vars['new_ads']->get_allow_mails() == 1): ?>checked<?php endif; ?> 
                                name="allow_mails">
                                <span>Я не хочу получать вопросы по объявлению по e-mail</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="phone form-group col-md-12">
                    <label class="col-sm-5" for="field_phone">Номер телефона</label>
                    <div class="col-sm-12">
                        <input class="form-control" placeholder="Введите номер телефона" id="field_phone" type="phone" 
                               value="<?php echo $this->_tpl_vars['new_ads']->get_phone(); ?>
"
                               name="phone">
                    </div>
                </div>
                <div class="city form-group col-md-12">
                    <label for="field_region" class="col-sm-3">Город</label>
                    <div class="col-sm-12">
                        <select style="cursor:pointer; text-align-last: center;font-style:italic;"
                        name="location" class="form-control" >
                            <option>Выберите город</option>
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['new_ads']->get_location()), $this);?>

                        </select>
                    </div>
                </div>
                <div class="category form-group col-md-12">
                    <label for="category_field" class="col-sm-3">Категория</label>
                    <div class="col-sm-12">
                        <select  style="cursor:pointer; text-align-last: center;font-style:italic;"
                         name="category" class="form-control">
                            <option>Выберите категорию</option>
                         <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['new_ads']->get_category()), $this);?>

                        </select>
                    </div>
                </div>
                <div class="title form-group col-md-12">
                    <label class="col-sm-3" for="title_field">Название</label>
                    <div class="col-sm-12">
                        <input class="form-control" placeholder="Введите название объявления" id="title_field" type="text"
                        maxlength="50" 
                        value="<?php echo $this->_tpl_vars['new_ads']->get_title(); ?>
" 
                        name="title">
                    </div>
                </div>
                <div class="description form-group col-md-12">
                    <label class="col-sm-8" for="description_field">Описание объявления</label>
                    <div class="col-sm-12">
                        <textarea class="form-control" id="description_field" name="description"
                        cols="100" placeholder="Введите информацию о товаре/услуге" rows="5"
                        maxlength="3000"><?php echo $this->_tpl_vars['new_ads']->get_description(); ?>
</textarea>
                    </div>
                </div>
                <div class="price form-group col-md-12">
                    <label class="col-sm-3" for="price_field">Цена</label>
                    <div class="col-sm-12">
                        <input class="form-control" type="text" id="price_field" placeholder="Введите цену в рублях" maxlength="9"
                               value="<?php echo $this->_tpl_vars['new_ads']->get_price(); ?>
" 
                               name="price">
                    </div>
                </div>
                <div class="personal form-group col-md-12">
                    <div class="col-xs-12">
                        <label for="field_private">
        <input type="radio" <?php if ($this->_tpl_vars['new_ads']->get_private() == 0): ?>checked=""<?php endif; ?>  value="0" name="private" id="field_private">Частное лицо</label>
                    </div>
                    <div class="col-xs-12">
                        <label for="field_company">
        <input type="radio" <?php if ($this->_tpl_vars['new_ads']->get_private() == 1): ?>checked=""<?php endif; ?>value="1" name="private" id="field_company">Компания</label>
                    </div>
                </div>
                <div class="form-group col-sm-12 text-center">
                    <input type="hidden" name="addEdit" id="addEdit" value="add">
                    <button id="submit_add" class="btn btn-success btn_confirm">Добавить объявление</button>
                    <a class="btn btn-default btn_clear_form">Очистить форму</a>
                    <a class="btn btn-danger btn_clear_base">Очистить базу</a>
                    <input style="display:inline-block" type="file" data-filename-placement="inside" name="fupload">
                    <button type="submit" class="btn btn-warning btn_download_file" name="download_file">Загрузить фото!</button>
                    <button type="submit" class="btn btn-info btn_clear_photos" name="clear_photos">Удалить фотографии</button>
                </div>
                    <input class="hidden_id" type="hidden" name="id" value="<?php echo $this->_tpl_vars['new_ads']->get_id(); ?>
">
                </form>
                </font>
            
                    <div id="container" class=" col-md-12 alert alert-success alert-dismissible" style="display:none;">
                        <a style="vertical-align: top;" class="close"
                            onclick="$('#container').fadeOut('slow');">
                            <span style="vertical-align:middle;" aria-hidden="true">&times;</span>
                        </a>
                        <div id="container_info"></div>
                        <div id="db_info">В базе данных больше нет объявлений</div>    
                    </div>
            
                    <div id="container_clearbase"
                        class="col-md-12 alert alert-info alert-dismissible" style="display:none;">
                        <a style="vertical-align: top;" class="close"
                            onclick="$('#container_clearbase').fadeOut('slow');">
                            <span style="vertical-align:middle;" aria-hidden="true">&times;</span>
                        </a>
                        <div id="container_clearbase_info"></div>
                    </div>
                
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "show_ads.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
    </div>
</div>
                