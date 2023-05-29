

function checkUpload(event){
	console.log('sto inserendo la foto');
	const foto = event.currentTarget;
	//restituisce la dimensione della foto
	const dim = foto.files[0].size;
	//prende il nome della foto e appena incontra il punto prende l'estensione del file
	const ext = foto.files[0].name.split('.').pop;
	if(dim >= 7000000){
		console.log('file supera la dimensione')
	}
	if(!['jpeg', 'png', 'jpg', 'gif'].includes(ext)){
		console.log('non è del formato richiesto')
	}

	const form = document.querySelector('form');

	const formData = new FormData(form);

	fetch('ControlloImmagine.php', {method: 'post', body: formData}).then(response).then(json);
}

function response(response){
	return response.json();
}

function json(json){
	console.log(json);
	const contenitore = document.querySelector('img');
	contenitore.src = json;

	const formData = new FormData();

	formData.append('image', json);

	fetch('SalvoImmagineDatabase.php?q=Carico', {method: 'post', body: formData}).then(response).then(OnJson);

}


function  OnJson(json){
	console.log('caricati');
}


fetch('SalvoImmagineDatabase.php?q=Importo').then(response).then(Json);

function Json(json){
	console.log(json);
	const contenitore = document.querySelector('img');
	console.log(contenitore);
	if(json !== 'non presenti'){
		console.log("metto l'immagine");
		contenitore.src = json[0].immagine;
	}
	else{
		contenitore.src = 'foto_profilo.png';

		const formData = new FormData();

		formData.append('image', contenitore.src);

		fetch('SalvoImmagineDatabase.php?q=Carico', {method: 'post', body: formData}).then(response).then(OnJson);
	}
}



document.getElementById('profile-picture').addEventListener('change', checkUpload);