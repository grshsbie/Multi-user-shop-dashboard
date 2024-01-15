<?php
include_once("../config_admin.php");
if (isset($_REQUEST['idproduct'])) {
    $idproduct = (int) $_REQUEST['idproduct'];
    $r = getrecord('tbl_product', "idproduct='$idproduct'");
    if (count($r) > 0) {
        $description = $r[0]['description'];
    } else {
        echo 'متاسفانه چنین محصولی وجود ندارد یا حذف شده است';
    }
} else {
    echo 'خطا در پارامتر های ارسالی';
}

?>

<textarea name="" id="des_product" cols="30" rows="10">
    <?= $description ?>
</textarea>
<div class="btn btn-success btn-block" onclick='savereview(<?= $idproduct ?>)'>ثبت نقد و بررسی</div>

<script>
    function savereview(idproduct) {
        var description = $('#des_product').val();
        $.ajax({
            url: 'function/updatereview.php',
            data: 'idproduct=' + idproduct +'&description='+ description,
            type:"POST",
            success:function(data) {
                alert(data);
            }
        });

    }
</script>