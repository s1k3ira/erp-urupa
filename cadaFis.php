<?
require_once("class/Cliente.php");

//Inserir Cliente
if($_POST[action] == "cadaCli"){
	$cliente = new Cliente;
	$cliente->setNome($_POST[cliNome]);
	$cliente->setCpf($_POST[juriCnpj]);
	$cliente->setRg($_POST[cliInsc]);
	$cliente->setResp($_POST[cliResp]);
	$cliente->setMail($_POST[cliMail]);
	$cliente->setLoga($_POST[cliLoga]);
	$cliente->setBair($_POST[cliBair]);
	$cliente->setCep($_POST[cliCep]);
	$cliente->setCida($_POST[cliCida]);
	$cliente->setEsta($_POST[cliEsta]);
	$cliente->setTddd($_POST[cliTddd]);
	$cliente->setTele($_POST[cliTele]);
	$cliente->setFddd($_POST[cliFddd]);
	$cliente->setFax($_POST[cliFax]);
	$cliente->setNexte($_POST[cliFax]);
	$cliente->setSitu("Liberado");
	$cliente->setTipo("2");
	$last = $cliente->cadaFis();
	?>
    <script>
		location.href='cadaFis.php?id=<?= $last?>';
    </script>
	<?	

}

//Update
if($_POST[action] == "updaCli"){
	$cliente = new Cliente;
	$cliente->setId($_POST[id]);
	$cliente->setNome($_POST[cliNome]);
	$cliente->setCpf($_POST[juriCnpj]);
	$cliente->setRg($_POST[cliInsc]);
	$cliente->setResp($_POST[cliResp]);
	$cliente->setMail($_POST[cliMail]);
	$cliente->setLoga($_POST[cliLoga]);
	$cliente->setBair($_POST[cliBair]);
	$cliente->setCep($_POST[cliCep]);
	$cliente->setCida($_POST[cliCida]);
	$cliente->setEsta($_POST[cliEsta]);
	$cliente->setTddd($_POST[cliTddd]);
	$cliente->setTele($_POST[cliTele]);
	$cliente->setFddd($_POST[cliFddd]);
	$cliente->setFax($_POST[cliFax]);
	$cliente->setNexte($_POST[cliFax]);
	$cliente->setSitu($_POST[cliSitu]);
	$cliente->setForma($_POST[cliForma]);
	$cliente->setOber($_POST[cliObse]);
	$cliente->setDebi($_POST[cliDebi]);
	$cliente->setCred($_POST[cliCred]);
	$cliente->alteFis();
	?>
    <script>
		alert('CLIENTE FÍSICO ALTERADO COM SUCESSO !!!');
		location.href='gereFis.php';
    </script>
	<?	

}



if($_GET[id] == ""){
$acao = "cadaCli";
}else{
$acao = "updaCli";	
//Buscar Cliente
$busca = new Cliente;
$busca->setId($_GET[id]);
$query = $busca->consCli();
$cli = mysql_fetch_array($query);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/formValid.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<style type="text/css">
<!--
#jurDados .tabsis tr td table {
	text-align: left;
}
-->
</style>
</head>

