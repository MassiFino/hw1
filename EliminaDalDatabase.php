<?php
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}


Elimina();

function Elimina(){
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$userid = mysqli_real_escape_string($conn, $_SESSION["username"]);

	$title = mysqli_real_escape_string($conn, $_POST['title']);

	$query = "SELECT * FROM PREFERITI WHERE usern = '$userid' AND titolo = '$title'";

	$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0) {
       $query1 = "DELETE FROM PREFERITI WHERE usern = '$userid' AND titolo = '$title'";
       $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
       if($res1 >0){
       	while($row = mysqli_fetch_assoc($res)){
       		$eliminato[] = $row;
       	}
       	echo json_encode($eliminato);
       	exit;
       }
    }
    else{
    	echo json_encode("non eliminato");
    	exit;
    }

}


?>