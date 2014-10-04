<?php
namespace WebTester\Tests\Base;
/**
 * Test class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
abstract class Test implements \WebTester\Tests\iTest {

	protected $name;
	protected $description;
	protected $params;
	protected $lastResult;

	/**
	 * Constructor
	 * 
	 * @return object
	 */
	public function __construct() {
		$this->params = new \SplObjectStorage();
		$this->params->attach(new \WebTester\Parameters\UrlParameter('url', true, 'URL to test'));
		$this->params->attach(new \WebTester\Parameters\HttpClientParameter('httpClient', true, 'HTTP Client to use'));
	}

	/**
	 * Get last test run result
	 * 
	 * @return \WebTester\Result\Result
	 */
	public function getLastResult() {
		return $this->lastResult;
	}
	
	/**
	 * Run test
	 * 
	 * @param array $params Associative array of parameters for the test run
	 * @return \WebTester\Result\Result
	 */
	abstract public function run($params = array());

	/**
	 * Get test name
	 * 
	 * @return string
	 */
	public function getName() {
		if (empty($this->name)) {
			$this->name = basename(__CLASS__, 'Test') . ' ' . 'Test';
		}
		return $this->name;
	}

	/**
	 * Get test description
	 * 
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}
	
	/**
	 * Validate params
	 * 
	 * @param array $params Parameters to validate
	 * @return Result
	 */
	public function validParams($params = array()) {
		$allParams = $this->getParams();

		$allParams->rewind();
		while($allParams->valid()) {
			$currentParam = $allParams->current();
			
			$name = $currentParam->getName();
			$value = empty($params[$name]) ? null : $params[$name];

			$valid = $currentParam->isValid($value);
			if (!$valid->isSuccess()) {
				return $valid;
			}

			$allParams->next();
		}

		return new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS);
	}
	
	/**
	 * Get test parameters setup
	 * 
	 * @return \SplObjectStorage
	 */
	public function getParams() {
		return $this->params;
	}
}
?>
