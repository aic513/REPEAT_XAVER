<?php /* Smarty version 2.6.30, created on 2016-12-10 12:35:22
         compiled from form.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'form.tpl', 46, false),)), $this); ?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-10 col-md-offset-1 col-sm-offset-2">
            <h1 class="text-center text-info"><strong>Доска объявлений</strong></h1>
            <form method="post" class="form-horizontal clearfix" enctype="multipart/form-data">
                <font size="4">
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
                            <label for="allow_mails_field">
                                <input type="checkbox"  id="allow_mails_field" value="checked" 
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
                        <?php echo smarty_function_html_options(array('style' => "cursor:pointer; text-align-last: center;font-style:italic;",'name' => 'location','options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['new_ads']->get_location(),'class' => "form-control"), $this);?>

                    </div>
                </div>
                <div class="category form-group col-md-12">
                    <label for="category_field" class="col-sm-3">Категория</label>
                    <div class="col-sm-12">
                         <?php echo smarty_function_html_options(array('style' => "cursor:pointer; text-align-last: center;font-style:italic;",'name' => 'category','options' => $this->_tpl_vars['categories'],'selected' => $this->_tpl_vars['new_ads']->get_category(),'class' => "form-control"), $this);?>

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
                    <button type="submit" class="btn btn-success" name="confirm"> <?php if ($this->_tpl_vars['new_ads']->get_id() != ''): ?>Сохранить <?php else: ?>Добавить <?php endif; ?>объявление</button>
                    <button type="submit" class="btn btn-default" name="clear_form">Очистить форму</button>
                    <button type="submit" class="btn btn-danger" name="clear_base">Очистить базу</button>
                    <input style="display:inline-block" type="file" data-filename-placement="inside" name="fupload">
                    <button type="submit" class="btn btn-warning" name="download_file">Загрузить фото!</button>
                    <button type="submit" class="btn btn-info" name="clear_photos">Удалить фотографии</button>
                </div>
                     <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['new_ads']->get_id(); ?>
">
                </form>
                    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "show_ads.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
    </div>
</div>

