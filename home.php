<?php
	//avvio la sessione
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}


?>

<html>
	<head>
		<link rel='stylesheet' href='home.css?ts=<?=time()?>&quot'>
		<script src='home.js' defer></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<img class = "menu" src="menu.png">
			<h1 class = "title">GAME FILM TALK</h1>
			 <nav>
    			<ul>
     			 	<li><a href="#">Home</a></li>
      				<li><a href="preferiti.php">Preferiti</a></li>
      				<li><a href="profile.php">Profile</a></li>
      				<li><a href="#">Contact</a></li>
      				<li><a href="logout.php" class = "logout">Logout</a></li>
   				 </ul>
  			</nav>
  			<h1 id = "name">Benvenuto <?php echo $_SESSION["username"]; ?>!</h1>
  			<div>
  				<img id ="foto">
  				<div class = "testo">Vai alle impostazioni profilo</div>
  			</div>
		</header>
		<section>
		<div id=trasparenza>
		<form name='search_content' id='search_content'>
			<h1 class = "cerca">Ultima ricerca</h1>
			<label>Cerca: <input type='text'name='content' id='content'></label>	
			<input class="submit" value ='cerca' type='submit'>
		</form>
			
		<article id="album-view">
		</article>
		</div>
		</section>
		<footer>
		</footer>
	</body>

</html>