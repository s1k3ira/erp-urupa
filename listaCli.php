<?
require_once("class/classCliente.php");

//Paginacao
$pag = 10;
$ini = 0;
$fim = 1000;

$tipo = new Cliente();//Consultar Cliente
$result = $tipo->consulCliente($ini,$fim);
$total = mysql_num_rows($result);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script>
function subPagina(cid, vid){ 
	location.href = 'fichaCve.php?cid='+cid+'&vid='+vid+'&action=inserir'; 
} 
function fechaJanela(){
	self.parent.tb_remove();
} 
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="450" cellspacing="0" align="center">
  <tr class="topficha">
   	  <td width="82%"><strong>Lista de Clientes</strong></td>
      <td width="18%"><div align="right">Fechar <a href="#" onClick="fechaJanela();"><img src="pictures/buttonFecha.gif" border="0" /></a></div></td>
  </tr>
</table>
<br />
<table width="100%" cellspacing="0">
  <tr class="tabsis">
   	 <td width="21%" class="tabsis"><div align="right">1 2 Próximo</div></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
      <td width="25%"><strong>CNPJ/CPF</strong></td>
      <td width="24%"><strong>Inscrição/RG</strong></td>
      <td width="38%"><strong>Nome</strong></td>
      <td width="13%"><strong>Selecione</strong></td>
  </tr>
<? 
for($e; $e<$total; $e++) {
	$ust = mysql_fetch_array($result);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["CNPJ"]?><?= $ust["CPF"]?></td>
        <td><?= $ust["INSC"]?><?= $ust["RG"]?></td>
        <td><?= $ust["NOME"]?></td>
        <td><div align="center"><a href="#" onclick="subPagina('<?= $ust["ID"]?>','<?= $_GET["vid"]?>');"><img src="pictures/b_select.png" alt="Visualizar" border="0" /></a></div></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right">1 2 Próximo</div></td>
  </tr>
</table>
</body>
</html>


