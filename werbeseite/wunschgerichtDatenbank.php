<?php

function addToDB($vorname, $email, $gericht, $beschreibung) : void{
    $link = mysqli_connect(
        "127.0.0.1", // Host der Datenbank
        "root", // Benutzername zur Anmeldung
        "Tarik2002", // Passwort zur Anmeldung
        "emensawerbeseite" // Auswahl der Datenbank
    );

    $stmt = $link->prepare("INSERT INTO wunschgericht (vorname, email, gerichtname, beschreibung) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vorname, $email, $gericht, $beschreibung);
    $stmt->execute();

    mysqli_close($link);
}