/**
 * Bestätigung Prüfungsdatum vom Client
 * @param elem
 */
function validateExamDate(elem) {
    // Neues Datumsobjekt mit heutigem Datum
    let today = new Date()
    // Die Stunden wird alles auf 0 gesetzt, damit nur das Datum verglichen werden kann
    today.setHours(0,0,0,0)

    // Das übergebene Element wird als Datumsobjekt umgewandelt
    let examDate = new Date(elem.value);
    // Die Stunden wird alles auf 0 gesetzt, damit nur das Datum verglichen werden kann
    examDate.setHours(0,0,0,0)

    /*
    Vergleich der beiden Date-Objekte
    Durch Zugriff auf die css-Klasse des übergebenen Elements ( Bootstrap ), können neue Klassen hinzugefügt werden
     */
    if (examDate <= today) {
        // hinzufügen und entfernen neuer Klassen is-valid und is-invalid
        elem.classList.add("is-valid")
        elem.classList.remove("is-invalid")
    } else {
        // hinzufügen und entfernen neuer Klassen is-valid und is-invalid
        elem.classList.add("is-invalid")
        elem.classList.remove("is-valid")
    }
}
