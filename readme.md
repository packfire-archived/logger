#Packfire Logger

Logger provides simplest log file implementation of the [`LoggerInterface` provided by PHP Framework Interop Group ](https://github.com/php-fig/log/).

In this library, `Packfire\Logger\File` is provided to write log entries to a file based on the interface provided by `Psr\Log\LoggerInterface`.

````php
<?php
use Packfire\Logger\File as Logger;

$logger = new Logger('app.log');
$logger->info('Setting up the application');
````