<?php
//inizio sessione
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}

$query = urlencode($_GET["Carico"]);


if($query == "si"){

	CaricoPreferiti();

}
else if($query == "controllo"){
	ControlloPreferiti();
}
else{

	SalvoPreferiti();
}

function SalvoPreferiti(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $anno = mysqli_real_escape_string($conn, $_POST['anno']);
    $like = mysqli_real_escape_string($conn, $_POST['like']);


    $query = "SELECT * FROM PREFERITI WHERE usern = '$username' AND titolo = '$title'";


    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0) {
       $query1 = "DELETE FROM PREFERITI WHERE usern = '$username' AND titolo = '$title'";
       $res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
       exit;
    }

    $query2 = "INSERT INTO PREFERITI(usern, titolo, img, tipo, anno, liked) VALUES('$username','$title','$image','$type','$anno','$like')";

    $res2 = mysqli_query($conn, $query2) or die(mysqli_error($conn));
    if($res2>0){
    	echo json_encode("ok, inserito");
    }
    mysqli_close($conn);
}


function CaricoPreferiti(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");
	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);

	$query = "SELECT * FROM PREFERITI WHERE usern = '$username'";
	
	$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if(mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			$risultati[] = $row;
		}

		mysqli_free_result($res);
		mysqli_close($conn);

		echo json_encode($risultati);
	}
	else{
		echo json_encode(false);
	}

}


function ControlloPreferiti(){
	header('Content-Type: application/json');
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$username = mysqli_real_escape_string($conn, $_SESSION["username"]);

	$title = mysqli_real_escape_string($conn, $_POST['title']);

	$query = "SELECT * FROM PREFERITI WHERE usern = '$username' AND titolo = '$title'";


    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0) {
     /*  while($row = mysqli_fetch_assoc($res)){
			$risultati[] = $row;
		}

		mysqli_free_result($res);
		mysqli_close($conn);
*/
		echo json_encode(array('notfav'=> 'presente'));
		exit();
    }
    else{
    	echo json_encode(array('notfav'=> 'non presente'));
    	exit();
    }

}

?>