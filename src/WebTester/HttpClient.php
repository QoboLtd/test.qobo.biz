<?php
namespace WebTester;
/**
 * HttpClient class
 * 
 * @author Leonid Mamchenkov
 */
class HttpClient {

	const USER_AGENT = 'Qobo Web Tester - http://test.qobo.biz';

	public static function init() {
		$result = new \GuzzleHttp\Client([
							'defaults' => [
								'headers' => [
									'User-Agent' => self::USER_AGENT,
								],
								'timeout' => 5,
							]
						]);
		$result->timeout = 5;
		
		return $result;
	}
}
