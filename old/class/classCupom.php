<?
//Classe Cupom
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//16/01/09 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Cupom{
	var $cid;
	var $mid;
	var $pid;
	var $uid;
	var $sid;
	var $daemi;
	var $daven;
	var $dapam;
	var $horas;
	var $clien;
	var $cnpcp;
	var $motor;
	var $placa;
	var $qtant;
	var $vunit;
	var $produ;
	var $valo;
	var $desco;
	var $total;
	var $user;


	function GetClassName(){
		return 'Cupom'; 
	}

	
	function getCid(){
		return $this->cid;
	}
	function getMid(){
		return $this->mid;
	}
	function getPid(){
		return $this->pid;
	}
	function getUid(){
		return $this->uid;
	}
	function getSid(){
		return $this->sid;
	}
	function getDaemi(){
		return $this->daemi;
	}
	function getDaven(){
		return $this->daven;
	}
	function getDapam(){
		return $this->dapam;
	}
	function getHoras(){
		return $this->horas;
	}
	function getClien(){
		return $this->clien;
	}
	function getCnpcp(){
		return $this->cnpcp;
	}
	function getMotor(){
		return $this->motor;
	}
	function getPlaca(){
		return $this->placa;
	}
	function getUf(){
		return $this->uf;
	}
	function getQtant(){
		return $this->qtant;
	}
	function getVunit(){
		return $this->vunit;
	}
	function getProdu(){
		return $this->produ;
	}
	function getValo(){
		return $this->valo;
	}
	function getDesco(){
		return $this->desco;
	}
	function getTotal(){
		return $this->total;
	}
	function getUser(){
		return $this->user;
	}
	
	

	
	function setCid($cid){
		$this->cid = $cid;
	}
	function setMid($mid){
	    $this->mid = $mid;
	}
	function setPid($pid){
	    $this->pid = $pid;
	}
	function setUid($uid){
	    $this->uid = $uid;
	}
	function setSid($sid){
	    $this->sid = $sid;
	}
	function setDaemi($daemi){
	    $this->daemi = $daemi;
	}
	function setDaven($daven){
	    $this->daven = $daven;
	}
	function setDapam($dapam){
	    $this->dapam = $dapam;
	}
	function setHoras($horas){
	    $this->horas = $horas;
	}
	function setClien($clien){
	    $this->clien = $clien;
	}
	function setCnpcp($cnpcp){
	    $this->cnpcp = $cnpcp;
	}
	function setMotor($motor){
	    $this->motor = $motor;
	}
	function setPlaca($placa){
	    $this->placa = $placa;
	}
	function setUf($uf){
	    $this->uf = $uf;
	}
	function setQtant($qtant){
	    $this->qtant = $qtant;
	}
	function setVunit($vunit){
	    $this->vunit = $vunit;
	}
	function setProdu($produ){
	    $this->produ = $produ;
	}
	function setValo($valo){
	    $this->valo = $valo;
	}
	function setDesco($desco){
	    $this->desco = $desco;
	}
	function setTotal($total){
	    $this->total = $total;
	}
	function setUser($user){
	    $this->user = $user;
	}
		
	function cadCupom(){
		$sql= sprintf("INSERT INTO TBCUPOM(CID,MID,PID,UID,SID,DAEMI,DAVEN,DAPAM,HORAS,CLIENT,CNPCP,MOTOR,PLACA,UF,QUANT,VUNIT,PRODU,VALO,DESCO,TOTAL,USER)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->cid, "text"),
			getValorSQL($this->mid, "text"),
			getValorSQL($this->pid, "text"),
			getValorSQL($this->uid, "text"),
			getValorSQL($this->sid, "text"),
			getValorSQL($this->daemi, "text"),
			getValorSQL($this->daven, "text"),
			getValorSQL($this->dapam, "text"),
			getValorSQL($this->horas, "text"),
			getValorSQL($this->clien, "text"),
			getValorSQL($this->cnpcp, "text"),
			getValorSQL($this->motor, "text"),
			getValorSQL($this->placa, "text"),
			getValorSQL($this->uf, "text"),
			getValorSQL($this->qtant, "text"),
			getValorSQL($this->vunit, "text"),
			getValorSQL($this->produ, "text"),
			getValorSQL($this->valo, "text"),
			getValorSQL($this->desco, "text"),
			getValorSQL($this->total, "text"),			
			getValorSQL($this->user, "text"));

		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cupom ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	
	function cupMax(){
		$conexao = getConexao();
		$query = "SELECT MAX(ID) FROM TBCUPOM";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupAbe(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE SID = 1";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupFec(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE SID = 2";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupCan(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE SID = 3";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupBai(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE SID = 4";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupCons($dati, $datf, $scon){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.QUANT) as TOQUANT, SUM(v.DESCO) as TODESC, SUM(v.TOTAL) as TOTOTAL, c.NOME, c.CNPJ, c.CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.SID='".$scon."' AND v.DAEMI >= '".$dati."' AND v.DAEMI <= '".$datf."' AND v.CID = c.ID GROUP BY v.CID"; 
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupRel($dati, $datf, $clie, $sid){
		$conexao = getConexao();
		$query = "SELECT ID, DAEMI, USER, DAVEN, PLACA, MOTOR, PRODU, QUANT, TOTAL FROM TBCUPOM WHERE CID='".$clie."' AND DAEMI >= '".$dati."' AND DAEMI <= '".$datf."' AND SID = '".$sid."' ORDER BY DAEMI "; 
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function canCupom($id){
		$sql = "UPDATE TBCUPOM SET	 
					SID='3'
			WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cupom ' . mysql_error());
  		return($resultado);
	}
	function pagCupom($id){
		$sql = "UPDATE TBCUPOM SET	 
					DAPAM='".$this->dapam."',
					SID='4'
			WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cupom ' . mysql_error());
  		return($resultado);
	}
	

}

?>
