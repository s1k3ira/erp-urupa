<?
session_start();
$day = date("d-m-Y");//Pega data do Servidor

require_once("class/classCupom.php");
require_once("class/classVeiculo.php");
require_once("class/classUser.php");
require_once("class/classCliente.php");
require_once("class/classProd.php");

//Pega o Max ID
$cup = new Cupom();
$cupM = $cup->cupMax();
$cupMa = mysql_fetch_array($cupM);
$ped = $cupMa[0] + 1;

//Pega na Session o Usuario
$use2 = new User();
$use2->getSession();
$usua2 = $use2->getNome();

//Seleciona os Produtos do Banco
$prod = new Produto();
$uresul = $prod->venProd();
$utotal = mysql_num_rows($uresul);

//Buscar Veiculo e Verificar se o mesmo esta cadastrado
if($_GET["conVen"] == "conVei" ){
	$conVei = new Veiculo();
	$fiVei = $conVei->veiPlaca($_GET[pvei]);
	$totalli = mysql_num_rows($fiVei);
	if($totalli == ""){
		?>
		<script>
			alert('Veiculo nao Cadastrado');
			location.href='gereVen.php';
	    </script>
        <?
	}else{	
		$escVei = mysql_fetch_array($fiVei);
		$cei = new Cliente();
		$clivei = $cei->consVeicli($escVei["ID"]);
		$total = mysql_num_rows($clivei);
		$_SESSION["vid"] =  $escVei["ID"];
	}
}

//Buscar Veiculo e Cliente e Verificar se o mesmo esta liberado
if($_GET["conVen"] == "conCli" ){
	//Buscar Veiculo
	$conVei = new Veiculo();
	$fiVei = $conVei->veiCons($_SESSION["vid"]);
	$totalli = mysql_num_rows($fiVei);
	$escVei = mysql_fetch_array($fiVei);
	
	//Buscar Cliente Lista
	$cei = new Cliente();
	$clivei = $cei->consVeicli($escVei["ID"]);
	$total = mysql_num_rows($clivei);
	
	//Buscar Dados do Cliente
	$cli = new Cliente();
	$busCli = $cli->venCli($_GET["cid"]);
	$totalli = mysql_num_rows($busCli);
	$escCli = mysql_fetch_array($busCli);
	$_SESSION["cid"] =  $escCli["ID"];
	if($escCli{"TIPO"} == "Bloqueado"){
		?>
        <script>
			alert('Cliente Bloqueado favor entre em contato com a Administracao');
			location.href='gereVen.php';
	    </script>
		<?
	}	
}

//Buscar Veiculo, Cliente e Produto
if($_GET["conVen"] == "conPro" ){
	//Buscar Veiculo
	$conVei = new Veiculo();
	$fiVei = $conVei->veiCons($_SESSION["vid"]);
	$totalli = mysql_num_rows($fiVei);
	$escVei = mysql_fetch_array($fiVei);
	
	//Buscar Cliente Lista
	$cei = new Cliente();
	$clivei = $cei->consVeicli($escVei["ID"]);
	$total = mysql_num_rows($clivei);
	
	//Buscar Dados do Cliente
	$cli = new Cliente();
	$busCli = $cli->clienteCons($_SESSION["cid"]);
	$totalli = mysql_num_rows($busCli);
	$escCli = mysql_fetch_array($busCli);
	
	//Buscar Dados do Cliente
	$cpro = new Produto();
	$busPro = $cpro->consProd($_GET["pid"]);
	$totalp = mysql_num_rows($busPro);
	$escPro = mysql_fetch_array($busPro);
	$_SESSION["pid"] =  $escPro["ID"];
	
}
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
function consVei(pvei){ 
	location.href='gereVen.php?pvei='+pvei+'&conVen=conVei';
}
function consCli(cid){ 
	location.href='gereVen.php?cid='+cid+'&conVen=conCli';
}
function consPro(pid){ 
	location.href='gereVen.php?pid='+pid+'&conVen=conPro';
}


