#!/usr/bin/env php
<?php
array_shift($argv);
foreach ($argv as $idx => $arg) {
	if (preg_match('/NetBeansSuite.php$/', $arg)) {
		$argv[$idx] = __DIR__ . DIRECTORY_SEPARATOR . 'NetBeansSuite.php' ;
	}
}
$command = 'C:\wamp\bin\php\php5.6.5\phpunit.phar';
$args = join(' ', $argv);

passthru($command . ' ' . $args);