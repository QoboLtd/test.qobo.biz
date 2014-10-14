<?php
namespace WebTester\Tests\Basic;
/**
 * PerformanceTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class PerformanceTest extends \WebTester\Tests\Base\PerformanceTest {

	protected $name = 'Homepage';
	protected $description = 'Check if the homepage is fast enough.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['maxWait'] = 0.5;
		parent::run($params);
	}
	
}
?>
