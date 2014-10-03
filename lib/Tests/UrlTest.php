<?php
/**
 * UrlTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class UrlTest extends BaseTest {

	protected $name = 'URL Test';
	protected $description = 'Check if the URL is accessible.';
	
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
		
		try {
			$res = $httpClient->get($url);
			$statusCode = $res->getStatusCode();
		}
		catch(Exception $e) {
			$this->lastResult = new Result(Result::FAILURE, "Failed to fetch URL[$url]: " . $e->getMessage());
		}

		switch($statusCode) {
			case '200':
			case '301':
			case '302':
				$this->lastResult = new Result(Result::SUCCESS, "HTTP status code: $statusCode");
				break;
			default:
				$this->lastResult = new Result(Result::FAILURE, "HTTP status code: $statusCode");
				break;
		}
		
		return $this->lastResult;
	}
	
}
?>
