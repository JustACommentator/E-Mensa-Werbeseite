<!DOCTYPE html>
<html lang="de">
<head>
    <title>Hier könnte Ihre Werbung stehen</title>
    <style>
        li{
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<?php
/**
 * Praktikum DBWT. Autoren:
 * Tarik, Glasmacher, 3277950
 * Tim, Bering, 3281627
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];
$winneryears = array();
echo '<ol>';
foreach($famousMeals as $meal){
    echo '<li>';
    echo $meal['name'];
    echo '<br>';
    if(is_array($meal['winner'])) {
        krsort($meal['winner']);
        $last = end($meal['winner']);
        foreach ($meal['winner'] as $year) {
            echo $year . ($year == $last ? "" : ', ');
            array_push($winneryears, $year);
        }
    } else{
        echo $meal['winner'];
        array_push($winneryears, $meal['winner']);
    }
}
echo '</ol>';
echo '<br>' . "Jahre ohne Gewinner:" . '<br>';
for($currentyear = 2000; $currentyear <= 2021; $currentyear++){
    if(!in_array($currentyear, $winneryears)){
        echo $currentyear  . ($currentyear==2021?"":', ');
    }
}
?>
</body>
</html>