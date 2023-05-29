<?php
	//avvio la sessione
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}

	header('Content-Type: application/json');

	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION['username']);
	$query = "DELETE FROM PAGINA WHERE usern = '".$username."'";
	$res = mysqli_query($conn, $query);

	mysqli_close($conn);

	$apikey = '5df27769';
	$url = 'http://www.omdbapi.com/?';

	$curl = curl_init();
	$query = urlencode($_GET["q"]);

	curl_setopt($curl, CURLOPT_URL,$url.'s='.$query.'&apikey='.$apikey);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($curl);
	curl_close($curl);

	echo json_encode($result);
?>