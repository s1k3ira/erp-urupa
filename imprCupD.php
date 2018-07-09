<?
session_start();
require_once("logaut.php");

$_SESSION[tab] = "";
require_once("class/Cupom.php");

$cup = new Cupom();
$cup->setId($_GET[id]);
$cupom = $cup->cupBus();
$cupo = mysql_fetch_array($cupom);



?>

<link href="css/style2.css" rel="stylesheet" type="text/css" />
<script>
	function docuPrint(){
		window.focus();
		window.print(); 
		history.go(-1);
	}
	setTimeout("docuPrint()",10);
</script>

<body id="venCup">
<table width="470">
	<tr>
    	<td><div align="center" class="titulo"><strong>Urupa Mineracao</strong></div><br /></td>
        
    <tr>   
    	<td>Telefone: 21 3691-0538</td>
    </tr>
    <tr>
        <td>NEXTEL ID: 82*5862</td>
        
    </tr>
    <tr>
    	<td><hr /></td>
    </tr>
</table>
<table width="470">
<tr>
    	<td width="165"><?= $cupo["CUP_DATE"]?></td>
        <td width="187"><?= $cupo["CUP_HORA"]?></td>
        <td width="132"><div align="right"><strong>NC: <?= $cupo["ID"]?></strong></div></td>
  </tr>
</table>
<table width="470">
	<tr>
    	<td width="165">Cliente:</td>
        <td width="293"><?= $cupo["CUP_CLIE"]?></td>
    </tr>
    <tr>
    	<td>CNPJ:</td>
        <td><?= $cupo[""]?></td>
    </tr>
    <tr>
    	<td>Motorista:</td>
        <td><?= $cupo["CUP_MOTO"]?></td>
    </tr>
    <tr>
    	<td>Placa:</td>
        <td><?= $cupo["CUP_PLAC"]?> - <?= $cupo["CUP_ESTA"]?></td>
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
    	<td><?= $cupo["CUP_QUAN"]?></td>
        <td><?= $cupo["CUP_PUNI"]?></td>
        <td><?= $cupo["CUP_PRON"]?></td>
        <td><div align="right"><?= $cupo["CUP_VALO"]?></div></td>
    </tr>
    <tr>
    	<td colspan="2"><strong>Desconto</strong></td>
        <td></td>
        <td><div align="right"><strong><?= $cupo["CUP_DESC"]?></strong></div></td>
    </tr>
    <tr>
    	<td colspan="2"><strong>TOTAL</strong></td>
        <td><div align="right"><strong>R$</strong></div></td>
        <td><div align="right"><strong><?= $cupo["CUP_TOTA"]?></strong></div></td>
    </tr>
</table>
<table width="470">
	<tr>
    	<td><strong>Pagamento: </strong></td>
        <td><strong><div align="right"><?= $cupo["CUP_DATP"]?></div></strong></td>
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
    	<td><div align="center"><span class="tabsis">
    	  <?= $_SESSION[user]?>
   	  </span></strong></div></td>
        <td><div align="center"><strong><?= $cupo["CUP_MOTO"]?></strong></div></td>
    </tr>
</table>
<table width="470">
	<tr>
    	<td align="center"><br /><br /></td>
    </tr>
    <tr>
    	<td align="center"><br><br>OBRIGADO PELA PREFERENCIA</td>
    </tr>
</table>
</body>
