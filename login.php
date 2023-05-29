<?php
//inizio sessione
session_start();

if(isset($_SESSION["username"])){

	header("Location: home.php");
	exit; //così siamo sicuri di uscire
}


//verifichiamo le credenziali
if(isset($_POST["username"]) && isset($_POST["password"])){

	//connetto al database

	$conn = mysqli_connect("localhost", "root", "", "utenti_app");

	//utilizzo per mettere l'escape dove necessario

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$query = "SELECT * from utenti WHERE username = '".$username."' AND pw = '".$password."'";

	$res = mysqli_query($conn, $query);

	if(mysqli_num_rows($res)>0){

		$_SESSION["username"] = $_POST['username'];

		header("Location: home.php");
		exit;
	}
	else{
		$error = true;
	}
}

?>

<html>
	<head>
		<link rel='stylesheet' href='login.css?ts=<?=time()?>&quot'>
        <script src='login.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<?php
		if(isset($error)){
			echo "<p class='errore'>";
            echo "Credenziali non valide.";
            echo "</p>";
		}

		?>
		
		<main>
  				<h2>LOGIN</h2>
			<form name='credenziali' method='post'>
                <p>
                    <label>Nome utente <input type='text' name='username' placeholder="inserisci il tuo username"></label>
                </p>
                <p>
                    <label>Password<input type='password' name='password' placeholder="inserisci la password"></label>
                </p>
                <p>
                    <label>&nbsp;<input type='submit' value = 'sign in' name = 'accedi'></label>                
                </p>
                  <label><a href = "register.php"> Crea un nuovo account</a></label>
			</form>
		</main>
	</body>
</html>