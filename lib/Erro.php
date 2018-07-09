<?php
	// função para tratamento de erros.
	function Erro($mensagem)
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Erro</title></head>

<body>
<table width="100%%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><strong>P&aacute;gina de Erro </strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><em>N&atilde;o foi poss&iacute;vel realizar a opera&ccedil;&atilde;o solicitada.<br />
Por favor, entre em contato com o administrador do sistema: s1qu3ira@4sys.com.br </em></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><?= $mensagem ?></td>
  </tr>
</table>
<?php
	    die();
?>
</body>
</html>
<?php
	}
?>