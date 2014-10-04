<?php
namespace WebTester\Tests;
/**
 * BaseUrlTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
abstract class BaseUrlTest extends BaseTest {

	protected $name = 'URL Test';
	protected $description = 'Check if the URL is accessible.';
	
	public function __construct() {
		parent::__construct();
		$this->params->attach(new \WebTester\Parameters\SelectParameter('allowedStatusCodes', true, 'Allowed HTTP status codes'));
	}
	
	/**
	 * Run test
	 * 
	 * @param array $params Parameters for the test
	 * @return Result
	 */
	public function run($params = array()) {
		$valid = $this->validParams($params);
		if (!$valid->isSuccess()) {
			$this->lastResult = $valid;
			return $this->lastResult;
		}

		$httpClient = $params['httpClient'];
		$url = $params['url'];
		$allowedStatusCodes = $params['allowedStatusCodes'];
		
		try {
			$res = $httpClient->get($url);
			$statusCode = $res->getStatusCode();
		}
		catch(\Exception $e) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Failed to fetch URL[$url]: " . $e->getMessage());
			return $this->lastResult;
		}

		if (in_array($statusCode, $allowedStatusCodes)) {
				$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS, "HTTP status code: $statusCode");
		}
		else {
				$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "HTTP status code: $statusCode");
		}
		
		return $this->lastResult;
	}
	
}
?>
