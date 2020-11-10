$('.delete_class').click(function () {
    var card = $(this).closest('.card');
    var del_id = $(this).attr('id');
    $.ajax({
        url: "delete.php?id=" + del_id,
        cache: false,
        success: function (result) {
            card.fadeOut(1000, function () {
                $(this).remove();
            });
        }

    });
});