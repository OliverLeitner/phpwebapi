<?php
require __DIR__ . '/vendor/autoload.php';
$router = new \Bramus\Router\Router();

// routes
$router->get('/about', function() {
    echo 'sample web api with php';
});

// Run it!
$router->run();
