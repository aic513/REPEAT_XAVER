$(document).ready(function () {
    $('input[type=file]').bootstrapFileInput();
    $('.file-inputs').bootstrapFileInput();

    $('a.delete').on('click', function () {
        var tr = $(this).closest('tr');
        var id = tr.children('td:first').html();
        $('input,select,textarea,checkbox').val('');
        $('#container').load('ajax.php?action=delete&delete_ads=' + id,
                function () {
                    tr.fadeOut("slow",
                            function () {
                                $(this).remove();
                                clear_form();
                            });
                });
    });
});

clear_form = function () {
    $(':input', '#form').removeAttr('checked').removeAttr('selected')
            .not(':button, :submit, :reset, #addEdit, :checkbox, :radio').val('');
};

