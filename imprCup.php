<?
session_start();
require_once("logaut.php");

$_SESSION[tab] = "";
require_once("class/Cupom.php");
require_once("class/Cliente.php");
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
	$situ = 2;
	$dap = $dav;
}else{
	$pag = $_POST[venVenc];
	$situ = 1;
}

$cup = new Cupom();
	$cup->setCid($_POST[cid]);
	$cup->setVid($_POST[vid]);
	$cup->setpid($_POST[pid]);
	$cup->setuid($_POST[uid]);
	$cup->setdate($dae);
	$cup->setdatv($dav);
	$cup->setdatp($dap);
	$cup->sethora($hou);
	$cup->setclie($_POST[cliNo]);
	$cup->setcncp(sergio);
	$cup->setmoto($_POST[veiMot]);
	$cup->setplac($_POST[veiPla]);
	$cup->setesta($_POST[veiEsta]);
	$cup->setquan($_POST[veiTotl]);
	$cup->setpuni($_POST[proValo]);
	$cup->setpron($_POST[proNome]);
	$cup->setvalo($_POST[venTota]);
	$cup->setdesc($_POST[venDesc]);
	$cup->settota($_POST[venConf]);
	$cup->setuser($_SESSION[user]);
	$cup->setsitu($situ);
	$nc = $cup->cadaCup();
	
	
	$cli = new Cliente();
	$cli->setId($_POST[cid]);
	$cli->setOber($_POST[cliObse]);
	$cli->cliObs();

?>


<link href="css/style2.css" rel="stylesheet" type="text/css" />
<script>
	function docuPrint(){
		window.focus();
		window.print(); 
		location.href='cadaCup.php';
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
    	<td width="165"><?= $day?></td>
        <td width="187"><?= $hou?></td>
        <td width="132"><div align="right"><strong>NC: <?= $nc?></strong></div></td>
  </tr>
</table>
<table width="470">
	<tr>
    	<td width="165">Cliente:</td>
        <td width="293"><?= $_POST[cliNo]?></td>
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
    	<td><div align="center"><span class="tabsis">
    	  <?= $_SESSION[user]?>
   	  </span></strong></div></td>
        <td><div align="center"><strong><?= $_POST[veiMot]?></strong></div></td>
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

