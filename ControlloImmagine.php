<?php
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}

	
   if(isset($_FILES['profile-picture']['size'])){

		 $file_photo = $_FILES['profile-picture']; 

		$type = exif_imagetype($file_photo['tmp_name']); //metto un temporary name al file

		$allowed_type= array(IMAGETYPE_PNG => 'png', IMAGETYPE_JPEG => 'jpg', IMAGETYPE_GIF => 'gif');

		if(isset($allowed_type[$type])){ //SE SI VUOL DIRE CHE IL TIPO COINCIDE CON UNO DEI TRE

	 		if($file_photo['error'] === 0){

				if ($file_photo['size'] < 7000000) {

 					$fileNameNew = uniqid('', true).".".$allowed_type[$type]; //GENERO L'ID CON LA FUNZIONE uniqid //QUESTO NOME SERVIRA' SOLO PER AGGIUNGERLO IN FILEDESTINATION

					$fileDestination = 'avatar/'.$fileNameNew; //GLI ASSEGNO IL NUOVO NOME

					move_uploaded_file($file_photo['tmp_name'], $fileDestination); //MUOVO IL FILE NELLA DESTINAZIONE

					echo json_encode($fileDestination);
				}
			}
		}
	}

?>