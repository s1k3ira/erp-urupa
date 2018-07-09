<?
require_once("logaut.php");
require_once("class/classProd.php");

if($_POST[action] == "inseriProd"){//Inserir Produto
	$prod = new Produto();
	$prod->setNome($_POST[proNome]);
	$prod->setDesc($_POST[proDes]);
	$prod->setPrec($_POST[proPre]);
	$prod->addProd();
	
	?>
    <script>
		alert('Produto Cadastrado com Sucesso');
		location.href='gerePro.php';
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
<div class="titulo"><strong>Gerenciar Produto</strong></div>
<hr />
<iframe name="gerePro" width="965" height="200" src="listaPro.php" scrolling="yes" frameborder="0"></iframe>
<br />
<div class="titulo"><strong>Adicionar Produto</strong></div>
<hr />
<form action="<?= $PHP_SELF?>" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="action" value="inseriProd" />
<strong>Todos os campos marcados com * são obrigatórios.</strong>
<table width="100%" cellspacing="0">
	<tr>
    	<td colspan="2" width="15%" class="tabsis"><strong>Nome*</strong></td>
      <td width="85%" class="tabsis"><input type="text" name="proNome" id="Nome" size="50" class="input" lang="1" onFocus="mudarCorCampo(this,'white')" onKeyUp="upperCase(this.id)"/></td>
    </tr>
    <tr>
    	<td colspan="2" class="tabsis">Descrição</td>
        <td class="tabsis"><input type="text" name="proDes" id="Descricao" size="50" class="input" onKeyUp="upperCase(this.id)" /></td>
    </tr>
    <tr>
    	<td class="tabsis"><strong>Preço* </strong></td>
        <td class="tabsis"><div align="right"><strong>R$</strong></div></td>
        <td class="tabsis"><input type="text" name="proPre" id="Preco" size="10" class="input" onKeyPress="formatar_mascara(this, '##.##')" lang="1" onFocus="mudarCorCampo(this,'white')" maxlength="5"/></td>
    </tr>
    <tr>
    	<td colspan="2" class="tabsis"></td>
        <td class="tabsis"><input type="submit" class="botao" value=" CADASTRAR PRODUTO " /></td>
    </tr>
</table>
</form>
<br /><br />
</body>
</html>
