<?php
/**
 * preload stuff we need here
 * this file will be included
 * into actual scripts
 */
// 1. the database orm thingy
require_once 'vendor/autoload.php';
require_once 'generated-conf/config.php';

// error logging
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// logger config
$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('./propel.log', Logger::WARNING));
$serviceContainer->setLogger('defaultLogger', $defaultLogger);

// TODO: move the whole bearer stuff out into a middleware class
// 3. JSON jwt library stuff
/*use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Lcobucci\JWT\Validation\Constraint;*/

// basic config for the jwt
/*$config = Configuration::forSymmetricSigner(
    // You may use any HMAC variations (256, 384, and 512)
    new Sha256(),
    // replace the value below with a key of your own!
    InMemory::plainText('mysuperdupersecretestkey') // provide hashing key, TODO: load in via config.php
    // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
);*/

// define stuff for validating the jwt, needed for validation to work
//$config->setValidationConstraints(
    /*new Constraint\LooseValidAt(                        // Token should not be expired
        new SystemClock(new DateTimeZone('UTC')),
        new DateInterval('PT30S')
    ),*/
//    new Constraint\IssuedBy('http://php.localnet'),      // Check the issuer
//    new Constraint\PermittedFor('http://php.localnet'),  // Check the audience
//);

// 2. whatever we need for routing
$router = new \Bramus\Router\Router();


