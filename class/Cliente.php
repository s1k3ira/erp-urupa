<?php
//Classe Cliente
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//21-07-2009 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

require_once("Produto.php");
require_once("Veiculo.php");

class Cliente{
	//Atributos
	var $id;
	var $nome;
    var $cnpj;
    var $insc;
	var $cpf;
	var $rg;
	var $resp;
	var $email;
	var $loga;
	var $bair;
	var $cep;
	var $cida;
	var $esta;
	var $tddd;
	var $tele;
	var $fddd;
	var $fax;
	var $nexte;
	var $situ;
	var $tipo;
	var $forma;
	var $ober;
	var $debi;
	var $cred;
	
   
    //construtor
    function __construct(){
    }
 
	//Métodos de Acesso
	function setId($id){
		$this->id = $id;
	}
	function setVid($vid){
		$this->vid = $vid;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}
	function setInsc($insc){
		$this->insc = $insc;
	}
	function setCpf($cpf){
		$this->cpf = $cpf;
	}
	function setRg($rg){
		$this->rg = $rg;
	}
	function setResp($resp){
		$this->resp = $resp;
	}
	function setMail($email){
		$this->email = $email;
	}
	function setLoga($loga){
		$this->loga = $loga;
	}
	function setBair($bair){
		$this->bair = $bair;
	}
	function setCep($cep){
		$this->cep = $cep;
	}
	function setCida($cida){
		$this->cida = $cida;
	}
	function setEsta($esta){
		$this->esta = $esta;
	}
	function setTddd($tddd){
		$this->tddd = $tddd;
	}
	function setTele($tele){
		$this->tele = $tele;
	}
	function setFddd($fddd){
		$this->fddd = $fddd;
	}
	function setFax($fax){
		$this->fax = $fax;
	}
	function setNexte($nexte){
		$this->nexte = $nexte;
	}
	function setSitu($situ){
		$this->situ = $situ;
	}
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	function setForma($forma){
		$this->forma = $forma;
	}
	function setOber($ober){
		$this->ober = $ober;
	}
	function setDebi($debi){
		$this->debi = $debi;
	}
	function setCred($cred){
		$this->cred = $cred;
	}
	
