<?php
namespace WebTester\Tests\Basic;
/**
 * WwwTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class WwwTest extends \WebTester\Tests\Base\UrlTest {

	protected $name = 'Homepage';
	protected $description = 'Check if the homepage is available with both www/no-www.';
	
	/**
	 * Run test
	 * 
	 * @todo Test without redirects and disallow 200 response
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedStatusCodes'] = array(200, 301, 302);

		$url = $params['url'];
		$urlParts = parse_url($url);
		$urlParts['host'] = (preg_match('/^www\./i', $urlParts['host'])) ? substr($urlParts['host'], 4) : 'www.' . $urlParts['host'];
		$params['url'] = \http_build_url($urlParts);

		parent::run($params);
	}
	
}
?>
