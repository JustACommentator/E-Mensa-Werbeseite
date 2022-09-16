<?php
$meal = include 'gerichte.php';
include 'dynamic.php';
$allergenarray = include 'allergens.php';

/*
 * list to check what allergens to output in allergen list / restrict to allergens used in meals
 */
$allergenlist = [];

visitupdate();
mealupdate($meal);

$name = "default";
if(isset($_POST['newsletter_vorname'])) $name = $_POST['newsletter_vorname'];
$email = "default";
if(isset($_POST['newsletter_mail'])) $email = $_POST['newsletter_mail'];
$language = 1;
if(isset($_POST['newsletter_lang'])) $language = $_POST['newsletter_lang'];

/*
 * checks if the name consists of only whitespaces
 */
$whitespaceonly = ctype_space($name);

/*
 * checks email for invalid addresses
 */
$falseemail = (str_ends_with($email, "rcpt.at")) || (str_ends_with($email, "damnthespam.at")) || (str_ends_with($email, "wegwerfmail.de")) || (str_contains($email, "trashmail."));
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
    <title>Die E-Mensa</title>
    <link rel="stylesheet" href="emensastyle.css">
</head>
<body>

<span   class="top">
    <a id="logo"  href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><abbr title="Die E-Mensa"><img src="sources/mensa_logo.png" width="150" height="50" alt="Die E-Mensa"></abbr></a>
  <span id="linklist">
  <a class="link" href="#headline1">Ankündigung</a>
  <a class="link" href="#headline2">Speisen</a>
  <a class="link" href="#headline3">Zahlen</a><br>
  <a class="link" href="#headline4">Kontakt</a>
  <a class="link" href="#headline5">Wichtig für uns</a>
  </span>
</span>


<hr class="line">

<customselect>

  <img src="sources/banner.png" alt="requiredField" width="1000" height="350">
  <h1 id="headline1">Bald gibt es Essen auch online ;)</h1>

    <div style="position:relative; width: 0; height: 0;">
      <img id="cat" src="sources/cat.png" style="position: absolute; top: 5px; left: 260px;">
    </div>

  <p id="loremtext">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore<br>
        et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut<br>
        aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum<br>
        dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui<br>
        officia deserunt mollit anim id est laborum.<br><br>
        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque daudantium,<br>
        totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae<br>
        dicta sunt explicabo. Nemo enim ipsam voluptatem quia volptas sit aspernatur aut odit aut fugit,<br>
        sed quia consequuntur magni dolores eos qui ratione volptatem sequi nesciunt.</p>

    <h1 id="headline2">Köstlichkeiten, die Sie erwarten</h1>
<table id="mealtable">
    <tr>
        <td><b>Bezeichnung</b></td>
        <td><b>Preis intern</b></td>
        <td><b>Preis extern</b></td>
    </tr>
    <?php
        foreach($meal as $number){
            echo '<tr>' .
                '<td>' . $number['beschreibung'];

            if(!empty($number['allergen'])) {
                echo " ";
                foreach ($number['allergen'] as $allergen) {
                    echo '<sup>' . '<a style="color: rgb(64,190,170)" href="#allergen" class="allergenlink">' . $allergen . ($allergen == end($number['allergen']) ? "" : ", ") . '</a>' . '</sup>';
                    array_push($allergenlist, $allergen);
                }
            }

            echo '</td>';
            echo '<td style="text-align: right">' . number_format($number['preisintern'], 2) . '€' . '</td>' .
                '<td style="text-align: right">' . number_format($number['preisextern'], 2) . '€' . '</td>' .
                '</tr>';
        }
    ?>
</table>
<table id="picturetable">
        <?php
        foreach($meal as $number){
            if(array_key_exists('bild', $meal))
                echo '<td>' . '<img src="' . $number['bild'] . '" alt="requiredField" width="150" height="150">' . '</td>';
        }
        ?>
</table>
<br>
<table id="allergen">
    <tr>
        <td><b>Code</b></td>
        <td><b>Beschreibung</b></td>
    </tr>
    <?php
    foreach($allergenarray as $code => $beschreibung){
        if(in_array($code, $allergenlist)) {
            echo '<tr><td>' . $code . '</td><td>' . $beschreibung . '</td></tr>';
        }
    }
    ?>
</table>

<!-- Wunschgericht-->
<h2>Nichts für Sie dabei?</h2>
    <a class="link" href="wunschgericht.php">Reichen Sie Anfragen für Ihre Wunschgerichte ein!</a>
    <br>

<?php
if(isset($_POST['newsletter_vorname'])) {
    if(!$whitespaceonly && !$falseemail){
        file_put_contents("user_data.txt", $name . '§' . $email . '§' . $language . PHP_EOL, FILE_APPEND); //ändern
        newsletterupdate();
    }
}
?>

<h1 id="headline3">E-Mensa in Zahlen</h1>
<div>
    <h2 class="numbers" style="color: rgb(45,30,30)"><?php echo getvisits(). " Besuche" ?></h2>
    <h2 class="numbers"><?php echo getnewsletter() . " Anmeldungen zum Newsletter" ?></h2>
    <h2 class="numbers" style="color: rgb(64,190,170)"><?php echo getmeals(). " Speisen" ?></h2>
</div>

<h1 id="headline4">Interesse geweckt? Wir informieren Sie!</h1>

<!--Newsletteranmeldung-->
<form method="post" action="index.php">
    <table id="newsletter">
        <tr>
            <td><label for="newsletter_vorname">Ihr Name:</label></td>
            <td><label for="newsletter_mail">Ihre E-Mail:</label></td>
            <td><label for="newsletter_lang">Newsletter bitte in:</label><br></td>
        </tr>
        <tr>
            <td><input required type="text" placeholder="Vorname" id="newsletter_vorname" name="newsletter_vorname"></td>
            <td><input required type="email" placeholder="g.hoever@mathe.de" id="newsletter_mail" name="newsletter_mail"></td>
            <td> <select name="newsletter_lang" id="newsletter_lang">
                <option value="1" selected>Deutsch</option>
                <option value="2">English</option>
                <option value="3">한국인</option>
                <option value="4">蘇格瑪</option>
            </select><br></td>
        </tr>
        <tr>
            <td colspan="3"><input required type="checkbox" id="newsletter_datenschutz" name="newsletter_datenschutz">
                <label for="newsletter_datenschutz">Den Datenschutzbestimmungen stimme ich zu</label>
                <input type="submit" id="newsletter_submit" name="newsletter_submit"></td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['newsletter_vorname'])) {
    if($whitespaceonly) echo "Bitte gültigen Namen angeben!" . '<br>';
    if($falseemail) echo "Bitte gültige email angeben!";
    if(!$whitespaceonly && !$falseemail) echo "Ihre Daten wurden gespeichert!";
}
?>

<h1 id="headline5">Das ist uns wichtig</h1>
<ul style="text-align: center">
    <li>Beste frische saisonale Zutaten</li>
    <li>Ausgewogene abwechslungsreiche Gerichte</li>
    <li>Sauberkeit</li>
</ul>

<h1 style="text-align: center">Wir freuen uns auf Ihren Besuch!</h1>
<hr class="line">

<footer>
  <ul>
      <li>(c) E-Mensa GmbH</li>
      <li>Tim Bering & Tarik Glasmacher</li>
      <li><a href="http://eelslap.com/">Impressum</a></li>
  </ul>
</footer>
</customselect>
</body>
</html>