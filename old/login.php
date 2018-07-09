<?
//Destroi Todas as Sesseion
session_start();
session_destroy();

include("class/classUser.php"); // Add Classe User

if($_POST[action] == "autentc"){ // Faz o login do sistema
	$user = new User();
	$user->setLogin($_POST["admLog"]);
	$user->setPassw($_POST["admPas"]);
	$user->checarUser();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Urupa - Login</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>

<div align="center" id="Topo">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="31" bgcolor="#000000">
   	  <td width="824" align="left"><img src="pictures/logo.gif" /></td>
      <td width="158" align="right">
      <br /><br />
      <div class="branco">
      <strong>+55 11 4794-8473</strong><br />
      <strong>+55 11 7150-0358</strong><br />
      </div>
      <a href="mailto:suporte@4sys.com.br">suporte@4sys.com.br</a>
      <br /><br />
      </td>
  </tr>
</table>
</div>

<div id="login">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="519" bgcolor="#f5f0f7">
   	  <td align="left"> 
		<form action="<?= $PHP_SELF?>" method="post">
        <input type="hidden" name="action" value="autentc" />
        <table align="center">
        	<tr>
            	<td></td>
            </tr>
        </table>
        
        <table align="center">
        	<tr>
            	<td colspan="2"><span class="titulo"><strong>Login do Sistema</strong></span><br /><br /></td>
            </tr>
            <tr>
            	<td colspan="2"><span class="cinza">Prezado Cliente, insira seu nome de usuário e senha para logar no sistema.</span><br /><br /></td>
            </tr>
        </table>
		<? if($_GET[value]==1){ ?>
        <table align="center">
        	<tr>
            	<td class="tabred">&nbsp; ERRO: Usuário ou senha inválidos &nbsp;</td>
            </tr>
        </table>
        <? }?>
        <br />
        
        <table align="center">
            <tr>
           	  <td><div align="right" class="cinza">Usuário: </div></td>
                <td><input type="text" name="admLog" class="input" size="28" /></td>
            </tr>
            <tr>
            	<td><div align="right" class="cinza">Senha:</div></td>
                <td><input type="password" name="admPas" class="input" size="28" /></td>
                <td><img src="pictures/buttonSecu.gif" /></td>    
            </tr>
            <tr>
                <td colspan="3" align="right"><a href="senha.php">Esqueceu a senha ?</a>&nbsp;&nbsp;&nbsp; <input type="submit" value=" ENTRAR " class="botao" /></td>
           	</tr>
        </table>
        <br /><br />
        </form>	
      </td>
  </tr>
</table>
</div>

<div align="center" id="Rodape">
<table width="984" align="center" cellpadding="0" cellspacing="0">
  <tr height="35" bgcolor="#464646">
   	  <td align="left">Copyright 2009 - 4sys - Todos os direitos reservados</td>
  </tr>
</table>
</div>

</body>
</html>
