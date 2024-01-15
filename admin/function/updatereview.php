<?php
include_once("../config_admin.php");
if (isset($_REQUEST['idproduct']) and isset($_REQUEST['description'])) {
    $idproduct = (int) $_REQUEST['idproduct'];
    $description = $_REQUEST['description'];
    updaterecord("tbl_product", array("description" => $description), "idproduct='$idproduct'");
    echo 'بروز رسانی با موفقیت انجام شد';
} else {
    echo 'خطا در پارامترهای ارسالی';
}
?>