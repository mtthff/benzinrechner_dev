"use strict";

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
            document.querySelector('#bemerkung').value = result.bemerkung;
            myModal.show();
        }

    });
}); 
