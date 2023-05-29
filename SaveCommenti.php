<?php
//inizio sessione
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}

$query = urlencode($_GET["q"]);


if($query == "salva"){

	SalvoCommentoDatabase();

}
else if($query == "carico"){
	CaricoCommenti();
}
else{
	EliminoCommento();
}


function SalvoCommentoDatabase(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $comment = mysqli_real_escape_string($conn, $_POST['commento']);
    $anno = mysqli_real_escape_string($conn, $_POST['anno']);
    $data = date("Y-m-d H-i-s");

    $query = "INSERT INTO COMMENTI(usern, titolo, commento, anno, giorno) VALUES('$username','$title','$comment','$anno','$data')";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if($res >0){
    	echo json_encode("inseriti commento");

    }
    else{
    	echo json_encode("commento non inserito");
    }
}


function CaricoCommenti(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");
	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$anno = mysqli_real_escape_string($conn, $_POST['anno']);

	$query = "SELECT * FROM COMMENTI WHERE titolo = '$title' AND anno = '$anno'";


    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) >0){
       	while($row = mysqli_fetch_assoc($res)){
       		$commenti[] = $row;
       	}
       	echo json_encode($commenti);
       	exit;
    }
    else{
    	$result = null;
    	$resultJson = json_encode($result);
    	echo $resultJson;
    }
}


function EliminoCommento(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);

    $query1 = "DELETE FROM COMMENTI WHERE usern = '$username' AND titolo = '$title' AND giorno = '$data'";

    $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));

    if($res1 >0){
       	echo json_encode('eliminato');
       	exit;
    }
    else{
    	echo json_encode('non eliminato');
    }

}

