<?php
namespace WebTester\Tests\Favicon;
/**
 * TypeTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class TypeTest extends \WebTester\Tests\BaseTypeTest {

	protected $name = 'favicon.ico';
	protected $description = 'Check if favicon.ico is an icon image.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedMimeTypes'] = array('image/x-icon', 'image/vnd.microsoft.icon');
		$params['url'] = $params['url'] . '/favicon.ico';
		parent::run($params);
	}
	
}
?>
