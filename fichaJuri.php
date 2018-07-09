<?
require_once("class/classCfop.php");
require_once("class/classCliente.php");
require_once("class/classCsit.php");

//Verifica se Altera
if($_GET[cid] == ""){
	$value = "addcliJuri";
	$button = " CADASTRAR ";
}else{
	$value = "altcliJuri";
	$button = " ALTERAR ";
	
	$conCli = new Cliente();
	$fiCli = $conCli->clienteCons($_GET[cid]);
	$totalli = mysql_num_rows($fiCli);
	$escCli = mysql_fetch_array($fiCli); 
}
//Alterar Cliente
if($action == "altcliJuri"){
	
	$tip = 2;
	$data = date('Y-m-d');
	
	$cli = new Cliente();
	$cli->setCid($_POST["juriCfop"]);
	$cli->setSid($_POST["juriCsit"]);
	$cli->setData($data);
	$cli->setNome($_POST["juriNome"]);
	$cli->setEnde($_POST["juriEnde"]);
	$cli->setBairr($_POST["juriBair"]);
	$cli->setCidad($_POST["juriCidad"]);
	$cli->setCep($_POST["juriCep"]);
	$cli->setUf($_POST["juriEsta"]);
	$cli->setCnpj($_POST["juriCnpj"]);
	$cli->setInsc($_POST["juriInsc"]);
	$cli->setDddt($_POST["juriTddd"]);
	$cli->setTel($_POST["juriTel"]);
	$cli->setDddf($_POST["juriFddd"]);
	$cli->setFax($_POST["juriFax"]);
	$cli->setMail($_POST["juriMail"]);
	$cli->setObs($_POST["juriObs"]);
	$cli->alterarJuri($_POST["id"]);
	?>
    <script>
		alert('Cliente Alterado com Sucesso');
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>
	<?
}
//Add Cliente
if($action == "addcliJuri"){
	
	$tip = 2;
	$sid = 1;
	$data = date('Y-m-d');
	
	$cli = new Cliente();
	$cli->setTid($tip);
	$cli->setCid($_POST["juriCfop"]);
	$cli->setSid($sid);
	$cli->setData($data);
	$cli->setNome($_POST["juriNome"]);
	$cli->setEnde($_POST["juriEnde"]);
	$cli->setBairr($_POST["juriBair"]);
	$cli->setCidad($_POST["juriCidad"]);
	$cli->setCep($_POST["juriCep"]);
	$cli->setUf($_POST["juriEsta"]);
	$cli->setCnpj($_POST["juriCnpj"]);
	$cli->setInsc($_POST["juriInsc"]);
	$cli->setDddt($_POST["juriTddd"]);
	$cli->setTel($_POST["juriTel"]);
	$cli->setDddf($_POST["juriFddd"]);
	$cli->setFax($_POST["juriFax"]);
	$cli->setMail($_POST["juriMail"]);
	$cli->addcliJuri();
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
   	  <td width="82%"><strong>Cadastro Cliente Pessoa Jurídica</strong></td>
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
        <td colspan="3"><input type="text" name="juriNome" id="Nome" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["NOME"]?>"></td>
    </tr>
    <tr>
    	<td><strong>Endereço*</strong></td>
        <td colspan="3"><input type="text" name="juriEnde" id="Endereco" size="78" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["ENDE"]?>" ></td>
    </tr>
    <tr>
		<td><strong>Bairro*</strong></td>
		<td><input type="text" name="juriBair" id="juriBairro" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["BAIRR"]?>"></td>
		<td><strong>Cidade*</strong></td>
		<td><input type="text" name="juriCidad" id="juriCidade" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CIDAD"]?>"></td>
	</tr>
    <tr>
		<td><strong>CEP*</strong></td>
		<td><input type="text" name="juriCep" size="29" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '#####-###')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CEP"]?>"></td>
		<td><strong>UF*</strong></td>
		<td><select name="juriEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["UF"]?>">
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
		<td><strong>CNPJ*</strong></td>
		<td><input type="text" name="juriCnpj" size="29"  maxlength="18" class="input" onKeyPress="formatar_mascara(this, '##.###.###/####-##')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CNPJ"]?>" ></td>
		<td>Inscrição</td>
		<td><input type="text" name="juriInsc" size="29" class="input" value="<?= $escCli["INSC"]?>"></td>
	</tr>
	<tr>
		<td><strong>Tel*</strong></td>
		<td><input type="text" name="juriTddd" size="2" maxlength="2" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["DDT"]?>"> <input type="text" name="juriTel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["TEL"]?>"></td>
		<td>Fax</td>
		<td><input type="text" name="juriFddd" size="2" maxlength="2" class="input" value="<?= $escCli["DDF"]?>"> <input type="text" name="juriFax" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escCli["FAX"]?>" ></td>
	</tr>
    <tr>
		<td>E-mail</td>
		<td><input type="text" name="juriMail" size="29" class="input" value="<?= $escCli["MAIL"]?>"></td>
		<td>CFOP</td>
		<td><select name="juriCfop" class="input">
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
		<td><select name="juriCsit" class="input">
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
        <td colspan="3"><textarea name="juriObs" id="juriObs" class="input" cols="78" rows="4" onKeyUp="upperCase(this.id)"><?= $escCli["OBS"]?></textarea></td>
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
