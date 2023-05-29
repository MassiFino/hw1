
<?php
    if(isset($_POST["username"]) && isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"])){
	    $conn = mysqli_connect("localhost", "root", "", "utenti_app");
        
        $user = mysqli_real_escape_string($conn, $_POST['username']);
	    $name = mysqli_real_escape_string($conn, $_POST['name']);
	    $surname = mysqli_real_escape_string($conn, $_POST['surname']);
	    $email = mysqli_real_escape_string($conn, $_POST['email']);
	    $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query1 = "SELECT * from utenti WHERE email = '".$email."'";
        $query2 = "SELECT * from utenti WHERE username = '".$user."'";

        $res1 = mysqli_query($conn, $query1);
        $res2 = mysqli_query($conn, $query2);

        $err = array();

        if(mysqli_num_rows($res1)>0){
            $err1 = true ;
        }
        if(mysqli_num_rows($res2)>0){
            $err2 = true ;
        }

        else{

                 if(!preg_match('/^[a-zA-Z0-9]{1,15}$/', $_POST['username'])){
                    $err[] = "Username non soddisfa i requisiti richiesti";
                 }

                $uppercasePattern = '/[A-Z]/';     // Corrispondenza di almeno una lettera maiuscola
                $numberPattern = '/[0-9]/';         // Corrispondenza di almeno un numero
                $specialCharPattern = '/[^A-Za-z0-9]/';  // Corrispondenza di almeno un carattere speciale

                if (!preg_match($uppercasePattern, $_POST['password']) && !preg_match($numberPattern, $_POST['password']) && !preg_match($specialCharPattern, $_POST['password'])) {

                    $err[] = "la password non soddisfa i requisiti richiesti";
                }

                if(count($err) == 0){
	               $query = "INSERT INTO UTENTI(username, Nome, Cognome, email, pw) VALUES(\"$user\",\"$name\", \"$surname\",\"$email\", \"$password\")";
                    $res = mysqli_query($conn, $query);
        
                    if($res>0){
                        header("Location: login.php");
                        exit;
                    }
                    else{
                        echo "Errore nell' if";
                    }
                }
            }
    }

 ?>
    <html>
    <head>
        <link rel='stylesheet' href='login.css?ts=<?=time()?>&quot'>
        <script src='register.js' defer></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <main>
            <form name='credenziali' action = 'register.php' method='post'>
                <h2>REGISTER</h2>
                <p>
                    <label>Username<input type='text' name='username' placeholder="inserisci un nome utente"></label>
                </p>
                <?php
                    if(isset($err2)){
                        echo "<p class='errore'>";
                        echo "Username già in uso";
                        echo "</p>";
                    }
                ?>
                <p>
                    <label>Nome <input type='text' name='name' placeholder="inserisci il tuo nome"></label>
                </p>
                <p>
                    <label>Cognome<input type='text' name='surname' placeholder="inserisci il tuo cognome"></label>
                </p>
                <p>
                    <label>Email<input type='email' name='email' placeholder="inserisci una email"></label>
                    <?php
                if(isset($err1)){
                     echo "<p class='errore'>";
                     echo "email collegata ad un account";
                    echo "</p>";
                }
                ?>
                </p>
                <p class ="password">
                    <span class = "testo">La tua password deve contenere almeno 6 caratteri di cui:  una lettera maiuscola, un numero e un carattere speciale </span>
                    <label>Password <input type='password' class= "cursor" name='password' require></label>
                </p>
                <p>
                    <label>&nbsp;<input type='submit' value ="iscriviti"></label>
                </p>
                Sei gia iscritto? <a href = "login.php">Clicca Qui<a>
            </form>
        </main>
    </body>
</html>