	//Métodos
	function cadaJur(){
		$sql= sprintf("INSERT INTO TBCLIENTE(CLI_NOME, CLI_CNPJ, CLI_INSC, CLI_RESP, CLI_MAIL, CLI_LOGA, CLI_BAIR, CLI_CEP, CLI_CIDA, CLI_ESTA, CLI_TDDD, CLI_TELE, CLI_FDDD, CLI_FAX, CLI_NEXT, CLI_SITU, CLI_TIPO)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->nome, "text"),
			getValorSQL($this->cnpj, "text"),
			getValorSQL($this->insc, "text"),
			getValorSQL($this->resp, "text"),
			getValorSQL($this->email, "text"),
			getValorSQL($this->loga, "text"),
			getValorSQL($this->bair, "text"),
			getValorSQL($this->cep, "text"),
			getValorSQL($this->cida, "text"),
			getValorSQL($this->esta, "text"),
			getValorSQL($this->tddd, "text"),
			getValorSQL($this->tele, "text"),
			getValorSQL($this->fddd, "text"),
			getValorSQL($this->fax, "text"),
			getValorSQL($this->nexte, "text"),
			getValorSQL($this->situ, "text"),
		    getValorSQL($this->tipo, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cliente Juridico ' . mysql_error());
  		$last = mysql_insert_id();
		mysql_close($conexao);
		return($last);
	}
	
	function cadaFis(){
		$sql= sprintf("INSERT INTO TBCLIENTE(CLI_NOME, CLI_CPF, CLI_RG, CLI_RESP, CLI_MAIL, CLI_LOGA, CLI_BAIR, CLI_CEP, CLI_CIDA, CLI_ESTA, CLI_TDDD, CLI_TELE, CLI_FDDD, CLI_FAX, CLI_NEXT, CLI_SITU, CLI_TIPO)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->nome, "text"),
			getValorSQL($this->cpf, "text"),
			getValorSQL($this->rg, "text"),
			getValorSQL($this->resp, "text"),
			getValorSQL($this->email, "text"),
			getValorSQL($this->loga, "text"),
			getValorSQL($this->bair, "text"),
			getValorSQL($this->cep, "text"),
			getValorSQL($this->cida, "text"),
			getValorSQL($this->esta, "text"),
			getValorSQL($this->tddd, "text"),
			getValorSQL($this->tele, "text"),
			getValorSQL($this->fddd, "text"),
			getValorSQL($this->fax, "text"),
			getValorSQL($this->nexte, "text"),
			getValorSQL($this->situ, "text"),
		    getValorSQL($this->tipo, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cliente Juridico ' . mysql_error());
  		$last = mysql_insert_id();
		mysql_close($conexao);
		return($last);
	}
	
	function alteCli(){
		$sql = "UPDATE TBCLIENTE SET	
					CLI_NOME='".$this->nome."',
					CLI_CNPJ='".$this->cnpj."',
					CLI_INSC='".$this->insc."',
					CLI_RESP='".$this->resp."',
					CLI_MAIL='".$this->email."',
					CLI_LOGA='".$this->loga."',
					CLI_BAIR='".$this->bair."',
					CLI_CEP='".$this->cep."',
					CLI_CIDA='".$this->cida."',
					CLI_ESTA='".$this->esta."',
					CLI_TDDD='".$this->tddd."',
					CLI_TELE='".$this->tele."',
					CLI_FDDD='".$this->fddd."',
					CLI_FAX='".$this->fax."',
					CLI_NEXT='".$this->nexte."',
					CLI_PAGA='".$this->forma."',
					CLI_SITU='".$this->situ."',
					CLI_OBSE='".$this->ober."',
					CLI_DEBI='".$this->debi."',
					CLI_CRED='".$this->cred."'
			WHERE ID='".$this->id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cliente Juridico ' . mysql_error());
  		return($resultado);
	}
	
	function alteFis(){
		$sql = "UPDATE TBCLIENTE SET	
					CLI_NOME='".$this->nome."',
					CLI_CPF='".$this->cpf."',
					CLI_RG='".$this->rg."',
					CLI_RESP='".$this->resp."',
					CLI_MAIL='".$this->email."',
					CLI_LOGA='".$this->loga."',
					CLI_BAIR='".$this->bair."',
					CLI_CEP='".$this->cep."',
					CLI_CIDA='".$this->cida."',
					CLI_ESTA='".$this->esta."',
					CLI_TDDD='".$this->tddd."',
					CLI_TELE='".$this->tele."',
					CLI_FDDD='".$this->fddd."',
					CLI_FAX='".$this->fax."',
					CLI_NEXT='".$this->nexte."',
					CLI_PAGA='".$this->forma."',
					CLI_SITU='".$this->situ."',
					CLI_OBSE='".$this->ober."',
					CLI_DEBI='".$this->debi."',
					CLI_CRED='".$this->cred."'
			WHERE ID='".$this->id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cliente Juridico ' . mysql_error());
  		return($resultado);
	}
	
	function clienteCons($idc){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIENTE WHERE ID='".$idc."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function consCli(){
		$sql = ("SELECT * FROM TBCLIENTE WHERE ID=".$this->id."");
		$conexao = getConexao();
		$resultado = mysql_query($sql, $conexao);
		mysql_close($conexao);
		return($resultado);
	}
	
	function buscCli(){
		$sql = ("SELECT * FROM TBCLIENTE WHERE CLI_TIPO=".$this->tipo." ORDER BY CLI_NOME");
		$conexao = getConexao();
		$resultado = mysql_query($sql, $conexao);
		mysql_close($conexao);
		return($resultado);
	}
	
	function deleCli(){
		$sql = "DELETE FROM TBCLIENTE WHERE ID='".$this->id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Usuario');
  		mysql_close($conexao);
		//Deleta Produtos
		$pro = new Produto();
		$pro->setCid($this->id);
		$pro->deleCpr();
		
		//Deleta Veículos
		$ved = new Veiculo();
		$ved->setCid($this->id);
		$ved->deleCve();
	}
	
	function cliVei(){
		$conexao = getConexao();
		$query = "SELECT c.CLI_NOME, v.CID, v.ED FROM TBCLIENTE AS c, TBCLIVEI AS v WHERE c.ID = v.CID AND v.VID = '".$this->vid."' AND c.ID IN(SELECT CID FROM TBCLIVEI WHERE VID = '".$this->vid."') ORDER BY CLI_NOME";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function cliObs(){
		$sql = "UPDATE TBCLIENTE SET	
					CLI_OBSE='".$this->ober."'
			WHERE ID='".$this->id."'";
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar a Observação');
	}
	
}//fim da classe
?>

