<?
require_once("class/classCfop.php");
require_once("class/classCliente.php");
require_once("class/classCsit.php");

//Verifica se Altera
if($_GET[cid] == ""){
	$value = "addcliFisi";
	$button = " CADASTRAR ";
}else{
	$value = "altcliFisi";
	$button = " ALTERAR ";
	
	$conCli = new Cliente();
	$fiCli = $conCli->clienteCons($_GET[cid]);
	$totalli = mysql_num_rows($fiCli);
	$escCli = mysql_fetch_array($fiCli); 
}
//Alterar Cliente
if($action == "altcliFisi"){
	
	$tip = 2;
	$data = date('Y-m-d');
	
	$cli = new Cliente();
	$cli->setCid($_POST["fisiCfop"]);
	$cli->setSid($_POST["fisiCsit"]);
	$cli->setData($data);
	$cli->setNome($_POST["fisiNome"]);
	$cli->setEnde($_POST["fisiEnde"]);
	$cli->setBairr($_POST["fisiBair"]);
	$cli->setCidad($_POST["fisiCidad"]);
	$cli->setCep($_POST["fisiCep"]);
	$cli->setUf($_POST["fisiEsta"]);
	$cli->setCpf($_POST["fisiCpf"]);
	$cli->setRg($_POST["fisiRg"]);
	$cli->setDddt($_POST["fisiTddd"]);
	$cli->setTel($_POST["fisiTel"]);
	$cli->setDddf($_POST["fisiFddd"]);
	$cli->setFax($_POST["fisiFax"]);
	$cli->setMail($_POST["fisiMail"]);
	$cli->setObs($_POST["fisiObs"]);
	$cli->alterarFisi($_POST["id"]);
	?>
    <script>
		alert('Cliente Alterado com Sucesso');
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>
	<?
}
//Add Cliente
if($action == "addcliFisi"){
	
	$tip = 1;
	$sid = 1;
	$data = date('Y-m-d');
	
	$cli = new Cliente();
	$cli->setTid($tip);
	$cli->setCid($_POST["fisiCfop"]);
	$cli->setSid($sid);
	$cli->setData($data);
	$cli->setNome($_POST["fisiNome"]);
	$cli->setEnde($_POST["fisiEnde"]);
	$cli->setBairr($_POST["fisiBair"]);
	$cli->setCidad($_POST["fisiCidad"]);
	$cli->setCep($_POST["fisiCep"]);
	$cli->setUf($_POST["fisiEsta"]);
	$cli->setCpf($_POST["fisiCpf"]);
	$cli->setRg($_POST["fisiRg"]);
	$cli->setDddt($_POST["fisiTddd"]);
	$cli->setTel($_POST["fisiTel"]);
	$cli->setDddf($_POST["fisiFddd"]);
	$cli->setFax($_POST["fisiFax"]);
	$cli->setMail($_POST["fisiMail"]);
	$cli->addcliFisi();
	?>
    <script>
		alert('Cliente Cadastrado com Sucesso');
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>
	<?
}

$tipo = new Cfop();//Consultar CFOP
$result = $tipo->consuCfop();
$total = mysql_num_rows($result);

$sit = new Csit();//Consultar Situacao de Cliente
$result2 = $sit->consuCsit();
$total2 = mysql_num_rows($result2);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script>
function fechaJanela(){
	self.parent.tb_remove();
} 
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="450" cellspacing="0" align="center">
  <tr class="topficha">
   	  <td width="82%"><strong>Cadastro Cliente Pessoa Física</strong></td>
      <td width="18%"><div align="right">Fechar <a href="#" onClick="fechaJanela();"><img src="pictures/buttonFecha.gif" border="0" /></a></div></td>
  </tr>
