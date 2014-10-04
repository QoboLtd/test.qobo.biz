<?php
/**
 * iResult interface
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
interface iResult {

	/**
	 * Check if the result is a success
	 * 
	 * @return boolean True on success, false otherwise
	 */
	public function isSuccess();

	/**
	 * Get result description
	 * 
	 * @return string
	 */
	public function getDescription();

	/**
	 * Convert object to string
	 * 
	 * @return string
	 */
	public function __toString();
}
?>
