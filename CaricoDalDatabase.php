<?php


session_start();

if(!isset($_SESSION["username"])){

	header("Location: home.php");
	exit; //così siamo sicuri di uscire
}


	header('Content-Type: application/json');
 	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION['username']);

 	$query = "SELECT * FROM PAGINA WHERE usern = '".$username."'";

 $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
 if(mysqli_num_rows($res)> 0) {
 	$query = "SELECT titolo, img, tipo, anno, liked FROM PAGINA WHERE usern = '".$username."'";

 	$res2 = mysqli_query($conn, $query) or die(mysqli_error($conn));

    while($row = mysqli_fetch_assoc($res2)) {
        // Scorro i risultati ottenuti e creo l'elenco di post
        $Dati[] = $row;
    }
    mysqli_free_result($res2);
    mysqli_close($conn);
    
    echo json_encode($Dati);

 }
 else{
   echo json_encode('non presente');
 }

?>