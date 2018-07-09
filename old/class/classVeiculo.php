<?
//Classe Veiculo
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//17/12/08 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Veiculo{
	var $cid;
	var $vid;
	var $data;
	var $placa;
	var $uf;
	var $dcomp;
	var $dlarg;
	var $daltu;
	var $total;
	var $mnome;
	var $cpf;
	var $rg;
	var $dddt;
	var $tel;
	var $dddc;
	var $cel;
	var $nex;


	function GetClassName(){
		return 'Veiculo'; 
	}

	
	function getData(){
		return $this->data;
	}
	function getPlaca(){
		return $this->placa;
	}
	function getUf(){
		return $this->uf;
	}
	function getMnome(){
		return $this->mnome;
	}
	function getDcomp(){
		return $this->dcomp;
	}
	function getDlarg(){
		return $this->dlarg;
	}
	function getDaltu(){
		return $this->daltu;
	}
	function getDtota(){
		return $this->dtota;
	}
	function getCpf(){
		return $this->cpf;
	}
	function getRg(){
		return $this->rg;
	}
	function getDddt(){
		return $this->dddt;
	}
	function getTel(){
		return $this->tel;
	}
	function getDddc(){
		return $this->dddc;
	}
	function getCel(){
		return $this->cel;
	}
	function getCid(){
		return $this->cid;
	}
	function getVid(){
		return $this->vid;
	}
	function getNex(){
		return $this->nex;
	}
	
	

	
	function setData($data){
		$this->data = $data;
	}
	function setPlaca($placa){
	    $this->placa = $placa;
	}
	function setUf($uf){
	    $this->uf = $uf;
	}
	function setDcomp($dcomp){
	    $this->dcomp = $dcomp;
	}
	function setDlarg($dlarg){
	    $this->dlarg = $dlarg;
	}
	function setDaltu($daltu){
	    $this->daltu = $daltu;
	}
	function setDtota($dtota){
	    $this->dtota = $dtota;
	}
	function setMome($mnome){
	    $this->mnome = $mnome;	
	}
	function setCpf($cpf){
	    $this->cpf = $cpf;
	}
	function setRg($rg){
	    $this->rg = $rg;
	}
	function setDddt($dddt){
	    $this->dddt = $dddt;
	}
	function setTel($tel){
	    $this->tel = $tel;
	}
	function setDddc($dddc){
	    $this->dddc = $dddc;
	}
	function setCel($cel){
	    $this->cel = $cel;
	}
	function setCid($cid){
	    $this->cid = $cid;
	}
	function setVid($vid){
	    $this->vid = $vid;
	}
	function setNex($nex){
	    $this->nex = $nex;
	}
		
	function addVeiculo(){
		$sql= sprintf("INSERT INTO TBVEICULO(DATA, PLACA, UF, DCOMP, DLARG, DALTU, DTOTAL, MNOME, CPF, RG, DDT, TEL, DDC, CEL, NEXTE)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->data, "text"),
			getValorSQL($this->placa, "text"),
			getValorSQL($this->uf, "text"),
			getValorSQL($this->dcomp, "text"),
			getValorSQL($this->dlarg, "text"),
			getValorSQL($this->daltu, "text"),
			getValorSQL($this->dtota, "text"),
			getValorSQL($this->mnome, "text"),
			getValorSQL($this->cpf, "text"),
			getValorSQL($this->rg, "text"),
			getValorSQL($this->dddt, "text"),
			getValorSQL($this->tel, "text"),
			getValorSQL($this->dddc, "text"),
			getValorSQL($this->cel, "text"),
			getValorSQL($this->nex, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Veiculo ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function addVeicli(){
		$sql= sprintf("INSERT INTO TBVEICLI (VID, CID)VALUES(%s, %s)",
			getValorSQL($this->vid, "text"),
			getValorSQL($this->cid, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Veiculo ' . mysql_error());
  		mysql_close($conexao);	
	}
	function altVeiculo($id){
		$sql = "UPDATE TBVEICULO SET	 
					DATA='".$this->data."',
					PLACA='".$this->placa."',
					UF='".$this->uf."',
					DCOMP='".$this->dcomp."',
					DLARG='".$this->dlarg."',
					DALTU='".$this->daltu."',
					DTOTAL='".$this->dtota."',
					MNOME='".$this->mnome."',
					CPF='".$this->cpf."',
					RG='".$this->rg."',
					DDT='".$this->dddt."',
					TEL='".$this->tel."',
					DDC='".$this->dddc."',
					CEL='".$this->cel."',
					NEXTE='".$this->nex."'
			WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Veículo ' . mysql_error());
  		return($resultado);
	}
	
	function consulVeiculo($ini, $fin){
		$conexao = getConexao();
		$query = "SELECT ID, PLACA, MNOME, DTOTAL, DDT, TEL, DDC, CEL, CPF FROM TBVEICULO ORDER BY PLACA LIMIT $ini, $fin ";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function consVeipn(){
		$conexao = getConexao();
		if($this->placa == ""){
			$query = "SELECT ID, PLACA, MNOME, DTOTAL, DDT, TEL, DDC, CEL, CPF FROM TBVEICULO WHERE MNOME LIKE '%".$this->mnome."%'  ORDER BY PLACA";
		}else{
			$query = "SELECT ID, PLACA, MNOME, DTOTAL, DDT, TEL, DDC, CEL, CPF FROM TBVEICULO WHERE PLACA ='".$this->placa."' ORDER BY PLACA";
		}
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function veiCons($idc){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO WHERE ID='".$idc."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function veiPlaca($pvei){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO WHERE PLACA='".$pvei."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function veiculoTotal(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		$total = mysql_num_rows($resultados);
		return($total);
	}
	function delVeiculo($id){
		$sql = "DELETE FROM TBVEICULO WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Veículo');
  		mysql_close($conexao);
	}
	function delVeicli($cid){
		$sql = "DELETE FROM TBVEICLI WHERE ID='".$cid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Veículo');
  		mysql_close($conexao);
	}
}

?>
