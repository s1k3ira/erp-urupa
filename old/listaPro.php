<?
require_once("logaut.php");
require_once("class/classProd.php");

if($_GET[action] == "deletarPro"){//Inserir User
	$pro = new Produto();
	$pro->deletarPro($_GET[id]);
	
}

//Paginacao
$pag = 10;
$ini = 0;
$fim = 1000;

//Consulta
$prod = new Produto();//Consultar User
$uresul = $prod->consulProd($ini,$fim);
$utotal = mysql_num_rows($uresul);

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
		if(confirm('Deletar o produto '+nome+' ?')){
			location.href='listaPro.php?action=deletarPro&id='+id+'';
		}
	}
</script>
</head>

<body>
<table width="100%" cellspacing="0">
	<tr>
   	  <td class="tabsis"><div align="right"></div></td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="19%"><strong>Nome</strong></td>
   	    <td width="31%"><strong>Descrição</strong></td>
        <td width="19%"><strong>Preço</strong></td>
        <td width="7%"><strong>Açao</strong></td>
  </tr>
<? 
for($e; $e<$utotal; $e++) {
	$ust = mysql_fetch_array($uresul);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>

  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["NOME"]?></td>
        <td><?= $ust["DESR"]?></td>
        <td>R$ <?= $ust["PREC"]?></td>
        <td><a href="#" onClick="deletaPro('<?= $ust["ID"]?>', '<?= $ust["NOME"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
<?
}
?>
  </tr>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right"> </div></td>
  </tr>
</table>
</body>
</html>