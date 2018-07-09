<?
require_once("logaut.php");
require_once("class/classVeiculo.php");

if($_GET[action] == "deletaVei"){//Deletar Cli
	$ved = new Veiculo();
	$ved->delVeiculo($_GET[id]);
}

//Paginacao
$pag = 10;
$ini = 0;
$fim = 1000;

//Consulta
if($_POST[action] == "buscar"){//busca por placa ou motorista
	$vei = new Veiculo();//Consultar
	$vei->setPlaca($_POST[veiPla]);
	$vei->setMome($_POST[veiMot]);
	$vresul = $vei->consVeipn();
	$vtotal = mysql_num_rows($vresul);
}else{
	$vei = new Veiculo();//Consultar
	$vresul = $vei->consulVeiculo($ini,$fim);
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
   	  <td width="8%" height="25" class="tabsis">&nbsp;<a href="fichaVei.php?placeValuesBeforeTB_=savedValues&TB_iframe=true&height=300&width=423&modal=true" class="thickbox"><input type="button" value=" INSERIR " class="botao" /></a></td>
      <td width="7%" class="tabsis">
     <div align="left">&nbsp;Placa:</div>
     <div align="left"><input type="text" name="veiPla" id="Placa" size="15" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="22%" class="tabsis">
     <div align="left">&nbsp;Motorista:</div>
     <div align="left"><input type="text" name="veiMot" id="Motorista" size="55" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="19%" class="tabsis">
       <div align="left">&nbsp;</div>
      <div align="left"><input type="submit" class="botao" value=" Buscar " /></div>
      </td>
      <td width="44%" class="tabsis"><div align="right"></div></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
    	<td width="7%"><strong>Placa</strong></td>
        <td width="25%"><strong>Motorista</strong></td>
        <td width="21%"><strong>CPF</strong></td>
        <td width="13%"><strong>Volume m<sup>3</sup></strong></td>
      <td width="13%"><strong>Telefone</strong></td>
      <td width="13%"><strong>Celular</strong></td>
      <td width="8%"><strong>Ações</strong></td>
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
        <td><?= $ust["PLACA"]?></td>
        <td><?= $ust["MNOME"]?></td>
        <td><?= $ust["CPF"]?></td>
        <td><?= $ust["DTOTAL"]?></td>
        <td><?= $ust["DDT"]?> <?= $ust["TEL"]?></td>
        <td><?= $ust["DDC"]?> <?= $ust["CEL"]?></td>
        <td><a href="fichaVei.php?cid=<?= $ust["ID"]?>&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=300&width=423&modal=true" class="thickbox"> <img src="pictures/b_edit.png" alt="Editar" border="0" /></a><a href="fichaCve.php?vid=<?= $ust["ID"]?>&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=300&width=450&modal=true" class="thickbox"><img src="pictures/b_insrow.png" border="0" alt="Inserir Cliente" /> </a> <a href="#" onClick="deletaVei('<?= $ust["ID"]?>', '<?= $ust["PLACA"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
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
