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

// Zwischenergebnisse bei Dateneingabe ausrechnen
let literValue = '';
let kmStand = document.querySelector('[name="kmStand"]');
let liter = document.querySelector('[name="liter"]');
let betrag = document.querySelector('[name="betrag"]');

kmStand.addEventListener('change', function () {
    let kmStandValue = this.value;

    // tatsächlich gefahrene KM ausrechnen
    // kmStandAlt wird per php in index.php übergeben
    let gefahreneKm = kmStandValue - kmStandAlt;
    let td_gefahreneKm = document.querySelector('#gefahreneKm');

    td_gefahreneKm.innerHTML = gefahreneKm + ' km';
    td_gefahreneKm.setAttribute('data-verbrauch', gefahreneKm); //wird unten bei verbrauch benötigt und vereinfacht die Sache
});

liter.addEventListener('change', function () {
    literValue = this.value;
});

betrag.addEventListener('change', function () {
    let betragValue = this.value;
    if (literValue !== '') {

        // Literpreis ausrechen
        let roundedLiterPreis = parseFloat((betragValue / literValue).toFixed(2));
        document.querySelector('#literPreis').innerHTML = roundedLiterPreis + ' €';

        // oben berechnete gefahrene KM holen
        let gefahreneKm = document.querySelector('#gefahreneKm').getAttribute('data-verbrauch');

        // Verbrauch ausrechnen und auf zwei Kommastellen runden
        let roundedVerbrauch = (literValue / (gefahreneKm / 100)).toFixed(2);

        document.querySelector('#verbrauch').innerHTML = roundedVerbrauch + ' l';
    }
});
