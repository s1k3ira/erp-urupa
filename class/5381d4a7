<?
//Classe Faturamento
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//16/01/09 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Faturamento{


	function GetClassName(){
		return 'Faturamento'; 
	}
	function fatDia($day){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_PLAC, CUP_CLIE, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA, CUP_DATV FROM TBCUPOM WHERE CUP_DATP = '".$day."' AND CUP_SITU <> 3 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatDiav($day){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_PLAC, CUP_CLIE, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA, CUP_DATV FROM TBCUPOM WHERE CUP_DATP = '".$day."' AND CUP_SITU = 2 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatDiad($day){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_PLAC, CUP_CLIE, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA, CUP_DATV, CUP_DATP FROM TBCUPOM WHERE CUP_DATP = '".$day."' AND CUP_SITU = 4 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatDiap($day){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 1 AND CUP_DATE = '".$day."' OR CUP_SITU = 4 AND CUP_DATE = '".$day."' ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatMes($mes, $ano){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.QUANT) as TOQUANT, SUM(v.DESCO) as TODESC, SUM(v.TOTAL) as TOTOTAL, c.NOME, c.CNPJ, c.CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.DAPAM >= '".$ano."-".$mes."-01' AND v.DAPAM <= '".$ano."-".$mes."-31' AND v.CID = c.ID AND v.SID <> 3 AND v.SID <> 1 GROUP BY v.CID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
}

?>
