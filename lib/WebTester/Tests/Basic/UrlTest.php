<?php
namespace WebTester\Tests\Basic;
/**
 * UrlTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class UrlTest extends \WebTester\Tests\Base\UrlTest {

	protected $name = 'Homepage';
	protected $description = 'Check if the homepage URL is accessible.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedStatusCodes'] = array(200, 301, 302);
		parent::run($params);
	}
	
}
?>
