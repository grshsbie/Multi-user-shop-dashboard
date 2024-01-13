<?php

include_once("../config_admin.php");
if(isset($_REQUEST['name']) and
  isset($_REQUEST['nameen']) and
  isset($_REQUEST['idcat']) and 
  isset($_REQUEST['description']) and
  isset($_REQUEST['sumurise']) and
  isset($_REQUEST['idbrand']) and
  isset($_REQUEST['colors']) and
  isset($_REQUEST['status'])){
  
      $name         = sqi($_REQUEST['name']);
      $nameen       = sqi($_REQUEST['nameen']);
      $idcat        = (int) sqi($_REQUEST['idcat']);
      $description  = sqi($_REQUEST['description']);
      $sumurise     = sqi($_REQUEST['sumurise']);
      $idbrand      = sqi($_REQUEST['idbrand']);
      $colors       = sqi($_REQUEST['colors']);
      $status       = sqi($_REQUEST['status']);
      $iduser       = $idadmin;

      $r = getrecord("tbl_product","name='$name' and nameen='$nameen' and idcat='$idcat'");
      if(count($r) > 0){
          echo "این موارد قبلا ثبت شده اند لطفا موارد دیگری را در نظر بگیرید";
      }
      else{
          $d = addrecord("tbl_product",array(
              "name"=>$name,
              "nameen"=>$nameen,
              "idcat"=>$idcat,
              "description"=>$description,
              "sumurise"=>$sumurise,
              "idbrand"=>$idbrand,
              "colors"=>$colors,
              "status"=>$status,
              "iduser"=>$iduser
            ));

            if($d){
                echo "محصول مورد نظر با موفقیت ثبت شد";
            }
            else{
                echo "خطای سیستمی در ثبت محصول";
            }
      }
  }
  else{
      echo "Error";
  }
?>

