
async function Onjson(json){
    let jsonObject = JSON.parse(json);
    console.log(jsonObject)

    const album = document.querySelector('#album-view');
    album.innerHTML = '';

    const titolo = jsonObject.Title;
    const img = jsonObject.Poster;
    const attori = jsonObject.Actors;
    const genere = jsonObject.Genre;
    const lingua = jsonObject.Language;
    const AnnoPubl = jsonObject.Released;
    const Regista = jsonObject.Writer;
    const Anno = jsonObject.Year;
    const premi = jsonObject.Awards;
    const trama = jsonObject.Plot;
    const numVoti = jsonObject.imdbRating;

    const header = document.createElement('h2');
    header.textContent = titolo;
    const image = document.createElement('img');
    image.src = img;
    const sezione = document.createElement('div');
    sezione.classList.add('movie-details');
    const info = document.createElement('div');
    info.classList.add('movie-info');
    const summary = document.createElement('div');
    summary.classList.add('movie-summary');
    const partAtt = document.createElement('p');
    const strongAtt= document.createElement('h4');
    strongAtt.textContent = 'Attori'
    partAtt.appendChild(strongAtt);
    const testoAtt = document.createElement('div');
    testoAtt.textContent = attori;
    partAtt.appendChild(testoAtt);
    const partLingua = document.createElement('p');
    const strongLingua= document.createElement('h4');
    strongLingua.textContent = 'Lingua';
    partLingua.appendChild(strongLingua);
    const testoLingua = document.createElement('div');
    testoLingua.textContent = lingua;
    partLingua.appendChild(testoLingua);
    const partgen = document.createElement('p');
    const strongen= document.createElement('h4');
    strongen.textContent = 'Genere';
    partgen.appendChild(strongen);
    const testoGenere = document.createElement('div');
    testoGenere.textContent = genere;
    partgen.appendChild(testoGenere);
    const partUscita = document.createElement('p');
    const strongUscita= document.createElement('h4');
    strongUscita.textContent = 'Data di uscita';
    partUscita.appendChild(strongUscita);
    const testoUscita = document.createElement('div');
    testoUscita.textContent = AnnoPubl;
    partUscita.appendChild(testoUscita);
    const partReg = document.createElement('p');
    const strongReg= document.createElement('h4');
    strongReg.textContent = 'Scritto da';
    partReg.appendChild(strongReg);
    const testoReg = document.createElement('div');
    testoReg.textContent = Regista;
    partReg.appendChild(testoReg);
    const partAnno = document.createElement('p');
    const strongAnno= document.createElement('strong');
    strongAnno.textContent = 'Anno di produzione';
    partAnno.appendChild(strongAnno);
    const testoAnno = document.createElement('div');
    testoAnno.textContent = Anno;
    testoAnno.classList.add('anno');
    partAnno.appendChild(testoAnno);
    const partPremi = document.createElement('p');
    const strongPremi= document.createElement('h4');
    strongPremi.textContent = 'Premi Vinti';
    partPremi.appendChild(strongPremi);
    const testoPremi = document.createElement('div');
    testoPremi.textContent = premi;
    partPremi.appendChild(testoPremi);
    const partVoti = document.createElement('p');
    const strongVoti= document.createElement('h4');
    strongVoti.textContent = 'Punteggio';
    partVoti.appendChild(strongVoti);
    const testoVoti = document.createElement('div');
    testoVoti.textContent = numVoti;
    partVoti.appendChild(testoVoti);
    const plot = document.createElement('div');
    plot.classList.add('movie-plot');
    const strongTrama= document.createElement('h3');
    const partTrama = document.createElement('p');
    strongTrama.textContent = 'Trama';
    partTrama.textContent = trama;
    plot.appendChild(strongTrama);
    plot.appendChild(partTrama);

    const preferiti = document.createElement('div');
    preferiti.classList.add('bottone');
    const bottone = document.createElement('div');
    bottone.setAttribute("id", "cliccabile");

    const formData = new FormData();
    formData.append('title', titolo);

    const result = await fetch("SavePreferiti.php?Carico=controllo", {method: 'post', body: formData}).then(Response, DError).then(Json);

    if(result === true){
        bottone.textContent = 'rimuovi dai preferiti';
        bottone.classList.add('colore');
    }
    else{
        bottone.textContent = 'Aggiungi ai preferiti';
        bottone.classList.remove('colore');
    }

    console.log(bottone.textContent);

    preferiti.appendChild(bottone);

    summary.appendChild(partAtt);
    summary.appendChild(partLingua);
    summary.appendChild(partgen);
    summary.appendChild(partUscita);
    summary.appendChild(partReg);
    summary.appendChild(partAnno);
    summary.appendChild(partPremi);
    summary.appendChild(partVoti);
    info.appendChild(image);
    info.appendChild(summary);
    sezione.appendChild(header);
    sezione.appendChild(info);
    sezione.appendChild(plot);
    sezione.appendChild(preferiti);
    album.appendChild(sezione);


    const link = document.getElementById('link');
    link.addEventListener('click', OnClick);


    bottone.addEventListener('click', Click);

    LeggoCommenti(Anno,titolo);
}


