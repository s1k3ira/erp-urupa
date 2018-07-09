<?
session_start();
require_once("class/Faturamento.php");
require_once("class/Despesa.php");

if($_GET[action] == "deleProd"){
	$pid = $_GET[pid];
	
	$prod = new Despesa();
	$prod->deleProd($pid);
}

$dia = date("Y-m-d");//Pega data do Servidor
$di = date("d-m-Y");
$hou = date("G:i:s");

if($_GET[dia] == ""){
	$dia = date("Y-m-d");//Pega data do Servidor	
}else{
	list($d, $m, $y) = explode("-",$_GET[dia]);
	$dia = "$y-$m-$d";
}

list($d, $m, $y) = explode("-",$dia);
	$dip = "$y-$m-$d";

if($_POST[action] == "Emitir Despesa"){
	$des = new Despesa();
	$des->setTip($_POST[tip]);
	$des->setPid($_POST[destip]);
	$des->setDes($_POST[desDes]);
	$des->setDat($dia);
	$des->setHou($hou);
	$des->setUse($_SESSION[user]);
	$des->setVal($_POST[desVal]);
	$des->cadaDespe();
	?>
    <script>
		location.href='gereDes.php';
    </script>
	<?	
	
}


$cpro = new Despesa();
	$busPro = $cpro->listTdesp();
	$totalp = mysql_num_rows($busPro);

//Buscar a Vista
$cuv = new Despesa();
$cpoV = $cuv->desDia($dia);
$totalv = mysql_num_rows($cpoV);
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
	function listarDia(dia){
		location.href='gereDes.php?dia='+dia+'';
	}
	
	function deletaPro(id, nome){		
		if(confirm('Deseja deletar a despesa '+nome+' ?')){
			location.href='gereDes.php?action=deleProd&pid='+id+'';
		}
	}
</script>
<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="<?= $PHP_SELF?>" name="listaCli" method="post" onSubmit="return validaForm(this)">
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="65%" height="25" class="tabsis"><strong>Despesa do dia 
   	      <input type="text" class="input" id="Dia" lang="1" name="fatDia" size="9" value="<?= $dip?>" maxlength="10" onKeyPress="formatar_mascara(this, '##-##-####')" onChange="listarDia(this.value)"  /></strong></div></td>
      <td width="31%" class="tabsis">&nbsp;</td>
      <td width="4%" class="tabsis" align="right"><a href="#" onClick="javascript:window.print();" ><img src="pictures/ic_impressao.gif" border="0" /></a></td>
  </tr>
</table>
<br /></br>
<table align="center" cellpadding="0" cellspacing="0">
	<tr class="tabsis">
    	<td>Tipo:</td><td><select type="text" name="destip" id="destip" class="input" lang="1" onfocus="mudarCorCampo(this,'white')" value="<?= $pro["TDE_NOME"]?>" onchange="consPro(document.formVei.veiPla.value, document.formVei.veiCli.value, this.value)">
    	  <option value="">Selecione</option>
    	  <?
							for($e; $e<$totalp; $e++) {
								$pro = mysql_fetch_array($busPro);
								?>
    	  <option value="<?= $pro["TDE_NOME"]?>"<? if($_GET["pid"] == $pro["ID"]) echo"selected"?>>
    	    <?= $pro["TDE_NOME"]?>
   	      </option>
    	  <?
							}
							?>
    </select></td>
        <td>Descrição:</td><td><input name="desDes" type="text" size="50" class="input" onKeyUp="upperCase(this.id)" id="desDes" lang="1" /></td>
        <td>R$:</td>
        <td><input name="desVal" id="desVal" lang="1" type="text" size="20" class="input" /></td>
        <td></td><td><input type="submit" name="action" value="Emitir Despesa" class="botao" /></td>
    </tr>
</table>
<br /></br>
<table width="100%" cellpadding="0" cellspacing="0">
<tr class="tabescu"> 
        <td width="18%"><strong>Tipo</strong></td>
        <td width="25%"><strong>Descrição</strong></td>
        <td width="11%"><strong>Data</strong></td>
        <td width="10%"><strong>Hora</strong></td>
        <td width="16%"><strong>Emitido</strong></td>
        <td width="17%" align="right"><strong>Valor</strong></td>
         <td width="3%" align="right"><strong>Ação</strong></td>
    </tr>
<? 
for($v = 0; $v<$totalv; $v++) {
	$cupv = mysql_fetch_array($cpoV);
	$fatTotv = $fatTotv + $cupv["DES_VALO"];
	$fatTotv = number_format($fatTotv, 2, '.', '');
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $cupv["DES_TIPO"]?></td>
        <td><?= $cupv["DES_DESC"]?></td>
        <td><? list($d, $m, $y) = explode("-", $cupv["DES_DATA"]); $pag = "$y-$m-$d"; echo $pag; ?></td>
        <td><?= $cupv["DES_HORA"]?></td>
        <td><?= $cupv["DES_USER"]?></td>
        <td align="right">R$ <?= number_format($cupv["DES_VALO"], 2, '.', '');?></td>
       <td align="center"><a href="#" onClick="deletaPro('<?= $cupv[ID]?>', '<?= $cupv["DES_DESC"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
    </tr>
<?
}
?>
<tr class="tabsis">
        <td colspan="5" align="right"><strong>Total </strong></td>
        <td width="17%" align="right"><strong>R$ <?= number_format($fatTotv, 2, '.', '');?></strong></td>
        <td>&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>