<?
session_start();
require_once("class/classCupom.php");
$day = date("d-m-Y");
$hou = date("G:i:s");

//Data Para Insercao no DB
$dae = date("Y-m-d");

//Data de Venc Explode
list($d, $m, $y) = explode("-",$_POST[venVenc]);
$dav = "$y-$m-$d";

//Pagamento Conferencia de Data
if($_POST[venVenc] == $day){
	$pag = "a vista";
	$sit = 2;
	$paga = $dav;
}else{
	$pag = $_POST[venVenc];
	$sit = 1;
}


//Insercao no DB Tabela Cupom
$cup = new Cupom();
$cup->setCid($_SESSION["cid"]);
$cup->setMid($_SESSION["vid"]);
$cup->setPid($_POST[pid]);
$cup->setUid($_SESSION["uid"]);
$cup->setSid($sit);
$cup->setDaemi($dae);
$cup->setDaven($dav);
$cup->setDapam($paga);
$cup->setHoras($hou);
$cup->setClien($_POST[cliNome]);
$cup->setCnpcp($_POST[cliCp]);
$cup->setMotor($_POST[veiMot]);
$cup->setPlaca($_POST[veiPla]);
$cup->setUf($_POST[veiEsta]);
$cup->setQtant($_POST[veiTotl]);
$cup->setVunit($_POST[proValo]);
$cup->setProdu($_POST[proNome]);
$cup->setValo($_POST[venTota]);
$cup->setDesco($_POST[venDesc]);
$cup->setTotal($_POST[venConf]);
$cup->setUser($_POST[useNome]);
$cup->cadCupom();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
	function docuPrint(){
		window.focus();
		window.print(); 
		location.href='gereVen.php';
	}
	setTimeout("docuPrint()",10);
</script>
</head>

<body id="venCup">
<table width="470">
	<tr>
    	<td><div align="center" class="titulo"><strong>ORCAMENTO</strong></div><br /></td>
        
    <tr>   
    	<td>Telefone: 21 3691-0538</td>
    </tr>
    <tr>
        <td>NEXTEL ID: 80*65972</td>
        
    </tr>
    <tr>
    	<td><hr /></td>
    </tr>
</table>
<table width="470">
<tr>
    	<td width="165"><?= $day?></td>
        <td width="187"><?= $hou?></td>
        <td width="132"><div align="right"><strong>NC: <?= $_POST[ped]?></strong></div></td>
  </tr>
</table>
<table width="470">
	<tr>
    	<td width="165">Cliente:</td>
        <td width="293"><?= $_POST[cliNome]?></td>
    </tr>
    <tr>
    	<td>CNPJ:</td>
        <td><?= $_POST[cliCp]?></td>
    </tr>
    <tr>
    	<td>Motorista:</td>
        <td><?= $_POST[veiMot]?></td>
    </tr>
    <tr>
    	<td>Placa:</td>
        <td><?= $_POST[veiPla]?> - <?= $_POST[veiEsta]?></td>
    </tr>
</table>
<table width="470">
<tr>
    	<td width="80">QTD</td>
        <td width="80"> UNIT</td>
        <td width="211">PRODUTO</td>
        <td width="79"><div align="right">VALOR</div></td>
    </tr>
    <tr>
    	<td><?= $_POST[veiTotl]?></td>
        <td><?= $_POST[proValo]?></td>
        <td><?= $_POST[proNome]?></td>
        <td><div align="right"><?= $_POST[venTota]?></div></td>
    </tr>
    <tr>
    	<td colspan="2"><strong>Desconto</strong></td>
        <td></td>
        <td><div align="right"><strong><?= $_POST[venDesc]?></strong></div></td>
    </tr>
    <tr>
    	<td colspan="2"><strong>TOTAL</strong></td>
        <td><div align="right"><strong>R$</strong></div></td>
        <td><div align="right"><strong><?= $_POST[venConf]?></strong></div></td>
    </tr>
</table>
<table width="470">
	<tr>
    	<td><strong>Pagamento: </strong></td>
        <td><strong><div align="right"><?= $pag?></div></strong></td>
    </tr>
</table>
<table width="470">
	<tr>
    	<td><br /><br /><br /></td>
    </tr>
</table>

<table width="470">
	<tr>
    	<td><div align="center">Emitido por:</div></td>
        <td><div align="center"><strong>_________________________</strong></div></td>
    </tr>
    <tr>
    	<td><div align="center"><?= $_POST[useNome]?></strong></div></td>
        <td><div align="center"><strong><?= $_POST[veiMot]?></strong></div></td>
    </tr>
</table>
<table width="470">
	<tr>
    	<td align="center"><br /><br /></td>
    </tr>
    <tr>
    	<td align="center">OBRIGADO PELA PREFERENCIA</td>
    </tr>
    <tr>
    	<td align="center">FELIZ 2009</td>
    </tr>
</table>
</body>
</html>