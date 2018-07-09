<?
require_once("class/Despesa.php");

if($_POST[action] == "cadaProd"){//Inserir Produto
	$produto = new Despesa();
	$produto->setTip($_POST[proNome]);
	$produto->setMpr($_POST[proVist]);
	$produto->cadaTdespe();
	
	?>
    <script>
		alert('Tipo de Despesa Cadastrada com Sucesso');
		location.href='gereTde.php';
    </script>
	<?
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="titulo"><strong>Gerenciar Tipo de Despesa</strong></div>
<hr />
<iframe name="gerePro" width="965" height="200" src="listaDes.php" scrolling="yes" frameborder="0"></iframe>
<br />
<div class="titulo"><strong>Adicionar Tipo de Despesa</strong></div>
<hr />
<form action="<?= $PHP_SELF?>" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="action" value="cadaProd" />
<strong>Todos os campos marcados com * são obrigatórios.</strong>
<table width="100%" cellspacing="0">
	<tr>
    	<td width="206" class="tabsis"><strong>Tipo*</strong></td>
        <td width="46" class="tabsis"><strong>V Max</strong></td>
        <td colspan="3" rowspan="2" class="tabsis">&nbsp;</td>
    </tr>
    <tr>
    	<td width="206" class="tabsis"><input type="text" name="proNome" id="proNome" size="50" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyUp="upperCase(this.id)"/></td>
        <td width="46" class="tabsis"><input type="text" name="proVist" id="proVist" size="20" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyUp="upperCase(this.id)"/></td>
    </tr>
    <tr>
        <td colspan="5" class="tabsis"><input type="submit" class="botao" value=" Cadastrar Despesa " /></td>
    </tr>
</table>
</form>
<br /><br />
</body>
</html>
