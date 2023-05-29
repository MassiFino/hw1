function verifica(event){
    console.log("sono nel javascript");
	if(form.password.value.length< 6)
    {
        // Avvisa utente
        alert("La password deve avere almeno 6 caratteri ");
        // Blocca l'invio del form
        event.preventDefault();
    }
    else if(form.name.value.length == 0 || form.surname.value.length == 0 || 
        form.email.value.length == 0 || form.password.length == 0){

        alert("Compilare tutti i campi");
        // Blocca l'invio del form
        event.preventDefault();
    }

    
    const iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
    const alfabeto = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    const number = "1234567890";
    let cont = 0;
    let char = 0;
    let num = 0;

    for (let i = 0; i < form.password.value.length; i++) {
        if (iChars.indexOf(form.password.value.charAt(i)) !== -1) {
            cont = 1;

        }
        if(alfabeto.indexOf(form.password.value.charAt(i)) !== -1){
            if(form.password.value.charAt(i) === form.password.value.charAt(i).toUpperCase()){
                char = 1;
            }
        }
        if(number.indexOf(form.password.value.charAt(i)) !== -1){
            num = 1;
        }
    }

    if(cont == 0){
        alert ("La tua password deve contenere almeno un  carattere speciale");
        event.preventDefault();
    }
    if(char == 0){
        alert ("La tua password deve contenere almeno una lettera maiuscola");
        event.preventDefault();
    }
    if(num == 0){
        alert ("La tua password deve contenere almeno un numero");
        event.preventDefault();
    }
}


const form= document.forms['credenziali'];
form.addEventListener('submit', verifica);