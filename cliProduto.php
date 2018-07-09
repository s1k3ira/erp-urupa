<?
require_once("class/Produto.php");

//Listagem de Produtos
$prod = new Produto();
$prod->setCid($_GET[id]);
$result = $prod->listPid();
$total = mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/formValid.js"></script>
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="50%"><strong>Nome</strong></td>
        <td width="12,5%"><strong>Antec</strong></td>
        <td width="12,5%"><strong>D.Vista</strong></td>
        <td width="12,5%"><strong>C.Vista</strong></td>
        <td width="12,5%"><strong>Prazo</strong></td>
        
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
        <td><?= $pro["CPR_NOME"]?></td>
        <td>R$ <?= $pro["CPR_VIST"]?></td>
        <td>R$ <?= $pro["CPR_PRAZ"]?></td>
        <td>R$ <?= $pro["CPR_CVIS"]?></td>
        <td>R$ <?= $pro["CPR_CPRA"]?></td>
      
<?
}
?>
  </tr>
</table>
</body>
</html>