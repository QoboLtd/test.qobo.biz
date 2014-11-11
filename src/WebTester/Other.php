<?php
namespace WebTester;
use \Qobo\Pattern\Pattern;
/**
 * Other tests
 * 
 * @author Leonid Mamchenkov <l.mamchenkov@qobo.biz>
 */
class Other {

	/**
	 * Test patterns
	 */
	protected static $patterns = array(
		'Am I Responsive?' => 'http://ami.responsivedesign.is/?url=%%url_encoded%%',
		'Built With Report' => 'http://builtwith.com/%%host%%',
		'DNSstuff DNS Report' => 'http://dnsstuff.com/tools#dnsReport|type=domain&&value=%%host%%',
		'SSL Server Test' => 'https://www.ssllabs.com/ssltest/analyze.html?d=%%host%%',
		'W3C Markup Validator' => 'http://validator.w3.org/check?uri=%%url_encoded%%',
	);

	/**
	 * Get list of other tests
	 * 
	 * @param string $url URL to use in test links
	 * @return array
	 */
	public static function getTests($url) {
		$result = array();
		
		$data = parse_url($url);
		if (empty($data))  {
			return $result;
		}

		$data['url_encoded'] = urlencode($url);

		foreach (self::$patterns as $label => $pattern) {
			$result[$label] = (string) new Pattern($pattern, $data);
		}

		return $result;
	}
}
?>
