<?
//Include de Classes
require_once("class/classVeiculo.php");	
require_once("class/classCliente.php");

//Deleta o Cliente Relacionado ao Veiculo
if($_GET[action] =="deletaCli"){
	$veicli = new Veiculo();
	$veicli->delVeicli($_GET["id"]);
}


//Adiciona relacionamento Cliente Veiculo
if($_GET[action] =="inserir"){
	$vei = new Veiculo();
	$vei->setCid($_GET[cid]);
	$vei->setVid($_GET[vid]);
	$vei->addVeicli();
}
		
$conVei = new Veiculo();
$fiVei = $conVei->veiCons($_GET[vid]);
$totalli = mysql_num_rows($fiVei);
$escVei = mysql_fetch_array($fiVei);

$tipo = new Cliente();//Consultar Cliente
$result = $tipo->consVeicli($_GET[vid]);
$total = mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script>
function subPagina(){ 
	document.getElementById('formVei').action = 'listaCli.php';
	document.formVei.submit();
} 
function fechaJanela(){
	self.parent.tb_remove();
}
function deletaCli(id, cliente, vid){		
		if(confirm('Deletar o Cliente '+cliente+' ?')){
			location.href='fichaCve.php?action=deletaCli&id='+id+'&vid='+vid+'';
		}
	}
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="450" cellspacing="0" align="center">
  <tr class="topficha">
   	  <td width="82%"><strong>Inserir Cliente no Veiculo</strong></td>
      <td width="18%"><div align="right">Fechar <a href="#" onClick="fechaJanela();"><img src="pictures/buttonFecha.gif" border="0" /></a></div></td>
  </tr>
</table>
<br />
<table align="center">
    <tr>
    	<td colspan="4"><strong>Todos os campos marcados com * são obrigatórios.</strong></td>
    </tr>
    <tr>
		<td><strong>Placa*</strong></td>
		<td><input type="text" name="veiPla" id="Placa" size="29" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["PLACA"]?>" /></td>
		<td><strong>UF*</strong></td>
		<td><select name="veiEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["UF"]?>">
		    	<option value=""></option>
				<option value="AC"<? if($escVei["UF"] == "AC") echo"selected"?>>AC</option>
				<option value="AL"<? if($escVei["UF"] == "AL") echo"selected"?>>AL</option>
				<option value="AM"<? if($escVei["UF"] == "AM") echo"selected"?>>AM</option>
				<option value="AP"<? if($escVei["UF"] == "AP") echo"selected"?>>AP</option>
				<option value="BA"<? if($escVei["UF"] == "BA") echo"selected"?>>BA</option>
				<option value="CE"<? if($escVei["UF"] == "CE") echo"selected"?>>CE</option>
				<option value="DF"<? if($escVei["UF"] == "DF") echo"selected"?>>DF</option>
				<option value="ES"<? if($escVei["UF"] == "ES") echo"selected"?>>ES</option>
				<option value="GO"<? if($escVei["UF"] == "GO") echo"selected"?>>GO</option>
				<option value="MA"<? if($escVei["UF"] == "MA") echo"selected"?>>MA</option>
				<option value="MG"<? if($escVei["UF"] == "MG") echo"selected"?>>MG</option>
				<option value="MS"<? if($escVei["UF"] == "MS") echo"selected"?>>MS</option>
				<option value="MT"<? if($escVei["UF"] == "MT") echo"selected"?>>MT</option>
				<option value="PA"<? if($escVei["UF"] == "PA") echo"selected"?>>PA</option>
				<option value="PB"<? if($escVei["UF"] == "PB") echo"selected"?>>PB</option>
				<option value="PE"<? if($escVei["UF"] == "PE") echo"selected"?>>PE</option>
				<option value="PI"<? if($escVei["UF"] == "PI") echo"selected"?>>PI</option>
				<option value="PR"<? if($escVei["UF"] == "PR") echo"selected"?>>PR</option>
				<option value="RJ"<? if($escVei["UF"] == "RJ") echo"selected"?>>RJ</option>
				<option value="RN"<? if($escVei["UF"] == "RN") echo"selected"?>>RN</option>
				<option value="RO"<? if($escVei["UF"] == "RO") echo"selected"?>>RO</option>
				<option value="RR"<? if($escVei["UF"] == "RR") echo"selected"?>>RR</option>
				<option value="RS"<? if($escVei["UF"] == "RS") echo"selected"?>>RS</option>
				<option value="SC"<? if($escVei["UF"] == "SC") echo"selected"?>>SC</option>
				<option value="SE"<? if($escVei["UF"] == "SE") echo"selected"?>>SE</option>
				<option value="SP"<? if($escVei["UF"] == "SP") echo"selected"?>>SP</option>
				<option value="TO"<? if($escVei["UF"] == "TO") echo"selected"?>>TO</option>
			</select>		</td>
	</tr> 
       	<td><strong>Motorista*</strong></td>
        <td colspan="3"><input type="text" name="veiMot" id="Motorista" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["MNOME"]?>"></td>
    </tr>
    </tr> 
       	<td><strong>Cliente*</strong></td>
        <td colspan="3"><a href="listaCli.php?vid=<?= $escVei["ID"]?>"><img src="pictures/b_search.png" border="0" /></a></td>
    </tr>
</table>
<br />
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu">
    <td width="25%"><strong>CNPJ/CPF</strong></td>
    <td width="24%"><strong>Inscrição/RG</strong></td>
    <td width="38%"><strong>Nome</strong></td>
    <td width="13%"><strong>Apagar</strong></td>
  </tr>
  <? 
for($e; $e<$total; $e++) {
	$ust = mysql_fetch_array($result);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
    	<td><?= $ust["CNPJ"]?>
      <?= $ust["CPF"]?></td>
    	<td><?= $ust["INSC"]?>
      <?= $ust["RG"]?></td>
    	<td><?= $ust["NOME"]?></td>
    <td><div align="center"><a href="#" onClick="deletaCli('<?= $ust["ID"]?>', '<?= $ust["NOME"]?>','<?= $_GET[vid]?>');"><img src="pictures/b_drop.png" border="0" /></a></div></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>


