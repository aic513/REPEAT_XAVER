<?php /* Smarty version 2.6.30, created on 2016-12-10 11:26:57
         compiled from show_ads.tpl */ ?>
<br>
<table style="font-family:Consolas;font-style:italic; font-size: 16px;" class="table table-bordered table-responsive">
   <thead>
                <tr>
                  <th>#id</th>
                  <th style="background-color:#bbeeff;">Имя</th>
                   <th style="background-color:#EACEAA;">Телефон</th>
                  <th class="success">Название</th>
                  <th class="warning">Описание</th>
                  <th class="danger">Цена</th>
                  <th class="active">Действия</th>
                </tr>
              </thead>
              <tbody>
                 <?php echo $this->_tpl_vars['ads_rows']; ?>

              </tbody>
</table>