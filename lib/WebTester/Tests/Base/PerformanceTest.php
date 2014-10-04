<?php
namespace WebTester\Tests\Base;
/**
 * PerformanceTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
abstract class PerformanceTest extends Test {

	protected $name = 'Performance Test';
	protected $description = 'Check if the response is received within accepted time interval.';
	
	public function __construct() {
		parent::__construct();
		$this->params->attach(new \WebTester\Parameters\TextParameter('maxWait', true, 'Maximum number of milliseconds to wait'));
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
		$maxWait = $params['maxWait'];
		
		try {
			$startTime = microtime(true);
			$res = $httpClient->get($url);
			$responseTime = microtime(time) - $startTime;
		}
		catch(\Exception $e) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Failed to fetch URL[$url]: " . $e->getMessage());
			return $this->lastResult;
		}

		if ($responseTime <= $maxWait) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS, "Received response in $responseTime seconds");
			return $this->lastResult;
		}
		$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Received response in $responseTime seconds");
		
		return $this->lastResult;
	}
	
}
?>
