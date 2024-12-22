<?php
// config.php

$serverName = "?";
$connectionOptions = array(
    "Database" => "SIPRESMA",
    "Uid" => "",
    "PWD" => ""
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

return $conn;
