<?php
include 'dynamic.php';
$userarray = getnewsletterinfo();
$search = "";
if(isset($_POST['search'])){
    $search = $_POST['search'];
}
$editedarray = array(array());
$count = 0;

/*
 * call sorting function with user-preferences
 */
if(isset($_POST['name']) && isset($_POST['ascending'])){
    $userarray = sortarray($userarray, $_POST['ascending'], $_POST['name']);
}

/*
 * update search results by saving array containing user information in $editedarray if an entry meets search-criteria
 */
if(isset($_POST['search'])){
    for($i=0; $i < count($userarray); $i++)
        if(str_contains(strtolower($userarray[$i][0]),strtolower($_POST['search']))) $editedarray[$count++] = $userarray[$i];
}
?>


<!DOCTYPE html>
<head>
    <style>
        td{
            border: 1px solid black;
        }
    </style>
</head>
<html>
<form method="post" action="nl-admin.php">
    <input type="text" name="search" placeholder="Suchbegriff" value="<?php echo $_POST['search'] ?? "" ?>">
    <a style="border: 1px solid black"><input <?php if(isset($_POST['name']) && $_POST['name'] == 1) echo "checked" ?> type="radio" name="name" value="1">name
        <input <?php if(isset($_POST['name']) && $_POST['name'] == 0) echo "checked" ?> type="radio" name="name" value="0">email</a>
    <a style="border: 1px solid black"><input <?php if(isset($_POST['ascending']) && $_POST['ascending'] == 1) echo "checked" ?> type="radio" name="ascending" value="1">aufsteigend
    <input <?php if(isset($_POST['ascending']) && $_POST['ascending'] == 0) echo "checked" ?> type="radio" name="ascending" value="0">absteigend</a>
    <input type="submit">
</form>
<table style="border: 1px solid black">
    <tr>
        <td><b>Vorname</b></td>
        <td><b>e-Mail</b></td>
        <td><b>Sprache</b></td>
    </tr>

    <?php
    /*
     * displays as a table: $userarray if 'search' is not set, $editedarray if 'search' is set
     */
        if (isset($_POST['search'])) {
            if($editedarray[0] != NULL) {
                foreach ($editedarray as $user) {
                    echo '<tr>' .
                        '<td>' . _O($user[0]) . '</td>' . '<td>' . _O($user[1]) . '</td>' . '<td>' . _O($user[2]) . '</td>' .
                        '</tr>';
                }
            }
        } else {
            if ($userarray[0] != NULL) {
                foreach ($userarray as $user) {
                    echo '<tr>' .
                        '<td>' . _O($user[0]) . '</td>' . '<td>' . _O($user[1]) . '</td>' . '<td>' . _O($user[2]) . '</td>' .
                        '</tr>';
                }
            }
        }
    ?>
</table>
</html>