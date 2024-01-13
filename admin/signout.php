<?php

include_once("config_admin.php");
if(isset($_REQUEST['action'])){
     $action = $_REQUEST['action'];
     if($action == "signout"){
          session_destroy();
          header('location:'.URL.'admin/login.php');
          exit();
     }
}