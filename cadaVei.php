<?
require_once("class/Veiculo.php");

$action = $_GET[action];

//Consulta
$ved = new Veiculo;
$ved->setVid($_GET[vid]);
$vresul = $ved->consVei();
$vtotal = mysql_num_rows($vresul);
$escVei = mysql_fetch_array($vresul);


//Insert
if($_POST[action] == "insert"){
	
	$date = date("Y-m-d");  
	
	$vei = new Veiculo;
	$vei->setData($date);
	$vei->setPlaca($_POST[veiPla]);
	$vei->setUf($_POST[veiEsta]);
	$vei->setMarca($_POST[veiMarca]);
	$vei->setModelo($_POST[veiMode]);
	$vei->setAno($_POST[veiAno]);
	$vei->setTipo($_POST[veiTipo]);
	$vei->setCor($_POST[veiCor]);
	$vei->setComp($_POST[veiComp]);
	$vei->setLarg($_POST[veiLarg]);
	$vei->setAltu($_POST[veiAltu]);
	$vei->setTabu($_POST[veiTabu]);
	$vei->setDescoc($_POST[veiDcom]);
	$vei->setDescos($_POST[veiDsem]);
	$vei->setTotalc($_POST[veiTcom]);
	$vei->setTotals($_POST[veiTsem]);
	$vei->setMome($_POST[veiMot]);
	$vei->setCpf($_POST[motCpf]);
	$vei->setRg($_POST[motRg]);
	$vei->setDddt($_POST[motTddd]);
	$vei->setTel($_POST[motTel]);
	$vei->setDddc($_POST[motCddd]);
	$vei->setCel($_POST[motCel]);
	$vei->setNex($_POST[motNex]);
	$vei->cadaVei();
	?>
	<script>
		alert('VEÍCULO CADASTRADO COM SUCESSO');
		
		var answer = confirm("DESEJA CADASTRAR UM CLIENTE AGORA ??")
		if (answer){
			location.href = 'gereVei.php';
		}else{
			location.href = 'gereJur.php';
		}
	</script>
    <?
}

//Update
if($_POST[action] == "update"){
	
	$date = date("Y-m-d");
	
	
	$vei = new Veiculo;
	$vei->setVid($_POST[vid]);
	$vei->setData($date);
	$vei->setPlaca($_POST[veiPla]);
	$vei->setUf($_POST[veiEsta]);
	$vei->setMarca($_POST[veiMarca]);
	$vei->setModelo($_POST[veiMode]);
	$vei->setAno($_POST[veiAno]);
	$vei->setTipo($_POST[veiTipo]);
	$vei->setCor($_POST[veiCor]);
	$vei->setComp($_POST[veiComp]);
	$vei->setLarg($_POST[veiLarg]);
	$vei->setAltu($_POST[veiAltu]);
	$vei->setTabu($_POST[veiTabu]);
	$vei->setDescoc($_POST[veiDcom]);
	$vei->setDescos($_POST[veiDsem]);
	$vei->setTotalc($_POST[veiTcom]);
	$vei->setTotals($_POST[veiTsem]);
	$vei->setMome($_POST[veiMot]);
	$vei->setCpf($_POST[motCpf]);
	$vei->setRg($_POST[motRg]);
	$vei->setDddt($_POST[motTddd]);
	$vei->setTel($_POST[motTel]);
	$vei->setDddc($_POST[motCddd]);
	$vei->setCel($_POST[motCel]);
	$vei->setNex($_POST[motNex]);
	$vei->updateVeiculo();
	?>
	<script>
		alert('VEÍCULO ALTERADO COM SUCESSO');
		location.href = 'gereVei.php';
	</script>
    <?
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
}
</script>
</head>

