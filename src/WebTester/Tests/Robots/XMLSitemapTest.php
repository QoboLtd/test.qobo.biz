<?php
namespace WebTester\Tests\Robots;
/**
 * CopyrightTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class XMLSitemapTest extends \WebTester\Tests\Base\ContentTest {

	protected $name = 'XML Sitemap';
	protected $description = 'Check that robots.txt contains link to the XML sitemap.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['contentRegex'] = '/sitemap:\s+http.*/i';
		$params['url'] = $params['url'] . '/robots.txt';
		parent::run($params);
	}
	
}
?>
