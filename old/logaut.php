<?
require_once("class/classUser.php");

//Pega na Session o Usuario
session_start();
$use = new User();
$usua = $_SESSION['uid'];

if($usua == ""){
	?>
     <script>
     	window.parent.location = "login.php"; 
     </script>
	<?	
} 
?>