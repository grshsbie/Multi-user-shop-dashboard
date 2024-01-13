
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login - DijiKala</title>
<link rel="stylesheet" type="text/css" href="css/btn.css">
<link rel="stylesheet" type="text/css" href="font/font.css">
<link rel="stylesheet" type="text/css" href="css/admin.css">
<script src="js/jquery.min.js"></script>
</head>

<body>

	<div id="login">
    	<Div class="head">ورود به سامانه</Div>
        <div class="body">
        	<div class="error">
            	
            </div>
        	<Div class="wait">
            	<div class="spin"></div>
                <div class="wait-text">در حال بررسی</div>
            </Div>
        	<div class="row">
            	<Div class="name">نام کاربری</Div>
                <Div class="input"><input type="text" id="username" placeholder="نام کاربری.."></Div>
            </div>
            <div class="row">
            	<Div class="name">رمز عبور</Div>
                <Div class="input"><input type="password" id="password" placeholder="رمز عبور .."></Div>
            </div>
            <div class="row">
            	<Div class="btn btn-block btn-default" id="chklogin">وورد</Div>
            </div>
        </div>
    </div>
    <script>
		$('#chklogin').click(function(){
			$('#login .body .row').hide();
			$('#login .body .wait').show();
			var u=$('#username').val();
			var p=$('#password').val();
			var gr = 'ok';
			if(u!='' && p!=''){
				$.ajax({
					url:'function/login.php',
					type:'POST',
					data:'username='+u+'&password='+p,
					success:function(data){
						if(data == true){
							window.parent.location ='index.php';
						}
						else{
							showerror(data);
						}
					}
				});
			}
			else{
				showerror('رمز عبور یا نام کاربری پر نشده است');
				
			}
		});
		function showerror(str){
			$('#login .body .row').show();
			$('#login .body .wait').hide();
			$('#login .body .error').show();
			$('#login .body .error').html(str);
			setTimeout(function(){
				$('#login .body .error').hide();
			},5000);	
		}
	</script>
</body>
</html>

