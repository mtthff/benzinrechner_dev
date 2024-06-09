"use strict";

let kmStandValue = '';
let literValue = '';
let betragValue = '';

let kmStand = document.querySelector('[name="kmStand"]');
let liter = document.querySelector('[name="liter"]');
let betrag = document.querySelector('[name="betrag"]');

kmStand.addEventListener('change', function () {
    kmStandValue = this.value;
    if (literValue !== '') {
        console.log('kmStand:', kmStandValue, 'liter:', literValue);
    }
});

liter.addEventListener('change', function () {
    literValue = this.value;
    if (kmStandValue !== '') {
        console.log('kmStand:', kmStandValue, 'liter:', literValue);
    }
});

betrag.addEventListener('change', function () {
    betragValue = this.value;
    if (literValue !== '') {
        let divisionResult = betragValue / literValue;
        let roundedResult = parseFloat(divisionResult.toFixed(2));
        let tdLiterpreis = document.querySelector('#literPreis');
        tdLiterpreis.innerHTML = roundedResult + ' €';
    }
});


