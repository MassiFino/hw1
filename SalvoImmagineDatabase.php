<?php
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}


	$query = urlencode($_GET["q"]);

	if($query == 'Carico'){
		CaricoDati();
	}
	else{
		ImportoDati();
	}



	function CaricoDati(){

		$conn = mysqli_connect("localhost", "root", "", "utenti_app");
		$userid = mysqli_real_escape_string($conn, $_SESSION["username"]);
		$image = mysqli_real_escape_string($conn, $_POST['image']);

		$query = "SELECT * FROM IMMAGINE WHERE usern = '$userid'";

		$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if(mysqli_num_rows($res)>0){
			$query1 = "UPDATE IMMAGINE SET immagine =  '$image' WHERE usern = '$userid'";
			$res1 = mysqli_query($conn, $query1) or die(mysqli_error($conn));
			if($res1 > 0){

				if($res1 > 0){
					echo json_encode('immagine aggiornata');
					exit;
				}
				else{
					echo json_encode('errore update');
				}

			}
		}
		else{
			$query3 = "INSERT INTO IMMAGINE(usern, immagine) VALUES('$userid','$image')";

			$res3 = mysqli_query($conn, $query3) or die(mysqli_error($conn));

			if($res3 > 0){
				echo json_encode('dati salvati');
				exit;
			}
			else{
			echo json_encode('errore salvataggio');
			}

		}
	}


	function ImportoDati(){
		$conn = mysqli_connect("localhost", "root", "", "utenti_app");
		$userid = mysqli_real_escape_string($conn, $_SESSION["username"]);

		$query = "SELECT * FROM IMMAGINE WHERE usern = '$userid'";

		$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

		if(mysqli_num_rows($res)>0){
			while($row = mysqli_fetch_assoc($res)){
				$Dati[] = $row;
			}
			mysqli_free_result($res);
    		mysqli_close($conn);
    
    		echo json_encode($Dati);
		}
		else{
			echo json_encode('non presenti');
		}
	}

?>