<?
function getValorSQL($valor, $tipo, $valorSeDefinido = "", $valorSeNaoDefinido = "") 
{
 	// verifica se existem caracteres especiais e se eles serao formatados
 	// pelo PHP.
	$valor = (!get_magic_quotes_gpc()) ? addslashes($valor) : $valor;

	// verifica qual é o tipo.
  	switch ($tipo) {
    	case "text":
      	    $valor = ($valor != "") ? "'" . $valor . "'" : "NULL";
      		break;    
    	case "long":
    	case "int":
      		$valor = ($valor != "") ? intval($valor) : "NULL";
      		break;
    	case "double":
      		$valor = ($valor != "") ? "'" . doubleval($valor) . "'" : "NULL";
      		break;
    	case "date":
      		$valor = ($valor != "") ? "'" . $valor . "'" : "NULL";
      		break;
    	case "defined":
      		$valor = ($valor != "") ? $valorSeDefinido : $valorSeNaoDefinido;
      		break;
    }
    // retorna o valor formatado para o SQL.
	return $valor;
}

function getConexao() {
	// parametros da conexao.
	$hostname = "localhost";
	$bancoDados = "DBURUPA";
	$usuario = "root";
	$senha = "sion80";
	
	// cria uma conexao com o banco de dados.
	$conexao = mysql_connect($hostname, $usuario, $senha) or trigger_error(mysql_error(),E_USER_ERROR);
	// seleciona o banco de dados.
	mysql_select_db($bancoDados, $conexao) or die(mysql_error());

	// retorna a conexao criada.
	return($conexao);
}
?>