<?
require_once("class/Veiculo.php");

if($_GET[action] == "deleVei"){
$vei = new Veiculo();//Consultar
$vei->setCid($_GET[vid]);
$vresul = $vei->delVeicli();	
}


if($_POST[action] == "inserir"){
	$vei = new Veiculo;
	$vei->setCid($_POST[cid]);
	$vei->setPlaca($_POST[veiPla]);
	$vei->addVeicli();
	?>
	<script>
		location.href = 'cliVeiculo.php?id=<?= $_POST[cid]?>';
	</script>
    <?
}

	$vei = new Veiculo();//Consultar
	$vei->setCid($_GET[id]);
	$vresul = $vei->listaVei();
	$vtotal = mysql_num_rows($vresul);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/formValid.js"></script>
<script>
	function fechaJanela(){
		document.cadaClivei.submit();
	}
</script>
<script>
	function deletaVei(id, nome){		
		if(confirm('Deseja desagregar o veículo '+nome+' ?')){
			location.href='cliVeiculo.php?action=deleVei&vid='+id+'&id=<?= $_GET[id]?>';
		}
	}
</script>
</head>

<body>
<form action="<?= $PHP_SELF?>" name="cadaClivei" method="post">
<input type="hidden" name="cid" value="<?= $_GET[id]?>" />
<input type="hidden" name="action" value="inserir" />
<input type="text" name="veiPla" id="Placa" size="10" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_PLAC"]?>" /> <img src="pictures/Knob Add.png" width="20" border="0" onClick="fechaJanela();" />
</form>
<table width="776">
  <tr  class="tabescu">
    	<td width="81">Placa</td>
        <td width="173">Motorista</td>
        <td width="102">CPF</td>
        <td width="83">Marca</td>
        <td width="73">Modelo</td>
        <td width="66">Cor</td>
         <td width="49">m<sup>3</sup></td>
        <td width="137">Celular</td>
        <td width="50"></td>
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
        <td><?= $ust["VEI_MARC"]?></td>
        <td><?= $ust["VEI_MODE"]?></td>
        <td><?= $ust["VEI_COR"]?></td>
         <td><?= $ust["VEI_TCOM"]?></td>
        <td><?= $ust["VEI_CDDD"]?> <?= $ust["VEI_CELU"]?></td>
        <td><div align="center"><img src="pictures/Knob Cancel.png" width="16" onClick="deletaVei('<?= $ust["ED"]?>', '<?= $ust["VEI_PLAC"]?>');" /></div></td>
  </tr>
<?
}
?>
</table>
</body>
</html>