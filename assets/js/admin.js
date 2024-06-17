'use strict';

let buttonNewVehicle = document.querySelector('#newVehicle');
buttonNewVehicle.addEventListener('click', () => {
    let myModal = new bootstrap.Modal(document.querySelector('#vehicleModal'));
    document.querySelector('#vehicleModalLabel').innerHTML = 'Neues Auto angeben';
    myModal.show();
})