<ul>
    {foreach from=$add key=Id item=i name='add'}      {* foreach($items as $Id => $i)*}
        <div align='center'>
            <a href='{$smarty.server.SCRIPT_NAME}?show_id={$i->get_id()}'> {$i->get_title()}</a>
            | Цена: {$i->get_price()} | Продавец: {$i->get_name()} | Email: {$i->get_email()} | Телефон: {$i->get_phone()} |
            <a href='{$smarty.server.SCRIPT_NAME}?delete_ads={$i->get_id()}'>Удалить</a><br>
    {foreachelse} Объявлений не добавлено
    {/foreach}
</ul>
