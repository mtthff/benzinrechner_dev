"use strict";

let kmStandValue = '';
let literValue = '';
let betragValue = '';

let kmStand = document.querySelector('[name="kmStand"]');
let liter = document.querySelector('[name="liter"]');
let betrag = document.querySelector('[name="betrag"]');

kmStand.addEventListener('change', function () {
    kmStandValue = this.value;
    let gefahreneKm = kmStandValue - kmStandAlt;
    let td_gefahreneKm = document.querySelector('#gefahreneKm');
    td_gefahreneKm.innerHTML = gefahreneKm + ' km';
    // if (literValue !== '') {
    //     console.log('kmStand:', kmStandValue, 'liter:', literValue);
    // }
});

liter.addEventListener('change', function () {
    literValue = this.value;
    if (kmStandValue !== '') {
    }
});

betrag.addEventListener('change', function () {
    betragValue = this.value;
    if (literValue !== '') {
        let divisionResult = betragValue / literValue;
        let roundedResult = parseFloat(divisionResult.toFixed(2));
        let tdLiterpreis = document.querySelector('#literPreis');
        tdLiterpreis.innerHTML = roundedResult + ' €';
        
        let tdElement = document.querySelector('#gefahreneKm');
        let gefahreneKmText = tdElement.innerHTML;
        // Entfernen Sie die letzten 3 Zeichen (" km")
        let gefahreneKm = parseFloat(gefahreneKmText.slice(0, -3))
        let temp = literValue/ (gefahreneKm / 100);
        // let roundedVerbrauch = Math.round(literValue/ (gefahreneKm / 100));
        let roundedVerbrauch = temp.toFixed(2); // Rundet das Ergebnis auf zwei Nachkommastellen
        // console.log(roundedTemp);
        let tdVerbrauch = document.querySelector('#verbrauch');
        tdVerbrauch.innerHTML = roundedVerbrauch + ' l';
    }
});