<? 
if($_GET[cid] ==""){
?>
  <tr>
  	   <td><a href="fichaJuri.php">Pessoa Jurídica</a> | <a href="fichaFisi.php">Pessoa Física</a></td>
  </tr>
<?
}
?>  
</table>
<br />
<form action="<?= $PHP_SELF?>" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="action" value="<?= $value?>" />
<input type="hidden" name="id" value="<?= $_GET[cid]?>" />
<table align="center">
<? 
if($_GET[cid] ==""){
?>
    <tr>
    	<td colspan="4"><strong>Todos os campos marcados com * são obrigatórios.</strong></td>
    </tr>
<?
}
?> 
    <tr>
    	<td><strong>Nome*</strong></td>
        <td colspan="3"><input type="text" name="fisiNome" id="Nome" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["NOME"]?>"></td>
    </tr>
    <tr>
    	<td><strong>Endereço*</strong></td>
        <td colspan="3"><input type="text" name="fisiEnde" id="Endereco" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["ENDE"]?>" ></td>
    </tr>
    <tr>
		<td><strong>Bairro*</strong></td>
		<td><input type="text" name="fisiBair" id="fisiBairro" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["BAIRR"]?>"></td>
		<td><strong>Cidade*</strong></td>
		<td><input type="text" name="fisiCidad" id="fisiCidade" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CIDAD"]?>"></td>
	</tr>
    <tr>
		<td><strong>CEP*</strong></td>
		<td><input type="text" name="fisiCep" size="29" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '#####-###')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CEP"]?>"></td>
		<td><strong>UF*</strong></td>
		<td><select name="fisiEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["UF"]?>">
		    	<option value=""></option>
				<option value="AC"<? if($escCli["UF"] == "AC") echo"selected"?>>AC</option>
				<option value="AL"<? if($escCli["UF"] == "AL") echo"selected"?>>AL</option>
				<option value="AM"<? if($escCli["UF"] == "AM") echo"selected"?>>AM</option>
				<option value="AP"<? if($escCli["UF"] == "AP") echo"selected"?>>AP</option>
				<option value="BA"<? if($escCli["UF"] == "BA") echo"selected"?>>BA</option>
				<option value="CE"<? if($escCli["UF"] == "CE") echo"selected"?>>CE</option>
				<option value="DF"<? if($escCli["UF"] == "DF") echo"selected"?>>DF</option>
				<option value="ES"<? if($escCli["UF"] == "ES") echo"selected"?>>ES</option>
				<option value="GO"<? if($escCli["UF"] == "GO") echo"selected"?>>GO</option>
				<option value="MA"<? if($escCli["UF"] == "MA") echo"selected"?>>MA</option>
				<option value="MG"<? if($escCli["UF"] == "MG") echo"selected"?>>MG</option>
				<option value="MS"<? if($escCli["UF"] == "MS") echo"selected"?>>MS</option>
				<option value="MT"<? if($escCli["UF"] == "MT") echo"selected"?>>MT</option>
				<option value="PA"<? if($escCli["UF"] == "PA") echo"selected"?>>PA</option>
				<option value="PB"<? if($escCli["UF"] == "PB") echo"selected"?>>PB</option>
				<option value="PE"<? if($escCli["UF"] == "PE") echo"selected"?>>PE</option>
				<option value="PI"<? if($escCli["UF"] == "PI") echo"selected"?>>PI</option>
				<option value="PR"<? if($escCli["UF"] == "PR") echo"selected"?>>PR</option>
				<option value="RJ"<? if($escCli["UF"] == "RJ") echo"selected"?>>RJ</option>
				<option value="RN"<? if($escCli["UF"] == "RN") echo"selected"?>>RN</option>
				<option value="RO"<? if($escCli["UF"] == "RO") echo"selected"?>>RO</option>
				<option value="RR"<? if($escCli["UF"] == "RR") echo"selected"?>>RR</option>
				<option value="RS"<? if($escCli["UF"] == "RS") echo"selected"?>>RS</option>
				<option value="SC"<? if($escCli["UF"] == "SC") echo"selected"?>>SC</option>
				<option value="SE"<? if($escCli["UF"] == "SE") echo"selected"?>>SE</option>
				<option value="SP"<? if($escCli["UF"] == "SP") echo"selected"?>>SP</option>
				<option value="TO"<? if($escCli["UF"] == "TO") echo"selected"?>>TO</option>
			</select>
		</td>
	</tr>
    <tr>
		<td><strong>CPF*</strong></td>
		<td><input type="text" name="fisiCpf" size="29"  maxlength="14" class="input" onKeyPress="formatar_mascara(this, '###.###.###-##')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CPF"]?>" ></td>
		<td>RG</td>
		<td><input type="text" name="fisiRg" size="29" class="input" value="<?= $escCli["RG"]?>"></td>
	</tr>
	<tr>
		<td><strong>Tel*</strong></td>
		<td><input type="text" name="fisiTddd" size="2" maxlength="2" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["DDT"]?>"> <input type="text" name="fisiTel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["TEL"]?>"></td>
		<td>Fax</td>
		<td><input type="text" name="fisiFddd" size="2" maxlength="2" class="input" value="<?= $escCli["DDF"]?>"> <input type="text" name="fisiFax" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escCli["FAX"]?>" ></td>
	</tr>
    <tr>
		<td>E-mail</td>
		<td><input type="text" name="fisiMail" size="29" class="input" value="<?= $escCli["MAIL"]?>"></td>
		<td>CFOP</td>
		<td><select name="fisiCfop" class="input">
								    	<option value="">Selecione</option>
										<? 
										for($i; $i<$total; $i++) {
											$rst = mysql_fetch_array($result);
											?>
                							<option value="<?= $rst["ID"]?>"<? if($escCli["CID"] == "$rst[ID]") echo"selected"?>><?= $rst["GRUPO"]?></option>
               							<?
										}
										?>
								    </select></td>
	</tr>
<?
if(!($_GET[cid] == "")){
?>
    <tr>
    	<td>Situação</td>
		<td><select name="fisiCsit" class="input">
								    	<option value="">Selecione</option>
										<? 
										for($e; $e<$total2; $e++) {
											$rst = mysql_fetch_array($result2);
											?>
                							<option value="<?= $rst["ID"]?>"<? if($escCli["SID"] == "$rst[ID]") echo"selected"?>><?= $rst["TIPO"]?></option>
               							<?
										}
										?>
								    </select></td>
    </tr>
    <tr>
    	<td>Observação</td>
        <td colspan="3"><textarea name="fisiObs" id="fisiObs" class="input" cols="78" rows="4" onKeyUp="upperCase(this.id)"><?= $escCli["OBS"]?></textarea></td>
    </tr>
<?
}
?>
</table>
<br />

<div align="center"><input type="submit" value="<?= $button?>" class="botao" /></div>
</form>
</body>
</html>
