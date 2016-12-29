<?php /* Smarty version 2.6.30, created on 2016-12-24 23:21:54
         compiled from table_row.tpl */ ?>
<tr id="r<?php echo $this->_tpl_vars['ads']->get_id(); ?>
" style="background-color:#d8fffe">
    <td><?php echo $this->_tpl_vars['ads']->get_id(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_name(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_phone(); ?>
</td>
    <td><a class="edit_link"><?php echo $this->_tpl_vars['ads']->get_title(); ?>
</a></td>
    <td><?php echo $this->_tpl_vars['ads']->get_description(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ads']->get_price(); ?>
</td>
    <td><a class="delete btn btn-danger">Удалить</a></td>
</tr>