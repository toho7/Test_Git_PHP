<?php

// In diesem assoziativen Array werden alls Validierungsfehler aufgenommen
$errors = [];

/**
 * Bestätigt, ob ein Name eingegebene wurde und ob dieser
 * nicht länger ist als 20 Zeichen ist
 * @param $name
 * @return bool
 */
function validateName($name) {
    // Mit global erhält man Zugriff auf die globale Variable errors
    // sonst würde $errors als lokale Variable der Funktion gewertet
    global $errors;

    if (strlen($name) == 0) {
        $errors['name'] = "Der Name darf nicht leer sein";
        return false;
    } else if (strlen($name) > 20) {
        $errors['name'] = "Der Name ist zu lang";
        return false;
    } else {
        return true;
    }
}

/**
 * Bestätigt, ob die E-Mail-Adresse gültig ist
 * @param $email
 * @return bool
 */
function validateEmail($email) {
    // Mit global erhält man Zugriff auf die globale Variable errors
    // sonst würde $errors als lokale Variable der Funktion gewertet
    global $errors;

    // mit der Funktion vilter_var die Email-Adresse überprüfen
    if ($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "E-Mail ist ungültig";
        return false;
    } else {
        return true;
    }
}

/**
 * Bestätigt, ob der übergebene Wert ein Zahl ist und
 * ob diese im Bereich 1-5 liegt
 * @param $grade
 * @return bool
 */
function validateGrade($grade) {
    // Mit global erhält man Zugriff auf die globale Variable errors
    // sonst würde $errors als lokale Variable der Funktion gewertet
    global $errors;

    // Prüft ob es eine Zahl ist und ob sie zwischen 1 bis 5 liegt
    if (!is_numeric($grade) || $grade < 1 || $grade > 5) {
        $errors['grade'] = "Die Note ist ungültig";
        return false;
    } else {
        return true;
    }
}

/**
 * Bestätigt, ob eine richtige Auswahl der
 * möglichen Fächer getroffen wurde
 * @param $subject
 * @return bool
 */
function validateSubject($subject) {
    // Mit global erhält man Zugriff auf die globale Variable errors
    // sonst würde $errors als lokale Variable der Funktion gewertet
    global $errors;

    // Prüft, ob Mathematik, Deutsch oder Englisch übergeben wurde
    if ($subject != 'm' && $subject != 'd' && $subject != 'e') {
        $errors['subject'] = "Das Fach ist nicht gültig";
        return false;
    } else {
        return true;
    }
}

/**
 * Bestätigt, ob ein Datum eingegeben wurde
 * und ob dieses Datum gültig, also nicht in der Zukunft liegt.
 * @param $examDate
 * @return bool
 */
function validateExamDate($examDate) {
    // Mit global erhält man Zugriff auf die globale Variable errors
    // sonst würde $errors als lokale Variable der Funktion gewertet
    global $errors;

    try {
        if ($examDate == "") {
            $errors['examDate'] = "Das Prüfungsdatum darf nicht leer sein";
            return false;
        } else if (new DateTime($examDate) > new DateTime()) {
            $errors['examDate'] = "Das Prüfungsdatum darf nicht in der Zukunft liegen";
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        $errors['examDate'] = "Das Prüfungsdatum ist nicht gültig";
        return false;
    }
}

/**
 *
 * Bestätigt die Richtigkeit aller Eingabefehler oder gibt deren Fehler aus
 * @param $name
 * @param $email
 * @param $examDate
 * @param $subject
 * @param $grade
 * @return bool
 */
function validate($name, $email, $examDate, $grade, $subject) {

    return validateName($name)
        & validateEmail($email)
        & validateExamDate($examDate)
        & validateGrade($grade)
        & validateSubject($subject);
}





