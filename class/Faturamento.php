﻿<?
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
		$query = "SELECT ID, PLACA, CLIENT, MOTOR, PRODU, QUANT, TOTAL, DAVEN FROM TBCUPOM WHERE DAPAM = '".$day."' AND SID <> 3 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatDiav($day){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_PLAC, CUP_CLIE, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA, CUP_DATV FROM TBCUPOM WHERE CUP_DATE = '".$day."' AND CUP_SITU = 1 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatDiap($day){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_PLAC, CUP_CLIE, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA, CUP_DATV FROM TBCUPOM WHERE CUP_DATE = '".$day."' AND CUP_SITU = 2 ORDER BY ID"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatMes($mes, $ano){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.CUP_QUAN) as TOQUANT, SUM(v.CUP_DESC) as TODESC, SUM(v.CUP_TOTA) as TOTOTAL, c.CLI_NOME, c.CLI_CNPJ, c.CLI_CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.CUP_DATE >= '".$ano."-".$mes."-01' AND v.CUP_DATE <= '".$ano."-".$mes."-31' AND v.CID = c.ID AND v.CUP_SITU <> 3 GROUP BY c.CLI_NOME"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function fatAno($ano){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.CUP_QUAN) as TOQUANT, SUM(v.CUP_DESC) as TODESC, SUM(v.CUP_TOTA) as TOTOTAL, c.CLI_NOME, c.CLI_CNPJ, c.CLI_CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.CUP_DATE >= '".$ano."-01-01' AND v.CUP_DATE <= '".$ano."-12-31' AND v.CID = c.ID AND v.CUP_SITU <> 3 GROUP BY c.CLI_NOME"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
}

?>
