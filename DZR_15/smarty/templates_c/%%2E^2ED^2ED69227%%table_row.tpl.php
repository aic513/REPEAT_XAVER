<?php /* Smarty version 2.6.30, created on 2016-12-16 11:13:32
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
    <td><a class="delete btn btn-danger">Удалить</a></td>
</tr>

 <div id="container"></div>