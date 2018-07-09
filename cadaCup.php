<?
session_start();
require_once("logaut.php");
if(!($_GET[tab] == "")){
	$_SESSION[tab] = $_GET[tab];
}

if(!($_GET[paga] == "")){
	$_SESSION[paga] = $_GET[paga];
}

require_once("class/Veiculo.php");
require_once("class/Cliente.php");
require_once("class/classCupom.php");

//Pega o Max ID
$cup = new Cupom();
$cupM = $cup->cupMax();
$cupMa = mysql_fetch_array($cupM);
$ped = $cupMa[0] + 1;

$day = date("d-m-Y");//Pega data do Servidor

if(!($_GET["pvei"] == "")){
	$conVei = new Veiculo();
	$conVei->setPlaca($_GET[pvei]);
	$fiVei = $conVei->veiPlaca();
	$totalli = mysql_num_rows($fiVei);
	if($totalli == ""){
		?>
		<script>
			alert('Veiculo nao Cadastrado');
			location.href='cadaCup.php';
	    </script>
        <?
	}else{	
		$escVei = mysql_fetch_array($fiVei);
		$cei = new Cliente();
		$cei->setVid($escVei["ID"]);
		$clivei = $cei->cliVei();
		$total = mysql_num_rows($clivei);
		$_SESSION["vid"] =  $escVei["ID"];
	}
	
if(!($_GET[cid] == "")){
	$cid = new Cliente();
	$cid->setId($_GET[cid]);
	$query = $cid->consCli();
	$cli = mysql_fetch_array($query);
	
	$cpro = new Produto();
	$cpro->setCid($_GET[cid]);
	$busPro = $cpro->listPid();
	$totalp = mysql_num_rows($busPro);
if(!($_GET[pid] == "")){
	$val = new Produto();
	$val->setId($_GET[pid]);
	$produto = $val->busPro();
	$prod = mysql_fetch_array($produto);
}
	
}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/formValid.js"></script>
<script>
function qtdTota(act){
	if(act == '1'){
		var com =  new Number(document.formVei.veiTcom.value);
		document.formVei.veiTotl.value = com;
		document.formVei.veiTotl.checked;
	}
	if(act == '2'){
		var sem =  new Number(document.formVei.veiTsem.value);
		document.formVei.veiTotl.value = sem;
		document.formVei.veiTotl.checked;
	}	
	venTotal();
}

function calcTotal(){
	var comp = new Number(document.formVei.veiComp.value);
	var larg = new Number(document.formVei.veiLarg.value);
	var altu = new Number(document.formVei.veiAltu.value);
	var tabu = new Number(document.formVei.veiTabu.value);
	
	var desc = new Number(document.formVei.veiDcom.value);
	var dess = new Number(document.formVei.veiDsem.value);
	
	var resc = (comp*larg*(altu+tabu)) - (desc);
	var ress = (comp*larg*altu) - (dess);
	
	document.formVei.veiTcom.value = resc.toFixed(2);
	document.formVei.veiTsem.value = ress.toFixed(2);
	
	
		if(document.formVei.veiTab[0].checked){
			var act = new Number(document.formVei.veiTab[0].value);	
		}
		if(document.formVei.veiTab[1].checked){
			var act = new Number(document.formVei.veiTab[1].value);
		}
	
	
	qtdTota(act);
	venTotal();
	
}

function valor(valo){
	calcTotal();
	
	var indice = document.formVei.proDes.selectedIndex;
	var produt = document.formVei.proDes[indice].text;
	
	document.formVei.proValo.value = valo;
	document.formVei.proNome.value = produt;
	
	venTotal();
	
}

function calcDesc(){
	var prec = document.formVei.venTota.value;
	var desc = document.formVei.venDesc.value;
	var tota = prec - desc;
	document.formVei.venConf.value=tota.toFixed(2);
}

function venTotal(){
	var qtd = document.formVei.veiTotl.value;
	var uva = document.formVei.proValo.value;
	var res = qtd*uva;
	document.formVei.venTota.value = res.toFixed(2);
	calcDesc();
}



function consVei(pvei){ 
	location.href='cadaCup.php?pvei='+pvei+'';
}

function consCli(pvei, cliid){
		if(document.formVei.veiTab[0].checked){
			var tab = new Number(document.formVei.veiTab[0].value);	
		}
		if(document.formVei.veiTab[1].checked){
			var tab = new Number(document.formVei.veiTab[1].value);
		} 
	location.href='cadaCup.php?pvei='+pvei+'&cid='+cliid+'&tab='+tab+'';
}

function consPro(pvei, cliid, proid){ 
		if(document.formVei.veiTab[0].checked){
			var tab = new Number(document.formVei.veiTab[0].value);	
		}
		if(document.formVei.veiTab[1].checked){
			var tab = new Number(document.formVei.veiTab[1].value);
		} 
	location.href='cadaCup.php?pvei='+pvei+'&cid='+cliid+'&pid='+proid+'&tab='+tab+'';
}

function carrCampo(){
	var indice = document.formVei.veiCli.selectedIndex;
	var produt = document.formVei.veiCli[indice].text;
	
	document.formVei.cliNo.value = produt;
}


</script>
<style type="text/css">
<!--
#jurDados table tr td table {
	text-align: left;
}
-->
</style>
</head>

