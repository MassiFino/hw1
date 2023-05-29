<?php
//inizio sessione
session_start();

if(!isset($_SESSION["username"])){

	header("Location: login.php");
	exit; //così siamo sicuri di uscire
}


	Database();

function Database(){
	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	$userid = mysqli_real_escape_string($conn, $_SESSION["username"]);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $anno = mysqli_real_escape_string($conn, $_POST['anno']);
    $liked = mysqli_real_escape_string($conn, $_POST['like']);

    

    $query = "SELECT * FROM PAGINA WHERE usern = '$userid' AND titolo = '$title'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));

    if(mysqli_num_rows($res) > 0) {
       echo json_encode(array('ok' => true));
       exit;
    }


    $query = "INSERT INTO PAGINA(usern, titolo, img, tipo, anno, liked) VALUES('$userid','$title','$image','$type','$anno', '$liked')";

    $res2 = mysqli_query($conn, $query) or die(mysqli_error($conn));
        # Se corretta, ritorna un JSON con {ok: true}
        if($res2>0){
            echo json_encode(array('ok' => true));
            exit;
        }

        mysqli_close($conn);
        echo json_encode(array('ok' => false));

}

?>