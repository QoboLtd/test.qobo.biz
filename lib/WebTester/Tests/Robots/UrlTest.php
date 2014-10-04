<?php
namespace WebTester\Tests\Robots;
/**
 * UrlTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class UrlTest extends \WebTester\Tests\BaseUrlTest {

	protected $name = 'robots.txt';
	protected $description = 'Check if robots.txt is accessible.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedStatusCodes'] = array(200);
		$params['url'] = $params['url'] . '/robots.txt';
		parent::run($params);
	}
	
}
?>
