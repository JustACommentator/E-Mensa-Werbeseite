<?php
$link = mysqli_connect(
    "127.0.0.1", // Host der Datenbank
    "root", // Benutzername zur Anmeldung
    "Tarik2002", // Passwort zur Anmeldung
    "emensawerbeseite" // Auswahl der Datenbank
);

if(!$link){
    echo "Verbindung fehlgeschlagen: ", mysqli_connect_error();
    exit();
}

$query = "SELECT UNIQUE kategorie.id as kategorie, COUNT(*) as gerichte_in_kategorie
FROM gericht_hat_kategorie ghk
         INNER JOIN kategorie
                    ON ghk.kategorie_id = kategorie.id
         INNER JOIN gericht
                    ON ghk.gericht_id = gericht.id
GROUP BY kategorie.id
HAVING COUNT(*) > 2";

$result = mysqli_query($link, $query);
?>

<!DOCTYPE html>
<head>
    <style>
td, table{
    border: 1px solid black;
        }
    </style>
</head>
<html>
<table>
    <tr>
        <td> Kategorie </td>
        <td> # Gerichte in Kategorie</td>
<?php
while($row = mysqli_fetch_assoc($result))
    echo "<tr><td>" . $row['kategorie'] . "</td><td>" . $row['gerichte_in_kategorie'] . "</td></tr>";
?>
</table>
</html>
<?php
mysqli_free_result($result);
mysqli_close($link);