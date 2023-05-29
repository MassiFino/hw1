<?php
//inizio sessione
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}

header('Content-Type: application/json');
$conn = mysqli_connect("localhost", "root", "", "utenti_app");

$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
$commentatore = mysqli_real_escape_string($conn, $_GET['q']);

if($username == $commentatore){
	echo json_encode('coincidenti');
}
else{
	echo json_encode('non coincidenti');
}