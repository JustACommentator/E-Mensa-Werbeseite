<!DOCTYPE html>
<html>
<form method="get" action="m2_4c_addform.php">
    <input type="submit" name="add" value="addieren">
    <input type="submit" name="mult" value="multiplizieren">
    <input required type="text" name="number1" value="<?php echo isset($_GET['number1']) ? $_GET['number1'] : "" ?>">
    &
    <input required type="text" name="number2" value="<?php echo isset($_GET['number2']) ? $_GET['number2'] : "" ?>">
</form>
=
<?php
/**
 * Praktikum DBWT. Autoren:
 * Tarik, Glasmacher, 3277950
 * Tim, Bering, 3281627
 */
include 'm2_4a_standardparameter.php';
if(isset($_GET['add'])){
    echo add($_GET['number1'], $_GET['number2']);
}
else if(isset($_GET['mult'])){
    if (isset($_GET['number1'])) {
        $a = $_GET['number1'];
        $b = $_GET['number2'];
        echo($a * $b);
    }
}
?>
</html>