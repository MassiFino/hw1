


fetch('SalvoImmagineDatabase.php?q=Importo').then(dResponse).then(ImJson);

function ImJson(json){
    console.log(json);
    const contenitore = document.querySelector('#foto');
    console.log(contenitore);
    if(json !== 'non presenti'){
        console.log("metto l'immagine");
        contenitore.src = json[0].immagine;
    }
    else{
        contenitore.src = 'foto_profilo.png';

        const formData = new FormData();

        formData.append('image', contenitore.src);

        fetch('SalvoImmagineDatabase.php?q=Carico', {method: 'post', body: formData}).then(dResponse).then(OnJson);
    }

    contenitore.addEventListener('click', Profile);
}

function Profile(event){
    location.href = 'profile.php';
}

const menu = document.querySelector('.menu');

menu.addEventListener('click', MenuClick);

function MenuClick(event){
    const header = event.currentTarget.parentNode;
    const nav = header.querySelector('nav');
    const title = header.querySelector('.title');
    const foto = header.querySelector('#foto');
    const name = header.querySelector('#name');
    console.log(title);
    console.log(name);

    if(nav.classList.contains("active")){
        nav.classList.remove('active');
        header.classList.remove('flex');
        title.classList.remove('width');
        foto.classList.remove('hidden');
        name.classList.remove('hidden');
    }

    else{
        nav.classList.add('active');
        header.classList.add('flex');
        title.classList.add('width');
        foto.classList.add('hidden');
        name.classList.add('hidden');
    }
}


async function Onjson(json){

    const JsonObject = JSON.parse(json);

    //console.log(JsonObject);

    const album = document.querySelector('#album-view');
    album.innerHTML = '';
    album.classList.remove('noRicerche');

    const vettore = JsonObject.Search;

    console.log(vettore);

    for(let element of vettore){

        const sezione = document.createElement('div');
        sezione.classList.add('blocco');

        const title = document.createElement('h1');
        title.textContent = element.Title;
        const image = document.createElement('img');
        if(element.Poster == "N/A"){
            image.src = 'https://www.associazioneostetriche.it/wp-content/uploads/2018/05/immagine-non-disponibile.png';
        }
        else{
            image.src= element.Poster;
        }
        const type = document.createElement('span');
        type.textContent=element.Type;
        type.classList.add('tipo');
        const anno = document.createElement("span");
        anno.textContent= element.Year;
        anno.classList.add('anno');

        const preferiti = document.createElement('div');
        preferiti.classList.add('bottone');

        const like = document.createElement('img');

        const formData = new FormData();
        formData.append('title', title.textContent);

        const result = await fetch("SavePreferiti.php?Carico=controllo", {method: 'post', body: formData}).then(Response, DError).then(Json);

        if(result == true){
            like.src = 'cuore_pieno.png';
            SaveDatabase(title, image, type, anno, like);
        }
        else{
            like.src = 'cuore_vuoto.png';
            SaveDatabase(title, image, type, anno, like);
        }


        preferiti.appendChild(like);


        sezione.appendChild(title);
        sezione.appendChild(image);
        sezione.appendChild(type);
        sezione.appendChild(anno);
        sezione.appendChild(preferiti);

        album.appendChild(sezione);



        sezione.addEventListener('click', OnClick);

        like.addEventListener('click', Click);

    }

}

function SalvoEliminoPreferiti(title, image, type, anno, like){
    console.log("aggiungo ai preferiti");
    const formData = new FormData();
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('type', type.textContent);
    formData.append('anno', anno.textContent);
    formData.append('like', like.src);


    fetch("SavePreferiti.php?Carico=no", {method: 'post', body: formData}).then(dResponse).then(Risultato);
}

function dResponse(response){
    return response.json();
}

function Risultato(json){
    console.log(json);
}

function SalvoDatabase(title, like){

    console.log("sto salvando nel database");
    const formData = new FormData();
    formData.append('title', title.textContent);
    formData.append('like', like.src);

    fetch("ModificaDatabase.php", {method: 'post', body: formData}).then(dResponse).then(Risultato);
}

