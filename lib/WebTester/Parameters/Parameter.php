<?php
namespace WebTester\Parameters;
/**
 * Parameter class
 * 
 * Simplest parameter
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class Parameter implements iParameter {

	const PARAMATER_TYPE_TEXT = 'text';
	const PARAMATER_TYPE_HIDDEN = 'hidden';

	protected $name;
	protected $type;
	protected $required;
	protected $description;

	/**
	 * Constructor
	 * 
	 * @param string $name Name of the parameter
	 * @param string $type Type of the parameter
	 * @param boolean $required Whether required or not
	 * @param string $description Description of the parameter
	 * @return object
	 */
	public function __construct($name, $type, $required = false, $description = false) {
		$this->name = (string) $name;
		$this->type = (string) $type;
		$this->required = (boolean) $required;
		$this->description = (string) $description;
	}

	/**
	 * Get name
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/*
	 * Get type
	 * 
	 * @return string
	 */
	public function getWebType() {
		return $this->type;
	}
	
	/**
	 * Check if required
	 * 
	 * @return boolean
	 */
	public function isRequired() {
		return $this->required;
	}

	/**
	 * Get description
	 * 
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Check if given value is valid for parameter
	 * 
	 * @param mixed $value Parameter value to validate
	 * @return \WebTester\Result\Result
	 */
	public function isValid($value) {
		$result = new \WebTester\Result\Result(\WebTester\Result\Result::SUCCESS);

		if ($this->required && empty($value)) {
			$result = new \WebTester\Result\Result(\WebTester\Result\Result::FAILURE, "Required parameter [" . $this->getName() . "] cannot be empty");
		}

		return $result;
	}
	
}
?>