function venTotal(){
	var qtd = document.gereVen.veiTotl.value;
	var uva = document.gereVen.proValo.value;
	var res = qtd*uva;
	document.gereVen.venTota.value = res.toFixed(2);
	calcDesc();
}
function calcTotal(){
	var comp = document.gereVen.veiComp.value;
	var larg = document.gereVen.veiLarg.value;
	var altu = document.gereVen.veiAltu.value;
	var res = comp*larg*altu;
	document.gereVen.veiTota.value = res.toFixed(2);
	document.gereVen.veiTotl.value = res.toFixed(2);
	venTotal();
	calcDesc();
}
function calcDesc(){
	var prec = document.gereVen.venTota.value;
	var desc = document.gereVen.venDesc.value;
	var tota = prec - desc;
	document.gereVen.venConf.value=tota.toFixed(2);
}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body onLoad="venTotal();">
<div><span class="titulo"><strong>Pedido de Venda</strong></span></div>
<hr />
<br />

<strong>DADOS DO PEDIDO(<?= $ped?>)</strong>
<form action="vendCup.php" name="gereVen" id="gereVen" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="cliCp" value="<?= $escCli["CNPJ"]?><?= $escCli["CPF"]?>" />
<input type="hidden" name="pid" value="<?= $escPro["ID"]?>" />
<input type="hidden" name="ped" value="<?= $ped?>" />
<table width="512" align="center">
<tr>
    	<td width="69"></td>
        <td width="80"><strong>Emissao*</strong></td>
        <td width="127"><input type="text" class="input" size="15" value="<?= $day?>" /></td>
        <td width="85"><strong>Faturado por*</strong></td>
        <td width="127"><input name="useNome" type="text" class="input" size="29" value="<?= $usua2?>" readonly="true"/></td>
    </tr>
    <tr>
		<td><strong>1º passo</strong></td>
        <td><strong>Placa*</strong></td>
		<td><input type="text" name="veiPla" id="Placa" size="15" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["PLACA"]?>" onBlur="javascript:consVei(this.value);" /></td>
		<td><div align="right">UF*</div></td>
		<td><input type="text" size="2" name="veiEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["UF"]?>"  readonly="true"></td>
	</tr>
	<tr>
    	<td></td>
        <td>Dimensão*</td>
        <td colspan="4">
        	<table>
            	<tr>
                	<td><div align="center">Compri.</div></td>
                    <td><div align="center">Largura</div></td>
                    <td><div align="center">Altura</div></td>
                    <td>&nbsp;</td>
                    <td><div align="center">Total</div></td>
                </tr>
                <tr>
                	<td><div align="center"><input type="text" name="veiComp" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DCOMP"]?>"/></div></td>
                    <td><div align="center"><input type="text" name="veiLarg" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DLARG"]?>"/></div></td>
                    <td><div align="center"><input type="text" name="veiAltu" size="4" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["DALTU"]?>" /></div></td>
                    <td>&nbsp;</td>
                    <td><div align="center"><input type="text" name="veiTota" size="6" class="input" readonly="true" value="<?= $escVei["DTOTAL"]?>" /></div></td>
                    <td>m<sup>3</sup></td>
                </tr>
            </table>           </td>
    </tr> 
       	<td></td>
        <td>Motorista*</td>
        <td colspan="3"><input type="text" name="veiMot" id="Motorista" size="84" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["MNOME"]?>"></td>
    </tr>
    <?
	//Retira o Selecione de Cliente
	if($escCli["NOME"] == ""){
	?>
    <tr>
    	<td><strong>2º passo</strong></td>
        <td><strong>Cliente*</strong></td>
        <td colspan="3"><select type="text" name="veiCli" id="Cliente" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["NOME"]?>" onChange="consCli(this.value)">
        					<option value="">Selecione</option>
                            <?
							for($i; $i<$total; $i++) {
								$ust = mysql_fetch_array($clivei);
							?>
                            <option value="<?= $ust["ID"]?>"><?= $ust["NOME"]?></option>
                            <?
							}
							?>
                        </select></td>
    </tr>
    <?
	}else{
	?>
    <tr>
    	<td><strong>2º passo</strong></td>
        <td><strong>Cliente*</strong></td>
        <td colspan="3"><input type="text" name="cliNome" id="Nome" size="84" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["NOME"]?>"></td>
    </tr>
    <?
	}
	?>
    <tr>
    	<td></td>
        <td>Endereço*</td>
        <td colspan="3"><input type="text" name="juriEnde" id="Endereco" size="84" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["ENDE"]?>" ></td>
    </tr>
    <tr>
		<td></td>
        <td>Bairro*</td>
		<td><input type="text" name="juriBair" id="juriBairro" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["BAIRR"]?>"></td>
		<td>Cidade*</td>
		<td><input type="text" name="juriCidad" id="juriCidade" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CIDAD"]?>"></td>
	</tr>
    <tr>
		<td></td>
        <td>CEP*</td>
		<td><input type="text" name="juriCep" size="29" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '#####-###')" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["CEP"]?>"></td>
		<td>UF*</td>
		<td><input type="text" size="2" name="juriEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escCli["UF"]?>"></td>
	</tr>
     <?
	//Retira o Selecione do Produto
	if($escPro["ID"] == ""){
	?>
    <tr>
    	<td><strong>3º passo</strong></td>
        <td><strong>Produto*</strong></td>
        <td colspan="3"><select type="text" name="proDes" id="Cliente" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $pro["NOME"]?>" onChange="consPro(this.value)">
        					<option value="">Selecione</option>
                            <?
							for($e; $e<$utotal; $e++) {
								$pro = mysql_fetch_array($uresul);
								?>
                            	<option value="<?= $pro["ID"]?>"><?= $pro["NOME"]?> - <?= $pro["DESR"]?></option>
                            <?
							}
							?>
                        </select>
        </td>
    </tr>
    <?
	}else{
	?>
    <tr>
    	<td><strong>3º passo</strong></td>
        <td><strong>Produto*</strong></td>
        <td colspan="3"><input type="text" name="proNome" id="Nome" size="84" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escPro["NOME"]?> <?= $escPro["DESR"]?>"></td>
    </tr>
    <?
	}
	?>
