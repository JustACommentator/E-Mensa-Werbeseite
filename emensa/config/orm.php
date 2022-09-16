<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "emensawerbeseite",
    "username" => "root",
    "password" => "Tarik2002"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();