<?
$day = date("d-m-Y");//Pega data do Servidor
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
	function deletaVei(id, placa){		
		if(confirm('Deletar o Veículo de placa '+placa+' ?')){
			location.href='gereVei.php?action=deletaVei&id='+id+'';
		}
	}
</script>

<link rel="stylesheet" href="css/thickbox.css" type="text/css" media="screen" />
<link href="css/styleFat.css" rel="stylesheet" type="text/css" />
</head>

<body> 
<div><span class="titulo"><strong>Gerenciar Faturamento</strong></span> 
| <a href="fatDia.php" target="gereFat">Faturamento Dia</a>
| <a href="fatMes.php" target="gereFat">Faturamento Mês</a>
</div>
<hr />
<iframe name="gereFat" width="965" height="430" src="blank.php" scrolling="auto" frameborder="0"></iframe>
</body>
</html>
