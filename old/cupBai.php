<?
$dia = date("d-m-Y");//Pega data do Servidor
$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";

require_once("class/classUser.php");
require_once("class/classCupom.php");
require_once("class/classFatura.php");

if($dati == ""){
	$dati = "2009-$m-01";
	$datf = "2009-$m-31";
	$_GET[dati] = "01-$m-2009";
	$_GET[datf] = "31-$m-2009";
}else{
	list($d, $m, $y) = explode("-",$_GET[dati]);
	$dati = "$y-$m-$d";
	list($d, $m, $y) = explode("-",$_GET[datf]);
	$datf = "$y-$m-$d";
}

//Pega na Session o Usuario
$use = new User();
$use->getSession();
$usua = $use->getNome();

//Pega Cliente no Banco
	$scon = 4;
	$cli = new Cupom();
	$resul = $cli->cupCons($dati, $datf, $scon);
	$total = mysql_num_rows($resul);
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
	function listarDias(){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		location.href='cupBai.php?dati='+diai+'&datf='+diaf+'&sit=2';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCupa" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>De: <input type="text" class="input" onchange="listarDias();" id="Diai" lang="1" name="cupDe" size="9" value="<?= $_GET[dati]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')"  /> Ate: <input type="text" class="input" id="Diaf" lang="1" name="cupAt" size="9" value="<?= $_GET[datf]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDias();"  /></strong></div></td>
      <td width="31%" class="tabsis">Emitido por: <?= $usua?> - <?= $dip?> - <?= $hou?></td>
       <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="14%"><strong>CNPJ/CPF</strong></td>
        <td width="27%"><strong>Nome</strong></td>
        <td width="10%" align="right"><strong>Quantidade</strong></td>
        <td width="15%" align="right"><strong>Desconto</strong></td>
        <td width="17%" align="right"><strong>Arendamento</strong></td>
        <td width="14%" align="right"><strong>Total</strong></td>
        <td width="3%" align="right">&nbsp;</td>
  </tr>
<? 
for($i; $i<$total; $i++) {
	$cli = mysql_fetch_array($resul);
	$ren = ($cli["TOTOTAL"] / 100) * 7;
	
	$totAre = $totAre + $cli["TOQUANT"];
	$totMes = $totMes + $cli["TOTOTAL"];
	$totDes = $totDes + $cli["TODESC"];
	$totRen = $totRen + $ren;
	if($cor =="#FFFFFF"){
		
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cli["CNPJ"]?><?= $cli["CPF"]?></td>
        <td><?= $cli["NOME"]?></td>
        <td align="right"><?= number_format($cli["TOQUANT"], 2, '.', '')?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cli["TODESC"], 2, '.', '')?></td>
        <td align="right">R$ <?= number_format($ren, 2, '.', '')?> </td>
        <td align="right"><strong>R$ <?= number_format($cli["TOTOTAL"], 2, '.', '')?></strong></td>
        <td align="center"><a href="cupChe.php?cid=<?= $cli["CID"]?>&dati=<?= $_GET[dati]?>&datf=<?= $_GET[datf]?>&sit=4"><img src="pictures/b_search.png" border="0" /></a></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="14%" height="18"><strong>Total</strong></td>
      <td width="27%"></td>
        <td width="10%" align="right"><strong><?= number_format($totAre, 2, '.', '')?> m<sup>3</sup></strong></td>
        <td width="15%" align="right"><strong>R$ <?= number_format($totDes, 2, '.', '')?></strong></td>
        <td width="17%" align="right"><strong>R$ <?= number_format($totRen, 2, '.', '')?></strong></td>
        <td width="14%" align="right"><strong>R$ <?= number_format($totMes, 2, '.', '')?></strong></td>
        <td width="3%" align="right"></td>
  </tr>
</table>
</form>
</body>
</html>