<body>
<form action="<?= $PHP_SELF?>" method="post">
<input type="hidden" name="action" value="<?= $acao?>" />
<input type="hidden" name="id" value="<?= $_GET[id]?>" />
<div id="jurMenu"><strong>&nbsp;Dados Pessoais</strong></div>
<div id="jurDados">
<table width="800" align="center"  class="tabsis">
	<tr>
    	<td width="380">
            <table width="100%">
				<tr>
                    <td>Nome</td>
                    <td><input class="input"  type="text" size="55" onKeyUp="upperCase(this.id)" id="cliNome" name="cliNome" value="<?= $cli["CLI_NOME"]?>" /></td>
                </tr>
                <tr>
                    <td>CPF</td>
                    <td><input name="juriCnpj" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyPress="formatar_mascara(this, '###.###.###-##')" value="<?= $cli["CLI_CPF"]?>" size="29"  maxlength="18" xml:lang="1" /></td>
                </tr>
                <tr>
                    <td>RG</td>
                    <td><input class="input"  type="text" size="29"  id="cliInsc" name="cliInsc" value="<?= $cli["CLI_RG"]?>" /></td>
                </tr>
                 <tr>
                    <td>Responsável</td>
                    <td><input class="input"  type="text" size="55"  onKeyUp="upperCase(this.id)" id="cliResp" name="cliResp" value="<?= $cli["CLI_RESP"]?>"  /></td>
                </tr>
                 <tr>
                    <td>E-mail</td>
                    <td><input class="input"  type="text" size="29"  id="cliMail" name="cliMail" value="<?= $cli["CLI_MAIL"]?>" /></td>
                </tr>
			</table>
		</td>
        <td width="408">
            <table width="414">
                <tr>
                    <td width="56">Logadouro</td>
                    <td colspan="3"><input class="input"  type="text" size="68"  onKeyUp="upperCase(this.id)"  id="cliLoga" name="cliLoga" value="<?= $cli["CLI_LOGA"]?>" /></td>
                </tr>
                <tr>
                    <td>Bairro</td>
                    <td width="143"><input class="input"  type="text"  onKeyUp="upperCase(this.id)"  id="cliBair" name="cliBair" value="<?= $cli["CLI_BAIR"]?>" /></td>
                    <td width="36">CEP</td>
                    <td width="151"><input class="input"  type="text"  id="cliCep" name="cliCep" value="<?= $cli["CLI_CEP"]?>" maxlength="9" onKeyPress="formatar_mascara(this, '#####-###')" /></td>
                </tr>
                <tr>
                    <td>Cidade</td>
                    <td><input class="input"  type="text"  onKeyUp="upperCase(this.id)"  id="cliCida" name="cliCida" value="<?= $cli["CLI_CIDA"]?>" /></td>
                    <td>Estado</td>
                    <td>
                    	<select name="cliEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')">
                            <option value=""></option>
                            <option value="AC"<? if($cli["CLI_ESTA"] == "AC") echo"selected"?>>AC</option>
                            <option value="AL"<? if($cli["CLI_ESTA"] == "AL") echo"selected"?>>AL</option>
                            <option value="AM"<? if($cli["CLI_ESTA"] == "AM") echo"selected"?>>AM</option>
                            <option value="AP"<? if($cli["CLI_ESTA"] == "AP") echo"selected"?>>AP</option>
                            <option value="BA"<? if($cli["CLI_ESTA"] == "BA") echo"selected"?>>BA</option>
                            <option value="CE"<? if($cli["CLI_ESTA"] == "CE") echo"selected"?>>CE</option>
                            <option value="DF"<? if($cli["CLI_ESTA"] == "DF") echo"selected"?>>DF</option>
                            <option value="ES"<? if($cli["CLI_ESTA"] == "ES") echo"selected"?>>ES</option>
                            <option value="GO"<? if($cli["CLI_ESTA"] == "GO") echo"selected"?>>GO</option>
                            <option value="MA"<? if($cli["CLI_ESTA"] == "MA") echo"selected"?>>MA</option>
                            <option value="MG"<? if($cli["CLI_ESTA"] == "MG") echo"selected"?>>MG</option>
                            <option value="MS"<? if($cli["CLI_ESTA"] == "MS") echo"selected"?>>MS</option>
                            <option value="MT"<? if($cli["CLI_ESTA"] == "MT") echo"selected"?>>MT</option>
                            <option value="PA"<? if($cli["CLI_ESTA"] == "PA") echo"selected"?>>PA</option>
                            <option value="PB"<? if($cli["CLI_ESTA"] == "PB") echo"selected"?>>PB</option>
                            <option value="PE"<? if($cli["CLI_ESTA"] == "PE") echo"selected"?>>PE</option>
                            <option value="PI"<? if($cli["CLI_ESTA"] == "PI") echo"selected"?>>PI</option>
                            <option value="PR"<? if($cli["CLI_ESTA"] == "PR") echo"selected"?>>PR</option>
                            <option value="RJ"<? if($cli["CLI_ESTA"] == "RJ") echo"selected"?>>RJ</option>
                            <option value="RN"<? if($cli["CLI_ESTA"] == "RN") echo"selected"?>>RN</option>
                            <option value="RO"<? if($cli["CLI_ESTA"] == "RO") echo"selected"?>>RO</option>
                            <option value="RR"<? if($cli["CLI_ESTA"] == "RR") echo"selected"?>>RR</option>
                            <option value="RS"<? if($cli["CLI_ESTA"] == "RS") echo"selected"?>>RS</option>
                            <option value="SC"<? if($cli["CLI_ESTA"] == "SC") echo"selected"?>>SC</option>
                            <option value="SE"<? if($cli["CLI_ESTA"] == "SE") echo"selected"?>>SE</option>
                            <option value="SP"<? if($cli["CLI_ESTA"] == "SP") echo"selected"?>>SP</option>
                            <option value="TO"<? if($cli["CLI_ESTA"] == "TO") echo"selected"?>>TO</option>
               			</select>
                    </td>
                </tr>
                <tr>
                    <td>Tel</td>
                    <td><input type="text" name="cliTddd" size="2" maxlength="2" class="input" value="<?= $cli["CLI_TDDD"]?>" />
      <input type="text" name="cliTele" size="11" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $cli["CLI_TELE"]?>" /></td>
                    <td>Fax</td>
                    <td><input type="text" name="cliFddd" size="2" maxlength="2" class="input" value="<?= $cli["CLI_TDDD"]?>" />
      <input type="text" name="cliFax" size="11" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $cli["CLI_FAX"]?>" /></td>
                </tr>
                 <tr>
                    <td>Nextel ID</td>
                    <td><input class="input"  type="text"  id="cliNext" name="cliNext" value="<?= $cli["CLI_NEXT"]?>" /></td>
                </tr>
   			</table>
        </td>
    </tr>
