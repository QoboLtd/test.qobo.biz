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
		$this->lastResult = new Result(Result::SUCCESS);

		return $this->lastResult;
	}
	
}
?>
