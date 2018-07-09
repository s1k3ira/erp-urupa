<?
//Classe Produto
//E: login, senha , S: SQL.
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//08/01/09 - Versão 1.0
require_once("lib/Erro.php");
require_once("lib/libConnect.php");//Conexão com Banco de Dados

class Produto{
	var $nome;
	var $desr;
	var $prec;

	function GetClassName(){
		return 'Produto'; 
	}

	function getNome(){
		return $this->nome;
	}
	function getDesc(){
		return $this->desr;
	}
	function getPrec(){
		return $this->prec;
	}
		
	
	function setNome($nome){
		$this->nome = $nome;
	}
	function setDesc($desr){
		$this->desr = $desr;
	}
	function setPrec($prec){
		$this->prec = $prec;
	}
		
	function addProd(){
		$sql= sprintf("INSERT INTO TBPRODUTO(NOME, DESR, PREC)VALUES(%s, %s, %s)",
			getValorSQL($this->nome, "text"),
			getValorSQL($this->desr, "text"),
			getValorSQL($this->prec, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	function consulProd($ini, $fin){
		$conexao = getConexao();
		$query = "SELECT * FROM TBPRODUTO ORDER BY NOME LIMIT $ini, $fin ";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function venProd(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBPRODUTO ORDER BY NOME";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function consProd($id){
		$conexao = getConexao();
		$query = "SELECT * FROM TBPRODUTO WHERE ID= $id  ORDER BY NOME";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function deletarPro($id){
		$sql = "DELETE FROM TBPRODUTO WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
	}

	

    

}

?>
