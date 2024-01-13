<?php
include_once("../config_admin.php");
$json = array();
$json['status'] = 'error';

if (isset($_REQUEST['idinfo']) and isset($_REQUEST['tblname'])) {

    $tblname = sqi($_REQUEST['tblname']);
    $idinfo = (int) sqi($_REQUEST['idinfo']);

    if (isset($_FILES['file']) and isset($_FILES['file']['name'])) {

        $file = $_FILES['file'];
        $namefile = $file['name'];
        $ext = strtolower(pathinfo($namefile, PATHINFO_EXTENSION));
        $allowedext = array('---', 'jpg', 'png', 'jpeg');
        $upload = 1;

        if (!array_search($ext, $allowedext)) {
            $json['error'] = 'فرمت فایل مجاز نیست';
            $upload = 0;
        }
        if ($file['size'] > (1024 * 1024)) {
            $json['error'] = 'حجم فایل بیش از حد مجاز می‌باش';
            $upload = 0;
        }
        if ($upload == 1) {
            $target = '../../content/product/' . $namefile;
            $urlimg = 'content/product/' . $namefile;
            if (file_exists($target)) {
                $newname = date('y-n-j-h-i-s') . rand(1024, 999999);
                $target = '../../content/product/' . $newname . "." . $ext;
            }
            move_uploaded_file($file['tmp_name'], $target);
            $primary = 0;
            if ($tblname == 'tbl_product') {
                $r = getrecord("tbl_images", "idinfo='$idinfo' and tblname='tbl_product'");

                if (count($r) == 0) {
                    $primary = 1;
                    updaterecord('tbl_product', array("pic" => $urlimg), "idproduct='$idinfo'");
                }
            }
            addrecord('tbl_images', array(
                "idinfo" => $idinfo,
                "tblname" => $tblname,
                "url" => $urlimg,
                "primary_img" => $primary,
                "iduser" => $idadmin
            )
            );

            $json['status'] = 'ok';
            $json['urlimg'] = $urlimg;

        }

    } else {
        $json['error'] = 'فایلی برای آپلود وجود ندارد';

    }
} else {
    $json['error'] = 'پارامتر فرم ارسال نامعتبر می‌باشد';
}
header("content-Type:application/json; charset=utf-8");
echo json_encode($json, JSON_UNESCAPED_UNICODE);

?>