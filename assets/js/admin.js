'use strict';


let buttonNewVehicle = document.querySelector('#newVehicle');
buttonNewVehicle.addEventListener('click', () => {
    let myModal = new bootstrap.Modal(document.querySelector('#vehicleModal'));

    document.querySelector('#vehicleModalLabel').innerHTML = 'Neues Auto angeben';
    document.querySelector('#formVehicle').setAttribute('action', 'ajax/save_neues_vehicle.php');
    document.querySelector('#IdVehicle').disabled = true;
    document.querySelector('#deleteVehicle').style.display = 'none';
    document.querySelector('#switchVehicleAktiv').style.display = 'none';
    document.querySelector('#submitForm').innerHTML = 'Neues Auto speichern';
    myModal.show();
})

let buttonDeleteVehicle = document.querySelector('#deleteVehicle');
buttonDeleteVehicle.addEventListener('click', async function () {
    if (confirm('Soll dieses Auto wirklich gelöscht werden?')) {
        let id = this.dataset.id;
        // console.log(idEintrag);
        let response = await fetch('ajax/delete_vehicle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify({ id }),
        });

        if (response.ok) {
            location.reload();
            // let result = await response.text()
            // console.log(result);
        }
    } else {
        location.reload();
    }

});

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
            // { id: "1", name: "Zafira", kennzeichen: "S-RF 2822", kmStand: "143874", datum: "2019-04-12", aktiv: "ja", eintraege: "251" }

            let myModal = new bootstrap.Modal(document.querySelector('#vehicleModal'));
            document.querySelector('#formVehicle').setAttribute('action', 'ajax/update_vehicle.php');
            document.querySelector('#vehicleModalLabel').innerHTML = 'Auto editieren';
            document.querySelector('#IdVehicle').value = result.id;
            document.querySelector('#name').value = result.name;
            document.querySelector('#kennzeichen').value = result.kennzeichen;
            document.querySelector('#kmStand').value = result.kmStand;
            document.querySelector('#datum').value = result.datum;
            document.querySelector('#vehicleAktiv').style.display = 'block';
            document.querySelector('#vehicleAktiv').disabled = false;
            if (result.eintraege === null) {
                document.querySelector('#deleteVehicle').style.display = 'block';
                document.querySelector('#deleteVehicle').disabled = false;
                document.querySelector('#deleteVehicle').setAttribute("data-id", result.id);
            }else{
                document.querySelector('#deleteVehicle').style.display = 'none';
                document.querySelector('#deleteVehicle').disabled = true;
            }
            let checkboxAktiv = document.querySelector('#vehicleAktiv');
            result.aktiv === 'ja' ? checkboxAktiv.checked = true : checkboxAktiv.checked = false;
            document.querySelector('#submitForm').innerHTML = 'Änderungen speichern';

            myModal.show();

        }
    });
});
