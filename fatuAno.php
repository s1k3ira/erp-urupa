<?
session_start();
require_once("logaut.php");
$dia = date("Y-m-d");//Pega data do Servidor

$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";

require_once("class/Cupom.php");
require_once("class/Faturamento.php");
if($_GET[ano] == ""){
$ano = $d;
}else{
$ano = $_GET[ano];
}
//Pega Cliente no Banco
	$cli = new Faturamento();
	$resul = $cli->fatAno($ano);
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
	function listarMes(){
		var ano = document.listaFat.fatAno.value;
		location.href='fatuAno.php?ano='+ano+'';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaFat" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Faturamento Anual 
                                                                         <select name="fatAno" class="input" onchange="listarMes();">
      																	 	<option value="2009" <? if($ano == "2009"){echo "selected";}?>>2009</option>
                                                                            <option value="2010" <? if($ano == "2010"){echo "selected";}?>>2010</option>
                                                                            <option value="2011" <? if($ano == "2011"){echo "selected";}?>>2011</option>
                                                                            <option value="2012" <? if($ano == "2012"){echo "selected";}?>>2012</option>
<option value="2013" <? if($ano == "2013"){echo "selected";}?>>2013</option>
                                                                            <option value="2014" <? if($ano == "2014"){echo "selected";}?>>2014</option>
                                                                            <option value="2015" <? if($ano == "2015"){echo "selected";}?>>2015</option>
<option value="2016" <? if($ano == "2016"){echo "selected";}?>>2016</option>
<option value="2017" <? if($ano == "2017"){echo "selected";}?>>2017</option>
<option value="2018" <? if($ano == "2018"){echo "selected";}?>>2018</option>
<option value="2019" <? if($ano == "2019"){echo "selected";}?>>2019</option>
<option value="2020" <? if($ano == "2020"){echo "selected";}?>>2020</option>
                                                                         </select>
                                                                         </strong></div></td>
      <td width="31%" class="tabsis">Emitido por: 
        <?= $_SESSION[user]?>
-
<?= $dip?>- <?= $hou?></td>
       <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="15%"><strong>CNPJ/CPF</strong></td>
        <td width="26%"><strong>Nome</strong></td>
        <td width="6%" align="right"><strong>Quantidade</strong></td>
        <td width="16%" align="right"><strong>Desconto</strong></td>
        <td width="13%" align="right"><strong>Arendamento</strong></td>
        <td width="14%" align="right"><strong>Total</strong></td>
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
        <td><?= $cli["CLI_CNPJ"]?><?= $cli["CLI_CPF"]?></td>
        <td><?= $cli["CLI_NOME"]?></td>
        <td align="right"><?= number_format($cli["TOQUANT"], 2, '.', '')?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cli["TODESC"], 2, '.', '')?></td>
        <td align="right">R$ <?= number_format($ren, 2, '.', '')?> </td>
        <td align="right"><strong>R$ <?= number_format($cli["TOTOTAL"], 2, '.', '')?></strong></td>
  </tr>
<?
}
?>
<tr class="tabsis">
        <td width="14%"><strong>Total</strong></td>
        <td width="30%"></td>
        <td width="9%" align="right"><strong><?= number_format($totAre, 2, '.', '')?> m<sup>3</sup></strong></td>
        <td width="17%" align="right"><strong>R$ <?= number_format($totDes, 2, '.', '')?></strong></td>
        <td width="14%" align="right"><strong>R$ <?= number_format($totRen, 2, '.', '')?></strong></td>
        <td width="16%" align="right"><strong>R$ <?= number_format($totMes, 2, '.', '')?></strong></td>
  </tr>
</table>
</form>
</body>
</html>