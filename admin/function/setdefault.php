<?php
include_once("../config_admin.php");
if(isset($_REQUEST['idimages'])){
    $idimages = (int)$_REQUEST['idimages'];
    $r = getrecord("tbl_images","idimg='$idimages'");
    if(count($r) >0){
        $idproduct = $r[0]['idinfo'];
        $urlimg = $r[0]['url'];
        updaterecord("tbl_images",array("primary_img"=>0),"idinfo='$idproduct' and tblname='tbl_product'");
        updaterecord("tbl_images",array("primary_img"=>1),"idimg='$idimages'");
        updaterecord("tbl_product",array("pic"=>$urlimg),"idproduct='$idproduct'");
        echo 'ok';
    }
    else{
        echo 'error not img';
    }
}
else{
    echo 'error';
}
?>