<body onLoad="carrCampo();">
<form action="imprCup.php" name="formVei" method="post" onSubmit="return validaForm(this)">
<div id="jurMenu"><strong>&nbsp;Dados de Emissão</strong></div>
<div id="jurDados">
<table width="100%">
	<tr>
        <td width="47%"><div align="left"><strong>Emissão</strong> <?= $day?></div></td>
        <td width="53%"><div align="right"><strong>Faturado por</strong><span class="tabsis">
          <?= $_SESSION[user]?>
        </span></div></td>
    </tr>
</table>
</div>
<br />
<div id="jurMenu"><strong>&nbsp;Dados do Cupom</strong></div>
<div id="jurDados">
      <table width="100%">
      <tr>
      <td width="50%">
        <table>
    	  <tr>
          	<td width="126"><strong>NC: <?= $ped;?></strong></td>
          </tr>
          <tr>
            <td width="33"><strong>Placa*</strong></td>
    	    <td width="126"><input type="text" name="veiPla" id="Placa" size="15" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_PLAC"]?>" onBlur="javascript:consVei(this.value);" /></td>
            <td width="21">UF</td>
		<td width="54"><select name="veiEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_ESTA"]?>">
		    	<option value=""></option>
				<option value="AC"<? if($escVei["VEI_ESTA"] == "AC") echo"selected"?>>AC</option>
				<option value="AL"<? if($escVei["VEI_ESTA"] == "AL") echo"selected"?>>AL</option>
				<option value="AM"<? if($escVei["VEI_ESTA"] == "AM") echo"selected"?>>AM</option>
				<option value="AP"<? if($escVei["VEI_ESTA"] == "AP") echo"selected"?>>AP</option>
				<option value="BA"<? if($escVei["VEI_ESTA"] == "BA") echo"selected"?>>BA</option>
				<option value="CE"<? if($escVei["VEI_ESTA"] == "CE") echo"selected"?>>CE</option>
				<option value="DF"<? if($escVei["VEI_ESTA"] == "DF") echo"selected"?>>DF</option>
				<option value="ES"<? if($escVei["VEI_ESTA"] == "ES") echo"selected"?>>ES</option>
				<option value="GO"<? if($escVei["VEI_ESTA"] == "GO") echo"selected"?>>GO</option>
				<option value="MA"<? if($escVei["VEI_ESTA"] == "MA") echo"selected"?>>MA</option>
				<option value="MG"<? if($escVei["VEI_ESTA"] == "MG") echo"selected"?>>MG</option>
				<option value="MS"<? if($escVei["VEI_ESTA"] == "MS") echo"selected"?>>MS</option>
				<option value="MT"<? if($escVei["VEI_ESTA"] == "MT") echo"selected"?>>MT</option>
				<option value="PA"<? if($escVei["VEI_ESTA"] == "PA") echo"selected"?>>PA</option>
				<option value="PB"<? if($escVei["VEI_ESTA"] == "PB") echo"selected"?>>PB</option>
				<option value="PE"<? if($escVei["VEI_ESTA"] == "PE") echo"selected"?>>PE</option>
				<option value="PI"<? if($escVei["VEI_ESTA"] == "PI") echo"selected"?>>PI</option>
				<option value="PR"<? if($escVei["VEI_ESTA"] == "PR") echo"selected"?>>PR</option>
				<option value="RJ"<? if($escVei["VEI_ESTA"] == "RJ") echo"selected"?>>RJ</option>
				<option value="RN"<? if($escVei["VEI_ESTA"] == "RN") echo"selected"?>>RN</option>
				<option value="RO"<? if($escVei["VEI_ESTA"] == "RO") echo"selected"?>>RO</option>
				<option value="RR"<? if($escVei["VEI_ESTA"] == "RR") echo"selected"?>>RR</option>
				<option value="RS"<? if($escVei["VEI_ESTA"] == "RS") echo"selected"?>>RS</option>
				<option value="SC"<? if($escVei["VEI_ESTA"] == "SC") echo"selected"?>>SC</option>
				<option value="SE"<? if($escVei["VEI_ESTA"] == "SE") echo"selected"?>>SE</option>
				<option value="SP"<? if($escVei["VEI_ESTA"] == "SP") echo"selected"?>>SP</option>
				<option value="TO"<? if($escVei["VEI_ESTA"] == "TO") echo"selected"?>>TO</option>
			</select>		</td>
  	    </tr>
  	  </table>
