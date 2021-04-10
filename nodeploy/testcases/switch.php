<?php
/**
 * entry factory
 */
$get = "";

if ($_GET) {
    $get = $_GET; // catch our get thingy
    switch ($get["query"]) {
    case "customers":
        echo "give me a list of customers!";
        break;
    case "employees":
        echo "list of employees of our company!";
        break;
    case "offices":
        echo "our office buildings!";
        break;
    default:
        echo "give me the api manual!";
    }
} else {
    echo "give me the api manual";
}
