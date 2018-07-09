<?
require_once("class/classUser.php");

//Pega na Session o Usuario
$use = new User();
$use->getSession();
$usua = $use->getNome();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Urupa  -  Intranet</title>
<script language="JavaScript">
<!--
function resize_iframe()
{
	var hei = document.body.clientHeight - 97;
	//retorna a altura
	//resize the iframe according to the size of the
	//window (all these should be on the same line)
	parent.document.getElementById("iframe").height= +hei+;
	parent.document.getElementById("iframe").width = document.body.clientWidth;;
}

window.onresize=resize_iframe; 
</script>

<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body onload="resize_iframe()">

<div align="center" id="Topo">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="31" bgcolor="#000000">
   	  <td width="916" align="left">Painel Administrativo</td>
      <td width="38" align="right"><a href="login.php">Logout</a></td>
      <td width="28" align="right"><img src="pictures/buttonDesc.gif" border="0" align="right" /></td>
  </tr>
</table>
</div>

<div id="subMenu">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="31" bgcolor="#efebe2">
   	  <td align="left"> 
				<? include "admMenu.php"?>
      </td>
       <td align="right"><?= $usua?></td>
  </tr>
</table>
</div>

<div id="conteudo" align="center">
<br />
<iframe id="iframe" name="corpo" width="984" height="500" src="blank.php" scrolling="auto" frameborder="0"></iframe>
</div>

<div align="center" id="Rodape">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="35" bgcolor="#464646">
   	  <td align="left">Copyright 2009 - 4sys - Todos os direitos reservados</td>
      <td align="right">+55 11 4794-8473</td>
  </tr>
</table>
</div>

</body>
</html>