<body>
<form action="<?= $PHP_SELF?>" name="formVei" method="post">
<input type="hidden" name="action" value="<?= $action?>" />
<input type="hidden" name="vid" value="<?= $_GET[vid]?>" />
<div class="titulo"><strong>Adicionar Veículo</strong></div>
<table width="530" align="center" class="tabsis">
	<tr>
    	<td width="255">
        <strong>Dados do Veículo</strong>
        <table>
    	  <tr>
    	    <td width="34">Placa</td>
    	    <td width="126"><input type="text" name="veiPla" id="Placa" size="29" maxlength="7" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_PLAC"]?>" /></td>
            <td width="21"><strong>UF*</strong></td>
		<td width="50"><select name="veiEsta" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_ESTA"]?>">
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
    	  <tr>
    	    <td>Marca</td>
    	    <td><select name="veiMarca" class="input">
    	      <option>Selecione</option>
               <option value="Chevrolet"<? if($escVei["VEI_MARC"] == "Chevrolet") echo"selected"?>>Chevrolet</option>
 				<option value="Fiat"<? if($escVei["VEI_MARC"] == "Fiat") echo"selected"?>>Fiat</option>
 				<option value="Ford"<? if($escVei["VEI_MARC"] == "Ford") echo"selected"?>>Ford</option>
 				<option value="Iveco"<? if($escVei["VEI_MARC"] == "Iveco") echo"selected"?>>Iveco</option>
 				<option value="Kia"<? if($escVei["VEI_MARC"] == "Kia") echo"selected"?>>Kia</option>
				 <option value="Mercedes-Benz"<? if($escVei["VEI_MARC"] == "Mercedes-Benz") echo"selected"?>>Mercedes-Benz</option>
 				<option value="Scania"<? if($escVei["VEI_MARC"] == "Scania") echo"selected"?>>Scania</option>
 				<option value="Volvo"<? if($escVei["VEI_MARC"] == "Volvo") echo"selected"?>>Volvo</option>
 				<option value="VW"<? if($escVei["VEI_MARC"] == "VW") echo"selected"?>>VW</option>
  	      </select></td>
  	    </tr>
    	 
 		<tr>
    	    <td>Modelo</td>
    	    <td><input type="text" name="veiMode" id="Modelo" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_MODE"]?>" /></td>
  	    </tr>
        <tr>
    	    <td>Ano</td>
    	    <td><input type="text" name="veiAno" id="Ano" size="29" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" value="<?= $escVei["VEI_ANOV"]?>" /></td>
  	    </tr>           
  <tr>
    	    <td>Tipo</td>
    	    <td><select name="veiTipo" class="input">
    	      <option>Selecione</option>
              <option value="Carreta"<? if($escVei["VEI_TIPO"] == "Carreta") echo"selected"?>>Carreta</option>
              <option value="Carroça"<? if($escVei["VEI_TIPO"] == "Carroça") echo"selected"?>>Carroça</option>
              <option value="Truck"<? if($escVei["VEI_TIPO"] == "Truck") echo"selected"?>>Truck</option>
              <option value="Toco"<? if($escVei["VEI_TIPO"] == "Toco") echo"selected"?>>Toco</option>
              <option value="Utilitário"<? if($escVei["VEI_TIPO"] == "Utilitário") echo"selected"?>>Utilitário</option>
              
  	      </select></td>
  	    </tr>
    	  <tr>
    	    <td>Cor</td>
    	    <td><select name="veiCor" class="input">      
    	      <option>Selecione</option>
              <option value="Amarelo"<? if($escVei["VEI_COR"] == "Amarelo") echo"selected"?>>Amarelo</option>
              <option value="Azul"<? if($escVei["VEI_COR"] == "Azul") echo"selected"?>>Azul</option>
              <option value="Bege"<? if($escVei["VEI_COR"] == "Bege") echo"selected"?>>Bege</option>
              <option value="Branco"<? if($escVei["VEI_COR"] == "Branco") echo"selected"?>>Branco</option>
              <option value="Prata"<? if($escVei["VEI_COR"] == "Prata") echo"selected"?>>Prata</option>
              <option value="Preta"<? if($escVei["VEI_COR"] == "Preta") echo"selected"?>>Preta</option>
              <option value="Vermelho"<? if($escVei["VEI_COR"] == "Vermelho") echo"selected"?>>Vermelho</option>
              <option value="Verde"<? if($escVei["VEI_COR"] == "Verde") echo"selected"?>>Verde</option>
              <option value="Cinza"<? if($escVei["VEI_COR"] == "Cinza") echo"selected"?>>Cinza</option>
              <option value="Roxo"<? if($escVei["VEI_COR"] == "Roxo") echo"selected"?>>Roxo</option>
              <option value="Rosa"<? if($escVei["VEI_COR"] == "Rosa") echo"selected"?>>Rosa</option>
  	      </select></td>
  	    </tr>
  	  </table></td>
        <td width="235"><table align="right">
          <tr>
            <td width="46">Dimensão</td>
            <td width="149"><table>
              <tr>
                <td><div align="center">Compri.</div></td>
                <td><div align="center">Largura</div></td>
                <td><div align="center">Altura</div></td>
                <td><div align="center">Tábua</div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiComp" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_COMP"]?>" size="4" xml:lang="1" />
                </div></td>
                <td><div align="center">
                  <input name="veiLarg" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_LARG"]?>" size="4" xml:lang="1" />
                </div></td>
                <td><div align="center">
                  <input name="veiAltu" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_ALTU"]?>" size="4" xml:lang="1" />
                </div></td>
                 <td><div align="center">
                  <input name="veiTabu" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TABU"]?>" size="4" xml:lang="1" />
                </div></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>Desconto</td>
            <td><table>
              <tr>
                <td><div align="center"><strong>c/Tábua</strong></div></td>
                <td>&nbsp;</td>
                <td><div align="center"><strong>s/Tábua</strong></div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiDcom" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_DCOM"]?>" size="4" xml:lang="1" />
                </div></td>
                <td>&nbsp;</td>
                <td><div align="center">
                  <input name="veiDsem" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_DSEM"]?>" size="4" xml:lang="1" />
                </div></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>Total</td>
            <td><table>
              <tr>
                <td><div align="center"><strong>c/Tábua</strong></div></td>
                <td>&nbsp;</td>
                <td><div align="center"><strong>s/Tábua</strong></div></td>
              </tr>
              <tr>
                <td><div align="center">
                  <input name="veiTcom" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TCOM"]?>" size="4" xml:lang="1" readonly />
                </div></td>
                <td>&nbsp;</td>
                <td><div align="center">
                 <input name="veiTsem" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onChange="calcTotal();" value="<?= $escVei["VEI_TSEM"]?>" size="4" xml:lang="1" readonly />
                </div></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
