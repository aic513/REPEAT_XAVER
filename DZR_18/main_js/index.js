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

    submission = function () {
        var into_form = $('#form').serialize();
        $.ajax({
            type: "POST",
            data: into_form,
            url: "ajax.php?action=submit_add&addEdit=" + $('#addEdit').val(),
            dataType: "JSON",
            success: function (response) {
                if (response.status == 'success') {
                    $.each(response.all_fields, function (key, value) {
                        $('#form [name =' + value + '] + font').remove();
                    });

                    if (response.actions == 'add') { // добавление
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

                    };
                    clear_form();
                    error_message();
                    $('a.btn_confirm').html('Добавить объявление');
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
        });
    };
    
    
    $('a.btn_confirm').on('click', function(){
        submission();
        $('a.btn_confirm').text('Добавить объявление');
    });  //  обработчик добавления и редактирования
    
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
                    $('a.btn_confirm').text('Сохранить объявление');
                });
            },
            error: function () {
                console.log('Error');
            }
        });
    };
    
    $('table.table').on('click', 'a.edit_link', editing); // обработчик вывода данных в форму
            
            
    clearing_photos = function(){
        var no_photo = {"all_photos":"are_removed"};
        $.ajax({
            data:no_photo,
            type:"POST",
            url:'ajax.php?action=clear_photos',
            dataType: "JSON",
            success:function(response){
                clear_form();
                error_message();
                if(response.status == 'success'){
                    $('.all_photo').remove();
                    $('#container').removeClass('alert-info').addClass('alert-success');
                    $('#db_info').fadeOut('fast');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn("slow");
                         setTimeout(function () {
                            $('#container').fadeOut("slow");
                        }, 5000);
                    $('table.table').fadeIn('slow', function () {
                        $('table.table').after(function () {
                            return '<div class="info-img"></div>';
                        });
                    $('.info-img').html('<h3 class="text-center" style="color:purple;">Загруженных изображений не найдено</h3>');
                    });
                    $('#input-file').val('');
                    $('#input-file').attr('title', '');
                    clear_form();
                    error_message();
                    $('.file-input-wrapper span').html('Выберите фото');
                }
                else if(response.status == 'error'){
                    $('#container').removeClass('alert-success').addClass('alert-danger');
                    $('#db_info').fadeOut('fast');
                    $('#container_info').html(response.message);
                    $('#container').fadeIn("slow");
                    setTimeout(function () {
                    $('#container').fadeOut("slow");
                    }, 3000);
                }
                
            },
            error:function(){
                console.log('Error');
            }
        });
        
    };
    
    $('button.btn_clear_photos').on('click',clearing_photos);  //обработчик удаления фотографий
    
    
    
    
    /////////////////////////////////////////////////////Загрузка файлов
    function showResponse(response) {
        console.log(response);
        if (response.responseJSON.status == "success") {
            $('#container').removeClass('alert-danger').addClass('alert-success');
            $('#db_info').fadeOut('fast');
            $('#container_info').html(response.responseJSON.message);
            $('#container').fadeIn("slow");
            setTimeout(function () {
                $('#container').fadeOut("slow");
            }, 10000);
            if ($('.photo-block').length > 0) {
                $(".all_photo").append('<div class="photo-block">\n\
                <a class="photo img-responsive text-center" target="_blank" \n\
                href="photo.php?id=' + response.responseJSON.file_name + '">\n\
                <img src="img_small/' + response.responseJSON.file_name + '" alt="picture"></a>');
            }
            else {
                $('.info-img').hide();
                $('.row-main').after(function () {
                    return '<div class="container">\n\
                    <div class="row">\n\
                    <div class="col-md-10 col-md-offset-1 all_photo">\n\
                    <h3 class="text-center title-photos">Загруженные фотографии</h3>\n\
                    </div></div></div>';
                });
                $(".all_photo").append('<div class="photo-block">\n\
                <a class="photo img-responsive text-center" target="_blank" \n\
                href="photo.php?id=' + response.responseJSON.file_name + '">\n\
                <img src="img_small/' + response.responseJSON.file_name + '" alt="picture"></a>');
            }


        }
        else if (response.responseJSON.status == 'error') {
            $("#bar").width('0%');
            $("#message").html("");
            $("#percent").html("0%");
            $('#container').removeClass('alert-success').addClass('alert-danger');
            $('#db_info').fadeOut('fast');
            $('#container_info').html(response.responseJSON.message);
            $('#container').fadeIn("slow");
            setTimeout(function () {
                $('#container').fadeOut("slow");
            }, 5000);
        }
        else {
            $('#container').removeClass('alert-success').addClass('alert-danger');
            $('#db_info').fadeOut('fast');
            $('#container_info').html(response.responseJSON.answer);
            $('#container').fadeIn("slow");
            setTimeout(function () {
                $('#container').fadeOut("slow");
            }, 5000);

        }
        $('#input-file').val('');
        $('#input-file').attr('title', '');
        clear_form();
        error_message();
        $('.file-input-wrapper span').html('Выберите фото');
    };

    var options = {
        beforeSend: function ()
        {
            $("#progress").show();
            //clear everything
            $("#bar").width('0%');
            $("#message").html("");
            $("#percent").html("0%");
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $("#bar").width(percentComplete + '%');
            $("#percent").html(percentComplete + '%');
        },
        success: function () {
            $("#bar").width('100%');
            $("#percent").html('100%');
        },
        complete: showResponse,
        error: function () {
            console.log('ERROR: unable to upload files');
        },
        url: 'ajax.php?action=upload_img',
        dataType: 'JSON'
    };

    $('#form_img').ajaxForm(options);

    /////////////////////
    
            
       
    
    
    
    $('a.btn_clear_form').click(function () {
    clear_form();
    $('button.btn_confirm').html('Добавить объявление');
    $('#addEdit').val('add');
    });  // обработчик очистки формы
                
});

    






