<?php
namespace WebTester\Tests;
/**
 * BaseTypeTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
abstract class BaseTypeTest extends BaseTest {

	protected $name = 'Type Test';
	protected $description = 'Check if the response is of certain content type.';
	
	public function __construct() {
		parent::__construct();
		$this->params->attach(new \WebTester\Parameters\SelectParameter('allowedMimeTypes', true, 'Allowed MIME types'));
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
		$allowedMimeTypes = $params['allowedMimeTypes'];
		
		try {
			$res = $httpClient->get($url);
			$contentType = $res->getHeader('content-type');
		}
		catch(\Exception $e) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Failed to fetch URL[$url]: " . $e->getMessage());
			return $this->lastResult;
		}

		foreach ($allowedMimeTypes as $allowedMimeType) {
			if (preg_match('#' . $allowedMimeType . '#i', $contentType)) {
				$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS, "Content-Type: $contentType");
				return $this->lastResult;
			}
		}
		$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Content-Type: $contentType");
		
		return $this->lastResult;
	}
	
}
?>