function Click(event){
    event.stopPropagation();
    console.log('ho cliccato il cuore');
    //console.log(event.currentTarget.src);

    if(event.currentTarget.src.includes('cuore_pieno.png')){
        console.log("sono dentro all'if");
        event.currentTarget.src = 'cuore_vuoto.png';
    }
    else{
        event.currentTarget.src = 'cuore_pieno.png';
        console.log("sono dentro all'else");
    }

    //console.log(event.currentTarget.parentNode.parentNode);
    const blocco = event.currentTarget.parentNode.parentNode;
    const title = blocco.querySelector('h1');
    const image = blocco.querySelector('img');
    const div = blocco.querySelector('div');
    const like = div.querySelector('img');
    const type = blocco.querySelector('.tipo');
    const anno = blocco.querySelector('.anno');

    console.log(type);
    //console.log(like);

    SalvoDatabase(title, like);

    SalvoEliminoPreferiti(title, image, type, anno, like);
}

function OnClick(event){
    event.preventDefault();
    //console.log(event.currentTarget);
    console.log("sono dentro il click");
    const blocco = event.currentTarget;

    const title = blocco.querySelector('h1');


    const titolo = encodeURIComponent(title.textContent);
   // console.log(titolo);
    const content_input = document.querySelector('#content')
    const content_value = encodeURIComponent(content_input.value);
   // console.log(content_value);
    window.location.href = 'titoli.php?title='+titolo+'&q='+content_value;
}


function SaveDatabase(title, image, type, anno, like){

    console.log("sto salvando nel database");
    const formData = new FormData();
    formData.append('title', title.textContent);
    formData.append('image', image.src);
    formData.append('type', type.textContent);
    formData.append('anno', anno.textContent);
    formData.append('like', like.src);

    fetch("SaveDatabase.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);

}

function dispatchResponse(response) {

    console.log(response);
}

function dispatchError(error) { 
    console.log("Errore");
}


function Json(json){
            console.log(json);
            if(json.notfav === "non presente"){
                return false;
            }
            else{
                return true;
            }
        }



 function Response(response){
            return response.json();
        }

        function DError(error){
            console.log("errore");
        }




function searchResponse(response){
    if(!response.ok) return null;
    return response.json();
}

function search(event){

    const content_input = document.querySelector('#content')
    const content_value = encodeURIComponent(content_input.value);
    fetch("richiestaTitoli.php?q="+content_value).then(searchResponse).then(Onjson);
    event.preventDefault();
}


const form = document.querySelector('form');
form.addEventListener('submit', search);

function fetchCarico() {
    fetch("CaricoDalDatabase.php").then(fetchResponse).then(fetchDati);
}


function fetchResponse(response) {
    if (!response.ok) {return null};
    return response.json();
}

async function fetchDati(json) {
    console.log("Fetching...");
    console.log(json);
    if (json === 'non presente') {
        noResults(); 
        return;
    }

    const album = document.querySelector('#album-view');
    album.innerHTML = '';

    for(let element of json){

        const sezione = document.createElement('div');
        sezione.classList.add('blocco');

        const title = document.createElement('h1');
        title.textContent = element.titolo;
        const image = document.createElement('img');
        image.src= element.img;
        const type = document.createElement('span');
        type.textContent=element.tipo;
        type.classList.add('tipo');
        const anno = document.createElement("span");
        anno.textContent= element.anno;
        anno.classList.add('anno');
        const preferiti = document.createElement('div');
        preferiti.classList.add('bottone');

        const like = document.createElement('img');

        const formData = new FormData();
        formData.append('title', title.textContent);


        const result = await fetch("SavePreferiti.php?Carico=controllo", {method: 'post', body: formData}).then(Response, DError).then(Json);

        if(result == true){
            like.src = 'cuore_pieno.png';
        }
        else{
            like.src = 'cuore_vuoto.png';
        }

        preferiti.appendChild(like);

        sezione.appendChild(title);
        sezione.appendChild(image);
        sezione.appendChild(type);
        sezione.appendChild(anno);
        sezione.appendChild(preferiti);
        album.appendChild(sezione);

        //da vedere se si può non ripetere

        sezione.addEventListener('click', OnClick);

        like.addEventListener('click', Click);

    }
}

function noResults() {
    console.log("non ci sono dati");
    const noResult = document.createElement('h2');
    noResult.textContent = 'Non hai ultime ricerche';

    const album = document.querySelector('#album-view');
    album.innerHTML = '';
    const div = document.createElement('div');
    const image = document.createElement('img');
    image.src = 'NoRicerche.png';
    div.appendChild(image);
    album.classList.add('noRicerche');

    album.appendChild(noResult);
    album.appendChild(div);

}

fetchCarico();
