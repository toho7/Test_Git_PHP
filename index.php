#HAAAAAALLLOOOO

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Notenerfassung</title>

    <!-- Einbindung JS File -->
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<div class="container">

    <!-- Überschrift -->

    <h1 class="mt-5 mb-3">Notenerfassung</h1>

    <!-- PHP Code - Formularbearbeitung -->

    <?php

    // Einbinden von Skripten.
    // Dazu gibt es 2 Möglichkeiten. include und require.
    // include funktioniert auch wenn der Pfad der zum Skript fehlerhaft ist
    // bei require muss der Pfad stimmen, sonst wird abgebrochen.
    require "lib/func.inc.php";

    // Initialisierung der Variablen mit einem Leerzeichen, damit die Bedingung auch dann durchgeführt werden kann
    // wenn vom Anwender ein Feld nicht ausgefüllt wurde

    $name = '';
    $email = '';
    $examDate = '';
    $grade = '';
    $subject = '';

    // Prüfen ob man POST hat vom submit button
    if (isset($_POST['submit'])) {
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $examDate = isset($_POST['examDate']) ? $_POST['examDate'] : '';
        $grade = isset($_POST['grade']) ? $_POST['grade'] : '';
        $subject = isset($_POST['subject']) ? $_POST['subject'] : '';


        // Überprüfung der Funktion validate aus func.inc.php
        // Bestätigt die Ausgaben der HTML-Seite
        // Anschließend wird angezeigt ob die Daten korrekt sind oder nicht
        if (validate($name, $email, $examDate, $grade, $subject)) {
            echo "<p class='alert alert-success'>Die eingegeben Daten sind korrekt</p>";
        } else {
            echo "<div class='alert alert-danger'><p>Die eingegeben Daten sind nicht korrekt</p><ul>";

            foreach ($errors as $key => $value) {
                echo "<li>" . $value . "</li>";
            }
            echo "</ul></div>";
        }
    }
    ?>


    <!-- Formular -->
    <form id="form_grade" action="index.php" method="post">

        <!-- Erster Reihencontainer -->
        <div class="row">

            <!-- Erste Spalte für Name -->
            <div class="col-sm-6 form-group">
                <label for="name">Name*</label>

                <input type="text"
                       name="name"
                       class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($name) ?>"
                       maxlength="20"
                       required="required"/> <!-- Required bedeuted verpflichtend auszufüllen -->
            </div>

            <!-- Zweite Spalte für Email -->
            <div class="col-sm-6 form-group">
                <label for="email">E-Mail</label>
                <input type="email"
                       name="email"
                       class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                       value="<?= htmlspecialchars($email) ?>"
                />
            </div>
        </div>

        <!-- Zweiter Reihencontainer -->
        <div class="row">

            <!-- Erste Spalte für Fach -->
            <div class="col-sm-4 form-group">
                <label for="subject">Fach*</label>
                <select name="subject"
                        class="custom-select <?= isset($errors['subject']) ? 'is-invalid' : '' ?>"
                        required="required"
                >
                    <option value="" hidden>- Fach auswählen -</option>
                    <option value="m" <?php if ($subject == 'm') echo "selected='selected'"; ?> >Mathematik</option>
                    <option value="d" <?php if ($subject == 'd') echo "selected='selected'"; ?> >Deutsch</option>
                    <option value="e" <?php if ($subject == 'e') echo "selected='selected'"; ?> >Englisch</option>
                </select>
            </div>

            <!-- Zweite Spalte für Note -->
            <div class="col-sm-4 form-group">
                <label for="grade">Note*</label>
                <input type="number"
                       name="grade"
                       class="form-control <?= isset($errors['grade']) ? 'is-invalid' : '' ?>"
                       min="1"
                       max="5"
                       required="required"
                       value="<?= htmlspecialchars($grade) ?>"
                />
            </div>

            <!-- Dritte Spalte für Prüfungsdatum -->
            <div class="col-sm-4 form-group">
                <label for="examDate">Prüfungsdatum*</label>
                <input type="date"
                       name="examDate"
                       class="form-control <?= isset($errors['examDate']) ? 'is-invalid' : '' ?>"
                       onchange="validateExamDate(this)"
                       required="required"
                       value="<?= htmlspecialchars($examDate) ?>"
                />
            </div>
        </div>

        <!-- Dritter Reihencontainer -->
        <div class="row mt-3">

            <!-- Erste Spalte für Validieren -->
            <div class="col-sm-3 mb-3">
                <input type="submit"
                       name="submit"
                       class="btn btn-primary btn-block"
                       value="Validieren"
                >
            </div>

            <!-- Zweite Spalte für Löschen -->
            <div class="col-sm-3">
                <a href="index.php"
                   class="btn btn-secondary btn-block">Löschen
                </a>
            </div>
        </div>

    </form>
</div>

</body>
</html>
