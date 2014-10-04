<?php
namespace WebTester\Tests\Basic;
/**
 * TypeTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class TypeTest extends \WebTester\Tests\BaseTypeTest {

	protected $name = 'Homepage';
	protected $description = 'Check if the homepage URL is HTML.';
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$params['allowedMimeTypes'] = array('text/html');
		parent::run($params);
	}
	
}
?>
