<?
//Classe Cupom
//Desenvolvido por: Bruno Siqueira Lopes
//E-mail: siqueira@4sys.com.br

//Situação do Cupom
//1 - A Vista
//2 - Aberto
//3 - Fechado
//4 - Cancelado

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Cupom{
    //Atributos
	var $id;
	var $cid;
	var $vid;
	var $pid;
	var $uid;
	var $date;
	var $datv;
	var $datp;
	var $hora;
	var $clie;
	var $cncp;
	var $moto;
	var $plac;
	var $esta;
	var $quan;
	var $puni;
	var $pron;
	var $valo;
	var $desc;
	var $tota;
	var $user;
	var $canc;
	var $situ;
	
	//Métodos
	function setId($id){
		$this->id = $id;
	}
	function setCid($cid){
		$this->cid = $cid;
	}
	function setVid($vid){
		$this->vid = $vid;
	}
	function setpid($pid){
		$this->pid = $pid;
	}
	function setuid($uid){
		$this->uid = $uid;
	}
	function setdate($date){
		$this->date = $date;
	}
	function setdatv($datv){
		$this->datv = $datv;
	}
	function setdatp($datp){
		$this->datp = $datp;
	}
	function sethora($hora){
		$this->hora = $hora;
	}
	function setclie($clie){
		$this->clie = $clie;
	}
	function setcncp($cncp){
		$this->cncp = $cncp;
	}
	function setmoto($moto){
		$this->moto = $moto;
	}
	function setplac($plac){
		$this->plac = $plac;
	}
	function setesta($esta){
		$this->esta = $esta;
	}
	function setquan($quan){
		$this->quan = $quan;
	}
	function setpuni($puni){
		$this->puni = $puni;
	}
	function setpron($pron){
		$this->pron = $pron;
	}
	function setvalo($valo){
		$this->valo = $valo;
	}
	function setdesc($desc){
		$this->desc = $desc;
	}
	function settota($tota){
		$this->tota = $tota;
	}
	function setuser($user){
		$this->user = $user;
	}
	function setsitu($situ){
		$this->situ = $situ;
	}
	function setcanc($canc){
		$this->canc = $canc;
	}
	
	
	function cadaCup(){
		$sql= sprintf("INSERT INTO TBCUPOM(CID, VID, PID, UID, CUP_DATE, CUP_DATV, CUP_DATP, CUP_HORA, CUP_CLIE, CUP_CNCP, CUP_MOTO, CUP_PLAC, CUP_ESTA, CUP_QUAN, CUP_PUNI, CUP_PRON, CUP_VALO, CUP_DESC, CUP_TOTA, CUP_USER, CUP_CANC, CUP_SITU)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->cid, "text"),
			getValorSQL($this->vid, "text"),
			getValorSQL($this->pid, "text"),
			getValorSQL($this->uid, "text"),
			getValorSQL($this->date, "text"),
			getValorSQL($this->datv, "text"),
			getValorSQL($this->datp, "text"),
			getValorSQL($this->hora, "text"),
			getValorSQL($this->clie, "text"),
			getValorSQL($this->cncp, "text"),
			getValorSQL($this->moto, "text"),
			getValorSQL($this->plac, "text"),
			getValorSQL($this->esta, "text"),
			getValorSQL($this->quan, "text"),
			getValorSQL($this->puni, "text"),
			getValorSQL($this->pron, "text"),
			getValorSQL($this->valo, "text"),
			getValorSQL($this->desc, "text"),
			getValorSQL($this->tota, "text"),
			getValorSQL($this->user, "text"),
			getValorSQL($this->canc, "text"),
		    getValorSQL($this->situ, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cliente Juridico ' . mysql_error());
  		$last = mysql_insert_id();
		mysql_close($conexao);
		return($last);
	}
	
	function cupMax(){
		$conexao = getConexao();
		$query = "SELECT MAX(ID) FROM TBCUPOM";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupVen(){
		$data=date('Y-m-d');
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 1 AND CUP_DATV < NOW()";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function cupBus(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE ID='".$this->id."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function cupAbe(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 1";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupFec(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 2";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupCan(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 3";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupBai(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCUPOM WHERE CUP_SITU = 4";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupCons($dati, $datf, $scon){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.CUP_QUAN) as TOQUANT, SUM(v.CUP_DESC) as TODESC, SUM(v.CUP_TOTA) as TOTOTAL, c.CLI_NOME, c.CLI_CNPJ, c.CLI_CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.CUP_SITU='".$scon."' AND v.CUP_DATE >= '".$dati."' AND v.CUP_DATE <= '".$datf."' AND v.CID = c.ID GROUP BY v.CID ORDER BY c.CLI_NOME"; 
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupConsV($dati, $datf, $scon){
		$conexao = getConexao();
		$query = "SELECT v.CID, SUM(v.CUP_QUAN) as TOQUANT, SUM(v.CUP_DESC) as TODESC, SUM(v.CUP_TOTA) as TOTOTAL, c.CLI_NOME, c.CLI_CNPJ, c.CLI_CPF FROM TBCUPOM AS v, TBCLIENTE as c WHERE v.CUP_SITU='".$scon."' AND v.CUP_DATE >= '".$dati."' AND v.CUP_DATE <= '".$datf."' AND v.CID = c.ID AND v.CUP_DATV < NOW() GROUP BY v.CID ORDER BY c.CLI_NOME"; 
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function cupRel($dati, $datf, $clie, $sid){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_DATE, CUP_USER, CUP_DATV, CUP_PLAC, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA FROM TBCUPOM WHERE CID='".$clie."' AND CUP_DATE >= '".$dati."' AND CUP_DATE <= '".$datf."' AND CUP_SITU = '".$sid."' ORDER BY CUP_DATE"; 
		
		
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	
	function cupRel2($dati, $datf, $clie, $sid){
		$conexao = getConexao();
		$query = "SELECT ID, CUP_DATE, CUP_USER, CUP_DATV, CUP_PLAC, CUP_MOTO, CUP_PRON, CUP_QUAN, CUP_TOTA FROM TBCUPOM WHERE CID='".$clie."' AND CUP_DATE >= '".$dati."' AND CUP_DATE <= '".$datf."' AND CUP_SITU = '".$sid."' AND CUP_DATV < NOW() ORDER BY CUP_DATE"; 
		
		
		
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function canCupom($id){
		$sql = "UPDATE TBCUPOM SET	 
					CUP_SITU='3'
					WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cupom ' . mysql_error());
  		return($resultado);
	}
	function pagCupom($id){
		$sql = "UPDATE TBCUPOM SET	 
					CUP_DATP='".$this->datp."',
					CUP_SITU='4'
			WHERE ID='0'";
			 $count = count($id); 
        	for($i = 0; $i < $count; $i++){ 
				$sql.= " OR ID='".$id[$i]."'";
				echo $sql;
		}
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cupom ' . mysql_error());
  		return($resultado);
	}
}
?>