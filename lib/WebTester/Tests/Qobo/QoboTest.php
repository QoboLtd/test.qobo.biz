<?php
namespace WebTester\Tests\Qobo;
/**
 * QoboTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class QoboTest extends \WebTester\Tests\BaseContentTest {

	protected $name = 'Qobo';
	protected $description = 'Check that the site is powered by Qobo.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['contentRegex'] = '/qobo.biz/i';
		parent::run($params);
	}
	
}
?>
