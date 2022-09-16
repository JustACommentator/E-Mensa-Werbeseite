<?php
/**
 * Praktikum DBWT. Autoren:
 * Tarik, Glasmacher, 3277950
 * Tim, Bering, 3281627
 */
const GET_PARAM_MIN_STARS = 'search_min_stars';
const GET_PARAM_SEARCH_TEXT = 'search_text';
const GET_PARAM_DESCRIPTION = 'hidedesc';

/**
 * List of all allergens.
 */
$allergens = [
    11 => 'Gluten',
    12 => 'Krebstiere',
    13 => 'Eier',
    14 => 'Fisch',
    17 => 'Milch'
];

$meal = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'price_intern' => 2.90,
    'price_extern' => 3.90,
    'allergens' => [11, 13],
    'amount' => 42             // Number of available meals
];

$de = [
    'name' => 'Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'gericht' => 'Gericht',
    'verbergen' => 'Beschreibung verbergen',
    'description' => 'Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'allergene' => 'Allergene',
    'bewertungen' => 'Bewertungen (Insgesamt: ',
    'sterne' => 'Sterne',
    'autor' => 'Autor',
    'preisintern' => 'Interner Preis',
    'preisextern' => 'Externer Preis',
    'text' => 'Text',
    'suchen' => 'Suchen',
    'abschicken' => 'abschicken',
    ];

$en = [
    'name' => '(en) Süßkartoffeltaschen mit Frischkäse und Kräutern gefüllt',
    'gericht' => 'Dish',
    'verbergen' => 'hide description',
    'description' => '(en) Die Süßkartoffeln werden vorsichtig aufgeschnitten und der Frischkäse eingefüllt.',
    'allergene' => 'allergens',
    'bewertungen' => 'reviews (total: ',
    'sterne' => 'stars',
    'autor' => 'author',
    'preisintern' => 'internal price',
    'preisextern' => 'external price',
    'text' => 'text',
    'suchen' => 'search',
    'abschicken' => 'submit',
];

$lang = $de;

if(isset($_GET['sprache'])){
    if($_GET['sprache'] == "en"){
        $lang = $en;
    }
    else{
        $lang = $de;
    }
}


$ratings = [
    [   'text' => 'Die Kartoffel ist einfach klasse. Nur die Fischstäbchen schmecken nach Käse. ',
        'author' => 'Ute U.',
        'stars' => 2 ],
    [   'text' => 'Sehr gut. Immer wieder gerne',
        'author' => 'Gustav G.',
        'stars' => 4 ],
    [   'text' => 'Der Klassiker für den Wochenstart. Frisch wie immer',
        'author' => 'Renate R.',
        'stars' => 4 ],
    [   'text' => 'Kartoffel ist gut. Das Grüne ist mir suspekt.',
        'author' => 'Marta M.',
        'stars' => 3 ]
];

$showRatings = [];
if (!empty($_GET[GET_PARAM_SEARCH_TEXT])){
    $searchTerm = $_GET[GET_PARAM_SEARCH_TEXT];
    foreach ($ratings as $rating) {
        if (strpos(strtolower($rating['text']), strtolower($searchTerm)) !== false) {
            $showRatings[] = $rating;
        }
    }
} else if (!empty($_GET[GET_PARAM_MIN_STARS])) {
    $minStars = $_GET[GET_PARAM_MIN_STARS];
    foreach ($ratings as $rating) {
        if ($rating['stars'] >= $minStars) {
            $showRatings[] = $rating;
        }
    }
} else {
    $showRatings = $ratings;
}

function calcMeanStars(array$ratings) {
    $sum = 0;
    foreach ($ratings as $rating) {
        $sum += $rating['stars'] / count($ratings);
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title><?php echo $lang['gericht'] . ': ' . $lang['name']; ?></title>
        <style>
            * {
                font-family: Arial, serif;
            }
            .rating {
                color: darkgray;
            }
        </style>
    </head>
    <body>
        <h1><?php echo $lang['gericht'] . ': ' . $lang['name']; ?></h1>




        <form method="GET" action="meal.php">
        <p><?php if(!isset($_GET[GET_PARAM_DESCRIPTION])){
            echo $lang['description'] . '<br>';
                echo $lang['allergene'] . ':';
                echo '<ul>';
                foreach($meal['allergens'] as $number){
                    echo '<li>' . $allergens[$number];
                }
                echo '</ul>';
                echo $lang['preisintern'] . ': ' . number_format($meal['price_intern'], 2) . '€' . '<br>' .
                    $lang['preisextern'] . ': ' . number_format($meal['price_extern'], 2) . '€';
            }?></p>


            <input type="checkbox" id="hidedesc" name="hidedesc" <?php if(isset($_GET[GET_PARAM_DESCRIPTION])){echo 'checked';}?>><label for="hidedesc"><?php echo $lang['verbergen']?></label>
            <input type="submit" value="<?php echo $lang['abschicken'] ?>">
        <br>
        </form>


        <h1><?php echo $lang['bewertungen'] .calcMeanStars($ratings) . ')'; ?></h1>


        <form method="get">
            <label for="search_text">Filter:</label>
            <input id="search_text" type="text" name="search_text" value="<?php echo isset($_GET[GET_PARAM_SEARCH_TEXT]) ? $_GET[GET_PARAM_SEARCH_TEXT] : "" ?>">
            <input type="submit" value="<?php echo $lang['suchen']?>">
        </form>


        <table class="rating">
            <thead>
            <tr>
                <td><?php echo $lang['text']?></td>
                <td><?php echo $lang['sterne']?></td>
                <td><?php echo $lang['autor']?></td>
            </tr>
            </thead>
            <tbody>
            <?php
        foreach ($showRatings as $rating) {
            echo "<tr><td class='rating_text'>{$rating['text']}</td>
                      <td class='rating_stars'>{$rating['stars']}</td>
                      <td class='rating_author'>{$rating['author']}</td>
                  </tr>";
        }
        ?>
            </tbody>
        </table>
    <br><br>
    <a href="meal.php?sprache=de">deutsch</a>
        <a href="meal.php?sprache=en">english</a>
    </body>
</html>