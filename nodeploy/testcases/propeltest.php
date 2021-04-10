<?php
require_once 'vendor/autoload.php';
require_once 'generated-conf/config.php'; // propel config

// error logging
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$defaultLogger = new Logger('defaultLogger');
$defaultLogger->pushHandler(new StreamHandler('./propel.log', Logger::WARNING));

$serviceContainer->setLogger('defaultLogger', $defaultLogger);

$customers = CustomersQuery::create()->find();
/*foreach($customers as $customer) {
  echo $customer->getCustomerName();
}*/
header('Content-type: application/json; charset=utf-8');
echo $customers->toJSON();
