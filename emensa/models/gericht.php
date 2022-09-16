<?php
/**
 * Diese Datei enthält alle SQL Statements für die Tabelle "gerichte"
 */
function db_gericht_select_all()
{
    try {
        $link = connectdb();

        $sql = "SELECT * FROM gericht ORDER BY name";
        $result = mysqli_query($link, $sql);

        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    } catch (Exception $ex) {
        $data = array(
            'id' => '-1',
            'name' => 'Datenbankfehler ' . $ex->getCode(),
            'beschreibung' => $ex->getMessage());
    } finally {
        return $data;
    }
}

function db_gericht_select_soup() {
    try {
        $link = connectdb();

        $sql = "SELECT * FROM gericht WHERE name LIKE '%suppe%' ORDER BY name";
        $result = mysqli_query($link, $sql);


        $data = mysqli_fetch_all($result, MYSQLI_BOTH);

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }


}

function db_gericht_select_id($id) {
    try {
        $link = connectdb();

        $link->autocommit(false);

        $stmt = $link->prepare("SELECT * FROM gericht WHERE id = ?");

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $link->commit();

        mysqli_close($link);
    }
    catch (Exception $ex) {
        $data = array(
            'id'=>'-1',
            'name' => 'Datenbankfehler '.$ex->getCode(),
            'beschreibung' => $ex->getMessage());
    }
    finally {
        return $data;
    }


}