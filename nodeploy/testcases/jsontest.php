<?php
/**
 * output stuff as json test
 */
require_once "dbtest.php";
header('Content-type: application/json; charset=utf-8');

$jsonData = array();
if ($res) {
    while ($array = $res->fetch_row()) {
        $jsonData[] = $array;
    }
    print json_encode($jsonData);
} else {
    echo "something went wrong";
}
