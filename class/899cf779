<?php
//Classe Cliente
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//21-07-2009 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Produto{
	//Atributos
	public $nome;
    public $vist;
    public $praz;
	public $cvis;
    public $cpra;
	public $pid;
	public $cid;
	public $id;
   
    //construtor
    function __construct(){
    }
 
	//Métodos de Acesso
	function setId($id){
		$this->id = $id;
	}
	function setNome($nome){
		$this->nome = $nome;
	}
	function setVist($vist){
		$this->vist = $vist;
	}
	function setPraz($praz){
		$this->praz = $praz;
	}
	function setCist($Cvist){
		$this->Cvist = $Cvist;
	}
	function setCraz($Cpraz){
		$this->Cpraz = $Cpraz;
	}
	function setCid($cid){
		$this->cid = $cid;
	}
	function setPid($pid){
		$this->pid = $pid;
	}
		 
		 
	function getNome(){
		return $this->nome;
	}
	function getVist(){
		return $this->vist;
	}
	function getPraz(){
		return $this->praz;
	}
	
	//Métodos
	function cadaProd(){
		$sql= sprintf("INSERT INTO TBPRODUTO(PRO_NOME, PRO_VIST, PRO_PRAZ, PRO_CVIS, PRO_CPRA)VALUES(%s, %s, %s, %s, %s)",
			getValorSQL($this->nome, "text"),
			getValorSQL($this->vist, "text"),
			getValorSQL($this->praz, "text"),
			getValorSQL($this->Cvist, "text"),
			getValorSQL($this->Cpraz, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir o produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function cadaCliPro(){
		$sql= sprintf("INSERT INTO TBCLIPRO(CID, PID, CPR_NOME, CPR_VIST, CPR_PRAZ, CPR_CVIS, CPR_CPRA)VALUES(%s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->cid, "text"),
			getValorSQL($this->pid, "text"),
			getValorSQL($this->nome, "text"),
			getValorSQL($this->vist, "text"),
			getValorSQL($this->praz, "text"),
		    getValorSQL($this->Cvist, "text"),
			getValorSQL($this->Cpraz, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir o produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function listProd(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBPRODUTO ORDER BY PRO_NOME";
    	$result = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($result);
	}
	
	function listPid(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIPRO WHERE CID='".$this->cid."' ORDER BY CPR_NOME";
    	$result = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($result);
	}
	
	function consCliPro(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIPRO WHERE CID='".$this->cid."' AND PID='".$this->pid."'";
    	$result = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($result);
	}
	
	function deleProd($pid){
		$sql = "DELETE FROM TBPRODUTO WHERE ID='".$pid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
		
		$sql = "DELETE FROM TBCLIPRO WHERE PID='".$pid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
	}
	
	function busPro(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIPRO WHERE ID='".$this->id."'";
    	$result = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($result);
	}
	
	function deleCpr(){
		$sql = "DELETE FROM TBCLIPRO WHERE CID='".$this->cid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
	}
	
}//fim da classe
?>

