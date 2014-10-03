<?php
/**
 * Proof of concept
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'autoload.php';

// Parameters to send to the tests
$params = ['url' => 'http://foobar'];

// Run all the tests
$tests = TestFactory::runTests($params);

// Print out the results of the test run
$tests->rewind();
while ($tests->valid()) {
	$test = $tests->current();
	print 'Running ' . $test->getName() . ' (' . $test->getDescription() . ").  Result: " . $test->getLastResult() . "\n";
	$tests->next();
}
?>
