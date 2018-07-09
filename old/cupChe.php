<?
require_once("logaut.php");
require_once("class/classUser.php");
require_once("class/classCupom.php");
require_once("class/classCliente.php");

$data = date("Y-m-d");

//Deletar Cupom no Banco
if($_GET[action] == "cancelar"){
	$can = new Cupom();
	$cliz = $can->canCupom($_GET[id]);
}

//Pagar Cupom
if($_GET[action] == "pagar"){
	$can = new Cupom();
	$can->setDapam($data);
	$cliz = $can->pagCupom($_GET[id]);
}

$dia = date("d-m-Y");//Pega data do Servidor
$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";



if($dati == ""){
	$dati = "2009-$m-01";
	$datf = "2009-$m-31";
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
$cl = new Cliente();
$res = $cl->clienteCons($_GET["cid"]);
$tot = mysql_num_rows($res);
$cliente = mysql_fetch_array($res);

//Pega Cupons no Banco
    $sit = $_GET["sit"];
	$cli = new Cupom();
	$resul = $cli->cupRel($dati, $datf, $_GET["cid"], $sit);
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
		location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>';
	}
	function canCupom(nc){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		if(confirm('Deseja cancelar o cupom de numero: '+nc+'')){
			location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>&action=cancelar&id='+nc+'';
		}
	}
	function pagCupo(nc){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		if(confirm('Confirma o pagamento do cupom: '+nc+'')){
			location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>&action=pagar&id='+nc+'';
		}
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCupa" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="18%" height="25" class="tabsis"><strong>CNPJ / CPF: </strong><?= $cliente["CNPJ"]?><?= $cliente["CPF"]?></td>
      <td width="31%" class="tabsis"><strong>Cliente:</strong> <?= $cliente["NOME"]?></div></td>
      <td width="21%" class="tabsis"><strong>De: <input type="text" class="input" onchange="listarDias();" id="Diai" lang="1" name="cupDe" size="9" value="<?= $_GET[dati]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')"  /> Ate: <input type="text" class="input" id="Diaf" lang="1" name="cupAt" size="9" value="<?= $_GET[datf]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDias();"  /></strong></div></td>
      <td width="28%" class="tabsis">Emitido por: <?= $usua?> - <?= $dip?> - <?= $hou?></td>
       <td width="2%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="4%"><strong>NC()</strong></td>
        <td width="9%"><strong>Emissao</strong></td>
        <td width="11%"><strong>Emitido por:</strong></td>
        <td width="8%" align="left"><strong>Vencimento</strong></td>
        <td width="7%" align="left"><strong>Placa</strong></td>
        <td width="22%" align="left"><strong>Motorista</strong></td>
        <td width="13%" align="left"><strong>Produto</strong></td>
        <td width="10%" align="right"><strong>Quant</strong></td>
        <td width="10%" align="right"><strong>Total</strong></td>
<? 
switch ($_GET[sit]){
	case 1:
	?>
 	<td width="6%" align="center"><strong>Acoes</strong></td>
	<?
	break;
	case 2:
	?>
	<td width="6%" align="center"><strong>Cancelar</strong></td>
	<?
	break;
}
?>
  </tr>
<?

for($i; $i<$total; $i++) {
	$cli = mysql_fetch_array($resul);
	$ren = ($cli["TOTOTAL"] / 100) * 7;
	
	$totAre = $totAre + $cli["QUANT"];
	$totDes = $totDes + $cli["TOTAL"];
	if($cor =="#FFFFFF"){
		
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cli["ID"]?></td>
        <td><?= $cli["DAEMI"]?></td>
        <td><?= $cli["USER"]?></td>
        <td align="left"><?= $cli["DAVEN"]?></td>
        <td align="left"><?= $cli["PLACA"]?></td>
        <td align="left"><?= $cli["MOTOR"]?></td>
        <td align="left"><?= $cli["PRODU"]?></td>
        <td align="right"><?= $cli["QUANT"]?> m<sup>3</sup></td>
        <td align="right">R$ <?= $cli["TOTAL"]?></td>
<? 
switch ($_GET[sit]){
	case 1:
		?>
        <td align="center"><a href="#" onclick="pagCupo(<?= $cli["ID"]?>);"><img src="pictures/b_select.png" border="0" /></a> <a href="#" onclick="canCupom(<?= $cli["ID"]?>);"><img src="pictures/b_drop.png" border="0" /></a></td>
		<?
	break;
	case 2:
		?>      
        <td align="center"><a href="#" onclick="canCupom(<?= $cli["ID"]?>);"><img src="pictures/b_drop.png" border="0" /></a></td>
		<?
	break;
}
?>
</tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="9%"><strong>Total</strong></td>
        <td width="8%"></td>
        <td width="8%"></td>
        <td width="8%" align="right">&nbsp;</td>
        <td width="6%" align="right">&nbsp;</td>
        <td width="19%" align="right">&nbsp;</td>
        <td width="9%" align="right">&nbsp;</td>
        <td width="17%" align="right"><strong><?= number_format($totAre, 2, '.', '')?> m<sup>3</sup></strong></td>
        <td width="10%" align="right"><strong>R$ <?= number_format($totDes, 2, '.', '')?></strong></td>
        <td width="6%" align="right">&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>