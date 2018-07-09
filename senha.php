<?
if(action == 'enviaMail'){
	include("class/User.php");
	$email = $_POST["admMail"];

	$user = new User();
	$user = setMail($email);
	$user = enviaSenha();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
		<form action="<? $PHP_SELF?>" method="post">
        <input type="hidden" name="action" value="enviaMail" />
        <table align="center">
        	<tr>
            	<td></td>
            </tr>
        </table>
        
        <table align="center">
        	<tr>
            	<td colspan="2"><span class="titulo"><strong>Esqueceu a Senha</strong></span><br /><br /></td>
            </tr>
            <tr>
            	<td colspan="2" class="tabyellow"><span class="cinza">&nbsp; Por favor, digite seu endereco de e-mail cadastrado e sua senha sera enviada para seu e-mail. &nbsp;</span></td>
            </tr>
            <tr>
            	<td>&nbsp;</td>
            </tr>
        </table>
        <table align="center">    
            <tr>
            	<td colspan="2" class="tabred"><span class="cinza">&nbsp; Nenhum usuario cadastrado com esse endereco de e-mail. Por favor entre em contato com o administrador ! &nbsp;</span></td>
            </tr>
        </table>
        <br />
        <table align="center">
            <tr>
           	  <td><div align="right" class="cinza">E-mail: </div></td>
                <td><input type="text" name="admMail" class="input" size="40" /></td>
            </tr>
            <tr>
                <td><a href="login.php">Voltar</a></td>
                <td><div align="right">
                  <input type="submit" value=" ENVIAR " class="botao" />
                </div></td>
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
   	  <td align="left"><div class="branco">Copyright 2009 - 4sys - Todos os direitos reservados</div></td>
  </tr>
</table>
</div>

</body>
</html>
