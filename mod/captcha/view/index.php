<?php
//session_start();
//echo $_SESSION['CAPTCHA'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
</head>
<body>
<script>

function ujcpt(){
	var i=Math.floor((Math.random() * 100000) + 1); 
	$('#captcha_image').attr('src','image.php?kk='+i);
}

</script>
<div class="captchadiv">
<img width="150" height="40" id="captcha_image" src="image.php" >
<img onclick="ujcpt() ;" width="35" height="35" src="images/refresh2.png">
 <div class="form-group">
            <input type="password" class="form-control" name="password2" placeholder="Jelszó mégegyszer" data="password2" required="required" >
 </div> </div>
</body>
</html>

