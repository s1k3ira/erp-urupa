<?
require_once("logaut.php");
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

require_once("class/classUser.php");
require_once("class/classCupom.php");
require_once("class/classFatura.php");

//Pega na Session do Usuario
$use = new User();
$use->getSession();
$usua = $use->getNome();

//Buscar a Vista
$cuv = new Faturamento();
$cpoV = $cuv->fatDiav($dia);
$totalv = mysql_num_rows($cpoV);

//Buscar a Prazo
$cup = new Faturamento();
$cpoP = $cup->fatDiap($dia);
$totalp = mysql_num_rows($cpoP);

//Buscar a Baixa
$cud = new Faturamento();
$cpoD = $cud->fatDiad($dia);
$totald = mysql_num_rows($cpoD);
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
		location.href='fatDia.php?dia='+dia+'';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCli" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Faturamento dia <input type="text" class="input" id="Dia" lang="1" name="fatDia" size="9" value="<?= $dip?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDia(this.value)"  /></strong></div></td>
      <td width="31%" class="tabsis">Emitido por: <?= $usua?> - <?= $di?> - <?= $hou?></td>
      <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="4%"><strong>NC</strong></td>
        <td width="6%"><strong>Placa</strong></td>
        <td width="27%"><strong>Cliente</strong></td>
        <td width="22%"><strong>Motorista</strong></td>
        <td width="12%"><strong>Produto</strong></td>
        <td width="11%"><strong>Vencimento</strong></td>
        <td width="7%"><strong>Pagamento</strong></td>
      <td width="11%" align="right"><strong>Valor</strong></td>
  </tr>
<? 
for($f = 0; $f<$totald; $f++) {
	$cupd = mysql_fetch_array($cpoD);
	$areQtad = $areQtad + $cupd["QUANT"];
	$fatTotd = $fatTotd + $cupd["TOTAL"];
	$areQtad = number_format($areQtad, 2, '.', '');
	$fatTotd = number_format($fatTotd, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupd["ID"]?></td>
        <td><?= $cupd["PLACA"]?></td>
        <td><?= $cupd["CLIENT"]?></td>
        <td><?= $cupd["MOTOR"]?></td>
        <td><?= $cupd["PRODU"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupd["DAVEN"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td><? list($d, $m, $y) = explode("-", $cupd["DAPAM"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="right">R$ <?= number_format($cupd["TOTAL"], 2, '.', '');?></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="4%">&nbsp;</td>
        <td width="5%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="13%" align="right">&nbsp;</td>
        <td width="10%" align="right"><strong>TOTAL BAIXADO</strong></td>
        <td width="11%" align="right"><strong>R$ <?= number_format($fatTotd, 2, '.', '');?></strong></td>
  </tr>
 


</table>
<br /></br>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="4%"><strong>NC</strong></td>
        <td width="6%"><strong>Placa</strong></td>
        <td width="27%"><strong>Cliente</strong></td>
        <td width="22%"><strong>Motorista</strong></td>
        <td width="17%"><strong>Produto</strong></td>
        <td width="8%"><strong>Pagamento</strong></td>
        <td width="6%" align="right"><strong>Quant</strong></td>
        <td width="10%" align="right"><strong>Valor</strong></td>
  </tr>
<? 
for($v = 0; $v<$totalv; $v++) {
	$cupv = mysql_fetch_array($cpoV);
	$areQtav = $areQtav + $cupv["QUANT"];
	$fatTotv = $fatTotv + $cupv["TOTAL"];
	$areQtav = number_format($areQtav, 2, '.', '');
	$fatTotv = number_format($fatTotv, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupv["ID"]?></td>
        <td><?= $cupv["PLACA"]?></td>
        <td><?= $cupv["CLIENT"]?></td>
        <td><?= $cupv["MOTOR"]?></td>
        <td><?= $cupv["PRODU"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupv["DAVEN"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="right"><?= number_format($cupv["QUANT"], 2, '.', '');?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cupv["TOTAL"], 2, '.', '');?></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="4%">&nbsp;</td>
        <td width="5%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="14%" align="right"><strong>TOTAL A VISTA</strong></td>
        <td width="10%" align="right"><strong><?= number_format($areQtav, 2, '.', '');?> m<sup>3</sup></strong></td>
        <td width="10%" align="right"><strong>R$ <?= number_format($fatTotv, 2, '.', '');?></strong></td>
  </tr>
 


</table>
<br /><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="4%"><strong>NC</strong></td>
        <td width="6%"><strong>Placa</strong></td>
        <td width="27%"><strong>Cliente</strong></td>
        <td width="22%"><strong>Motorista</strong></td>
        <td width="17%"><strong>Produto</strong></td>
        <td width="8%"><strong>Pagamento</strong></td>
        <td width="6%" align="right"><strong>Quant</strong></td>
        <td width="10%" align="right"><strong>Valor</strong></td>
  </tr>
<? 
for($p = 0; $p<$totalp; $p++) {
	$cupp = mysql_fetch_array($cpoP);
	$areQtap = $areQtap + $cupp["QUANT"];
	$fatTotp = $fatTotp + $cupp["TOTAL"];
	$areQtap = number_format($areQtap, 2, '.', '');
	$fatTotp = number_format($fatTotp, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupp["ID"]?></td>
        <td><?= $cupp["PLACA"]?></td>
        <td><?= $cupp["CLIENT"]?></td>
        <td><?= $cupp["MOTOR"]?></td>
        <td><?= $cupp["PRODU"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupp["DAVEN"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="right"><?= number_format($cupp["QUANT"], 2, '.', '');?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cupp["TOTAL"], 2, '.', '');?></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
  <tr class="tabsis">
        <td width="4%">&nbsp;</td>
        <td width="5%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="14%" align="right"><strong>TOTAL A PRAZO</strong></td>
        <td width="10%" align="right"><strong><?= number_format($areQtap, 2, '.', '');?> m<sup>3</sup></strong></td>
        <td width="10%" align="right"><strong>R$ <?= number_format($fatTotp, 2, '.', '');?></strong></td>
  </tr>
</table>
<br /><br />
<?
$areQta = $areQtav + $areQtap;
$fatTot = $fatTotv + $fatTotd;
?>
<table width="100%" cellspacing="0">
 <tr class="tabsis">
        <td width="4%">&nbsp;</td>
        <td width="5%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="19%"></td>
        <td width="14%" align="right"><strong>TOTAL DIA</strong></td>
        <td width="10%" align="right"><strong><?= number_format($areQta, 2, '.', '');?> m<sup>3</sup></strong></td>
        <td width="10%" align="right"><strong>R$ <?= number_format($fatTot, 2, '.', '');?></strong></td>
  </tr>
</table>
</form>
</body>
</html>