<?
require_once("class/Veiculo.php");

if($_GET[action] == "deletaVei"){//Deletar Cli
	$ved = new Veiculo();
	$ved->delVeiculo($_GET[id]);
}

//Consulta
if($_POST[action] == "buscar"){//busca por placa ou motorista
	$vei = new Veiculo();//Consultar
	$vei->setPlaca($_POST[veiPla]);
	$vei->setMome($_POST[veiMot]);
	$vresul = $vei->consVeipn();
	$vtotal = mysql_num_rows($vresul);
}else{
	$vei = new Veiculo();//Consultar
	$vresul = $vei->consulVeiculo();
	$vtotal = mysql_num_rows($vresul);
}
$veit = new Veiculo();
$veiTotal = $veit->veiculoTotal();//Total de Veiculos Cadastrados

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script>
	function deletaVei(id, placa){		
		if(confirm('Deletar o Veículo de placa '+placa+' ?')){
			location.href='gereVei.php?action=deletaVei&id='+id+'';
		}
	}
</script>

<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div><span class="titulo"><strong>Gerenciar Veiculos</strong></span> | Total Cadastrados(<?= $veiTotal?>
)</div>
<hr />
<form action="<?= $PHP_SELF?>" name="listaCli" method="post">
<input type="hidden" name="action" value="buscar" /> 
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="5%" height="25" class="tabsis">&nbsp;<a href="#" onclick="location.href='cadaVei.php?action=insert';"><img src="pictures/Knob Add.png" width="20" border="0" /></a></td>
      <td width="8%" class="tabsis">
     <div align="left">&nbsp;Placa:</div>
     <div align="left"><input type="text" name="veiPla" id="Placa" size="15" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="21%" class="tabsis">
     <div align="left">&nbsp;Motorista:</div>
     <div align="left"><input type="text" name="veiMot" id="Motorista" size="55" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="22%" class="tabsis">
       <div align="left">&nbsp;</div>
      <div align="left"><input type="submit" class="botao" value=" Buscar " /></div>
      </td>
      <td width="44%" class="tabsis"><div align="right"></div></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="6%"><strong>Placa</strong></td>
        <td width="22%"><strong>Motorista</strong></td>
        <td width="13%"><strong>CPF</strong></td>
        <td width="13%"><strong>c/Tábua m<sup>3</sup></strong></td>
        <td width="14%"><strong>s/Tábua m<sup>3</sup></strong></td>
      <td width="11%"><strong>Telefone</strong></td>
      <td width="11%"><strong>Celular</strong></td>
      <td width="10%"><strong>Ações</strong></td>
  </tr>
<? 
for($e; $e<$vtotal; $e++) {
	$ust = mysql_fetch_array($vresul);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["VEI_PLAC"]?></td>
        <td><?= $ust["VEI_NOME"]?></td>
        <td><?= $ust["VEI_CPF"]?></td>
        <td><?= $ust["VEI_TCOM"]?></td>
        <td><?= $ust["VEI_TSEM"]?></td>
        <td><?= $ust["VEI_TDDD"]?> <?= $ust["VEI_TELE"]?></td>
        <td><?= $ust["VEI_CDDD"]?> <?= $ust["VEI_CELU"]?></td>
        <td><a href="cadaVei.php?action=update&vid=<?= $ust["ID"]?>"> <img src="pictures/b_edit.png" alt="Editar" border="0" /></a><a href="#" onClick="deletaVei('<?= $ust["ID"]?>', '<?= $ust["VEI_PLAC"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right"> </div></td>
  </tr>
</table>
</form>
</body>
</html>
