<?php
//inizio sessione
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}


	ModificaDatabase();

function ModificaDatabase(){
    header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$userid = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $mipiace = mysqli_real_escape_string($conn, $_POST['like']);

    $query = "UPDATE PAGINA SET liked =  '$mipiace' WHERE usern = '$userid' AND titolo = '$title'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if($res > 0) {
       echo json_encode("pagina modificata");
       exit;
    }

    mysqli_close($conn);
    echo json_encode("errore non modificata");

}

?>