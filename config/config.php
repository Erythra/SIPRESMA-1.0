<?php
// config.php

$serverName = "localhost";
$connectionOptions = array(
    "Database" => "sipresma",
    "Uid" => "sa",
    "PWD" => "siwof"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

return $conn;
