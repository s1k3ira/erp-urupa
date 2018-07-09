<?
require_once("logaut.php");
require_once("class/Cupom.php");
require_once("class/Cliente.php");

$data = date("Y-m-d");

//Deletar Cupom no Banco
if($_GET[action] == "cancelar"){
	$can = new Cupom();
	$cliz = $can->canCupom($_GET[id]);
}

//Pagar Cupom
if($_POST[action] == "pagar"){
	$can = new Cupom();
	$can->setdatp($data);
	$cliz = $can->pagCupom($_POST[cupom]);
}

$dia = date("d-m-Y");//Pega data do Servidor
$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";



if($_GET[dati] == ""){
	$dati = "$y-$m-01";
	$datf = "$y-$m-31";
}else{
	list($d, $m, $y) = explode("-",$_GET[dati]);
	$dati = "$y-$m-$d";
	list($d, $m, $y) = explode("-",$_GET[datf]);
	$datf = "$y-$m-$d";
}


//Pega Cliente no Banco
$cl = new Cliente();
$res = $cl->clienteCons($_GET["cid"]);
$tot = mysql_num_rows($res);
$cliente = mysql_fetch_array($res);

//Pega Cupons no Banco
    $sit = $_GET["sit"];
	$cli = new Cupom();
	if($_GET[tip] == 'v'){
		$resul = $cli->cupRel2($dati, $datf, $_GET["cid"], $sit);
	}else{
		$resul = $cli->cupRel($dati, $datf, $_GET["cid"], $sit);
	}
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
	$(document).ready(function() {
		function countChecked() {
			  var n = $("input:checked").length;
			  $("#tnc").text(n);
			}
			countChecked();
			sumChecked();
		
		$('#pag').click(function() {
	  	  $('#listaCupa').submit();
        });
			
		function sumChecked() {
			var result = $("input:checked");
			var i=0;
			var total = 0;
			var total2 = 0;
			for (i=0;i<result.length;i++){
				
				total = total+Number(result[i].lang);
				total2 = total2+Number(result[i].alt);
			}
			$("#qta").text(total.toFixed(2));
			$("#tot").text(total2.toFixed(2));
		}


			
			$(":checkbox").click(function(){
				countChecked();
				sumChecked();
				
			});
	}); 
	

	function listarDias(){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>&tip=<?= $_GET[tip]?>';
	}
	function canCupom(nc){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		if(confirm('Deseja cancelar o cupom de numero: '+nc+'')){
			location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>&tip=<?= $_GET[tip]?>&action=cancelar&id='+nc+'';
		}
	}
	function pagCupo(nc){
		var diai = document.listaCupa.cupDe.value;
		var diaf = document.listaCupa.cupAt.value;
		if(confirm('Confirma o pagamento dos cupoms selecionados ?')){
			location.href='cupChe.php?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>&tip=<?= $_GET[tip]?>&action=pagar&id='+nc+'';
		}
	}
	
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>?cid=<?= $_GET["cid"]?>&dati='+diai+'&datf='+diaf+'&sit=<?= $_GET[sit]?>" name="listaCupa" id="listaCupa" method="post">
<input type="hidden" name="action" value="pagar" />
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="18%" height="25" class="tabsis"><strong>CNPJ / CPF: </strong><?= $cliente["CLI_CNPJ"]?><?= $cliente["CLI_CPF"]?></td>
      <td width="31%" class="tabsis"><strong>Cliente:</strong> <?= $cliente["CLI_NOME"]?></div></td>
      <td width="21%" class="tabsis"><strong>De: <input type="text" class="input" onchange="listarDias();" id="Diai" lang="1" name="cupDe" size="9" value="<?= $_GET[dati]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')"  /> Ate: <input type="text" class="input" id="Diaf" lang="1" name="cupAt" size="9" value="<?= $_GET[datf]?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onchange="listarDias();"  /></strong></div></td>
      <td width="28%" class="tabsis">Emitido por: <?= $_SESSION[user]?> - <?= $dip?> - <?= $hou?></td>
       <td width="2%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="3%">&nbsp;<strong>NC</strong></td>
        <td width="7%"><strong>(<?= $total?>)</strong></td>
        <td width="10%"><strong>Emissao</strong></td>
        <td width="9%" align="left"><strong>Vencimento</strong></td>
        <td width="8%" align="left"><strong>Placa</strong></td>
        <td width="24%" align="left"><strong>Motorista</strong></td>
        <td width="15%" align="left"><strong>Produto</strong></td>
        <td width="6%" align="right"><strong>Quant</strong></td>
        <td width="11%" align="right"><strong>Total</strong></td>
	    <td width="7%" align="center"><strong>Ações</strong></td>	
  </tr>
<?

for($i; $i<$total; $i++) {
	$cli = mysql_fetch_array($resul);
	$ren = ($cli["TOTOTAL"] / 100) * 7;
	
	$totAre = $totAre + $cli["CUP_QUAN"];
	$totDes = $totDes + $cli["CUP_TOTA"];
	if($cor =="#FFFFFF"){
		
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td>&nbsp;<? if($sit == 1){?><input type="checkbox" id="ck" name="cupom[]" value="<?= $cli["ID"]?>" lang="<?= $cli["CUP_QUAN"]?>" alt="<?= $cli["CUP_TOTA"]?>" /><? }?>&nbsp;</td>
        <td><?= $cli["ID"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cli["CUP_DATE"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="left"><? list($d, $m, $y) = explode("-", $cli["CUP_DATV"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td align="left"><?= $cli["CUP_PLAC"]?></td>
        <td align="left"><?= $cli["CUP_MOTO"]?></td>
        <td align="left"><?= $cli["CUP_PRON"]?></td>
        <td align="right"><?= number_format($cli["CUP_QUAN"], 2, '.', '')?> m<sup>3</sup></td>
        <td align="right">R$ <?= $cli["CUP_TOTA"]?></td>
        <td align="center"><a href="imprCupD.php?id=<?= $cli["ID"]?>"><img src="pictures/printer_3.png" border="0" alt="Imprimir Cupon" /></a><a href="#" onclick="canCupom(<?= $cli["ID"]?>);"><img src="pictures/b_drop.png" border="0" /></a></td>
		
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
        <td width="15%" align="right"><strong><?= number_format($totAre, 2, '.', '')?> m<sup>3</sup></strong></td>
        <td width="12%" align="right"><strong>R$ <?= number_format($totDes, 2, '.', '')?></strong></td>
        <td width="6%" align="right">&nbsp;</td>
  </tr>
</table>
<br /><br />
<?
if($sit == 1){
?>
<div>
	<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="15%"><strong>Total de Cupon Baixados</strong></td>
        <td width="24%"><div id="tnc"></div></td>
        <td width="43%" align="right"><strong><div style="position:absolute; margin-left:355px; margin-top:2px;" id="qta"></div> m<sup>3</sup></strong></td>
        <td width="12%"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R$ <div style="position: absolute; margin-left:85px; margin-top:-15px;" id="tot"></div></strong></td>
        <td width="6%" align="center"><a href="#" id="pag"><img src="pictures/b_select.png" border="0" /></a>
  </tr>
</table>
</div>
<?
}
?>
</form>
</body>
</html>