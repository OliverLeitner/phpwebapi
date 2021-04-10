<?php
/**
 * handle item types by request and return the given item or items
 * TODO: implement this
 */
class ItemProcessing {
    protected $operations = Array(
        "create" => 1,
        "delete" => 2,
        "update" => 3,
        "select" => 4
    );

    function __construct($jsonObject, $operation) {
        // preset propel functions
    }

    // select case for the functs below
    protected function typeFactory($type) {
        switch ($type) {
        case "Customers":
            echo "calling Propel on Customers!";
            break;
        case "Products":
            echo "calling propel on products!";
            break;
        case "Orders":
            echo "calling propel on orders!";
            break;
        default:
            echo "error: no valid type provided";
        }
    }

    // get an array of objects from the db
    /*protected function getObjects($type) {
        // implement me
    }*/

    // get single object from db
    protected function getObject($type, $param) {
        // implement me
    }

    // create object in db
    protected function createObject($jsonObject) {
    }

    // update object from db
    protected function updateObject($jsonObject) {
    }

    // delete an object from db
    protected function deleteObject($jsonObject) {
    }

    // testing a single object
    protected function testObject() {
    }

    // testing an array of objects
    protected function testObjects() {
    }
}
