<?php /* Smarty version 2.6.30, created on 2016-12-10 00:05:01
         compiled from table_row.tpl */ ?>
<tr style="background-color:#d8fffe">
    <td><?php echo $this->_tpl_vars['ads']->get_id(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_name(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_phone(); ?>
</td>
    <td><a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?show_id=<?php echo $this->_tpl_vars['ads']->get_id(); ?>
'><?php echo $this->_tpl_vars['ads']->get_title(); ?>
<a></td>
    <td><?php echo $this->_tpl_vars['ads']->get_description(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_price(); ?>
</td>
    <td><a href='<?php echo $_SERVER['SCRIPT_NAME']; ?>
?delete_ads=<?php echo $this->_tpl_vars['ads']->get_id(); ?>
'>Удалить</a></td>
</tr>