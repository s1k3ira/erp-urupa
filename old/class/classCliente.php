<?
//Classe Cliente
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//09/01/09 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro
require_once("class/classVeiculo.php");//Classe Veiculo

class Cliente{
	var $tid;
	var $cid;
	var $sid;
	var $data;
	var $nome;
	var $ende;
	var $bairr;
	var $cidad;
	var $cep;
	var $uf;
	var $cnpj;
	var $insc;
	var $cpf;
	var $rg;
	var $dddt;
	var $tel;
	var $dddf;
	var $fax;
	var $email;
	var $obs;

	function GetClassName(){
		return 'Cliente'; 
	}

	function getTid(){
		return $this->tid;
	}
	function getCid(){
		return $this->cid;
	}
	function getSid(){
		return $this->sid;
	}
	function getData(){
		return $this->data;
	}
	function getNome(){
		return $this->nome;
	}
	function getEnde(){
		return $this->ende;
	}
	function getBairr(){
		return $this->bairr;
	}
	function getCidad(){
		return $this->cidad;
	}
	function getCep(){
		return $this->Cep;
	}
	function getUf(){
		return $this->uf;
	}
	function getCnpj(){
		return $this->cnpj;
	}
	function getInsc(){
		return $this->insc;
	}
	function getCpf(){
		return $this->cpf;
	}
	function getRg(){
		return $this->rg;
	}
	function getDddt(){
		return $this->dddt;
	}
	function getTel(){
		return $this->tel;
	}
	function getDddf(){
		return $this->dddf;
	}
	function getFax(){
		return $this->fax;
	}
	function getMail(){
		return $this->email;
	}
	function getObs(){
		return $this->obs;
	}
	
	
	function setTid($tid){
		$this->tid = $tid;
	}
	function setCid($cid){
		$this->cid = $cid;
	}
	function setSid($sid){
		$this->sid = $sid;
	}
	function setData($data){
		$this->data = $data;
	}
	function setNome($nome){
	    $this->nome = $nome;	
	}
	function setEnde($ende){
	    $this->ende = $ende;
	}
	function setBairr($bairr){
	    $this->bairr = $bairr;
	}
	function setCidad($cidad){
	    $this->cidad = $cidad;
	}
	function setCep($cep){
	    $this->cep = $cep;
	}
	function setUf($uf){
	    $this->uf = $uf;
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
	function setDddt($dddt){
	    $this->dddt = $dddt;
	}
	function setTel($tel){
	    $this->tel = $tel;
	}
	function setDddf($dddf){
	    $this->dddf = $dddf;
	}
	function setFax($fax){
	    $this->fax = $fax;
	}
	function setMail($email){
	    $this->email = $email;
	}
	function setObs($obs){
	    $this->obs = $obs;
	}
	
	function addcliJuri(){
		$sql= sprintf("INSERT INTO TBCLIENTE(TID, CID, SID, DATA, NOME, ENDE, BAIRR, CIDAD, CEP, UF, CNPJ, INSC, DDT, TEL, DDF, FAX, MAIL)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->tid, "text"),
			getValorSQL($this->cid, "text"),
			getValorSQL($this->sid, "text"),
			getValorSQL($this->data, "text"),
			getValorSQL($this->nome, "text"),
			getValorSQL($this->ende, "text"),
			getValorSQL($this->bairr, "text"),
			getValorSQL($this->cidad, "text"),
			getValorSQL($this->cep, "text"),
			getValorSQL($this->uf, "text"),
			getValorSQL($this->cnpj, "text"),
			getValorSQL($this->insc, "text"),
			getValorSQL($this->dddt, "text"),
			getValorSQL($this->tel, "text"),
			getValorSQL($this->dddf, "text"),
			getValorSQL($this->fax, "text"),
			getValorSQL($this->email, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cliente Juridico ' . mysql_error());
  		mysql_close($conexao);	
	}
	function addcliFisi(){
		$sql= sprintf("INSERT INTO TBCLIENTE(TID, CID, SID, DATA, NOME, ENDE, BAIRR, CIDAD, CEP, UF, CPF, RG, DDT, TEL, DDF, FAX, MAIL)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->tid, "text"),
			getValorSQL($this->cid, "text"),
			getValorSQL($this->sid, "text"),
			getValorSQL($this->data, "text"),
			getValorSQL($this->nome, "text"),
			getValorSQL($this->ende, "text"),
			getValorSQL($this->bairr, "text"),
			getValorSQL($this->cidad, "text"),
			getValorSQL($this->cep, "text"),
			getValorSQL($this->uf, "text"),
			getValorSQL($this->cpf, "text"),
			getValorSQL($this->rg, "text"),
			getValorSQL($this->dddt, "text"),
			getValorSQL($this->tel, "text"),
			getValorSQL($this->dddf, "text"),
			getValorSQL($this->fax, "text"),
			getValorSQL($this->email, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Cliente Juridico ' . mysql_error());
  		mysql_close($conexao);	
	}
	function consulCliente($ini, $fin){
		$conexao = getConexao();
		$query = "SELECT c.ID, c.TID, c.NOME, c.CPF, c.RG, c.CNPJ, c.INSC, c.ENDE, c.DDT, c.TEL, c.MAIL, s.TIPO FROM TBCLIENTE AS c, TBCSIT AS s WHERE c.SID = s.ID ORDER BY c.NOME LIMIT $ini, $fin ";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function consClin(){
		$conexao = getConexao();
		$query = "SELECT c.ID, c.TID, c.NOME, c.CPF, c.RG, c.CNPJ, c.INSC, c.ENDE, c.DDT, c.TEL, c.MAIL, s.TIPO FROM TBCLIENTE AS c, TBCSIT AS s WHERE c.NOME LIKE '%".$this->nome."%' AND c.SID = s.ID ORDER BY c.NOME";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function consVeicli($vid){
		$conexao = getConexao();
		$query = "SELECT c.NOME, c.CPF, c.RG, c.CNPJ, c.INSC, v.ID FROM TBCLIENTE AS c, TBVEICLI AS v WHERE c.ID = v.CID AND v.VID = $vid AND c.ID IN(SELECT CID FROM TBVEICLI WHERE VID = $vid) ORDER BY NOME";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function clienteTotal(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIENTE";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		$total = mysql_num_rows($resultados);
		return($total);
	}
	function clienteSitua($csi){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIENTE WHERE SID='".$csi."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		$total = mysql_num_rows($resultados);
		return($total);
	}
	function clienteCons($idc){
		$conexao = getConexao();
		$query = "SELECT * FROM TBCLIENTE WHERE ID='".$idc."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function venCli($idc){
		$conexao = getConexao();
		$query = "SELECT c.*, s.TIPO FROM TBCLIENTE AS c, TBCSIT AS s WHERE c.SID = s.ID AND c.ID=(SELECT CID FROM TBVEICLI WHERE ID='".$idc."')";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function alterarJuri($id){
		$sql = "UPDATE TBCLIENTE SET	 
					CID='".$this->cid."',
					SID='".$this->sid."',
					DATA='".$this->data."',
					NOME='".$this->nome."',
					ENDE='".$this->ende."',
					BAIRR='".$this->bairr."',
					CIDAD='".$this->cidad."',
					CEP='".$this->cep."',
					UF='".$this->uf."',
					CNPJ='".$this->cnpj."',
					INSC='".$this->insc."',
					DDT='".$this->dddt."',
					TEL='".$this->tel."',
					DDF='".$this->dddf."',
					FAX='".$this->fax."',
					MAIL='".$this->email."',
					OBS='".$this->obs."'
			WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cliente Juridico ' . mysql_error());
  		return($resultado);
	}
	function alterarFisi($id){
		$sql = "UPDATE TBCLIENTE SET	 
					CID='".$this->cid."',
					SID='".$this->sid."',
					DATA='".$this->data."',
					NOME='".$this->nome."',
					ENDE='".$this->ende."',
					BAIRR='".$this->bairr."',
					CIDAD='".$this->cidad."',
					CEP='".$this->cep."',
					UF='".$this->uf."',
					CPF='".$this->cpf."',
					RG='".$this->rg."',
					DDT='".$this->dddt."',
					TEL='".$this->tel."',
					DDF='".$this->dddf."',
					FAX='".$this->fax."',
					MAIL='".$this->email."',
					OBS='".$this->obs."'
			WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Cliente Juridico ' . mysql_error());
  		return($resultado);
	}
	function deletarCliente($id){
		$sql = "DELETE FROM TBCLIENTE WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Usuario');
  		mysql_close($conexao);
		//Deleta Veículos relacionado a clientes
		$ved = new Veiculo();
		$ved->delVeicli($id);
	}

}

?>
