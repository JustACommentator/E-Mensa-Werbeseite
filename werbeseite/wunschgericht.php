<?php
include 'wunschgerichtDatenbank.php';
$success = false;
if(isset($_POST['wunschgericht_email']) && isset($_POST['wunschgericht_name']) && isset($_POST['wunschgericht_beschreibung'])){
    addToDB($_POST['wunschgericht_vorname'] ?? "anonym", $_POST['wunschgericht_email'], $_POST['wunschgericht_name'], $_POST['wunschgericht_beschreibung']);
    $success = true;
}
?>

<!DOCTYPE html>
<!--
    - Praktikum DBWT. Autoren:
    - Tim Bering, 3281627
    - Tarik Glasmacher, 3277950
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>
    <link rel="stylesheet" href="emensastyle.css"
</head>
<body>

<span   class="top">
    <a id="logo"  href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><abbr title="Die E-Mensa"><img src="sources/mensa_logo.png" width="150" height="50" alt="Die E-Mensa"></abbr></a>
  <span id="linklist">
  <a class="link" href="index.php#headline1">Ankündigung</a>
  <a class="link" href="index.php#headline2">Speisen</a>
  <a class="link" href="index.php#headline3">Zahlen</a><br>
  <a class="link" href="index.php#headline4">Kontakt</a>
  <a class="link" href="index.php#headline5">Wichtig für uns</a>
  </span>
</span>
<hr class="line">

<customselect>
<form method="post" action="wunschgericht.php">
    <fieldset id="#wunschgericht" >
        <legend><h2>Zeigen Sie uns Ihr Wunschgericht!</h2></legend>
        <label for="wunschgericht_vorname">Vorname</label>
        <br>
        <input id="wunschgericht_vorname" name="wunschgericht_vorname"type="text" placeholder="Vorname">
        <br><br>
        <label for="wunschgericht_email">e-Mail*</label>
        <br>
        <input required id="wunschgericht_email" name="wunschgericht_email" type="text" placeholder="e-Mail">
        <br><br>
        <label for="wunschgericht_name" type="text">Name des Gerichts*</label>
        <br>
        <input required id="wunschgericht_name" name="wunschgericht_name" type="text" placeholder="Name des Gerichts">
        <br><br>
        <label for="wunschgericht_beschreibung" type="text">Beschreibung des Gerichts*</label>
        <br>
        <textarea required id="wunschgericht_beschreibung" name="wunschgericht_beschreibung" type="textarea" placeholder="Beschreibung des Gerichts (ggf. mit Zubereitungsanweisungen)" style="height: 100px; width: 500px; resize: none"></textarea>
        <br>
        <input type="submit" value="Einreichen">
    </fieldset>
</form>
    <?php if($success){
        echo "Ihre Anfrage wird bearbeitet!";
    } ?>
</customselect>
</body>