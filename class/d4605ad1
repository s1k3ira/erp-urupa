<?
//Classe User
//E: login, senha , S: SQL.
//Desenvolvido por: Bruno Siqueira - email: siqueira@4sys.com.br
//08/10/08 - Versão 1.0

require_once("lib/libConnect.php");//Conexão com Banco de Dados

class User{
	var $nome;
	var $email;
	var $tipo;
	var $login;
	var $passw;

	function GetClassName(){
		return 'User'; 
	}

	function getNome(){
		return $this->nome;
	}
	function getMail(){
		return $this->email;
	}
	function getTipo(){
		return $this->tipo;
	}
	function getLogin(){
		return $this->login;
	}
	function getPassw(){
		return $this->passw;
	}
	
	
	function setNome($nome){
		$this->nome = $nome;
	}
	function setMail($email){
		$this->email = $email;
	}
	function setTipo($tipo){
		$this->tipo = $tipo;
	}
	function setLogin($login){
	    $this->login = $login;	
	}
	function setPassw($passw){
	    $this->passw = md5($passw);
	}
	
	function addUser(){
		$sql= sprintf("INSERT INTO TBUSER(TID, USER, PASS, NOME, EMAIL)VALUES(%s, %s, %s, %s, %s)",
			getValorSQL($this->tipo, "text"),
			getValorSQL($this->login, "text"),
			getValorSQL($this->passw, "text"),
			getValorSQL($this->nome, "text"),
			getValorSQL($this->email, "text"));
			
		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar inserir Usuário ' . mysql_error());
  		mysql_close($conexao);	
	}
	function consulUser($ini, $fin){
		$conexao = getConexao();
		$query = "SELECT u.ID, u.USE_LOGI, u.USE_NOME, u.USE_MAIL, t.USE_TIPO FROM TBUSER AS u, TBTIPO AS t WHERE u.TID = t.ID ORDER BY u.NOME LIMIT $ini, $fin ";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		return($resultados);
	}
	function deletarUser($id){
		$sql = "DELETE FROM TBUSER WHERE ID='".$id."'";
  		$conexao = getConexao();
  		$resultado = mysql_query($sql, $conexao) or Erro('Erro ao tentar excluir o Usuario');
  		mysql_close($conexao);
	}
	//Funcoes de Login do Sistema
	function createSession($uid) {
    	session_start();
		$_SESSION['uid'] = $uid;
    }
	
	function getSession(){
		session_start();
   		if($_SESSION["uid"] == ""){
			header("location:login.php");
		}else{
			$conexao = getConexao();
			$query = "SELECT ID, USE_NOME FROM TBUSER WHERE ID='".$_SESSION["uid"]."'";
    		$resultados = mysql_query($query) or die(mysql_error());
			$prt = mysql_fetch_array($resultados);
			$this->setNome($prt["NOME"]);
		}	
	}
	function checarUser(){
    	$conexao = getConexao();
		$query = "SELECT ID FROM TBUSER WHERE USE_LOGI='".$this->login."' AND USE_PASS='".$this->passw."'";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		if (mysql_num_rows($resultados)>0) {
    		$prt = mysql_fetch_array($resultados);
			$this->createSession($prt["ID"]);
    		header("location:adm.php");
			return true;
    	}else{
    		header("location:login.php?value=1");
			return false;
    	}
    }
	function enviaSenha(){
    	$conexao = getConexao();
		$query = "SELECT * FROM TBUSER WHERE USE_MAIL=$email";
    	$resultados = mysql_query($query) or die(mysql_error());
    	mysql_close($conexao);
		if (mysql_num_rows($resultados)>0) {
    		$result = mysql_fetch_array($resultados);
			
			return true;
    	}else{
    		header("location:senha.php?value=1");
			return false;
    	}
    }
	

    

}

?>
