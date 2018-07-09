<?
//Include de Classes
require_once("class/classVeiculo.php");

//Verifica se Altera
if($_GET[cid] == ""){
$_GET[cid] = $_GET[aid];
}
if($_GET[cid] == ""){
	$value = "addVei";
	$button = " CADASTRAR ";
}else{
	$value = "altVei";
	$button = " ALTERAR ";
	if($_GET[aid] == ""){	
		$conVei = new Veiculo();
		$fiVei = $conVei->veiCons($_GET[cid]);
		$totalli = mysql_num_rows($fiVei);
		$escVei = mysql_fetch_array($fiVei); 
	}
}

//Alterar Veiculo
if($_POST["acao"] == "altVei"){
	
	$data = date('Y-m-d');
	
	$cli = new Veiculo();
	$cli->setCid($_POST["cid"]);
	$cli->setData($data);
	$cli->setPlaca($_POST["veiPla"]);
	$cli->setUf($_POST["veiEsta"]);
	$cli->setDcomp($_POST["veiComp"]);
	$cli->setDlarg($_POST["veiLarg"]);
	$cli->setDaltu($_POST["veiAltu"]);
	$cli->setDtota($_POST["veiTota"]);
	$cli->setMome($_POST["veiMot"]);
	$cli->setCpf($_POST["motCpf"]);
	$cli->setRg($_POST["motRg"]);
	$cli->setDddt($_POST["motTddd"]);
	$cli->setTel($_POST["motTel"]);
	$cli->setDddc($_POST["motCddd"]);
	$cli->setCel($_POST["motCel"]);
	$cli->setNex($_POST["motNex"]);
	$cli->altVeiculo($_POST["id"]);
	?>
    <script>
		alert('Veículo Alterado com Sucesso');
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>
	<?
}
//Add Cliente
if($_POST["acao"] == "addVei"){
	
	$data = date('Y-m-d');
	
	$cli = new Veiculo();
	$cli->setData($data);
	$cli->setPlaca($_POST["veiPla"]);
	$cli->setUf($_POST["veiEsta"]);
	$cli->setDcomp($_POST["veiComp"]);
	$cli->setDlarg($_POST["veiLarg"]);
	$cli->setDaltu($_POST["veiAltu"]);
	$cli->setDtota($_POST["veiTota"]);
	$cli->setMome($_POST["veiMot"]);
	$cli->setCpf($_POST["motCpf"]);
	$cli->setRg($_POST["motRg"]);
	$cli->setDddt($_POST["motTddd"]);
	$cli->setTel($_POST["motTel"]);
	$cli->setDddc($_POST["motCddd"]);
	$cli->setNex($_POST["motNex"]);
	$cli->setCel($_POST["motCel"]);
	$cli->addVeiculo();
	?>
    <script>
		alert('Veiculo Cadastrado com Sucesso');
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>
	<?
}
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

function calcTotal(){
	var comp = document.formVei.veiComp.value;
	var larg = document.formVei.veiLarg.value;
	var altu = document.formVei.veiAltu.value;
	var res = comp*larg*altu;
	document.formVei.veiTota.value = res.toFixed(2);	
}
function fechaJanela(){
	self.parent.tb_remove();
} 
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="450" cellspacing="0" align="center">
  <tr class="topficha">
   	  <td width="82%"><strong>Cadastro de Veiculos</strong></td>
      <td width="18%"><div align="right">Fechar <a href="#" onClick="fechaJanela();"><img src="pictures/buttonFecha.gif" border="0" /></a></div></td>
  </tr>
</table>
<br />
<form action="<?= $PHP_SELF?>" name="formVei" id="formVei" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="acao" value="<?= $value?>" />
<input type="hidden" name="cid" value="<?= $_GET[id]?>" />
<input type="hidden" name="aid" value="<?= $_GET[cid]?>" />
<input type="hidden" name="id" value="<?= $escVei["ID"]?>" />
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
	<tr>
    	<td><strong>Dimensão*</strong></td>
        <td colspan="3">
        	<table>
            	<tr>
                	<td><div align="center">Compri.</div></td>
                    <td><div align="center">Largura</div></td>
                    <td><div align="center">Altura</div></td>
                    <td>&nbsp;</td>
                    <td><div align="center"><strong>Total</strong></div></td>
                </tr>
                <tr>
                	<td><div align="center"><input type="text" name="veiComp" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DCOMP"]?>" /></div></td>
                    <td><div align="center"><input type="text" name="veiLarg" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DLARG"]?>" /></div></td>
                    <td><div align="center"><input type="text" name="veiAltu" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DALTU"]?>" /></div></td>
                    <td>&nbsp;</td>
                    <td><div align="center"><input type="text" name="veiTota" size="6" class="input" readonly="true" value="<?= $escVei["DTOTAL"]?>" /></div></td>
                    <td><strong>m<sup>3</sup></strong></td>
                </tr>
            </table>           </td>
    </tr> 
       	<td><strong>Motorista*</strong></td>
        <td colspan="3"><input type="text" name="veiMot" id="Motorista" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["MNOME"]?>"></td>
    </tr>
    
    <tr>
      <td><strong>CPF*</strong></td>
      <td><input name="motCpf" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyPress="formatar_mascara(this, '###.###.###-##')" value="<?= $escVei["CPF"]?>" size="29"  maxlength="14" xml:lang="1" /></td>
      <td>RG</td>
      <td><input type="text" name="motRg" size="29" class="input" value="<?= $escVei["RG"]?>" /></td>
    </tr>
	<tr>
		<td>Tel</td>
		<td><input type="text" name="motTddd" size="2" maxlength="2" class="input" value="<?= $escVei["DDT"]?>"> <input type="text" name="motTel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escVei["TEL"]?>"></td>
		<td>Cel</td>
		<td><input type="text" name="motCddd" size="2" maxlength="2" class="input" value="<?= $escVei["DDC"]?>"> <input type="text" name="motCel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escVei["CEL"]?>" ></td>
	</tr>
    <tr>
		<td>ID</td>
		<td><input type="text" name="motNex" size="20" maxlength="9" class="input" value="<?= $escVei["NEXTE"]?>"></td>
		<td></td>
		<td></td>
	</tr>
</table>
<br /><br />

<div align="center"><input type="submit" value="<?= $button?>" class="botao" /></div>
</form>
</body>
</html>
