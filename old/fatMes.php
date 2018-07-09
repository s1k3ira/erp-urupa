<?
require_once("logaut.php");
$dia = date("Y-m-d");//Pega data do Servidor

$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";

require_once("class/classUser.php");
require_once("class/classCupom.php");
require_once("class/classFatura.php");

if($_GET[mes] == ""){
	$day = date("Y-m-d");//Pega data do Servidor
	list($ano, $mes, $dat) = explode("-",$day);
}else{
	$mes = $_GET[mes];
	$ano = $_GET[ano];
}

//Pega na Session o Usuario
$use = new User();
$use->getSession();
$usua = $use->getNome();

//Pega Cliente no Banco
	$cli = new Faturamento();
	$resul = $cli->fatMes($mes, $ano);
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
		var mes = document.listaFat.fatMes.value;
		var ano = document.listaFat.fatAno.value;
		location.href='fatMes.php?mes='+mes+'&ano='+ano+'';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaFat" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Faturamento Mês <select name="fatMes" class="input" onchange="listarMes();">
      																	 	<? if($mes == "01"){echo "selected";}?>
                                                       <option value="01" <? if($mes == "01"){echo "selected";}?>>Janeiro</option>
                                                       <option value="02" <? if($mes == "02"){echo "selected";}?>>Fevereiro</option>
                                                       <option value="03" <? if($mes == "03"){echo "selected";}?>>Marco</option>
                                                       <option value="04" <? if($mes == "04"){echo "selected";}?>>Abril</option>
                                                       <option value="05" <? if($mes == "05"){echo "selected";}?>>Maio</option>
                                                       <option value="06" <? if($mes == "06"){echo "selected";}?>>Junho</option>
                                                       <option value="07" <? if($mes == "07"){echo "selected";}?>>Julho</option>
                                                       <option value="08" <? if($mes == "08"){echo "selected";}?>>Agosto</option>
                                                       <option value="09" <? if($mes == "09"){echo "selected";}?>>Setembro</option>
                                                       <option value="10" <? if($mes == "10"){echo "selected";}?>>Outubro</option>
                                                       <option value="11" <? if($mes == "11"){echo "selected";}?>>Novembro</option>
                                                       <option value="12" <? if($mes == "12"){echo "selected";}?>>Dezembro</option>
                                                                         </select>
                                                                         <select name="fatAno" class="input" onchange="listarMes();">
      																	 	<option value="2009" <? if($ano == "2009"){echo "selected";}?>>2009</option>
                                                                            <option value="2010" <? if($ano == "2010"){echo "selected";}?>>2010</option>
                                                                            <option value="2011" <? if($ano == "2011"){echo "selected";}?>>2011</option>
                                                                            <option value="2012" <? if($ano == "2012"){echo "selected";}?>>2012</option>
                                                                         </select>
                                                                         </strong></div></td>
      <td width="31%" class="tabsis">Emitido por: <?= $usua?> - <?= $dip?> - <?= $hou?></td>
       <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="15%"><strong>CNPJ/CPF</strong></td>
        <td width="26%"><strong>Nome</strong></td>
        <td width="6%"><strong>Quantidade</strong></td>
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
        <td><?= $cli["CNPJ"]?><?= $cli["CPF"]?></td>
        <td><?= $cli["NOME"]?></td>
        <td align="right"><?= number_format($cli["TOQUANT"], 2, '.', '')?> m<sup>3</sup></td>
        <td align="right">R$ <?= number_format($cli["TODESC"], 2, '.', '')?></td>
        <td align="right">R$ <?= number_format($ren, 2, '.', '')?> </td>
        <td align="right"><strong>R$ <?= number_format($cli["TOTOTAL"], 2, '.', '')?></strong></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr class="tabsis">
        <td width="15%"><strong>Total</strong></td>
        <td width="26%"></td>
        <td width="6%" align="right"><strong><?= number_format($totAre, 2, '.', '')?> m<sup>3</sup></strong></td>
        <td width="16%" align="right"><strong>R$ <?= number_format($totDes, 2, '.', '')?></strong></td>
        <td width="13%" align="right"><strong>R$ <?= number_format($totRen, 2, '.', '')?></strong></td>
        <td width="14%" align="right"><strong>R$ <?= number_format($totMes, 2, '.', '')?></strong></td>
  </tr>
</table>
</form>
</body>
</html>