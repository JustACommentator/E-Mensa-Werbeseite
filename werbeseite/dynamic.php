<?php

/*
 * translates html tags to prevent XSS when outputting user-input
 */
function _O($str) : string{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/*
 * explodes file content into array
 */
function getarray(): array{
    return explode("§", file_get_contents("usage_data.txt"));
}

/*
 * fetches old visit data from file and increments by one
 */
function visitupdate() : void{
    $data = getarray();
    $data[0] = ++$data[0];
    file_put_contents("usage_data.txt", implode("§", $data));
}

/*
 * updates current amount of meals based on "gerichte.php"'s return
 */
function mealupdate($meals) : void{
    $number = count($meals);
    $data = getarray();
    $data[1] = $number;
    file_put_contents("usage_data.txt", implode("§", $data));
}

/*
 * updates newsletter signups based on the amount of entries in "user_data.txt"
 */
function newsletterupdate() : void{
    $newslettersignup = explode(PHP_EOL, file_get_contents("user_data.txt"));
    $data = getarray();
    $data[2] = count($newslettersignup)-1;
    file_put_contents("usage_data.txt", implode("§", $data));
}

/*
 * returns amount of visits saved in "usage_data.txt"
 */
function getvisits(): int{
    $data = getarray();
    return $data[0];
}

/*
 * returns amount of meals saved in "usage_data.txt"
 */
function getmeals(): int{
    $data = getarray();
    return $data[1];
}

/*
 * returns amount of newsletter signups saved in "usage_data.txt"
 */
function getnewsletter(): int{
    $data = getarray();
    return $data[2];
}

/*
 * explodes .txt file string twice to get 2d array
 */
function getnewsletterinfo() : array{
    $newslettersignup = explode(PHP_EOL, file_get_contents("user_data.txt"));
    $count = count($newslettersignup);
    $finalarray = array(array());
    for($i=0; $i < count($newslettersignup); $i++){
        if(--$count <= 0)
            break;
        $finalarray[$i] = explode("§", $newslettersignup[$i]);
    }
    return $finalarray;
}

/*
 * usort to sort array based on user-preferences
 */
function sortarray($array, $asc, $name) : array{
    if($name){
        if($asc)
            usort($array, "sortname");
        else{
            usort($array, "sortname");
            return array_reverse($array);
        }
    } else{
        if($asc)
            usort($array, "sortmail");
        else{
            usort($array, "sortmail");
            return array_reverse($array);
        }
    }
    return $array;
}

/*
 * usort callback 1:
 * compares first element of each subarray
 */
function sortname($a, $b) : int{
    if($a[0] == $b[0])
        return 0;
    return ($a[0] < $b[0]) ? -1 : 1;
}

/*
 * usort callback 2:
 * compares second element of each subarray
 */
function sortmail($a, $b) : int{
    if($a[1] == $b[1])
        return 0;
    return ($a[1] < $b[1]) ? -1 : 1;
}