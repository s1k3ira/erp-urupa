<?
session_start();
require_once("class/Despesa.php");
require_once("class/Caixa.php");
$dia = date("Y-m-d");//Pega data do Servidor
if($_POST[action] == "fecha"){
	list($d, $m, $y) = explode("-",$_POST[fatDia]);
	$cer = "$y-$m-$d";
	
	$cax = new Caixa();
	$cax->setDat($cer);
	$cax->setDin($_POST[dinh]);
	$cax->setChe($_POST[cheq]);
	$cax->setTot($_POST[totad]);
	$cax->cadaCaixa();
	?>
    <script>
    	location.href='caixDia.php';
    </script>
	<?
}

require_once("logaut.php");

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

require_once("class/User.php");
require_once("class/Cupom.php");
require_once("class/classFatura.php");




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

//Buscar a Vista
$dep = new Despesa();
$depV = $dep->desDia($dia);
$totalD = mysql_num_rows($depV);

//Buscar a Caixa
$caixa = new Caixa();
$cai = $caixa->caiDia($dia);
$totalCai = mysql_num_rows($cai);
$caxa = mysql_fetch_array($cai);

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
		location.href='caixDia.php?dia='+dia+'';
	}
	function calcTotal(){
		var dinh = new Number(document.listaCli.dinh.value);
		var cheq = new Number(document.listaCli.cheq.value);
		
		var resc = new Number(dinh+cheq);
		
		
		document.listaCli.totad.value = resc.toFixed(2);
		
	}

</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCli" id="listaCli" method="post">
<input type="hidden" name="action" value="fecha" />
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Caixa dia <input type="text" class="input" id="Dia" lang="1" name="fatDia" size="9" value="<?= $dip?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDia(this.value)"  /></strong></div></td>
      <td width="31%" class="tabsis">Emitido por: <?= $_SESSION[user]?> - <?= $di?> - <?= $hou?></td>
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
	$areQtad = $areQtad + $cupd["CUP_QUAN"];
	$fatTotd = $fatTotd + $cupd["CUP_TOTA"];
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
        <td><?= $cupd["CUP_PLAC"]?></td>
        <td><?= $cupd["CUP_CLIE"]?></td>
        <td><?= $cupd["CUP_MOTO"]?></td>
        <td><?= $cupd["CUP_PRON"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupd["CUP_DATV"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td><? list($d, $m, $y) = explode("-", $cupd["CUP_DATP"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="right">R$ <?= number_format($cupd["CUP_TOTA"], 2, '.', '');?></td>
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
	$areQtav = $areQtav + $cupv["CUP_QUAN"];
	$fatTotv = $fatTotv + $cupv["CUP_TOTA"];
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
        <td><?= $cupv["CUP_PLAC"]?></td>
        <td><?= $cupv["CUP_CLIE"]?></td>
        <td><?= $cupv["CUP_MOTO"]?></td>
        <td><?= $cupv["CUP_PRON"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupv["CUP_DATV"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="right"><?= number_format($cupv["CUP_QUAN"], 2, '.', '');?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cupv["CUP_TOTA"], 2, '.', '');?></td>
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
<br /><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
        <td width="18%"><strong>Tipo</strong></td>
        <td width="25%"><strong>Descrição</strong></td>
        <td width="11%"><strong>Data</strong></td>
        <td width="10%"><strong>Hora</strong></td>
        <td width="16%"><strong>Emitido</strong></td>
        <td width="17%" align="right"><strong>Valor</strong></td>
    </tr>
<? 
for($v = 0; $v<$totalD; $v++) {
	$cupv = mysql_fetch_array($depV);
	$desTotv = $desTotv + $cupv["DES_VALO"];
	$desTotv = number_format($desTotv, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupv["DES_TIPO"]?></td>
        <td><?= $cupv["DES_DESC"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupv["DES_DATA"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td><?= $cupv["DES_HORA"]?></td>
        <td><?= $cupv["DES_USER"]?></td>
        <td align="right">R$ <?= number_format($cupv["DES_VALO"], 2, '.', '');?></td>
       
    </tr>
<?
}
?>
<tr class="tabsis">
        <td colspan="5" align="right"><strong>Total </strong></td>
        <td width="17%" align="right"><strong>R$ <?= number_format($desTotv, 2, '.', '');?></strong></td>
        
    </tr>
</table>
<br /><br />
<table>
	<tr>
    	<td>Total em Dinheiro:</td>
        <td>R$ <input type="text" class="input" lang="1" name="dinh" id="dinh" onChange="calcTotal();" size="9" value="<?= $caxa["CAIX_DINH"]?>" /></td>
    </tr>
    <tr>
    	<td>Total em Cheque:</td>
        <td>R$ <input type="text" class="input" lang="1" name="cheq" id="cheq" onChange="calcTotal();" size="9" value="<?= $caxa["CAIX_CHEQ"]?>" /></td>
    </tr>
    <tr>
    	<td><strong>Total:</strong></td>
        <td><strong>R$</strong> <input type="text" class="input" lang="1" name="totad" id="totad" size="9" value="<?= $caxa["CAIX_TOTA"]?>" /></td>
    </tr>
</table>
<br /><br />
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="4%" align="center"><strong>Entrada</strong></td>
        <td width="6%" align="center"><strong>Saida</strong></td>
        <td width="6%" align="center"><strong></strong></td>
        <td width="6%" align="center"><strong>Caixa</strong></td>
</tr>
<?
$caix = $fatTot - $desTotv;
?>
<tr class="tabsis">
        <td align="center">R$ <?= number_format($fatTot, 2, '.', '');?></td>
        <td align="center">R$ <?= number_format($desTotv, 2, '.', '');?></td>
        <td align="center"></td>
        <td align="center"><strong>R$ <?= number_format($caix, 2, '.', '');?></strong></td>
    </tr>
</table>
<br /><br />
<?
if($totalCai == 0){
?>
<div style="float:right"><input type="submit" class="botao" value=" FECHAR CAIXA" align="right" /></div>
<?
}
?>
</form>
</body>
</html>