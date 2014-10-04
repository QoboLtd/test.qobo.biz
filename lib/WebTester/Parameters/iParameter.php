<?php
/**
 * iParameter interface
 * 
 * Defines parameter inteface which is handy to convert
 * validation requirements into web forms, for example.
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
interface iParameter {

	/**
	 * Get parameter name
	 * 
	 * @return string
	 */
	public function getName();

	/**
	 * Get parameter type
	 * 
	 * gettype() is a reserved function name in PHP, so 
	 * we cannot use it.  On top of it, web type is more
	 * specific to what is actually returned.
	 * 
	 * @return string
	 */
	public function getWebType();
	
	/**
	 * Check if the parameter is required
	 * 
	 * @return boolean True if required, false otherwise
	 */
	public function isRequired();

	/**
	 * Get description
	 * 
	 * @return string
	 */
	public function getDescription();

	/**
	 * Validate value
	 * 
	 * @param mixed $value Value to validate
	 * @return Result
	 */
	public function isValid($value);
}
?>
