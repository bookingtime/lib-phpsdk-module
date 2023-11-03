<?php

namespace bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\Route;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * handle specific API requests
 *
 * @author <bookingtime GmbH>
 */
class AppointmentRoute extends Route {



	/**
	 * add an entity
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	array		$requestContent: send this content to api
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function add(array $urlParameter,array $requestContent,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$fakeId='ed'.BasicLib::getRandomHash(30);
			$response=$this->httpClient->mockRequest('POST','appointment/add',$expectedResponseCode,[
				'class'=>'APPOINTMENT',
				'id'=>$fakeId,
				'customId'=>'mock-appointment',
				'start'=>new \DateTime('tomorrow 10:00'),
				'end'=>new \DateTime('tomorrow 12:00'),
				'duration'=>120,
				'timeZone'=>'Europe/Berlin',
				'protected'=>FALSE,
				'name'=>'Mock-Appointment',
				'nameI18nList'=>[],
				'description'=>'1. description from datafixture...',
				'descriptionI18nList'=>['en'=>'1. Description from the datafixture...'],
				'showPrice'=>TRUE,
				'priceGross'=>34,99,
				'taxRate'=>19,
				'currency'=>'EUR',
				'customer'=>[],
				'address'=>['name'=>'Familie Mustermann','extra'=>'1. OG','street'=>'teststreet 10','zip'=>'22453','city'=>'Hamburg','country'=>'DE','latitude'=>53.6059747,'longitude'=>9.9841561],
				'canceled'=>FALSE,
				'moved'=>FALSE,
				'bookingResourceList'=>[],
				'fileList'=>[],
				'organizationId'=>'f6'.BasicLib::getRandomHash(30),
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>'Appointment successfully booked.'],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId'],$urlParameter);
		$response=$this->httpClient->request('POST','/organization/'.$urlParameter['organizationId'].'/appointment/add',$requestContent,$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * show an entity
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function show(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','appointmentId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/appointment/'.$urlParameter['appointmentId'].'/show',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * show an entity
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function showProtected(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','appointmentId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/appointment/'.$urlParameter['appointmentId'].'/showProtected',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * identify an entity
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function identify(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','customId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/appointment/'.$urlParameter['customId'].'/identify',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * cancel an entity
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function cancel(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','appointmentId'],$urlParameter);
		$response=$this->httpClient->request('PUT','/organization/'.$urlParameter['organizationId'].'/appointment/'.$urlParameter['appointmentId'].'/cancel',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}
}
