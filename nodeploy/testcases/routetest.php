<?php
/**
 * bram router test file
 */
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

// Define routes
// ...
// This route handling function will only be executed when visiting http(s)://www.example.org/about
$router->get('/about', function() {
    echo 'sample web api with php';
});

// Run it!
$router->run();
