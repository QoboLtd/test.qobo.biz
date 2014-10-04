<?php
/**
 * Result class
 * 
 * This class is used for passing around test results and 
 * their user friendly descriptions.
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class Result implements iResult {

	/**
	 * Successful result value
	 */
	const SUCCESS = true;

	/**
	 * Failed result value
	 */
	const FAILURE = false;

	/**
	 * Default description for successful result
	 */
	const DEFAULT_DESCRIPTION_SUCCESS = 'OK';

	/**
	 * Default description for failed result
	 */
	const DEFAULT_DESCRIPTION_FAIL = 'Failed';

	private $isSuccess;
	private $description;

	/**
	 * Constructor
	 * 
	 * @param boolean $isSuccess Result
	 * @param string $description Description of the result
	 * @return object
	 */
	public function __construct($isSuccess, $description = null) {
		$this->isSuccess = (boolean) $isSuccess;
		$this->description = (string) $description;
	}

	/**
	 * Check if the result is successful
	 * 
	 * @return boolean True on success, false otherwise
	 */
	public function isSuccess() {
		return $this->isSuccess;
	}

	/**
	 * Get result description
	 * 
	 * @return string
	 */
	public function getDescription() {

		$result = $this->isSuccess ? self::DEFAULT_DESCRIPTION_SUCCESS : self::DEFAULT_DESCRIPTION_FAIL;
		if (!empty($this->description)) {
			$result .= '. ' . $this->description;
		}

		return $result;
	}

	/**
	 * Convert object to string
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->getDescription();
	}
	
}
?>
