<?php
namespace WebTester\Tests\Favicon;
/**
 * UrlTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class UrlTest extends \WebTester\Tests\BaseUrlTest {

	protected $name = 'favicon.ico';
	protected $description = 'Check if favicon.ico is accessible.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedStatusCodes'] = array(200);
		$params['url'] = $params['url'] . '/favicon.ico';
		parent::run($params);
	}
	
}
?>
