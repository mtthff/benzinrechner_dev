'use strict';


let buttonNewVehicle = document.querySelector('#newVehicle');
buttonNewVehicle.addEventListener('click', () => {
    let myModal = new bootstrap.Modal(document.querySelector('#vehicleModal'));

    document.querySelector('#vehicleModalLabel').innerHTML = 'Neues Auto angeben';
    document.querySelector('#formVehicle').setAttribute('action', 'ajax/save_neues_vehicle.php');
    document.querySelector('#IdVehicle').disabled = true;
    document.querySelector('#deleteVehicle').style.display = 'none';
    document.querySelector('#switchVehicleDeaktivieren').style.display = 'none';
    document.querySelector('#submitForm').innerHTML = 'Neues Auto speichern';
    myModal.show();
})

let editIcon = document.querySelectorAll('.editVehicle');
editIcon.forEach((editVehicle) => {
    editVehicle.addEventListener('click', async function () {
        let idVehicle = this.dataset.id;

        let response = await fetch('ajax/get_vehicle_by_id.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({ idVehicle }),
        });

        if (response.ok) {
            let result = await response.json()
            // let result = await response.text()
            // console.log(result);
            // { "id": "1", "name": "Zaf...", "kennzeichen": "S-., ..22", "kmStand": "143874", "datum": "2019-04-12" }

            let myModal = new bootstrap.Modal(document.querySelector('#vehicleModal'));
            document.querySelector('#formVehicle').setAttribute('action', 'ajax/update_vehicle.php');
            document.querySelector('#vehicleModalLabel').innerHTML = 'Auto editieren';
            document.querySelector('#IdVehicle').value = result.id;
            document.querySelector('#name').value = result.name;
            document.querySelector('#kennzeichen').value = result.kennzeichen;
            document.querySelector('#kmStand').value = result.kmStand;
            document.querySelector('#datum').value = result.datum;
            document.querySelector('#switchVehicleDeaktivieren').style.display = 'block';
            document.querySelector('#deaktiviereVehicle').disabled = false;
            document.querySelector('#deleteVehicle').style.display = 'block';
            // document.querySelector('#deleteVehicle').disabled = false;
            document.querySelector('#submitForm').innerHTML = 'Änderungen speichern';

            myModal.show();
        }
    });
});