</table>
<br />
<table width="530" align="center" class="tabsis">
<tr>
<td>
<strong>Dados do Motorista</strong><br />
<table width="492" align="left">
  <tr>
    <td><strong>Nome*</strong></td>
    <td colspan="3"><input name="veiMot" type="text" class="input" id="Motorista" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyUp="upperCase(this.id)" value="<?= $escVei["VEI_NOME"]?>" size="87" xml:lang="1" /></td>
  </tr>
  <tr>
    <td><strong>CPF*</strong></td>
    <td><input name="motCpf" type="text" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyPress="formatar_mascara(this, '###.###.###-##')" value="<?= $escVei["VEI_CPF"]?>" size="29"  maxlength="14" xml:lang="1" /></td>
    <td>RG</td>
    <td><input type="text" name="motRg" size="29" class="input" value="<?= $escVei["VEI_RG"]?>" /></td>
  </tr>
  <tr>
    <td>Tel</td>
    <td><input type="text" name="motTddd" size="2" maxlength="2" class="input" value="<?= $escVei["VEI_TDDD"]?>" />
      <input type="text" name="motTel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escVei["VEI_TELE"]?>" /></td>
    <td>Cel</td>
    <td><input type="text" name="motCddd" size="2" maxlength="2" class="input" value="<?= $escVei["VEI_CDDD"]?>" />
      <input type="text" name="motCel" size="20" maxlength="9" class="input" onKeyPress="formatar_mascara(this, '####-####')" value="<?= $escVei["VEI_CELU"]?>" /></td>
  </tr>
  <tr>
    <td>ID</td>
    <td><input type="text" name="motNex" size="20" maxlength="9" class="input" value="<?= $escVei["VEI_NEXT"]?>" /></td>
    <td></td>
    <td></td>
  </tr>
</table>
</td>
</tr>
</table><br /><br />
<table align="center">
<tr>
	<td><input type="submit" class="botao" value="  Salvar  " /></td>
    <td><input type="reset" class="botao" value="  Limpar  " /></td>
</tr>
</table>
</form>
</body>
</html>