<?php

$meallimit = 5;
$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "Tarik2002",
    "emensawerbeseite"
);

/*
 * selects the first $meallimit meals, ordered by name
 */
$query1 = "SELECT gericht.id, gericht.name, gericht.preis_intern, gericht.preis_extern
FROM gericht
ORDER BY gericht.name ASC
LIMIT $meallimit";

$result = mysqli_query($link, $query1);

$counter = 0;
$sqlmeal = array(array());

/*
 * write table entries into array of associative array
 */
while($row = mysqli_fetch_assoc($result)) {
    $sqlmeal[$counter++] = array('id' => $row['id'], 'beschreibung' => $row['name'], 'preisintern' => $row['preis_intern'], 'preisextern' => $row['preis_extern']);
}

mysqli_free_result($result);

/*
 * reset counter to start at first entry
 */
$counter = 0;

/*
 * selects all allergens for a given meal id, <null> if there are none || PREPARED STATEMENT
 */
$query2 = $link->prepare("SELECT gericht.id, allergen.code
FROM gericht_hat_allergen gha
         INNER JOIN allergen
                    ON gha.code = allergen.code
         RIGHT JOIN gericht
                    ON gha.gericht_id = gericht.id
WHERE gericht.id = ?
ORDER BY allergen.code");

/*
 * add array containing all allergens for a given meal to said meal's array, creating a 3d array
 */
for($counter; $counter < $meallimit; $counter++){
    $query2->bind_param("i", $sqlmeal[$counter]['id']);
    $query2->execute();
    $result2 = $query2->get_result();

    $allergenarray = [];

    while($row = mysqli_fetch_assoc($result2)){
        if(!is_null($row['code'])) {
            array_push($allergenarray, $row['code']);
        }
    }
    mysqli_free_result($result2);

    $sqlmeal[$counter]['allergen'] = $allergenarray;
}

mysqli_close($link);

return $sqlmeal;