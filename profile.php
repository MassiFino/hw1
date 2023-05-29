<?php
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}


	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	//utilizzo per mettere l'escape dove necessario

	$username = mysqli_real_escape_string($conn, $_SESSION['username']);
	$query1 = "SELECT * from utenti WHERE username = '".$username."'";

	$result = mysqli_query($conn, $query1);


        if(mysqli_num_rows($result)>0){
            
            while($row = mysqli_fetch_object($result)){
            	$username = $row ->username;
            	$name = $row->Nome;
            	$surname = $row->Cognome;
            	$email = $row->email;
            	$password = $row->pw;
            }
        }

?>

<html>

<head>
	<link rel='stylesheet' href='profile.css?ts=<?=time()?>&quot'>
	<script src='profile.js' defer></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
  		<h1>Impostazioni Profilo<a href="home.php">Esc</a></h1>
	</header>
  <form>
    <label for="profile-picture"><strong>Foto Profilo:</strong></label>
    <input type="file" id="profile-picture" name="profile-picture" accept='.jpg, .jpeg, image/gif, image/png'>
    <div id="upload"><div class="file_name">Seleziona un file...</div><div class="file_size"></div></div>

    <div class="profile-picture">
    	<img>
    </div>
    <label for="name"><strong>Username:</strong> <?php echo "$username" ?></label>
    <label for="name"><strong>Nome:</strong> <?php echo "$name" ?></label>
    <label for="name"><strong>Cognome:</strong> <?php echo "$surname" ?></label>
    <label for="email"><strong>Email:</strong> <?php echo "$email" ?></label>   
</body>
</html>
