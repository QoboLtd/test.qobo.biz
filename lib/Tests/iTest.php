<?php
/**
 * iTest interface
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
interface iTest {

	/**
	 * Run test
	 * 
	 * @param array $params Optional parameters for test run
	 * @return Result
	 */
	public function run($params = array());

	/**
	 * Get last run result
	 * 
	 * @return Result
	 */
	public function getLastResult();

	/**
	 * Get test name
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Get test description
	 * 
	 * @return string
	 */
	public function getDescription();
	
	/**
	 * Validate params
	 * 
	 * @param array $params Parameters to validate
	 * @return Result
	 */
	public function validParams($params = array());
	
	/**
	 * Get supported parameters
	 * 
	 * @return SplObjectStorage
	 */
	public function getParams();
}
?>
