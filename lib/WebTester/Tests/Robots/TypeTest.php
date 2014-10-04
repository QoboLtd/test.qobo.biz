<?php
namespace WebTester\Tests\Robots;
/**
 * TypeTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class TypeTest extends \WebTester\Tests\Base\TypeTest {

	protected $name = 'robots.txt';
	protected $description = 'Check if robots.txt is a plain text file.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedMimeTypes'] = array('text/plain');
		$params['url'] = $params['url'] . '/robots.txt';
		parent::run($params);
	}
	
}
?>
