<?php /* Smarty version 2.6.30, created on 2016-12-04 21:47:00
         compiled from show_ads.tpl */ ?>
<ul>
    <?php $_from = $this->_tpl_vars['add']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['add'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['add']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Id'] => $this->_tpl_vars['i']):
        $this->_foreach['add']['iteration']++;
?>              <div align='center'>
            <a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?show_id=<?php echo $this->_tpl_vars['i']->get_id(); ?>
'> <?php echo $this->_tpl_vars['i']->get_title(); ?>
</a>
            | Цена: <?php echo $this->_tpl_vars['i']->get_price(); ?>
 | Продавец: <?php echo $this->_tpl_vars['i']->get_name(); ?>
 | Email: <?php echo $this->_tpl_vars['i']->get_email(); ?>
 | Телефон: <?php echo $this->_tpl_vars['i']->get_phone(); ?>
 |
            <a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?delete_ads=<?php echo $this->_tpl_vars['i']->get_id(); ?>
'>Удалить</a><br>
    <?php endforeach; else: ?> Объявлений не добавлено
    <?php endif; unset($_from); ?>
</ul>