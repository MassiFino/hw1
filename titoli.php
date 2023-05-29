<?php
	//avvio la sessione
	session_start();

	if(!isset($_SESSION['username'])){
		//vado alla pagina di login
		header("Location: login.php");
		exit();
	}

	$query = urlencode($_GET["title"]);
	$query2 = urlencode($_GET["q"]);		
	
?>
<html>
	<head>
		<link rel='stylesheet' href='titoli.css?ts=<?=time()?>&quot'>
		<script src='titoli.js' defer></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<header>
			<a href='#' id="link">BACK</a>
		</header>
		<section>
			<div id="myElement" data-parametro1="<?php echo $query; ?>" data-parametro2="<?php echo $query2; ?>"></div>
			<div id=trasparenza>
			<article id="album-view">
			</article>
			<div id="commenti">
				 <h1>Commenti</h1>
				 <div id="comments-list"></div>
				 <div class="comment-section">
					<form class="comment-form">
      					<textarea id="comment-input" placeholder="Inserisci un commento"></textarea>
      					<button type="button" id="bottone">Invia</button>
    				</form>
    			</div>
			</div>
		</div>
		</section>
		<footer>
		</footer>
	</body>
</html>