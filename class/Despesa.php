<?

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Despesa{
	var $id;
	var $pid;
	var $tip;
	var $mpr;
	var $des;
	var $dat;
	var $hou;
	var $use;
	var $val;
	
	function setId($id){
		$this->id = $id;
	}
	function setTip($tip){
		$this->tip = $tip;
	}
	function setPid($pid){
		$this->pid = $pid;
	}
	function setMpr($mpr){
		$this->mpr = $mpr;
	}
	function setDes($des){
		$this->des = $des;
	}
	function setDat($dat){
		$this->dat = $dat;
	}
	function setHou($hou){
		$this->hou = $hou;
	}
	function setUse($use){
		$this->use = $use;
	}
	function setVal($val){
		$this->val = $val;
	}
	
	
	function cadaTdespe(){
		$sql= sprintf("INSERT INTO TBTDESPESA(TDE_NOME, TDE_VALO)VALUES(%s, %s)",
		    getValorSQL($this->tip, "text"),
			getValorSQL($this->mpr, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir o produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function cadaDespe(){
		$sql= sprintf("INSERT INTO TBDESPESA(TIP, DES_TIPO, DES_DESC, DES_DATA, DES_HORA, DES_USER, DES_VALO)VALUES(%s, %s, %s, %s, %s, %s, %s)",
		    getValorSQL($this->tip, "text"),
			getValorSQL($this->pid, "text"),
			getValorSQL($this->des, "text"),
			getValorSQL($this->dat, "text"),
			getValorSQL($this->hou, "text"),
			getValorSQL($this->use, "text"),
			getValorSQL($this->val, "text"));
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir o produto ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function listTdesp(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBTDESPESA ORDER BY TDE_NOME";
    	$result = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($result);
	}
	
	function deleProd($pid){
		$sql = "DELETE FROM TBDESPESA WHERE ID='".$pid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
	}
	
	function desDia($day){
		$conexao = getConexao();
		$query = "SELECT ID, DES_TIPO, DES_DESC, DES_DATA, DES_HORA, DES_USER, DES_VALO FROM TBDESPESA WHERE DES_DATA = '".$day."' ORDER BY DES_HORA"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function despDia($day){
		$conexao = getConexao();
		$query = "SELECT ID, DES_TIPO, SUM(DES_VALO) as QTD FROM TBDESPESA WHERE DES_DATA = '".$day."' GROUP BY DES_TIPO"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function despMes($mes, $ano){
		$conexao = getConexao();
		$query = "SELECT ID, DES_TIPO, SUM(DES_VALO) as QTD FROM TBDESPESA WHERE DES_DATA >= '".$ano."-".$mes."-01' AND DES_DATA <= '".$ano."-".$mes."-31' GROUP BY DES_TIPO"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function despAno($ano){
		$conexao = getConexao();
		$query = "SELECT ID, DES_TIPO, SUM(DES_VALO) as QTD FROM TBDESPESA WHERE DES_DATA >= '".$ano."-01-01' AND DES_DATA <= '".$ano."-12-31' GROUP BY DES_TIPO"; 
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
}
?>