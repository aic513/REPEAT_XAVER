<?php /* Smarty version 2.6.30, created on 2016-11-30 12:17:31
         compiled from show_ads.tpl */ ?>
<ul>
    <?php $_from = $this->_tpl_vars['add']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['add'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['add']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['Id'] => $this->_tpl_vars['i']):
        $this->_foreach['add']['iteration']++;
?>              <div align='center'>
            <a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?show_id=<?php echo $this->_tpl_vars['i']['id']; ?>
'> <?php echo $this->_tpl_vars['i']['title']; ?>

            </a>
            | Цена: <?php echo $this->_tpl_vars['i']['price']; ?>
 | Продавец: <?php echo $this->_tpl_vars['i']['name']; ?>
 | Email: <?php echo $this->_tpl_vars['i']['email']; ?>
 | Телефон: <?php echo $this->_tpl_vars['i']['phone']; ?>
 |
            <a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?delete_ads=<?php echo $this->_tpl_vars['i']['id']; ?>
'>Удалить</a><br>
    <?php endforeach; else: ?> Объявлений не добавлено
    <?php endif; unset($_from); ?>
</ul>