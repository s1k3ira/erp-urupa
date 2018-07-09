<?
session_start();
require_once("logaut.php");
require_once("class/Despesa.php");

$dia = date("Y-m-d");//Pega data do Servidor
$di = date("d-m-Y");
$hou = date("G:i:s");

if($_GET[dia] == ""){
	$dia = date("Y-m-d");//Pega data do Servidor	
}else{
	list($d, $m, $y) = explode("-",$_GET[dia]);
	$dia = "$y-$m-$d";
}

list($d, $m, $y) = explode("-",$dia);
	$dip = "$y-$m-$d";





//Buscar a Vista
$cuv = new Despesa();
$cpoV = $cuv->despDia($dia);
$totalv = mysql_num_rows($cpoV);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script src="js/formValid.js"></script>
<script>
	function listarDia(dia){
		location.href='despDia.php?dia='+dia+'';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCli" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Despesa dia <input type="text" class="input" id="Dia" lang="1" name="fatDia" size="9" value="<?= $dip?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDia(this.value)"  /></strong></div></td>
      <td width="31%" class="tabsis">Emitido por: 
        <?= $_SESSION[user]?>
-
<?= $di?> - <?= $hou?></td>
      <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>

</form>
<br /><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
        <td width="77%"><strong>Tipo</strong></td>
        <td width="23%" align="right"><strong>Valor</strong></td>
    </tr>
<? 
for($v = 0; $v<$totalv; $v++) {
	$cupv = mysql_fetch_array($cpoV);
	$fatTotv = $fatTotv + $cupv["QTD"];
	$fatTotv = number_format($fatTotv, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupv["DES_TIPO"]?></td>
        <td align="right">R$ <?= number_format($cupv["QTD"], 2, '.', '');?></td>
    </tr>
<?
}
?>
<tr class="tabsis">
        <td colspan="1" align="right"><strong>Total </strong></td>
        <td width="23%" align="right"><strong>R$ <?= number_format($fatTotv, 2, '.', '');?></strong></td>
    </tr>
</table>
</body>
</html>