function Click(event){
    console.log('ho cliccato il bottone');
    event.stopPropagation();
    if(event.currentTarget.textContent == 'Aggiungi ai preferiti'){
        event.currentTarget.textContent = 'rimuovi dai preferiti';
        event.currentTarget.classList.add('colore');
    }
    else{
        event.currentTarget.textContent = 'Aggiungi ai preferiti';
        event.currentTarget.classList.remove('colore');
    }

    const bottone = event.currentTarget;
    const blocco = bottone.parentNode.parentNode;

    const titolo = blocco.querySelector('h2');

    const info = blocco.querySelector('movie-details');

    const img = info.querySelector('img');

    console.log(blocco);
    const formData = new FormData();
    formData.append('title', titolo.textContent);
    formData.append('image', img.src);

    fetch("SavePreferiti.php?Carico=no", {method: 'post', body: formData}).then(dispatchResponse, dispatchError).then(DatiJson);
}

function dispatchResponse(response) {

    console.log(response);
    return response.json();
}

function dispatchError(error) { 
    console.log("Errore");
}

function DatiJson(json){
    console.log(json);
}


function OnClick(event){
    console.log("sono dentro il click");
    event.preventDefault();
    event.stopPropagation();
    if(valore2 === "preferiti")
        window.location.href = 'preferiti.php';
    else
        window.location.href = 'home.php';
}


function Response(response){
    return response.json();
}

function DError(error){
    console.log("errore");
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




function searchResponse(response){
    if(!response.ok) return null;
    console.log(response);
    return response.json();
}

// Recupera il riferimento all'elemento HTML
const myElement = document.getElementById("myElement");

// Utilizza i valori degli attributi dati in JavaScript
const valore1 = myElement.getAttribute("data-parametro1");
const valore2 = myElement.getAttribute("data-parametro2");

// Esempio: Stampa i valori in console
console.log(valore1); // Output: valore del parametro1
console.log(valore2); // Output: valore del parametro2

fetch("richiestaApi.php?q="+valore1).then(searchResponse).then(Onjson);


const bottone = document.querySelector('button');

bottone.addEventListener('click', Cliccato);

async function Cliccato(event){
    console.log('ho scritto il commento');
    const content_input = document.querySelector('#comment-input');
    const content_value = content_input.value;
    const formattedText = content_value.replace(/\n/g, "<br>");
    const sezione = event.currentTarget.parentNode.parentNode.parentNode.parentNode;
    const album = sezione.querySelector('#album-view');
    const movie = album.querySelector('.movie-details');
    const titolo = movie.querySelector('h2');
    const info = movie.querySelector('.movie-info');
    const summary = info.querySelector('.movie-summary');
    const anno = summary.querySelector('.anno');
    console.log(anno);
    console.log(titolo);
    const formData = new FormData();
    formData.append('title', titolo.textContent);
    formData.append('commento', formattedText);
    formData.append('anno', anno.textContent);


    const result = await fetch('SaveCommenti.php?q=salva',{method: 'post', body: formData}).then(dispatchResponse, dispatchError).then(OJson);

    if(result == true){
        content_input.value = '';
        console.log('ho salvato il commento');
        LeggoCommenti(anno.textContent,titolo.textContent);
    }

}


function OJson(json){
    return true;

}

function LeggoCommenti(anno,titolo){
    const formData = new FormData();
        formData.append('title', titolo);
        formData.append('anno', anno);
    fetch('SaveCommenti.php?q=carico', {method: 'post', body: formData}).then(ResponseCommenti).then(Comment);

}

function ResponseCommenti(response){
    return response.json();
}

async function Comment(json){
    if(json!==null){
        console.log(json);
        const tabella = document.querySelector('#comments-list');
        tabella.innerHTML = '';
        for(element of json){
            const sezione = document.createElement('div');
            sezione.classList.add('comment');
            const name = document.createElement('h4');
            name.textContent = element.usern+':';
            const commento = document.createElement('span');
            commento.innerHTML = element.commento;

            const data = document.createElement('div');
            data.textContent= element.giorno;
            console.log(data.textContent);
            data.classList.add('data');
            sezione.appendChild(name);
            sezione.appendChild(commento);

            sezione.appendChild(data);

            const result = await fetch('VerificaCommentatore.php?q='+element.usern).then(Response).then(Cjson);

            if(result == true){
                const bottone = document.createElement('div');
                bottone.classList.add('button');
                bottone.textContent = 'elimina';
                sezione.appendChild(bottone);
                bottone.addEventListener('click', Clicked);
            }

            tabella.appendChild(sezione);
        }
    }
    else{
        console.log("non ci sono commenti");
    }

}

function Cjson(json){
    if(json ==='coincidenti'){
        return true;
    }
    else{
        return false;
    }
}

function Clicked(event){
    console.log('cliccato elimina');
    console.log(event.currentTarget.parentNode)
    const commento = event.currentTarget.parentNode;
    const name = commento.querySelector('h4');
    const data =commento.querySelector('.data');
    const album = document.querySelector('#album-view');
    const details = album.querySelector('.movie-details');
    const titolo = details.querySelector('h2');

    const formData = new FormData();
    formData.append('title', titolo.textContent);
    formData.append('data', data.textContent);

    const padre = commento.parentNode;
    console.log(padre);

    padre.removeChild(commento);

    fetch('SaveCommenti.php?q=elimina', {method: 'post', body: formData}).then(Response).then(DatiJson);
}
