<?php
/**
 * Praktikum DBWT. Autoren:
 * Tarik, Glasmacher, 3277950
 * Tim, Bering, 3281627
 */

date_default_timezone_set("Europe/Berlin");
file_put_contents("accesslog.txt", date("l") . ', ' . date("d.m.y") . ', ' . date("H:i") . ', ' . $_SERVER['REMOTE_ADDR']. ', ' . $_SERVER['HTTP_USER_AGENT'] . "\n", FILE_APPEND);