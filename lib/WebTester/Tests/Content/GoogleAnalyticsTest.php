<?php
namespace WebTester\Tests\Content;
/**
 * GoogleAnalyticsTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class GoogleAnalyticsTest extends \WebTester\Tests\Base\ContentTest {

	protected $name = 'Google Analytics';
	protected $description = 'Check if the is using Google Analytics.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['contentRegex'] = '#google-analytics.com/(ga|analytics).js#i';
		parent::run($params);
	}
	
}
?>
