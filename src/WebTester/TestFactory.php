<?php
namespace WebTester;
/**
 * Test Factory
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class TestFactory {

	/**
	 * Get all available tests
	 * 
	 * @return \SplObjectStorage
	 */
	public static function getTests() {
		$result = new \SplObjectStorage();
		
		$currentDir = dirname(__FILE__);
		
		$testsDir = $currentDir . DIRECTORY_SEPARATOR . 'Tests';
		$dir = new \RecursiveDirectoryIterator($testsDir);
		$iterator = new \RecursiveIteratorIterator($dir);
		$regex = new \RegexIterator($iterator, '/.*Test\.php$/');
		foreach ($regex as $file) {
			// Non-recursive list
			if ($file->isDir()) continue;	

			// Non-PHP files
			if ($file->getExtension() <> 'php') continue;
			
			// Full path to class file
			$className = $file->getRealPath();
			// Remove current folder path
			$className = substr($className, strlen($currentDir));
			// Remove extension
			$extension = '.' . $file->getExtension();
			$className = substr($className, 0, strlen($className) - strlen($extension));
			// Convert directory separators to namespace separators
			$className = str_replace(DIRECTORY_SEPARATOR, '\\', $className);
			// Add current namespace prefix
			$className = __NAMESPACE__ .  $className;
			
			$reflection = new \ReflectionCLass($className);
			
			// Skip classes that don't implement iTest interface
			if (!$reflection->implementsInterface('\WebTester\Tests\iTest')) {
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
	 * @param \SplObjectStorage $tests (Optional) A list of tests to run. Will run all if omitted.
	 * @return \SplObjectStorage
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
