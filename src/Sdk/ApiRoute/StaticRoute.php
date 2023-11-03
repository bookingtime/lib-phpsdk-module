<?php

namespace bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\Route;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * handle specific API requests
 *
 * @author <bookingtime GmbH>
 */
class StaticRoute extends Route {



	/**
	 * get list of countries
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function countryList(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$response=$this->httpClient->request('GET','/static/country/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * get list of currencies
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function currencyList(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$response=$this->httpClient->request('GET','/static/currency/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * show error
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function errorShow(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$this->checkUrlParameters(['errorCode'],$urlParameter);
		$response=$this->httpClient->request('GET','/static/error/'.$urlParameter['errorCode'].'/show',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * get list of languages
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function languageList(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$response=$this->httpClient->request('GET','/static/language/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * get list of sectors
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function sectorList(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$response=$this->httpClient->request('GET','/static/sector/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * get list of timeZones
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function timeZoneList(array $urlParameter,$expectedResponseCode) {
		//make request to API
		$response=$this->httpClient->request('GET','/static/timeZone/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}
}