<table width="395">
          <tr>
            <td width="60">Dimensão</td>
            <td width="323"><table>
              <tr>
                <td><div align="center">Compri.</div></td>
                <td><div align="center">Largura</div></td>
                <td><div align="center">Altura</div></td>
                <td><div align="center">Tábua</div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiComp" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_COMP"]?>" size="4" xml:lang="1" readonly />
                </div></td>
                <td><div align="center">
                  <input name="veiLarg" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_LARG"]?>" size="4" xml:lang="1" readonly />
                </div></td>
                <td><div align="center">
                  <input name="veiAltu" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_ALTU"]?>" size="4" xml:lang="1" />
                </div></td>
                 <td><div align="center">
                  <input name="veiTabu" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TABU"]?>" size="4" xml:lang="1" />
                </div></td>
              </tr>
            </table>
            </td>
          </tr>
          </table>
          <table width="392">
          <tr>
            <td width="60">Desconto</td>
            <td width="100"><table>
              <tr>
                <td><div align="center">c/Tábua</div></td>
                <td>&nbsp;</td>
                <td><div align="center">s/Tábua</div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiDcom" type="text" class="input" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_DCOM"]?>" size="4" xml:lang="1"  />
                </div></td>
                <td>&nbsp;</td>
                <td><div align="center">
                  <input name="veiDsem" type="text" class="input" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_DSEM"]?>" size="4" xml:lang="1"  />
                </div></td>
               
              </tr>
            </table></td>
            <td width="216" rowspan="2"><table width="100%">
  <tr class="tabescu" align="center"> 
        <td width="19%"><strong>Com Tábua</strong></td>
        <td width="19%"><strong>Sem Tábua</strong></td>
  </tr>
  <tr align="center">   
        <td><input type="radio" name="veiTab" id="1" value="1" onClick="javascript:qtdTota(this.value);" <? if($_SESSION[tab] == "1") echo"checked"?> /></td>
        <td><input type="radio" name="veiTab" id="2" value="2" onClick="javascript:qtdTota(this.value);" <? if($_SESSION[tab] == "2") echo"checked"?> /></td>
  </tr>
