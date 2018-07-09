<?
require_once("class/classTipo.php");
require_once("class/classUser.php");

if($_POST[action] == "inseriUser"){//Inserir User
	$user = new User();
	$user->setNome($_POST[userName]);
	$user->setMail($_POST[userEmail]);
	$user->setTipo($_POST[userTipo]);
	$user->setLogin($_POST[userLogin]);
	$user->setPassw($_POST[userSenha]);
	$user->addUser();
	
	?>
    <script>
		alert('Usuário Cadastrado com Sucesso');
		location.href='gereUser.php';
    </script>
	<?
}

if($_GET[action] == "deletarUser"){//Inserir User
	$user = new User();
	$user->deletarUser($_GET[id]);
	
}
$tipo = new Tipo();//Consultar Tipo de User
$result = $tipo->consuTipo();
$total = mysql_num_rows($result);

//Paginacao
$pag = 10;
$ini = 0;
$fim = 10;

//Consulta
$user = new User();//Consultar User
$uresul = $user->consulUser($ini,$fim);
$utotal = mysql_num_rows($uresul);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/formValid.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
	function deletaUser(id, nome){		
		if(confirm('Deletar o usuario '+nome+' ?')){
			location.href='gereUser.php?action=deletarUser&id='+id+'';
		}
	}
</script>
</head>

<body>
<div class="titulo"><strong>Gerenciar Usuários</strong></div>
<hr />
<form action="<?= $PHP_SELF?>" method="post">
<table width="100%" cellspacing="0">
	<tr>
   	  <td class="tabsis"><div align="right">1 2 Próximo</div></td>
    </tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0">
  <tr class="tabescu"> 
    	<td width="19%"><strong>Nome de Usuário</strong></td>
   	    <td width="31%"><strong>Nome</strong></td>
        <td width="22%"><strong>E-mail</strong></td>
        <td width="19%"><strong>Tipo</strong></td>
        <td width="7%"><strong>Açao</strong></td>
  </tr>
<? 
for($e; $e<$utotal; $e++) {
	$ust = mysql_fetch_array($uresul);
	if($cor =="#FFFFFF"){
		$cor = "#DADADA";
	}else{
		$cor = "#FFFFFF";
	}
?>

  <tr bgcolor="<?= $cor?>">
        <td><?= $ust["USER"]?></td>
        <td><?= $ust["NOME"]?></td>
        <td><?= $ust["EMAIL"]?></td>
        <td><?= $ust["TIPO"]?></td>
        <td><a href="#" onClick="deletaUser('<?= $ust["ID"]?>', '<?= $ust["NOME"]?>');"><img src="pictures/b_drop.png" alt="Apagar" border="0" /></a></td>
<?
}
?>
  </tr>
</table>
<table width="100%" cellspacing="0">
	<tr>
      <td width="21%" class="tabsis"><div align="right"> 1 2 Próximo</div></td>
  </tr>
</table>
</form>
<br />
<div class="titulo"><strong>Adicionar Usuário</strong></div>
<hr />
<form action="<?= $PHP_SELF?>" method="post" onSubmit="return validaForm(this)">
<input type="hidden" name="action" value="inseriUser" />
<strong>Todos os campos marcados com * são obrigatórios.</strong>
<table width="100%" cellspacing="0">
	<tr>
    	<td width="15%" class="tabsis"><strong>Nome de usuário*</strong></td>
      <td width="85%" class="tabsis"><input type="text" name="userLogin" size="50" class="input" lang="1" onFocus="mudarCorCampo(this,'white')"/></td>
    </tr>
    <tr>
    	<td class="tabsis">Nome</td>
        <td class="tabsis"><input type="text" name="userName" size="50" class="input" /></td>
    </tr>
    <tr>
    	<td class="tabsis"><strong>Email*</strong></td>
        <td class="tabsis"><input type="text" name="userEmail" size="50" class="input" lang="1" onFocus="mudarCorCampo(this,'white')"/></td>
    </tr>
    <tr>
    	<td class="tabsis"><strong>Senha*</strong></td>
        <td class="tabsis"><input type="text" name="userSenha" size="50" class="input" lang="1" onFocus="mudarCorCampo(this,'white')"/></td>
    </tr>
    <tr>
    	<td class="tabsis"><strong>Funçao*</strong></td>
        <td class="tabsis">
        	<select name="userTipo" class="input" lang="1" onFocus="mudarCorCampo(this,'white')">
            	<option value="Selecione">Selecione</option>
                <? 
				for($i; $i<$total; $i++) {
				$rst = mysql_fetch_array($result);
				?>
                	<option value="<?= $rst["ID"]?>"><?= $rst["TIPO"]?></option>
               	<?
				}
				?>
            </select>    
        </td>
    </tr>
    <tr>
    	<td class="tabsis"></td>
        <td class="tabsis"><input type="submit" class="botao" value=" CADASTRAR USUÁRIO " /></td>
    </tr>
</table>
</form>
<br /><br />
</body>
</html>
