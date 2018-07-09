<?
require_once("class/Cliente.php");

if($_GET[action] == "deletaCli"){//Deletar Cli
	$user = new Cliente();
	$user->setId($_GET[id]);
	$user->deleCli();
}

$busca = new Cliente;
$busca->setTipo("2");
$query = $busca->buscCli();
$total = mysql_num_rows($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script>
	function deletaCli(id, nome){		
		if(confirm('Deletar o cliente '+nome+' ?')){
			location.href='gereFis.php?action=deletaCli&id='+id+'';
		}
	}
</script>

<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div><span class="titulo"><strong>Pessoa Física</strong></span></div>
<hr />
<form action="<?= $PHP_SELF?>" name="listaCli" method="post">
<input type="hidden" name="action" value="buscar" /> 
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="5%" height="25" class="tabsis">&nbsp;<a href="#" onclick="location.href='cadaFis.php';" /><img src="pictures/Knob Add.png" width="20" border="0" /></a></td>
        <td width="9%" class="tabsis">
     <div align="left">&nbsp;CPF:</div>
     <div align="left"><input type="text" name="juriCnpj" size="20"  maxlength="18" class="input" onKeyPress="formatar_mascara(this, '##.###.###/####-##')" lang="1" onFocus="mudarCorCampo(this,'white')" ></div>
      </td>
       <td width="23%" class="tabsis">
     <div align="left">&nbsp;Cliente:</div>
     <div align="left"><input type="text" name="cliNome" id="Motorista" size="55" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="53%" class="tabsis">
       <div align="left">&nbsp;</div>
      <div align="left"><input type="submit" class="botao" value=" Buscar " /></div>
      </td>
      <td width="10%" class="tabsis"><div align="right"></div></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="12%"><strong>CPF</strong></td>
        <td width="24%"><strong>Nome de Cliente</strong></td>
        <td width="39%"><strong>Endereço</strong></td>
        <td width="11%"><strong>Telefone</strong></td>
        <td width="9%"><strong>Situação</strong></td>
        <td width="5%"><strong>Ações</strong></td>
  </tr>
<? 
for($e; $e<$total; $e++) {
	$ust = mysql_fetch_array($query);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["CLI_CPF"]?></td>
        <td><?= $ust["CLI_NOME"]?></td>
        <td><?= $ust["CLI_LOGA"]?></td>
        <td><?= $ust["CLI_TDDD"]?> <?= $ust["CLI_TELE"]?></td>
        <td><?= $ust["CLI_SITU"]?></td>
        <td><a href="cadaFis.php?id=<?= $ust["ID"]?>"> <img src="pictures/b_edit.png" alt="Editar" border="0" /></a> <a href="#" onClick="deletaCli('<?= $ust["ID"]?>', '<?= $ust["CLI_NOME"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
  </tr>
<?
}
?>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right"> </div></td>
  </tr>
</table>
</form>
</body>
</html>
