/*
 * Очистка формы
 */
clear_form = function () {
    $(':input', '#form').prop('checked', false).prop('selected', false)
            .not(':button, :submit,:checkbox, :reset, #addEdit, :radio')
            .val('');

    error_message();
};

/*
 *Очистка сообщений об ошибке 
 */
error_message = function () {
    if ($('.err_msg').html() == 0) {
        $.noop();
    }
    else if ($('.err_msg').html() != 0) {
        $('.err_msg').remove();
    }
};

/*
 * Проверка бд на наличие объявлений
 */
db_empty_notice = function () {
    if ($('#ads_list').html() == 0) {
        $('#db_info').fadeIn("fast");
    }
    else if ($('#ads_list').html() != 0) {
        $('#db_info').fadeOut("fast");
    }
};


$(document).ready(function () {
    $('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();

    /*
     * Удаление объявления
     */
    delete_function = function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        var number_ads = {"delete_ads": id};
        $.getJSON('ajax.php?action=delete',
                number_ads,
                function (result) {
                    tr.fadeOut("slow", function () {
                        if (result.status == "success") {
                            $('#container').removeClass('alert-info').addClass('alert-success');
                            $('#container_info').html(result.message);
                            $('#container').fadeIn("slow");
                        }
                        else if (result.status == "error") {
                            $('#container').removeClass('alert-success').addClass('alert-danger');
                            $('#container_info').html(result.message);
                            $('#container').fadeIn("slow");
                        }
                        setTimeout(function () {
                            $('#container').fadeOut("slow");
                        }, 3000);
                        $(this).remove();
                        db_empty_notice();
                        if ($('#form [name = id]').val() == id) {
                            error_message();
                            clear_form();
                        }
                        error_message();
                        clear_form();
                        $('button.btn_confirm').html('Добавить объявление');
                        $('#addEdit').val('add');
                    });
                });
    };
    $('table.table').on('click', 'a.delete', delete_function);  //обработчик удаления 1-го об-ия из бд
    
    /*
     * Очистка бд
     */
    cleaning_clearbase = function () {
        var clean_base = {"db": "is_removed"};
        $.getJSON('ajax.php?action=clear_base',
                clean_base,
                function (result) {
                    $('#ads_list tr').hide("slow", function () {
                        if (result.status == "success") {
                            $('#container_clearbase').removeClass('alert-info').addClass('alert-success');
                            $('#container_clearbase_info').html(result.message);
                            $('#container_clearbase').fadeIn("slow");
                        }
                        else if (result.status == "error") {
                            $('#container_clearbase').removeClass('alert-success').addClass('alert-danger');
                            $('#container_clearbase_info').html(result.message);
                            $('#container_clearbase').fadeIn("slow");
                        }
                        setTimeout(function () {
                            $('#container_clearbase').fadeOut("slow");
                        }, 3000);
                        clear_form();
                        error_message();
                        $('button.btn_confirm').html('Добавить объявление');
                        $('#addEdit').val('add');
                        $('#ads_list tr').remove();
                    });
                });
    };
    $('a.btn_clear_base').on('click', cleaning_clearbase);    //обработчик очистки бд
            
    /*
     * Добавление/редактирование объявления
     */        
    
    
    function showResponse(response){
        if (response.status == 'success') {
                    $.each(response.all_fields, function (key, value) {
                        $('#form [name =' + value + '] + font').remove();
                    });

                    if (response.actions == 'add') { // добавление
                        $('#container').removeClass('alert-info').addClass('alert-success');
                        $('#db_info').fadeOut('fast');
                        $('#container_info').html(response.message);
                        $('#container').fadeIn("slow");
                         setTimeout(function () {
                            $('#container').fadeOut("slow");
                        }, 3000);
                        $('#ads_list').append("<tr style='background-color:#d8fffe' hidden id='r" + response.id + "'>\n\
                        <td>" + response.id + "</td>\n\
                        <td>" + response.name + "</td>\n\
                        <td>" + response.phone + "</td>\n\
                        <td><a class='edit_link'>" + response.title + "</a></td>\n\
                        <td>" + response.description + "</td>\n\\n\
                        <td>" + response.price + "</td>\n\
                        <td><a class='delete btn btn-danger'>Удалить</a></td></tr>");
                        $("#r" + response.id).fadeIn('fast');
                        $("#ads_list").fadeIn('fast');
                    }
                    else if (response.actions == 'edit') { //редактирование
                        $('#r' + response.id + ' td:eq(0)').html(response.id);
                        $('#r' + response.id + ' td:eq(1)').html(response.name);
                        $('#r' + response.id + ' td:eq(2)').html(response.phone);
                        $('#r' + response.id + ' td:eq(3)').html("<a class='edit_link'>" + response.title + "</a>");
                        $('#r' + response.id + ' td:eq(4)').html(response.description);
                        $('#r' + response.id + ' td:eq(5)').html(response.price);
                        $('#container').removeClass('alert-info').addClass('alert-success');
                        $('#db_info').fadeOut('fast');
                        $('#container_info').html('Объявление № ' + response.id + ' успешно отредактировано');
                        $('#container').fadeIn("slow");
                         setTimeout(function () {
                            $('#container').fadeOut("slow");
                        }, 3000);

                    }
                    ;
                    clear_form();
                    error_message();
                    $('button.btn_confirm').html('Добавить объявление');
                    $('#addEdit').val('add');
                }
                else if (response.status == 'error') {
                   
                    $.each(response.all_fields, function (key, value) {
                        $('#form [name = ' + value + '] + font').remove();
                    });
                    $.each(response.fields, function (key, value) {
                        $('#form [name = ' + value + ']').after('<font class="err_msg" color="red">' + response.message + '</font>');
                    });
                }
    }
    
    var options = {           
        success:       showResponse, 
        url: 'ajax.php?action=submit_add',         
        dataType:  'json'      
    }; 
    
    $('#form').ajaxForm(options); 
    
    /*
     * Вывод данных в форму
     */
    
    editing = function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        var edit_id = {"id": id};
        $.ajax({
            type: "POST",
            data: edit_id,
            url: 'ajax.php?action=edit_add',
            dataType: "JSON",
            success: function (response) {
                clear_form();
                $.each(response, function (key, value) {
                    var path = '#form [name = ' + key + ']';
                    if (key == 'private' || key == 'allow_mails') {
                        $(path + '[value = ' + value + ']').prop('checked', true);
                    }
                    else if (key == 'location' || key == 'category') {
                        $(path + ' [value = ' + value + ']').prop('selected', true);
                    }
                    else {
                        $(path).val(value);
                    }
                    $('#addEdit').val('edit');
                    $('button.btn_confirm').text('Сохранить объявление');
                });
            },
            error: function (response) {
                console.log(response);
            }
        });
    };
    
    $('table.table').on('click', 'a.edit_link', editing); // обработчик вывода данных в форму
            
            
            
    $('a.btn_clear_form').click(function () {
    clear_form();
    $('button.btn_confirm').html('Добавить объявление');
    $('#addEdit').val('add');
    });  // обработчик очистки формы
                
});

    






