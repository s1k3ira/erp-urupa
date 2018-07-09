<?
//Destroi Todas as Sesseion
session_start();
session_destroy();

include("class/User.php"); // Add Classe User

if($_POST["action"] == "autentc"){ // Faz o login do sistema
	$user = new User();
	$user->setLogin($_POST["admLog"]);
	$user->setPassw($_POST["admPas"]);
	$user->checarUser();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/styleLogin.css" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>
<title>:: 4SYS :: - Urupa Mineracao</title>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>


</head>

<body>

<div id="Site">
	<form action="<?= $PHP_SELF?>" name="form" id="form" method="post">
	<div id="Login">
    	
            <input type="hidden" name="action" value="autentc" />
            
            <input type="text" name="admLog" size="28" class="usuario" />
            
            <input type="password" name="admPas" size="28" class="password" />
         
    
    	<div id="BotaoLogar"><input type="submit" value="OK" /></div>
	</form>	
    </div>
</div>
<div id="Rodape"><img src="images/rodape.png" /></div>




</body>
</html>
