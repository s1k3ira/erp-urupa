<?
//Classe Veiculo
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//17/12/08 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados
require_once("lib/Erro.php");//Classe de Erro

class Veiculo{
	var $cid;
	var $vid;
	var $data;
	var $placa;
	var $uf;
	var $marca;
	var $modelo;
	var $ano;
	var $tipo;
	var $cor;
	var $comp;
	var $larg;
	var $altu;
	var $tabua;
	var $descoc;
	var $descos;
	var $totalc;
	var $totals;
	var $mnome;
	var $cpf;
	var $rg;
	var $dddt;
	var $tel;
	var $dddc;
	var $cel;
	var $nex;
	

	function GetClassName(){
		return 'Veiculo'; 
	}

	
	function getData(){
		return $this->data;
	}
	function getPlaca(){
		return $this->placa;
	}
	function getUf(){
		return $this->uf;
	}
	function getMnome(){
		return $this->mnome;
	}
	function getDcomp(){
		return $this->dcomp;
	}
	function getDlarg(){
		return $this->dlarg;
	}
	function getDaltu(){
		return $this->daltu;
	}
	function getDtota(){
		return $this->dtota;
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
	function getDddc(){
		return $this->dddc;
	}
	function getCel(){
		return $this->cel;
	}
	function getCid(){
		return $this->cid;
	}
	function getVid(){
		return $this->vid;
	}
	function getNex(){
		return $this->nex;
	}
	
	

	
	function setCid($cid){
		$this->cid = $cid;
	}
	function setVid($vid){
		$this->vid = $vid;
	}
	function setData($data){
		$this->data = $data;
	}
	function setPlaca($placa){
	    $this->placa = $placa;
	}
	function setUf($uf){
	    $this->uf = $uf;
	}
	function setMarca($marca){
	    $this->marca = $marca;
	}
	function setModelo($modelo){
	    $this->modelo = $modelo;
	}
	function setAno($ano){
	    $this->ano = $ano;
	}
	function setTipo($tipo){
	    $this->tipo = $tipo;
	}
	function setCor($cor){
	    $this->cor = $cor;
	}
	function setComp($comp){
	    $this->comp = $comp;
	}
	function setLarg($larg){
	    $this->larg = $larg;
	}
	function setAltu($altu){
	    $this->altu = $altu;
	}
	function setTabu($tabua){
	    $this->tabua = $tabua;
	}
	function setDescoc($descoc){
	    $this->descoc = $descoc;
	}
	function setDescos($descos){
	    $this->descos = $descos;
	}
	function setTotalc($totalc){
	    $this->totalc = $totalc;
	}
	function setTotals($totals){
	    $this->totals = $totals;
	}
	function setMome($mnome){
	    $this->mnome = $mnome;	
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
	function setDddc($dddc){
	    $this->dddc = $dddc;
	}
	function setCel($cel){
	    $this->cel = $cel;
	}
	function setNex($nex){
	    $this->nex = $nex;
	}
	
	
		
	function cadaVei(){
		$sql= sprintf("INSERT INTO TBVEICULO(VEI_DATA, VEI_PLAC, VEI_ESTA, VEI_MARC, VEI_MODE, VEI_ANOV, VEI_TIPO, VEI_COR, VEI_COMP, VEI_LARG, VEI_ALTU, VEI_TABU, VEI_DCOM, VEI_DSEM, VEI_TCOM, VEI_TSEM, VEI_NOME, VEI_CPF, VEI_RG, VEI_TDDD, VEI_TELE, VEI_CDDD, VEI_CELU, VEI_NEXT)VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			getValorSQL($this->data, "text"),
			getValorSQL($this->placa, "text"),
			getValorSQL($this->uf, "text"),
			getValorSQL($this->marca, "text"),
			getValorSQL($this->modelo, "text"),
			getValorSQL($this->ano, "text"),
			getValorSQL($this->tipo, "text"),
			getValorSQL($this->cor, "text"),
			getValorSQL($this->comp, "text"),
			getValorSQL($this->larg, "text"),
			getValorSQL($this->altu, "text"),
			getValorSQL($this->tabua, "text"),
			getValorSQL($this->descoc, "text"),
			getValorSQL($this->descos, "text"),
			getValorSQL($this->totalc, "text"),
			getValorSQL($this->totals, "text"),
			getValorSQL($this->mnome, "text"),
			getValorSQL($this->cpf, "text"),
			getValorSQL($this->rg, "text"),
			getValorSQL($this->dddt, "text"),
			getValorSQL($this->tel, "text"),
			getValorSQL($this->dddc, "text"),
			getValorSQL($this->cel, "text"),
			getValorSQL($this->nex, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Veiculo ' . mysql_error());
  		mysql_close($conexao);	
	}
	
	function addVeicli(){
		$conexao = getConexao();
		$query = "SELECT ID FROM TBVEICULO WHERE VEI_PLAC='".$this->placa."'";
		$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		$placa = mysql_fetch_array($resultados);
		if($placa[ID] == ""){
			?>
            <script>
				alert('VEÍCULO NÃO CADASTRADO');
            </script>
			<?
		}else{
		$sql= sprintf("INSERT INTO TBCLIVEI (CID, VID)VALUES(%s, %s)",
			getValorSQL($this->cid, "text"),
			getValorSQL($placa[ID], "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Veiculo ' . mysql_error());
  		mysql_close($conexao);
		?>
            <script>
				alert('VEÍCULO FILIADO COM SUCESSO');
            </script>
			<?
		}
	}
	function updateVeiculo(){
		$sql = "UPDATE TBVEICULO SET	 
					VEI_DATA='".$this->data."', 
					VEI_PLAC='".$this->placa."', 
					VEI_ESTA='".$this->uf."', 
					VEI_MARC='".$this->marca."', 
					VEI_MODE='".$this->modelo."', 
					VEI_ANOV='".$this->ano."', 
					VEI_TIPO='".$this->tipo."', 
					VEI_COR='".$this->cor."', 
					VEI_COMP='".$this->comp."', 
					VEI_LARG='".$this->larg."', 
					VEI_ALTU='".$this->altu."', 
					VEI_TABU='".$this->tabua."', 
					VEI_DCOM='".$this->descoc."', 
					VEI_DSEM='".$this->descos."', 
					VEI_TCOM='".$this->totalc."', 
					VEI_TSEM='".$this->totals."', 
					VEI_NOME='".$this->mnome."', 
					VEI_CPF='".$this->cpf."', 
					VEI_RG='".$this->rg."', 
					VEI_TDDD='".$this->dddt."', 
					VEI_TELE='".$this->tel."', 
					VEI_CDDD='".$this->dddc."', 
					VEI_CELU='".$this->cel."', 
					VEI_NEXT='".$this->nex."'
			WHERE ID='".$this->vid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar alterar Veículo ' . mysql_error());
  		return($resultado);
	}
	
	function consulVeiculo(){
		$conexao = getConexao();
		$query = "SELECT ID, VEI_PLAC, VEI_NOME, VEI_TCOM, VEI_TSEM, VEI_TDDD, VEI_TELE, VEI_CDDD, VEI_CELU, VEI_CPF FROM TBVEICULO ORDER BY VEI_PLAC";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function consVeipn(){
		$conexao = getConexao();
		if($this->placa == ""){
			$query = "SELECT ID, VEI_PLAC, VEI_NOME, VEI_TCOM, VEI_TSEM, VEI_TDDD, VEI_TELE, VEI_CDDD, VEI_CELU, VEI_CPF FROM TBVEICULO WHERE VEI_NOME LIKE '%".$this->mnome."%'  ORDER BY VEI_PLAC";
		}else{
			$query = "SELECT ID, VEI_PLAC, VEI_NOME, VEI_TCOM, VEI_TSEM, VEI_TDDD, VEI_TELE, VEI_CDDD, VEI_CELU, VEI_CPF FROM TBVEICULO WHERE VEI_PLAC ='".$this->placa."' ORDER BY VEI_PLAC";
		}
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function consVei(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO WHERE ID='".$this->vid."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function veiPlaca(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO WHERE VEI_PLAC='".$this->placa."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function veiculoTotal(){
		$conexao = getConexao();
		$query = "SELECT * FROM TBVEICULO";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		$total = mysql_num_rows($resultados);
		return($total);
	}
	function delVeiculo($id){
		$sql = "DELETE FROM TBVEICULO WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Veículo');
  		mysql_close($conexao);
	}
	function delVeicli(){
		$sql = "DELETE FROM TBCLIVEI WHERE ED='".$this->cid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Veículo');
  		mysql_close($conexao);
	}
	
	function listaVei(){
		$conexao = getConexao();
		$query = "SELECT v.*, c.ED FROM TBVEICULO AS v, TBCLIVEI AS c WHERE c.CID='".$this->cid."' AND c.VID=v.ID";
		$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	
	function deleCve(){
		$sql = "DELETE FROM TBCLIVEI WHERE CID='".$this->cid."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Produto');
  		mysql_close($conexao);
	}
	
}

?>
