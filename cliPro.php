<?
require_once("class/Produto.php");


if($_POST[action] == "cadaCliPro"){
	$clipro = new Produto;
	$clipro->setCid($_POST[cid]);
	$clipro->deleCpr();
	$box=$_POST['clipro'];
		while (list ($key,$val) = @each ($box)) { 
			$clipro = new Produto;
			$clipro->setCid($_POST[cid]);
			$clipro->setPid($val);
			$clipro->setNome($_POST["cprNome-$val"]);
			$clipro->setVist($_POST["$val-vista"]);
			$clipro->setPraz($_POST["$val-prazo"]);
			$clipro->setCist($_POST["$val-cvista"]);
			$clipro->setCraz($_POST["$val-cprazo"]);
			$clipro->cadaCliPro();
} 

?>
	<script>
		self.parent.tb_remove();
		window.parent.location.reload();
    </script>	
<?
}

//Listagem de Produtos
$prod = new Produto();
$result = $prod->listProd();
$total = mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
	function fechaJanela(){
		document.cadaCli.submit();
	}
	function cadaPro(cid, pid){ 
		location.href = 'cliPro.php?cid='+cid+'&pid='+pid+'&action=inserir';
		
} 
</script>
</head>

<body>
<form action="<?= $PHP_SELF?>" name="cadaCli" method="post">
<input type="hidden" name="action" value="cadaCliPro" />
<input type="hidden" name="cid" value="<?= $_GET[id]?>" />
<table width="450" cellspacing="0" align="center">
  <tr class="topficha">
   	  <td width="82%"><strong>Listagem de Produtos</strong></td>
      <td width="18%"><div align="right">Fechar <a href="#" onClick="fechaJanela();"><img src="pictures/buttonFecha.gif" border="0" /></a></div></td>
  </tr>
</table>
<table width="100%" cellspacing="0">
	<tr>
   	  <td class="tabsis"><div align="right">&nbsp;</div></td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="67%"><strong>Nome</strong></td>
        <td width="17%"><strong>Antec</strong></td>
        <td width="16%"><strong>D Vista</strong></td>
        <td width="17%"><strong>C Vista</strong></td>
        <td width="16%"><strong>Prazo</strong></td>
        
  </tr>
<? 
for($e; $e<$total; $e++) {
	$pro = mysql_fetch_array($result);
		$busca = new Produto;
		$busca->setCid($_GET[id]);
		$busca->setPid($pro["ID"]);
		$query = $busca->consCliPro();
		$cli = mysql_fetch_array($query);
	if(!($cli == "")){	
		$pro["PRO_VIST"] = $cli["CPR_VIST"];
		$pro["PRO_PRAZ"] = $cli["CPR_PRAZ"];
		$pro["PRO_CVIS"] = $cli["CPR_CVIS"];
		$pro["PRO_CPRA"] = $cli["CPR_PRAZ"];
	}
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}

?>

  <tr bgcolor="<?= $cor?>">
        <td><input type="checkbox" name="clipro[]"  value="<?= $pro["ID"]?>" <? if($pro["ID"] == $cli["PID"]){ echo "checked=\"checked\"";}?> /><?= $pro["PRO_NOME"]?><input type="hidden" name="cprNome-<?= $pro["ID"]?>" value="<?= $pro["PRO_NOME"]?>"</td>
        <td>R$ <input type="text" name="<?= $pro["ID"]?>-vista" class="input" size="6" value="<?= $pro["PRO_VIST"]?>" /></td>
        <td>R$ <input type="text" name="<?= $pro["ID"]?>-prazo" class="input" size="6" value="<?= $pro["PRO_PRAZ"]?>" /></td>
        <td>R$ <input type="text" name="<?= $pro["ID"]?>-cvista" class="input" size="6" value="<?= $pro["PRO_CVIS"]?>" /></td>
        <td>R$ <input type="text" name="<?= $pro["ID"]?>-cprazo" class="input" size="6" value="<?= $pro["PRO_CPRA"]?>" /></td>
        
<?
}
?>
  </tr>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right">&nbsp; </div></td>
  </tr>
</table>
</form>
</body>
</html>