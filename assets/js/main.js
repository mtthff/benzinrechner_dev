"use strict";

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


