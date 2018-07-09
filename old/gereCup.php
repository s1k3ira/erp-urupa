<?
$day = date("d-m-Y");//Pega data do Servidor


require_once("class/classCupom.php");
//Pegar Abertos
$cupa = new Cupom();
$resua = $cupa->cupAbe();
$totala = mysql_num_rows($resua);
//Pegar Baixados
$cupb = new Cupom();
$resub = $cupb->cupBai();
$totalb = mysql_num_rows($resub);
//Pegar Fechados
$cupf = new Cupom();
$resuf = $cupf->cupFec();
$totalf = mysql_num_rows($resuf);
//Pegar Cancelados
$cupc = new Cupom();
$resuc = $cupc->cupCan();
$totalc = mysql_num_rows($resuc);
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
<div><span class="titulo"><strong>Gerenciar Cupoms</strong></span> 
| <a href="cupAbe.php" target="gereCup">Abertos(<?= $totala?>)</a>
| <a href="cupBai.php" target="gereCup">Baixados(<?= $totalb?>)</a>
| <a href="cupFec.php" target="gereCup">Fechados(<?= $totalf?>)</a>
| <a href="cupCan.php" target="gereCup">Cancelados(<?= $totalc?>)</a>
</div>
<hr />
<iframe name="gereCup" width="965" height="430" src="blank.php" scrolling="auto" frameborder="0"></iframe>
</body>
</html>
