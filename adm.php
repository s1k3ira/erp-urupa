<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Urupa Mineracao  -  Intranet</title>
<link rel="stylesheet" type="text/css" href="menu/sources/skins/dhtmlxmenu_clear_silver.css" />

<script src="menu/sources/dhtmlxcommon.js"></script>
<script src="menu/sources/dhtmlxmenu.js"></script>
<script>
var menu;
function initMenu() {
	menu = new dhtmlXMenuObject("menuObj","clear_silver");
	menu.setImagePath("menu/sources/imgs/");
	menu.setIconsPath("menu/sources/images/");
	menu.loadXML("menu/admMenu.xml");
	menu.attachEvent("onClick", function(id, zoneId, casState){
		document.getElementsByName("corpo")[0].contentWindow.location.href=id;
	});
}


</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body onLoad="initMenu();">

<div align="center" id="Topo">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="31" bgcolor="#000000">
   	  <td width="722" align="left">Painel Administrativo</td>
      <td width="168" align="right"><?= $_SESSION[user]?></td>
      <td width="63" align="right"><a href="login.php">Logout</a></td>
      <td width="29" align="right"><img src="pictures/buttonDesc.gif" border="0" align="right" /></td>
  </tr>
</table>
</div>

<div id="subMenu">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr>
   	  <td width="827" align="left"> 
	  	<div id="menuObj"></div>
      </td>
  </tr>
</table>
</div>

<div id="conteudo" align="center">
<br />
<iframe id="iframe" name="corpo" width="984" height="600" src="blank.php" scrolling="auto" frameborder="0"></iframe>
</div>

<div align="center" id="Rodape">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="35" bgcolor="#464646">
   	  <td align="left">Copyright 2012 - 4sys - Todos os direitos reservados</td>
      <td align="right">+55 11 2626-8128</td>
  </tr>
</table>
</div>

</body>
</html>
