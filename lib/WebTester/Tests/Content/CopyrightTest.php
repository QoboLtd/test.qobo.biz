<?php
namespace WebTester\Tests\Content;
/**
 * CopyrightTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class CopyrightTest extends \WebTester\Tests\BaseContentTest {

	protected $name = 'Copyright';
	protected $description = 'Check if the homepage contains copyright.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['contentRegex'] = '/copyright|&copy;/i';
		parent::run($params);
	}
	
}
?>
