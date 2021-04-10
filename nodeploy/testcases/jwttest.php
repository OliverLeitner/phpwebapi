<?php
/**
 * testing basic jwt functionality
 * bearertoken creation, check, against user, authentication...
 */
require 'vendor/autoload.php';

// demo user
$testuser = Array();
$testuser["username"] = "demo";
$testuser["email"] = "no@none.com";
$testuser["demostring"] = "im a little demo string";
var_dump($testuser);

// jwt config
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Lcobucci\JWT\Validation\Constraint;

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

function gtoken($config, $testuser) {
    $now   = new DateTimeImmutable();
    return $config->builder()
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
                  ->withClaim('username', $testuser["username"])
              // Configures a new header, called "foo"
                  ->withHeader('foo', 'bar')
              // Builds a new token
                  ->getToken($config->signer(), $config->signingKey());
    // ->toString(); // tostring here would break validation...
}


function pToken($config, $tkn) {
    $token = $config->parser()->parse($tkn->toString()); // on the other hand, we can do string on the parse
    assert($token instanceof UnencryptedToken);
    return $token;
}

// show me the token
$token = gtoken($config, $testuser);
var_dump($token);

// decode the token (might be enough for basic validation)
var_dump(pToken($config, $token));

// make sure that we get our token unencrypted into the validation
assert($token instanceof UnencryptedToken);

// token validation stuff
$constraints = $config->validationConstraints();

// and validate...
try {
    $config->validator()->assert($token, ...$constraints);
} catch (RequiredConstraintsViolated $e) {
    // list of constraints violation exceptions:
    var_dump($e->violations());
}

// the other type of validation
/*if (!$config->validator()->validate($token, ...$constraints)) {
    echo "not validated";
    throw new RuntimeException('No way!');
}*/

// solid gold
/*do {
    $token = gtoken($config);
    $parsed = pToken($config, $token);
    $timestring = $parsed->claims()->get('iat')->format('U.u');
    if (strpos($timestring, '.') === false) {
        continue;
    }
    $timefloat = (float) $timestring;
    $formatted = json_encode($timefloat, JSON_THROW_ON_ERROR);
    $decimalSeparatorPosition = strpos($formatted, '.');
    if ($decimalSeparatorPosition === false) {
        continue;
    }
    $microseconds = substr($formatted, $decimalSeparatorPosition + 1);
} while (strlen($microseconds) <= 6 && $timestring === (str_pad(json_encode($timefloat), 17, '0')));

echo 'Issue found in if its not i> 1 000 001:';
var_dump($token, $timestring, $microseconds, $formatted, number_format($timefloat, 6, '.', ''));*/