</table></td>
          </tr>
          <tr>
            <td>Total</td>
            <td><table>
              <tr>
                <td><div align="center">c/Tábua</div></td>
                <td>&nbsp;</td>
                <td><div align="center">s/Tábua</div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiTcom" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TCOM"]?>" size="4" xml:lang="1" readonly />
                </div></td>
                <td>&nbsp;</td>
                <td><div align="center">
                 <input name="veiTsem" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TSEM"]?>" size="4" xml:lang="1" readonly />
                </div></td>
              
              </tr>
            </table> 
</table>

<table width="396">
  <tr>
    <td width="39">Nome</td>
    <td colspan="3"><input name="veiMot" type="text" class="input" id="Motorista" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyUp="upperCase(this.id)" value="<?= $escVei["VEI_NOME"]?>" size="75" xml:lang="1" /></td>
  </tr>
  <tr>
    <td>CPF</td>
    <td width="152"><input name="motCpf" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyPress="formatar_mascara(this, '###.###.###-##')" value="<?= $escVei["VEI_CPF"]?>" size="29"  maxlength="14" xml:lang="1" /></td>
    <td width="21">RG</td>
    <td width="164"><input type="text" name="motRg" size="29" class="input" value="<?= $escVei["VEI_RG"]?>" /></td>
  </tr>
</table>
	</td>
    <td width="50%">
    	<table>
         <tr>
        <td><strong>Cliente*</strong></td>
        <td colspan="3"><select type="text" name="veiCli" id="veiCli" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["CLI_NOME"]?>" onChange="consCli(document.formVei.veiPla.value, this.value)">
        					<option value="">Selecione</option>
                            <?
							for($i; $i<$total; $i++) {
								$ust = mysql_fetch_array($clivei);
							?>
                            <option value="<?= $ust["CID"]?>"<? if($_GET["cid"] == $ust["CID"]) echo"selected"?>><?= $ust["CLI_NOME"]?></option>
                            <?
							}
							?>
                        </select></td>
    </tr>
    </table>
    	<br />
    	
    <table width="390">
              <tr>
                    <td width="53">Logadouro</td>
                    <td colspan="3"><input class="input"  type="text" size="68"  onKeyUp="upperCase(this.id)"  id="cliLoga" name="cliLoga" value="<?= $cli["CLI_LOGA"]?>" /></td>
                </tr>
                <tr>
                    <td>Bairro</td>
                    <td width="106"><input class="input"  type="text"  onKeyUp="upperCase(this.id)"  id="cliBair" name="cliBair" value="<?= $cli["CLI_BAIR"]?>" /></td>
                    <td width="62">CEP</td>
                    <td width="149"><input class="input"  type="text"  id="cliCep" name="cliCep" value="<?= $cli["CLI_CEP"]?>" maxlength="9" onKeyPress="formatar_mascara(this, '#####-###')" /></td>
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
                    <td colspan="2"><textarea class="input" rows="5" cols="35" onKeyUp="upperCase(this.id)" id="cliObse" name="cliObse" value="<?= $cli["CLI_OBSE"]?>" ><?= $cli["CLI_OBSE"]?></textarea></td>
                	<td width="62">Forma de Pagamento</td>
                    <td width="149"><input type="text" name="cliForma" value="<?= $cli["CLI_PAGA"]?>" class="input" onKeyUp="upperCase(this.id)" id="cliForma" />
                    	
                    </td>
                </tr>
		</table>
         <table>
            <tr>
    	
        <td><strong>Produto*</strong></td>
        <td colspan="3"><select type="text" name="proDes" id="proDes" class="input" lang="this.value" onFocus="mudarCorCampo(this,'white')" value="<?= $pro["CPR_NOME"]?>" onChange="consPro(document.formVei.veiPla.value, document.formVei.veiCli.value, this.value)">
        					<option value="">Selecione</option>
                            <?
							for($e; $e<$totalp; $e++) {
								$pro = mysql_fetch_array($busPro);
								?>
                            	<option value="<?= $pro["ID"]?>"<? if($_GET["pid"] == $pro["ID"]) echo"selected"?>><?= $pro["CPR_NOME"]?></option>
                            <?
							}
							?>
                        </select>
        </td>
    </tr>
    </table>
    <table width="100%">
  <tr class="tabescu" align="center"> 
        <td width="19%"><strong>Antec</strong></td>
        <td width="19%"><strong>D Vista</strong></td>
        <td width="19%"><strong>C Vista</strong></td>
        <td width="19%"><strong>Prazo</strong></td>
  </tr>
  <tr align="center">   
        <td><input type="radio" name="proTip" id="proDvis" value="<?= $prod["CPR_VIST"]?>" onClick ="valor(this.value)" /></td>
        <td><input type="radio" name="proTip" id="proDpra" value="<?= $prod["CPR_PRAZ"]?>" onClick ="valor(this.value)"  /></td>
        <td><input type="radio" name="proTip" id="proCvis" value="<?= $prod["CPR_CVIS"]?>" onClick ="valor(this.value)"  /></td>
        <td><input type="radio" name="proTip" id="proCpra" value="<?= $prod["CPR_CPRA"]?>" onClick ="valor(this.value)"  /></td>
  </tr>
