<?php
function checkCredentials($email, $passwort) : string {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("SELECT * FROM benutzer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $link->commit();

    mysqli_close($link);

    if(empty($data))
        return "email";

    if($data['passwort'] == sha1('ILikeTurtles' . $passwort, false))
        return "success";
    else
        return "passwort";
}

function changesuccess($email) : void {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL incrementLogin(?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt = $link->prepare("UPDATE benutzer SET letzteanmeldung = CURRENT_TIMESTAMP WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $link->commit();

    mysqli_close($link);
}

function changefail($email) : void {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL incrementFail(?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $stmt = $link->prepare("UPDATE benutzer SET letzterfehler = CURRENT_TIMESTAMP WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $link->commit();
}

function getUser($email) {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL getUser(?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    $link->commit();

    return $data;
}