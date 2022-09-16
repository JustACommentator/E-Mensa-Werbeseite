<?php

$link = mysqli_connect(
    "127.0.0.1",
    "root",
    "Tarik2002",
    "emensawerbeseite"
);
/*
 * selects allergens
 */
$query = "SELECT *
FROM allergen
ORDER BY allergen.code ASC";

$result = mysqli_query($link, $query);

$allergenarray = array();

/*
 * write table entries into array of associative array
 */
while($row = mysqli_fetch_assoc($result)) {
    $allergenarray[$row['code']] = $row['name'];
}

mysqli_free_result($result);
mysqli_close($link);

return $allergenarray;