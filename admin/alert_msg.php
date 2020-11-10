<?php
if (isset($_SESSION['msg']) && count($_POST) == 0) {

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
}
?>