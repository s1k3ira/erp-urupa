<?
require_once("logaut.php");
require_once("class/classCliente.php");

if($_GET[action] == "deletaCli"){//Deletar Cli
	$user = new Cliente();
	$user->deletarCliente($_GET[id]);
}

//Paginacao
$pag = 10;
$ini = 0;
$fim = 1000;

//Consulta
if($_POST[action] == "buscar"){//busca por placa ou motorista
	$user = new Cliente();//Consultar User
	$user->setNome($_POST[cliNome]);
	$uresul = $user->consClin();
	$utotal = mysql_num_rows($uresul);
}else{
	$user = new Cliente();//Consultar User
	$uresul = $user->consulCliente($ini,$fim);
	$utotal = mysql_num_rows($uresul);
}

$user = new Cliente();//Consultar User
$cliTotal = $user->clienteTotal();//Total Cadastrado
$cliBloq = $user->clienteSitua(2);
$cliLibe = $user->clienteSitua(1);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/thickbox.js"></script>
<script>
	function deletaCli(id, nome){		
		if(confirm('Deletar o cliente '+nome+' ?')){
			location.href='gereCli.php?action=deletaCli&id='+id+'';
		}
	}
</script>

<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div><span class="titulo"><strong>Gerenciar Clientes</strong></span> | Total Cadastrados(<?= $cliTotal?>) | Total Liberados(<?= $cliLibe?>) | Total Bloqueados(<?= $cliBloq?>)</div>
<hr />
<form action="<?= $PHP_SELF?>" name="listaCli" method="post">
<input type="hidden" name="action" value="buscar" /> 
<table width="100%" cellspacing="0">
	<tr>
   	  <td width="8%" height="25" class="tabsis">&nbsp;<a href="fichaJuri.php?placeValuesBeforeTB_=savedValues&TB_iframe=true&height=300&width=423&modal=true" class="thickbox"><input type="button" value=" INSERIR " class="botao" /></a></td>
            <td width="22%" class="tabsis">
     <div align="left">&nbsp;Cliente:</div>
     <div align="left"><input type="text" name="cliNome" id="Motorista" size="55" class="input" onKeyUp="upperCase(this.id)" lang="1" onFocus="mudarCorCampo(this,'white')" /></div>
      </td>
      <td width="57%" class="tabsis">
       <div align="left">&nbsp;</div>
      <div align="left"><input type="submit" class="botao" value=" Buscar " /></div>
      </td>
      <td width="13%" class="tabsis"><div align="right"></div></td>
  </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="19%"><strong>Nome de Cliente</strong></td>
        <td width="38%"><strong>Endereço</strong></td>
      <td width="11%"><strong>Telefone</strong></td>
        <td width="18%"><strong>E-mail</strong></td>
      <td width="8%"><strong>Situação</strong></td>
      <td width="6%"><strong>Ações</strong></td>
  </tr>
<? 
for($e; $e<$utotal; $e++) {
	$ust = mysql_fetch_array($uresul);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
	
	if($ust["TID"] == "2"){
		$openPag = "fichaJuri.php";
	}else{
		$openPag = "fichaFisi.php";
	}
?>
  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["NOME"]?></td>
        <td><?= $ust["ENDE"]?></td>
        <td><?= $ust["DDT"]?> <?= $ust["TEL"]?></td>
        <td><a href="mailto:<?= $ust["MAIL"]?>"><?= $ust["MAIL"]?></a></td>
        <td><?= $ust["TIPO"]?></td>
        <td><a href="<?= $openPag?>?cid=<?= $ust["ID"]?>&placeValuesBeforeTB_=savedValues&TB_iframe=true&height=350&width=423&modal=true" class="thickbox"> <img src="pictures/b_edit.png" alt="Editar" border="0" /></a> <a href="#" onClick="deletaCli('<?= $ust["ID"]?>', '<?= $ust["NOME"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
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
