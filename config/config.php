<?php

$serverName = "LAPTOP-AQ8AA8CK";
$connectionOptions = array(
    "Database" => "sipresmaPBL",
    "Uid" => "sa",
    "PWD" => "siwof"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

return $conn;
