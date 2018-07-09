<?
//Pega na Session o Usuario
session_start();
if($_SESSION[user] == ""){
	?>
     <script>
     	window.parent.location = "login.php"; 
     </script>
	<?	
}
?>