</table>
</div>
<br />
<?
if(!($_GET[id] == "")){
?>
<div id="jurMenu"><strong>&nbsp;Produtos</strong></div>
<div id="jurDados">
<table width="800" align="center"  class="tabsis">
	<tr>
        <td width="455">
       	  <table width="781">
                <tr>
                    <td>  <a href="cliPro.php?id=<?= $_GET[id]?>&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=300&width=423&modal=true" class="thickbox"> <img src="pictures/Knob Add.png" width="20" border="0" /></a></td>
                    <td width="116">Forma de Pagamento</td>
                    <td width="130"><input type="text" name="cliForma" value="<?= $cli["CLI_PAGA"]?>" class="input" onKeyUp="upperCase(this.id)" id="cliForma" />
                    </td>
                    <td width="45">Situação</td>
                    <td width="135">
                    	<select class="input" name="cliSitu">
                        	<option value="">Selecione</option>
                            <option value="Liberado" <? if($cli["CLI_SITU"] == "Liberado") echo"selected"?>>Liberado</option>
                            <option value="Bloqueado" <? if($cli["CLI_SITU"] == "Bloqueado") echo"selected"?>>Bloqueado</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table width="782">
          <tr>
                    <td width="472"><iframe scrolling="auto" src="cliProduto.php?id=<?= $_GET[id]?>" width="100%" height="80" allowtransparency="true" frameborder="0"></iframe></td>
                    <td width="298" height="34"><textarea class="input" rows="6" cols="70" onKeyUp="upperCase(this.id)" id="cliObse" name="cliObse" value="<?= $cli["CLI_OBSE"]?>" ><?= $cli["CLI_OBSE"]?></textarea></td>
              </tr>
          </table>
    	</td>
    </tr>
</table>
</div>
<br /><br />
<div id="jurMenu"><strong>&nbsp;Veículos</strong></div>
<div id="jurDados">
<table width="800" align="center"  class="tabsis">
	<tr>
		<td>
			<iframe scrolling="auto" src="cliVeiculo.php?id=<?= $_GET[id]?>" width="100%" height="100" allowtransparency="true" frameborder="0"></iframe> 
		</td>
	</tr>
</table><br /><br />
<?
}
?>
<table align="center">
<tr>
	<td><input type="submit" class="botao" value="  Salvar  " /></td>
    <td><input type="reset" class="botao" value="  Limpar  " /></td>
</tr>
</table>
</div>
</form>
<br /><br />

</body>
</html>