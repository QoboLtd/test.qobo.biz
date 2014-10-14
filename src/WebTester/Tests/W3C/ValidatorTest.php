<?php
namespace WebTester\Tests\W3C;
/**
 * ValidatorTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class ValidatorTest extends \WebTester\Tests\Base\Test {

	protected $name = 'Homepage';
	protected $description = 'Check if the homepage W3C standard compliant.';
	
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

		$validatorUrl = 'http://validator.w3.org/check?uri=' . urlencode($url);
		try {
			$res = $httpClient->head($validatorUrl);
			$validatorStatus = $res->getHeader('X-W3C-Validator-Status');
			$validatorErrors = $res->getHeader('X-W3C-Validator-Errors');
			$validatorWarnings = $res->getHeader('X-W3C-Validator-Warnings');
		}
		catch(\Exception $e) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Failed to fetch URL[$validatorUrl]: " . $e->getMessage());
		}

		if (strtoupper($validatorStatus) == 'VALID') {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS, "Status [$validatorStatus], Errors[$validatorErrors], Warnings[$validatorWarnings]");
			return $this->lastResult;
		}
		
		$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Status [$validatorStatus], Errors[$validatorErrors], Warnings[$validatorWarnings]");
		return $this->lastResult;
		
	}
	
}
?>
