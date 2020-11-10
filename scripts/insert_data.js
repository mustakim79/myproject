// $(document).ready(function () {
/* $("input#sub").click(function () {
    $.post(
        $("#myform").attr("action"),
        $("#myform :input").serializeArray(),
        function (data) {
            alert(data);
        });
}); */
function insert(id, qty) {
    // var qty = $("input#spinner").val();
    // console.log(id + " " + qty);
    $.ajax({
        url: `order_process.php?id=${id}`,
        type: 'POST',
        data: { qty: qty },
        success: function (data) {
            $("#tot_item").load('../count_item.php');
            console.log(data);
            $.toast({
                heading: '<b class="text-uppercase">' + data + '</b>',
                showHideTransition: 'slide',
                allowToastClose: true,
                stack: 3,
                position: 'bottom-center',
                bgColor: '#0069D9',
                textAlign: 'center',
            });
        }
    });
}

// });