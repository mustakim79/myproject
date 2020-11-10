 <?php
    if (isset($_SESSION['msg']) && count($_POST) == 0 && $_SESSION['login_status'] == "Successfully") {

    ?>
 <script>
$.alert({
    title: 'Log in ',
    content: 'You are successfully log in',
    type: 'green',
    typeAnimated: true,

});
 </script>
 <?php
        unset($_SESSION['msg']);
        unset($_SESSION['login_status']);
    }
    ?>