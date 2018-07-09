<?
session_start();
require_once("logaut.php");

require_once("class/Despesa.php");

$dia = date("Y-m-d");//Pega data do Servidor

$hou = date("G:i:s");

list($d, $m, $y) = explode("-",$dia);
$dip = "$y-$m-$d";

require_once("class/Cupom.php");
require_once("class/Faturamento.php");

if($_GET[mes] == ""){
	$day = date("Y-m-d");//Pega data do Servidor
	list($ano, $mes, $dat) = explode("-",$day);
}else{
	$mes = $_GET[mes];
	$ano = $_GET[ano];
}


//Buscar a Vista
$cuv = new Despesa();
$cpoV = $cuv->despMes($mes, $ano);
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
	function listarMes(){
		var mes = document.listaFat.fatMes.value;
		var ano = document.listaFat.fatAno.value;
		location.href='despMes.php?mes='+mes+'&ano='+ano+'';
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaFat" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Despesa Mês <select name="fatMes" class="input" onchange="listarMes();">
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
      <td width="31%" class="tabsis">Emitido por: <?= $_SESSION[user]?> - <?= $dip?> - <?= $hou?></td>
       <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
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
</form>
</body>
</html>