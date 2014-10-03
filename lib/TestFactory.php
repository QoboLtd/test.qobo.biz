<?php
/**
 * Test Factory
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class TestFactory {

	/**
	 * Get all available tests
	 * 
	 * @return SplObjectStorage
	 */
	public static function getTests() {
		$result = new SplObjectStorage();
		
		$testsDir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Tests';
		$dir = new DirectoryIterator($testsDir);
		foreach ($dir as $file) {
			// Non-recursive list
			if ($file->isDir()) continue;	

			// Non-PHP files
			if ($file->getExtension() <> 'php') continue;
			
			$className = basename($file->getFilename(), '.' . $file->getExtension());
			
			$reflection = new ReflectionCLass($className);
			
			// Skip classes that don't implement iTest interface
			if (!$reflection->implementsInterface('iTest')) {
				continue;
			}
			
			// Skip abstract classes
			if ($reflection->isAbstract()) {
				continue;
			}
		
			$result->attach(new $className);
		}

		return $result;
	}

	/**
	 * Run tests
	 * 
	 * @param array $params Parameters to pass to the tests
	 * @param SplObjectStorage $tests (Optional) A list of tests to run. Will run all if omitted.
	 * @return SplObjectStorage
	 */
	public static function runTests($params = array(), $tests = null) {
		if (empty($tests)) {
			$tests = self::getTests();
		}
		
		$tests->rewind();
		while ($tests->valid()) {
			$tests->current()->run($params);
			$tests->next();
		}

		return $tests;
	}
}
?>
