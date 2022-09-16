<?php

function addReview($mealID, $comment, $review) {

    $link = connectdb();

    $link->autocommit(false);

    $email = $_SESSION['email'];
    $stmt = $link->prepare("SELECT id FROM benutzer WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userid = ($result->fetch_assoc())['id'];

    $stmt = $link->prepare("CALL addreview(?, ?, ?, ?)");
    $stmt->bind_param("iiis", $userid, $mealID, $comment, $review);
    $stmt->execute();

    $link->commit();

    $link->close();
}

function getRecentReviews() {

    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL getReviews()");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_BOTH);

    $link->commit();

    $link->close();

    return $data;
}

function removeReview($userid, $mealid) {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL deleteReview(?, ?)");
    $stmt->bind_param("ii", $userid, $mealid);
    $stmt->execute();

    $link->commit();

    $link->close();
}

function highlight($highlight, $mealid, $userid) {
    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL highlight(?, ?, ?)");
    $stmt->bind_param("iii", $highlight, $mealid, $userid);
    $stmt->execute();

    $link->commit();

    $link->close();
}

function getHighlighted() {

    $link = connectdb();

    $link->autocommit(false);

    $stmt = $link->prepare("CALL getHighlighted()");
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_BOTH);

    $link->commit();

    $link->close();

    return $data;
}