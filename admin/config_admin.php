<?php
@session_start();
define("URL", "http://localhost/training_course/admin/" );
define("DB_lOCAL","localhost");
define("DB_NAME","digikala");
define("DB_USER","root");
define("DB_PASS","");


//co 
function db_connect(){
    $link = @mysqli_connect(DB_lOCAL,DB_USER,DB_PASS,DB_NAME) or die(exit('مشکل برات پیش آمد کسگم'));
    if($link){
        return $link;
    }
    else{
        echo "disconnect";
    }
}

function getrecord($tblname , $where = 1) {
    $link = db_connect();
    $tblname = sqi($tblname);
    $query = "SELECT * FROM $tblname  WHERE  $where "; 
    $r = mysqli_query($link,$query);

    if($r){


        $res = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($r)){
            $res[$i]=$row;
            $i++; 
        }
    
        return $res;
    


    }
    else { 
        echo mysqli_error($link);
        return false; 

    }


}

function runsql($query) {
    $link = db_connect();
    $r = mysqli_query($link,$query);

    if($r){


        $res = array();
        $i = 0;
        while($row = mysqli_fetch_assoc($r)){
            $res[$i]=$row;
            $i++; 
        }
    
        return $res;
    


    }
    else { 
        echo mysqli_error($link);
        return false; 

    }


}










function sqi ($value){
    $link = db_connect();
    if(get_magic_quotes_gpc()){
        $value = stripslashes($value); 
    }
    if(function_exists("mysqli_real_escape_string")){
        $value = mysqli_real_escape_string($link , $value);
    }
    else{
        $value = addcslashes($value);
    }
    return $value;
}

function addrecord($tblname,$values=NULL){
    $link    = db_connect();
    $tblname = sqi($tblname);
    if(is_array($values)){
        $key   = array_keys($values);
        $value = array_values($values);
        $i = 0;
        foreach($value as $row){
            $value[$i] = "'".sqi($row)."'";
            $i++;
        }
        $key = implode(',',$key);
        $value = implode(',',$value);
        $query = "INSERT INTO $tblname ($key) VALUES ($value)";
        $r = mysqli_query($link,$query);
        if($r){
            return true;
        }
        else{
            //mysqli_error($link);
            return false;
        }

    }
    else{
        //echo "Error";
        return false;
    }
}
function updaterecord($tblname, $values, $where){
    $link = db_connect();
    $tblname = sqi($tblname);
    if(is_array($values)){
        $key = array_keys($values);
        $value = array_values($values);
        $i = 0;
        foreach($value as $row){ 
            $value[$i] = "`$key[$i]`='".sqi($row)."'";
            $i++;
        }

    $value = implode(',', $value);
    $query = "UPDATE `$tblname` SET $value WHERE $where ";
    $r = mysqli_query($link , $query);
    if($r){
        echo "accepted";
       // return true;
    }
    else{
        return false;
    }
    }else {
        return false;
    }
}

//method for delet 

function delet_record($tblname , $where){
    $link =db_connect(); 
    $tblname = sqi($tblname);   
    $query = "DELETE FROM `$tblname` WHERE $where";
    $r = mysqli_query($link,$query);
    if($r){
        return true;
    }else {
        return false;
    }
}

?>

<?php
if(!isset($login)){
    if(!isset($_SESSION['idadmin'])){
        header('location:'.URL.'admin/login.php');
        exit();
    }
    else{
        $idadmin = $_SESSION['idadmin'];
    }
}
?>