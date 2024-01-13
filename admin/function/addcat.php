<?php

include_once('../config_admin.php');
if (isset($_REQUEST['name']) and isset($_REQUEST['nameen']) and isset($_REQUEST['subid'])) {
    $name = sqi($_REQUEST['name']);
    $nameen = sqi($_REQUEST['nameen']);
    $subid = (int) sqi($_REQUEST['subid']);

    $r = getrecord("tbl_cat", "name='$name' and nameen='$nameen' and subid='$subid'");
    if (count($r) > 0) {
        echo "نام دسته قبلا ثبت شده است";
    } else {
        $msg = addrecord("tbl_cat", array("name" => $name, "nameen" => $nameen, "subid" => $subid));
        if ($msg) {
            echo "دسته مورد نظر با موفقیت ثبت شد";
        } else {
            echo "مشکلی در ثبت دسته جدید پیش آمده است";
        }
    }

} else {
    echo "خطای سیستمی";
}