<?
require_once("class/Despesa.php");

if($_GET[action] == "deleProd"){
	$pid = $_GET[pid];
	
	$prod = new Despesa();
	$prod->deleProd($pid);
}

//Listagem de Produtos
$prod = new Despesa();
$result = $prod->listTdesp();
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
	function deletaPro(id, nome){		
		if(confirm('Deseja deletar o tipo de despesa '+nome+' ?')){
			location.href='listaDes.php?action=deleProd&pid='+id+'';
		}
	}
	
	function alteraDes(id, nome){		
			location.href='listaDes.php?action=alteDes&pid='+id+'';
	}
</script>
</head>

<body>
<table width="100%" cellspacing="0">
	<tr>
   	  <td class="tabsis"><div align="right">&nbsp;</div></td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="19%"><strong>Tipo</strong></td>
        <td width="19%"><strong>V Max</strong></td>
        <td width="7%"><strong>Açao</strong></td>
  </tr>
<? 
for($e; $e<$total; $e++) {
	$pro = mysql_fetch_array($result);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>

  <tr bgcolor="<?= $cor?>">
        <td><?= $pro["TDE_NOME"]?></td>
        <td>R$ <?= $pro["TDE_VALO"]?></td>
        <td><a href="#" onClick="deletaPro('<?= $pro["ID"]?>', '<?= $pro["TDE_NOME"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
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
</body>
</html>