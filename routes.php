<?php
/**
 * basic routing factory
 */
require_once "libs/itemprocessing.php";

// TODO: move to actual class (middleware)
// 3. JSON jwt library stuff
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Lcobucci\JWT\Validation\Constraint;

// default route
$router->get('/', function() {
    header('Content-type: application/json; charset=utf-8');
    //echo json_encode(Array("error" => "nothing to see here"));
    echo '[{"error": "nothing to see here"}]';
});

// bearer test
$router->get('/bearer', function() {


    // basic config for the jwt
    $config = Configuration::forSymmetricSigner(
        // You may use any HMAC variations (256, 384, and 512)
        new Sha256(),
        // replace the value below with a key of your own!
        InMemory::plainText('test')
        // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
    );

    // define stuff for validating the jwt, needed for validation to work
    $config->setValidationConstraints(
    /*new Constraint\LooseValidAt(                        // Token should not be expired
        new SystemClock(new DateTimeZone('UTC')),
        new DateInterval('PT30S')
    ),*/
        new Constraint\IssuedBy('http://php.localnet'),      // Check the issuer
        new Constraint\PermittedFor('http://php.localnet'),  // Check the audience
    );

    assert($config instanceof Configuration);
    $now   = new DateTimeImmutable();
    $token_string = $config->builder()
        // Configures the issuer (iss claim)
                ->issuedBy('http://php.localnet')
            // Configures the audience (aud claim)
                ->permittedFor('http://php.localnet')
            // Configures the id (jti claim)
                ->identifiedBy('4f1g23a12aa')
            // Configures the time that the token was issue (iat claim)
                ->issuedAt($now)
            // Configures the time that the token can be used (nbf claim)
                ->canOnlyBeUsedAfter($now->modify('+'.rand(0, 999999999).' msec'))
            // Configures the expiration time of the token (exp claim)
                ->expiresAt($now->modify('+'.rand(0, 999999999).' msec'))
            // Configures a new claim, called "uid"
                ->withClaim('username', "testusername")
            // Configures a new header, called "foo"
                ->withHeader('foo', 'bar')
            // Builds a new token
                ->getToken($config->signer(), $config->signingKey())
                ->toString(); // tostring here would break validation...

    header('Content-type: application/json; charset=utf-8');
    // below would be client part
    // header('Authorization: Bearer '.'sadfsaklfjfaskasjfsadjksf');
    /** https://tools.ietf.org/html/rfc6750#page-10 // oauth2 req res
     * {
     "access_token":"mF_9.B5f-4.1JqM",
         "token_type":"Bearer",
         "expires_in":3600,
         "refresh_token":"tGzv3JOkF0XG5Qx2TlKWIA"
}*/
    echo '[{"access_token": "'.$token_string.'","token_type":"Bearer","expires_in":3600,"refresh_token":"myrefreshtokensample"}]';
});


// get request to show all customers
$router->get('/getObjects', function() {
    header('Content-type: application/json; charset=utf-8');
    // todo: add factory
    echo CustomersQuery::create()->find()->toJSON();
});

// get a single customer
// TODO: get by single param, get my multiple params get based upon multiple tables...
$router->post('/getObject', function() {
    header('Content-type: application/json; charset=utf-8');
    echo CustomersQuery::create()->filterByCustomerNumber(stripslashes($_POST["CustomerNumber"]))->find()->toJSON();
});

// create a customer
$router->post('/createObject', function() {
    header('Content-type: application/json; charset=utf-8');
    if (isset($_POST["ObjectType"])) {
        // TODO: move to itemprocessing
        $customer = new Customers();
        if (isset($_POST["CustomerNumber"])) $customer->setCustomerNumber(stripslashes($_POST["CustomerNumber"]));
        if (isset($_POST["CustomerName"])) $customer->setCustomerName(stripslashes($_POST["CustomerName"]));
        if (isset($_POST["ContactLastName"])) $customer->setContactLastName(stripslashes($_POST["ContactLastName"]));
        if (isset($_POST["ContactFirstName"])) $customer->setContactFirstName(stripslashes($_POST["ContactFirstName"]));
        if (isset($_POST["Phone"])) $customer->setPhone(stripslashes($_POST["Phone"]));
        if (isset($_POST["AddressLine1"])) $customer->setAddressLine1(stripslashes($_POST["AddressLine1"]));
        if (isset($_POST["AddressLine2"])) $customer->setAddressLine2(stripslashes($_POST["AddressLine2"]));
        if (isset($_POST["City"])) $customer->setCity(stripslashes($_POST["City"]));
        if (isset($_POST["State"])) $customer->setState(stripslashes($_POST["State"]));
        if (isset($_POST["PostalCode"])) $customer->setPostalCode(stripslashes($_POST["PostalCode"]));
        if (isset($_POST["Country"])) $customer->setCountry(stripslashes($_POST["Country"]));
        if (isset($_POST["SalesRepEmployeeNumber"])) $customer->setSalesRepEmployeeNumber(stripslashes($_POST["SalesRepEmployeeNumber"]));
        if (isset($_POST["CreditLimit"])) $customer->setCreditLimit(stripslashes($_POST["CreditLimit"]));
        echo $customer->toJSON();
    } else {
        die("no ObjectType given");
    } // required field itemtype, to give back item(s) of type
});

// update a customer
$router->post('/updateObject', function() {
    header('Content-type: application/json; charset=utf-8');
    // echo CustomersQuery::create()->filterByCustomerNumber(stripslashes($_POST["custnumber"]))->find()->toJSON();
});

// delete a customer
$router->post('/deleteObject', function() {
    header('Content-type: application/json; charset=utf-8');
    // echo CustomersQuery::create()->filterByCustomerNumber(stripslashes($_POST["custnumber"]))->find()->toJSON();
});

// Run it!
$router->run();
