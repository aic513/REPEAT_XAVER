<tr style="background-color:#d8fffe">
    <td>{$ads->get_id()}</td>
    <td>{$ads->get_name()}</td>
    <td>{$ads->get_phone()}</td>
    <td><a href='{$smarty.server.SCRIPT_NAME}?show_id={$ads->get_id()}'>{$ads->get_title()}<a></td>
    <td>{$ads->get_description()}</td>
    <td>{$ads->get_price()}</td>
    <td><a class="delete btn btn-danger">Удалить</a></td>
</tr>

 <div id="container"></div>