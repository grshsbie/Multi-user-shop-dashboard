<?php
include_once("../config_admin.php");
if(isset($_REQUEST['idproduct']) and
isset($_REQUEST['idcolor']) and 
isset($_REQUEST['garanti']) and
isset($_REQUEST['price_sale']) and 
isset($_REQUEST['price_buy']) and 
isset($_REQUEST['tedad']) and
isset($_REQUEST['date_offer']) and 
isset($_REQUEST['price_offer'])){
    $idproduct = (int) sqi($_REQUEST['idproduct']);
    $idcolor = (int)sqi($_REQUEST['idcolor']);
    $garanti   = sqi($_REQUEST['garanti']);
    $price_sale =(int) sqi($_REQUEST['price_sale']);
    $price_buy = (int) sqi($_REQUEST['price_buy']);
    $tedad = (int) sqi($_REQUEST['tedad']);
    $date_offer = sqi($_REQUEST['date_offer']);
    $price_offer =(int) sqi($_REQUEST['price_offer']);
    if($price_sale < $price_buy){
        exit('قیمت فروش کمتر از قیمت خرید است');
    }
    $add = addrecord("tbl_store",
         array(
             "idproduct"=>$idproduct,
             "idcolor"=>$idcolor,
             "garanti"=>$garanti,
             "price_sale"=>$price_sale,
             "price_buy"=>$price_buy,
             "tedad"=>$tedad,
             "price_offer"=>$price_offer,
             "date_offer"=>$date_offer)
         );
        

    if($add){
        echo 'ok';
    }
    else{
        echo 'خطا در ثبت اطلاعات به وجود آمده است';
    }
}
else{
    echo 'خطا در پارامترهای ارسالی';
}

?>