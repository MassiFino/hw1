function Onjson(json){
	console.log(json);

	const album = document.querySelector('#album-view');
    album.innerHTML = '';

	for(let element of json){

		const sezione = document.createElement('div');
        sezione.classList.add('blocco');

        const title = document.createElement('h1');
        title.textContent = element.titolo;
        const image = document.createElement('img');
        if(element.Poster == "N/A"){
            image.src = 'https://www.associazioneostetriche.it/wp-content/uploads/2018/05/immagine-non-disponibile.png';
        }
        else{
            image.src= element.img;
        }

        const preferiti = document.createElement('div');
    	preferiti.classList.add('bottone');

    	const like = document.createElement('img');
    	like.src = 'trash.png';

    	preferiti.appendChild(like);

        sezione.appendChild(title);
        sezione.appendChild(image);
        sezione.appendChild(preferiti);
    
        album.appendChild(sezione);

        like.addEventListener('click', Onclick);

    	sezione.addEventListener('click', Click);
/*
        function Click(event){
            event.preventDefault();
            console.log("sono dentro il click");
            const titolo = encodeURIComponent(title.textContent);
            console.log(titolo);
            window.location.href = 'titoli.php?title='+titolo+'&q=preferiti';
        }*/
    }

}

function Click(event){
    event.preventDefault();
    console.log("sono dentro il click");
    console.log(event.currentTarget);
    const title = event.currentTarget.querySelector('h1'); 
    const titolo = encodeURIComponent(title.textContent);
    console.log(titolo);
    window.location.href = 'titoli.php?title='+titolo+'&q=preferiti';
}

function Json(json){
    console.log(json);
    if(json != "non eliminato"){
       return true;
    }
    else{
        return false;
    }
}

function Response(response){
    return response.json();
}

function DError(error){
    console.log("errore");
}


async function Onclick(event){
    event.stopPropagation();
    var evento = event.currentTarget;
    console.log("ho cliccato il cestino");

    const blocco = evento.parentNode.parentNode;
    console.log(blocco);

    const title = blocco.querySelector('h1');
    const formData = new FormData();

    formData.append('title', title.textContent);

    const result = await fetch("EliminaDalDatabase.php", {method: 'post', body: formData}).then(Response, DError).then(Json);

    if(result == true){
        const sezione = blocco.parentNode;
        console.log(sezione);
        sezione.removeChild(blocco);
    }
}



function searchResponse(response){
    if(!response.ok) return null;
    console.log(response);
    return response.json();
}



fetch("SavePreferiti.php?Carico=si").then(searchResponse).then(Onjson);