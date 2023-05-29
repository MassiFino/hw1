
function verifica(event){
	if(form.username.value.length == 0 ||
       form.password.value.length == 0)
    {
        // Avvisa utente
        // (meglio con div nascosto)
        alert("Compilare tutti i campi.");
        // Blocca l'invio del form
        event.preventDefault();
    }
}

















const form= document.forms['credenziali'];
form.addEventListener('sign in', verifica);