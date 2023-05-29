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

?>
<html>
<head>
	<link rel='stylesheet' href='preferiti.css?ts=<?=time()?>&quot'>
	<script src='preferiti.js' defer></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<header>
  		<h1>PREFERITI</h1><a href="home.php">Esc</a>
	</header>
	<section>
		<article id="album-view">
		</article>
	</section>
	<footer>
	</footer>
</body>
</html>