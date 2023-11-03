<?php

namespace bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\Route;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * handle specific API requests
 *
 * @author <bookingtime GmbH>
 */
class BookingTemplateRoute extends Route {



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

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$fakeId='fc'.BasicLib::getRandomHash(30);
			$response=$this->httpClient->mockRequest('POST','bookingTemplate/list',$expectedResponseCode,[
				'class'=>'BOOKING_TEMPLATE',
				'id'=>$fakeId,
				'customId'=>'mock-bookingTemplate',
				'name'=>'Mock-bookingTemplate',
				'nameI18nList'=>'',
				'image'=>'',
				'duration'=>60,
				'showPrice'=>FALSE,
				'priceGross'=>99.99,
				'currency'=>'EUR',
				'taxRate'=>19,
				'description'=>'',
				'descriptionI18nList'=>'',
				'appointmentAddressRequired'=>FALSE,
				'customerAddressRequired'=>FALSE,
				'customerEmailRequired'=>TRUE,
				'customerMobileRequired'=>FALSE,
				'bookingDayEarliest'=>0,
				'bookingDayLatest'=>99,
				'bookingLeadTime'=>0,
				'address'=>NULL,
				'bookingStepList'=>[],
				'emailTemplateList'=>[],
				'smsTemplateList'=>[],
				'additionalData'=>NULL,
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>''],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingTemplateId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['bookingTemplateId'].'/show',[],$expectedResponseCode);
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
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['customId'].'/identify',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * list entities
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function list(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$response=$this->httpClient->mockRequest('GET','bookingTemplate/list',$expectedResponseCode,[
				'class'=>'LIST',
				'recordTotal'=>'1',
				'recordLimit'=>9999,
				'recordList'=>[[
					'class'=>'BOOKING_TEMPLATE',
					'id'=>'fc'.BasicLib::getRandomHash(30),
					'customId'=>'mock-bookingTemplate',
					'name'=>'Mock-bookingTemplate',
					'nameI18nList'=>[],
					'image'=>'',
					'duration'=>120,
					'showPrice'=>TRUE,
					'priceGross'=>5.99,
					'currency'=>'EUR',
					'taxRate'=>19,
					'description'=>'',
					'descriptionI18nList'=>[],
					'appointmentAddressRequired'=>FALSE,
					'customerAddressRequired'=>FALSE,
					'customerEmailRequired'=>FALSE,
					'customerMobileRequired'=>FALSE,
					'bookingDayEarliest'=>0,
					'bookingDayLatest'=>0,
					'bookingLeadTime'=>0,
					'address'=>[],
					'bookingStepList'=>[[
						'class'=>'BOOKING_STEP',
						'name'=>'Employee',
						'nameI18nList'=>[],
						'description'=>'',
						'descriptionI18nList'=>[],
						'selectionQuantity'=>1,
						'selectionDisplay'=>'BOTH',
						'bookingResourceList'=>[[
							'class'=>'BOOKING_RESOURCE',
							'id'=>'br'.BasicLib::getRandomHash(30),
							'customId'=>'employee',
							'type'=>'EMPLOYEE',
							'name'=>'Max Mustermann',
							'nameI18nList'=>[],
							'gender'=>'FEMALE',
							'title'=>'',
							'firstName'=>'Max',
							'lastName'=>'Mustermann',
							'description'=>'',
							'descriptionI18nList'=>[],
							'image'=>'',
							'additionalData'=>NULL,
						]],
						'additionalData'=>NULL,
					]],
					'emailTemplateList'=>[],
					'smsTemplateList'=>[],
				]],
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>''],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * bookingResource list
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function bookingResourceList(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingResourceId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingResource/'.$urlParameter['bookingResourceId'].'/bookingTemplate/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * customEntity list
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function customEntityList(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','customEntityId','customEntityType'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/customEntity/'.$urlParameter['customEntityType'].'/'.$urlParameter['customEntityId'].'/bookingTemplate/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}
}