</table>
<table width="515" align="center">
<tr>
    	<td></td>
  <td width="36">QTD</td>
        <td width="63">VL UNIT</td>
        <td width="114">PRODUTO</td>
        <td width="47"><div align="right">VALOR</div></td>
    </tr>
    <tr>
    	<td></td>
        <td><input type="text" name="veiTotl" size="6" class="input" readonly="true" value="<?= $escVei["DTOTAL"]?>" /></td>
  <td>x <input type="text" name="proValo" size="6" class="input" readonly="true" value="<?= $escPro["PREC"]?>" /></td>
        <td><input type="text" name="proNome" id="Nome" size="50" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escPro["NOME"]?>"></td>
        <td><div align="right"><input type="text" name="venTota" size="6" class="input" readonly="true" /></div></td>
    </tr>
    <tr>
    	<td></td>
  <td colspan="2"><strong>Desconto</strong></td>
        <td></td>
        <td><div align="right"><strong><input type="text" name="venDesc" onChange="calcDesc();" size="6" class="input" /></strong></div></td>
    </tr>
    <tr>
    	<td></td>
  <td colspan="2"><strong>TOTAL</strong></td>
        <td><div align="right"><strong>R$</strong></div></td>
        <td><div align="right"><strong><input type="text" name="venConf" size="6" class="input" readonly="true" /></strong></div></td>
    </tr>
    <tr>
    	<td></td>
  <td colspan="2"><strong>Vencimento*</strong></td>
        <td colspan="2"><div align="right"><strong><input type="text" id="Vencimento" lang="1" name="venVenc" class="input" size="15" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" /></strong></div></td>
    </tr>
</table>
<br /><br />
<div align="center">
<input type="submit" class="botao" value="  EMITIR CUPOM   " /></a>
<input type="button" class="botao" onClick="javascript:history.go(-1);" value="  VOLTAR   " />
<input type="button" class="botao" onClick="javascript:window.print();" value="  IMPRIMIR   " />
</div>
</form>
</body>
</html>
