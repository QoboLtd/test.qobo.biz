<?php
/**
 * HiddenParameter class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class HiddenParameter extends Parameter {

	/**
	 * Constructor
	 * 
	 * @param string $name Name of the parameter
	 * @param boolean $required Whether required or not
	 * @param string $description Description of the parameter
	 * @return object
	 */
	public function __construct($name, $required = false, $description = false) {
		parent::__construct($name, Parameter::PARAMATER_TYPE_HIDDEN, $required, $description);
	}

}
?>
