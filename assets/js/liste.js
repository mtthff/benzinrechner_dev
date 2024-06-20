"use strict";

// Select Optionen für Fahrzeugauswahl einlesen
window.onload = async function () {
    let response = await fetch('ajax/get_vehicle.php');

    let result = await response.json();
    // let result = await response.text();
    // console.log(result);
    // "id": "1", "name": "Zafira", "kennzeichen": "S-RF 2822", "kmStand": "143874", "datum": "2019-04-12", "aktiv": "ja"}

    const selectElement = document.querySelector('#vehicle');
    result.forEach(function (element) {
        let option = document.createElement('option');
        option.value = element.id;
        option.textContent = element.name + ' · ' + element.kennzeichen;
        selectElement.appendChild(option);
    });
}

if (triggerFunction) {
    console.log(triggerFunction);
    alert ('Bitte Fahrzeug auswählen!');
}

document.querySelector('#vehicle').addEventListener('change', function(){
    let id = this.value;
    window.location = 'liste.php?id=' + id;
})

// Eintrag editieren
let editIcon = document.querySelectorAll('.editEintrag');
editIcon.forEach(function (element) {
    element.addEventListener('click', async function () {
        let idEintrag = element.dataset.id;

        let response = await fetch('ajax/get_eintrag.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({ idEintrag }),
        });

        if (response.ok) {
            let result = await response.json()
            console.log(result);

            let myModal = new bootstrap.Modal(document.getElementById('editModal'));
            document.querySelector('#id').value = result.id;
            document.querySelector('#datum').value = result.datum;
            document.querySelector('#kmStand').value = result.kmStand;
            document.querySelector('#liter').value = result.liter;
            document.querySelector('#preis').value = result.preis;
            let vollgetankt = (result.vollgetankt === 'ja') ? document.querySelector('#vollgetankt').checked = true : document.querySelector('#vollgetankt').checked = false ;
            document.querySelector('#bemerkung').value = result.bemerkung;
            myModal.show();
        }

    });
}); 
