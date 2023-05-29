<?php
	//devo aprire la sessione prima di distruggerla sennò non riconosce quale eliminare
	session_start();

	session_destroy();

	//ritorno alla pagina di login
	header("Location: login.php");
	exit();

?>