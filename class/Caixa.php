<?php
//Classe Caixa
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//06-08-2012 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Caixa{
	//Atributos
	public $id;
    public $dat;
    public $din;
	public $che;
    public $tot;

   
    //construtor
    function __construct(){
    }
 
	//Métodos de Acesso
	function setId($id){
		$this->id = $id;
	}
	function setDat($dat){
		$this->dat = $dat;
	}
	function setDin($din){
		$this->din = $din;
	}
	function setChe($che){
		$this->che = $che;
	}
	function setTot($tot){
		$this->tot = $tot;
	}
	
	
	//Métodos
	function cadaCaixa(){
		$sql= sprintf("INSERT INTO DBCAIXA(CAIX_DATA, CAIX_DINH, CAIX_CHEQ, CAIX_TOTA)VALUES(%s, %s, %s, %s)",
			getValorSQL($this->dat, "text"),
			getValorSQL($this->din, "text"),
			getValorSQL($this->che, "text"),
			getValorSQL($this->tot, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir o produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function caiDia($day){
		$conexao = getConexao();
		$query = "SELECT * FROM DBCAIXA WHERE CAIX_DATA = '".$day."'"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
}//fim da classe
?>

