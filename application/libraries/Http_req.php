<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  HTTP REQUEST HELPER
*
* Version: Alpha.0.0.2
*
* Author: Dian Mukti Wibowo
*		  Kamal Miftahul Amin
*   	  Iwan Firmawan      
*
*
* Created:  22.02.2019
*
* Description:  Di buat untuk kebutuhan penanganan HTTP request Stockraken
* Requirements:
*	- PHP5.3 or above
*	- CURL
*/
// require 'vendor/autoload.php';

class Http_req {

	private static $timeout	= NULL;

	private static $mashape	= NULL;

	private static $headers	= NULL;

	private static $body 	= NULL;

	public function __construct() {

		$this->load->config('http_req', TRUE);

	} // end __construct()

	protected function get_method_req($method) {
		
		$methodreq	= $this->config->item('http_req');
		$arrmeth	= $methodreq['method'];
		$method 	= strtolower($method);

		$hasil		= $arrmeth['get'];

		if (array_key_exists($method, $arrmeth)) {
			
			$hasil	= $arrmeth[$method];

		} // end if

		return $hasil;

	} // end get_method_req

	protected function get_curl_method($method) {

		$arrnew 	= $this->config->item('http_req');
		$curlauth	= $arrnew['curlauth'];

		$method 	= (string) $method;
		$method 	= strtolower($method);

		$hasil		= $curlauth['basic'];

		if (array_key_exists($method, $curlauth)) {
			
			$hasil	= $curlauth[$method];

		} // end if

		return $hasil;

	} // end get_curl_method

	protected function send($method = 'GET', $url = '', $header = NULL, $body = NULL) {

		if (isset(self::$mashape)) {
			
			Unirest\Request::setMashapeKey(self::$mashape);

		} // end if

		if (isset(self::$timeout) && self::$timeout > 0) {
			
			Unirest\Request::timeout(self::$timeout); // 5s timeout

		} // end if

		return Unirest\Request::send(strtoupper($method), $url, $header, $body);

	} // end basic_send

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var) {
		
		return get_instance()->$var;

	} // end _get or $this

	public function get($uri, $header = array(), $param = NULL) {

		if (isset(self::$headers) && $header !== array()) {
			
			$header 	= self::$headers;

		} // end if

		if (isset(self::$body) && $param === NULL) {
			
			$param 		= self::$body;

		} // end if

		return Unirest\Request::get($uri, $header, $param);

	} // end get

	public function post($uri, $header = array(), $body = NULL) {

		if (isset(self::$headers) && $header !== array()) {
			
			$header 	= self::$headers;

		} // end if

		if (isset(self::$body) && $body === NULL) {
			
			$body 		= self::$body;

		} // end if

		return Unirest\Request::post($uri, $header, $body);

	} // end post

	public function put($uri, $header = array(), $body = NULL) {

		if (isset(self::$headers) && $header !== array()) {
			
			$header 	= self::$headers;

		} // end if

		if (isset(self::$body) && $body === NULL) {
			
			$body 		= self::$body;

		} // end if

		return Unirest\Request::put($uri, $header, $body);

	} // end put

	public function patch($uri, $header = array(), $body = NULL) {

		if (isset(self::$headers) && $header !== array()) {
			
			$header 	= self::$headers;

		} // end if

		if (isset(self::$body) && $body === NULL) {
			
			$body 		= self::$body;

		} // end if

		return Unirest\Request::patch($uri, $header, $body);

	} // end post

	public function delete($uri, $header = array(), $body = NULL) {

		if (isset(self::$headers) && $header !== array()) {
			
			$header 	= self::$headers;

		} // end if

		if (isset(self::$body) && $body === NULL) {
			
			$body 		= self::$body;

		} // end if

		return Unirest\Request::delete($uri, $header, $body);

	} // end delete

	public function custom($method = 'get', $url, $headers = array(), $body = NULL) {

		$method = $this->get_method_req($method);

		if (NULL !== self::$headers && $headers !== array()) {
			
			$headers 	= self::$headers;

		} // end if

		if (isset(self::$body) && $body === NULL) {
			
			$body 		= self::$body;

		} // end if

		return $this->send($method, $url, $headers, $body);

	} // end custom

	public function set_Headers($headers) {

		if (is_array($headers) || is_object($headers)) {
			
			self::$headers 	= $headers;

		} // end if

	} // end set_Headers

	public function set_Body($body, $options = 'default') {

		if (isset($body) || is_array($body) || is_object($body)) {
			
			switch (strtolower($options)) {
				
				case 'query':
					
					self::$body 	= $body;

					break;

				case 'json':
					
					self::$body 	= Unirest\Request\Body::json($body);

					break;

				case 'form':
					
					self::$body 	= Unirest\Request\Body::form($body);

					break;

				case 'multipart':
					
					self::$body 	= Unirest\Request\Body::multipart($body);

					break;

				case 'upload':
					
					if (isset($body['files']) && isset($body['body'])) {
						
						self::$body 	= Unirest\Request\Body::form($body['body'], $body['files']);

					} else {

						self::$body 	= Unirest\Request\Body::multipart($body);

					}

					break;
				
				default:
					
					self::$body 	= $body;

					break;

			} // end switch

		} // end if

	}

	public function set_Timeout($second) {

		self::$timeout = (int) $second;

	} // end set_Timeout

	public function set_Mashape($key) {

		self::$mashape = (string) $key;

	} // end set_Mashape

	public function set_Auth($username, $password, $options = 'basic') {

		$method 	= strtolower($options);

		if ($method === 'basic') {
			
			Unirest\Request::auth($username, $password);

		} else {

			Unirest\Request::proxyAuth($username, $password, $this->get_curl_method($method));

		} // end if else

	} // end set_Auth

	public function set_Cookies($cookie, $options = 'default') {

		switch (strtolower($options)) {

			case 'file':
				
				Unirest\Request::cookieFile($cookie);

				break;
			
			default:
				
				Unirest\Request::cookie($cookie);

				break;

		} // end switch

	} // end set_Cookies

	public function set_JsonOpt($isassoc = FALSE, $rekusi = 512, $options = JSON_NUMERIC_CHECK & JSON_FORCE_OBJECT & JSON_UNESCAPED_SLASHES) {

		Unirest\Request::jsonOpts($isassoc, $rekusi, $options);

	} // end set_JsonOpt

	public function set_Proxy($ip, $port = 1080, $tunneling = FALSE, $type = CURLPROXY_HTTP) {

		if ($port !== 1080) {
			
			Unirest\Request::proxy($ip, $port, $type);

		} else if ($tunneling) {

			Unirest\Request::proxy($ip, $port, $type, TRUE);

		} else {

			Unirest\Request::proxy($ip);

		} // end if else

	} // end of set_Proxy

	public function curl_options($options) {

		if (is_string($options) && strtolower($options) == 'clear') {

			Unirest\Request::clearCurlOpts();
			
		} else {

			Unirest\Request::curlOpt($options);
		
		} // end if else

	} // end curl_options

	public function ssl_validation($bool = TRUE) {

		Unirest\Request::verifyPeer($bool);

	} // end ssl_validation

	public function utility($set = 'info') {

		switch (strtolower($set)) {

			case 'info':
				
				return Unirest\Request::getInfo();

				break;

			case 'handle':
				
				return Unirest\Request::getCurlHandle();

				break;
			
			default:
				
				return Unirest\Request::getInfo();

				break;
		}

	} // end utility

	public function get_File($path, $typeread = 'text/plain') {

		return Unirest\Request\Body::file($path, $typeread);

	} // end getFile

}