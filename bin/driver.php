<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__)  . DS);

require_once(ROOT . 'lib' . DS . 'Minter.php');

$minter = new Minter(ROOT . 'config' . DS . 'connection.ini');

$output = $minter->mint();

print 'Minted identifier ' . $output . "\n";
?>
