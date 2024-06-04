'use strict'


// let kategorien = [{ 'label': 'Computer', 'id': '17' }, { 'label': 'alles', 'id': '22' }, { 'label': 'Geldautomat', 'id': '24' }, { 'label': 'Instanthaltung', 'id': '28' }, { 'label': 'Fahrgeld', 'id': '42' }, { 'label': 'Kinderbetreuung', 'id': '60' }, { 'label': 'Lebensmittel', 'id': '61' }, { 'label': 'Bar-EC-Transfer', 'id': '65' }, { 'label': 'Rebecca', 'id': '69' }, { 'label': 'Franziska', 'id': '74' }, { 'label': 'Nachbarschaftshilfe', 'id': '76' }, { 'label': 'Schule', 'id': '78' }, { 'label': 'Hase', 'id': '81' }, { 'label': 'Fest', 'id': '83' }, { 'label': 'Sabine', 'id': '87' }, { 'label': 'Fortbildung', 'id': '4' }, { 'label': 'Kleidung-Rebecca', 'id': '10' }, { 'label': 'Kleidung-Luisa', 'id': '12' }, { 'label': 'Geschenke-Weihnachten', 'id': '13' }, { 'label': 'Geschenke-Ostern', 'id': '14' }, { 'label': 'Kleidung-Fransziska', 'id': '15' }, { 'label': 'Geschenke-Rebecca', 'id': '18' }, { 'label': 'Auto-tanken', 'id': '25' }, { 'label': 'Hobby-Foto', 'id': '27' }, { 'label': 'Freizeit-Ausflug', 'id': '30' }, { 'label': 'Lebensmittel-Weggehen', 'id': '31' }, { 'label': 'Lebensmittel-Essen allg.', 'id': '32' }, { 'label': 'Haushalt-Küche', 'id': '34' }, { 'label': 'Haushalt-Wohnen', 'id': '35' }, { 'label': 'Geschenke-Matthias', 'id': '36' }, { 'label': 'Feste-Weihnachten', 'id': '38' }, { 'label': 'Taschengeld-Rebecca', 'id': '40' }, { 'label': 'Geschenke-Franziska', 'id': '41' }, { 'label': 'Hobby-Bastel-/Malbedarf', 'id': '43' }, { 'label': 'Geschenke-Geschenke', 'id': '44' }, { 'label': 'Körperpflege-Friseur', 'id': '45' }, { 'label': 'Einnahmen-EC-Bar-Transfer', 'id': '47' }, { 'label': 'Haushalt-Büro', 'id': '48' }, { 'label': 'Auto-Parken', 'id': '49' }, { 'label': 'Kleidung-Sabine', 'id': '50' }, { 'label': 'Freizeit-Zeitschriften', 'id': '51' }, { 'label': 'Freizeit-Bücher', 'id': '52' }, { 'label': 'Körperpflege-Gesundheit', 'id': '53' }, { 'label': 'Einnahmen-Geschenk', 'id': '54' }, { 'label': 'Einnahmen-Sonstiges', 'id': '55' }, { 'label': 'Beruf-Zeitschriften', 'id': '57' }, { 'label': 'Auto-sonstiges', 'id': '58' }, { 'label': 'Schule-Luisa', 'id': '59' }, { 'label': 'Lebensmittel-Fest', 'id': '62' }, { 'label': 'Schule-Rebecca', 'id': '63' }, { 'label': 'Musikunterricht-Luisa', 'id': '64' }, { 'label': 'Haushalt-Hygiene', 'id': '66' }, { 'label': 'Schule-Austausch Reims', 'id': '67' }, { 'label': 'Freizeit-Urlaub', 'id': '68' }, { 'label': 'Feste-Firmung', 'id': '70' }, { 'label': 'Taschengeld-Luisa', 'id': '71' }, { 'label': 'Freizeit-Musik', 'id': '72' }, { 'label': 'Musikunterricht-L &amp; F', 'id': '73' }, { 'label': 'Schule-Franziska', 'id': '75' }, { 'label': 'Kleidung-Matthias', 'id': '77' }, { 'label': 'Schule-Schule - allgemein', 'id': '79' }, { 'label': 'Hobby-Sport', 'id': '80' }, { 'label': 'Lebensmittel-Urlaub', 'id': '82' }, { 'label': 'Musikunterricht-Franziska', 'id': '85' }, { 'label': 'Geschenke-Luisa', 'id': '86' }, { 'label': 'Feste-Kommunion F', 'id': '89' }, { 'label': 'Beruf-Sonstiges', 'id': '90' }, { 'label': 'Geschenke-Sabine', 'id': '92' }, { 'label': 'Taschengeld-Franziska', 'id': '94' }, { 'label': 'Haushalt-Garten', 'id': '95' },];

// window.onload = async function () {
//     const url = 'ajax/get_kategorie.php';
//     let response = await fetch(url);
//     let kategorien = await response.json();

//     // console.log(JSON.stringify(kategorien));

//     kategorien.forEach(function (element) {
//         console.log(element.label);
//     });

//     const inputElement = document.querySelector('#kat');


// }

window.onload = async function () {
    const url = 'ajax/get_kategorie.php';
    try {
        let response = await fetch(url);

        if (!response.ok) {
            throw new Error(`HTTP-Fehler! Status: ${response.status}`);
        }

        let responseData = await response.text();
        // console.log("Raw response:", responseData);

        // Überprüfen auf leere Antwort
        if (!responseData.trim()) {
            throw new Error("Leere Antwort erhalten");
        }

        // JSON-Daten als JavaScript-Objekt parsen
        let kategorien;
        try {
            kategorien = JSON.parse(responseData);
        } catch (e) {
            throw new Error("Fehler beim Parsen des JSON: " + e.message);
        }

        // console.log("Parsed response:", kategorien);

        if (!Array.isArray(kategorien)) {
            throw new Error("Erwartetes Array, aber etwas anderes erhalten");
        }

        const selectElement = document.getElementById('kategorien');

        kategorien.forEach(function (element) {
            const option = document.createElement('option');
            option.value = element.id;
            option.textContent = element.label;
            selectElement.appendChild(option);
        });

    } catch (error) {
        console.error("Es ist ein Fehler aufgetreten:", error);
    }
};

