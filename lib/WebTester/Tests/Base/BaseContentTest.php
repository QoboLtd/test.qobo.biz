<?php
namespace WebTester\Tests\Base;
/**
 * BaseContentTest class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
abstract class BaseContentTest extends BaseTest {

	protected $name = 'Content Test';
	protected $description = 'Check if the URL contains content.';
	
	public function __construct() {
		parent::__construct();
		$this->params->attach(new \WebTester\Parameters\TextParameter('contentRegex', true, 'Content to look for'));
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
		$content = $params['contentRegex'];
		
		try {
			$res = $httpClient->get($url);
			$body = $res->getBody();
		}
		catch(\Exception $e) {
			$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Failed to fetch URL[$url]: " . $e->getMessage());
			return $this->lastResult;
		}

		if (preg_match($content, $body, $matches)) {
				$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS, "Content contains [" . $matches[0] . "]");
				return $this->lastResult;
			}
		$this->lastResult = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Content does not contain [$content]");
		
		return $this->lastResult;
	}
	
}
?>