</table>
    </td>
</tr>
</table>
</div>
<br />
<div id="jurMenu"><strong>&nbsp;Fechamento</strong></div>
<div id="jurDados">
<table width="797">
	<tr>
    <td width="528">
<table width="528">
<tr>
   	  <td width="36">QTD</td>
        <td width="63">VL UNIT</td>
        <td width="114">PRODUTO</td>
        <td width="47"><div align="right">VALOR</div></td>
    </tr>
    <tr>
    	<td><input type="text" name="veiTotl" size="10" class="input" onChange="calcTotal();" /></td>
  <td><input type="text" name="proValo" id="proValo" size="10" class="input" readonly value="<?= $escPro["PREC"]?>" /></td>
        <td><input type="text" name="proNome" id="proNome" size="50" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value=""></td>
        <td><div align="right"><input type="text" name="venTota" size="10" class="input" readonly /></div></td>
    </tr>
    <tr>
   	  <td colspan="2"><strong>Desconto</strong></td>
        <td></td>
        <td><div align="right"><strong><input type="text" name="venDesc" onChange="calcDesc();" size="10" class="input" /></strong></div></td>
    </tr>
    <tr>
   	  <td colspan="2"><strong>TOTAL</strong></td>
        <td><div align="right"><strong>R$</strong></div></td>
        <td><div align="right"><strong><input type="text" name="venConf" size="10" class="input" readonly /></strong></div></td>
    </tr>
    <tr>
   	  <td colspan="2"><strong>Vencimento*</strong></td>
        <td colspan="2"><div align="right"><strong><input type="text" id="Vencimento" lang="1" name="venVenc" class="input" size="15" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" /></strong></div></td>
    </tr>
</table>
</td>
<td width="257">
<div align="center">
<input type="submit" value="Emitir Cupom" class="botao" />
<br />
<br />
<input type="reset" value="Limpar" class="botao" />
</div>
</td>
</tr>
</table>
</div>
<input type="hidden" name="cid" value="<?= $_GET[cid]?>" />
<input type="hidden" name="vid" value="<?= $_SESSION[vid]?>" />
<input type="hidden" name="pid" value="<?= $_GET[pid]?>" />
<input type="hidden" name="uid" value="<?= $_SESSION[uid]?>" />
<input type="hidden" name="cliNo" id="cliNo"/>
</form>
</body>
</html>