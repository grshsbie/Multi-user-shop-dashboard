
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= $title?></title>
<link rel="stylesheet" type="text/css" href="font/font.css">
<link rel="stylesheet" type="text/css" href="css/btn.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="font/font-awesome/font-awesome.css">
<script src="js/jquery.min.js"></script>
</head>
<body dir="rtl">
<div id="backgroundpopup">
    <div class="popup">
         <div class="close" onclick="hideall()">x</div>
         <div class="title">title</div>
         <div class="body">body</div>
    </div>
</div>
<?php
include_once("include/menu.php");
?>
	<Div id="main">
    	<Div id="head">
        <?php
            $r = getrecord("tbl_admin","id='$idadmin'");
            $nameadmin = $r[0]['name'].' '.$r[0]['family'];
        ?>
			<div class='nameuser'> <i class='icon-user'></i> <?=$nameadmin?></div>
			<a href='signout.php?action=signout' title='خروج از حساب کاربری'>
                 <div class='signout'> <i class='icon-power-off'></i> 
            </div> </a>
			
        </Div>

<script>
      function showpopup(titlehtml,bodyhtml){
          $('#backgroundpopup .popup .title').html(titlehtml);
          $('#backgroundpopup .popup .body').html(bodyhtml);
          $("#backgroundpopup").show();
      }

      function hideall(){
          $('#backgroundpopup').hide();
      }
</script>