<?
//Classe Tipo
//E: login, senha , S: SQL.
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//08/10/08 - Versão 1.0

require_once ("lib/libConnect.php");//Conexão com Banco de Dados

class Tipo{
	
	//Funcoes de Login do Sistema
	function consuTipo(){
    	$conexao = getConexao();
		$query = "SELECT * FROM TBTIPO ORDER BY TIPO";
    	$resultado = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultado);
    }
	

    

}

?>
