<?php
/**
 * lets connect and select from db
 */
$mysqli = new mysqli("localhost","demo","123","classicmodels");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
} else {
  $sql = "select * from customers";
  $res = $mysqli->query($sql);
  /*while ($row = $res->fetch_row()) {
      printf("%s (%s)\n", $row[0], $row[1]);
  }*/
}
