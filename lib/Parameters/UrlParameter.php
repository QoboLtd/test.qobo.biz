<?php
/**
 * UrlParameter class
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class UrlParameter extends TextParameter {

	/**
	 * Constructor
	 * 
	 * @param string $name Name of the parameter (defaults to 'url')
	 * @param boolean $required Whether parameter is required or not
	 * @param string $description Description of the parameter
	 * @return object
	 */
	public function __construct($name = 'url', $required = false, $description = false) {
		parent::__construct($name, $required, $description);
	}

	/**
	 * Check if given value is valid for parameter
	 * 
	 * @param string $value Value to check
	 * @return Result
	 */
	public function isValid($value) {
		$parentResult = parent::isValid($value);
		if (!$parentResult->isSuccess()) {
			return $parentResult;
		}

		$urlParts = parse_url($value);
		if (empty($urlParts)) {
			return new Result(Result::FAILURE, "Invalid URL");
		}

		$requiredParts = ['scheme', 'host'];
		foreach ($requiredParts as $requredPart) {
			if (empty($urlParts[$requredPart])) {
				return new Result(Result::FAILURE, "URL needs $requredPart");
			}
		}

		$bannedParts = ['user', 'pass', 'query', 'fragment'];
		foreach ($bannedParts as $bannedPart) {
			if (!empty($urlParts[$bannedPart])) {
				return new Result(Result::FAILURE, "URL $bannedPart (" . $urlParts[$bannedPart] . ") are not supported");
			}
		}

		if (!in_array($urlParts['scheme'], ['http', 'https'])) {
			return new Result(Result::FAILURE, "URL scheme must be either http:// or https://");
		}

		return new Result(Result::SUCCESS);

	}

}
?>
