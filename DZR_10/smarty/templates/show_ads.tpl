<ul>
    {foreach from=$add key=Id item=i name='add'}      {* foreach($items as $Id => $i)*}
        <div align='center'>
            <a href='{$smarty.server.SCRIPT_NAME}?show_id={$i.id}'> {$i.title}
            </a>
            | Цена: {$i.price} | Продавец: {$i.name} | Email: {$i.email} | Телефон: {$i.phone} |
            <a href='{$smarty.server.SCRIPT_NAME}?delete_ads={$i.id}'>Удалить</a><br>
    {foreachelse} Объявлений не добавлено
    {/foreach}
</ul>