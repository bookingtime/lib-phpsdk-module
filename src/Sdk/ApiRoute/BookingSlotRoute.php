<?php

namespace bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\Route;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * handle specific API requests
 *
 * @author <bookingtime GmbH>
 */
class BookingSlotRoute extends Route {



	/**
	 * show earliest bookingSlot
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function earliest(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingTemplateId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['bookingTemplateId'].'/bookingSlot/earliest',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * list day
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function listDay(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$response=$this->httpClient->mockRequest('POST','bookingSlot/year/',$expectedResponseCode,[
				'class'=>'RANGE_LIST',
				'rangeStart'=>'2024-01-01T00:00:00+00:00',
				'rangeEnd'=>'2024-01-01T23:59:59+00:00',
				'timeZone'=>'Europe\/Berlin',
				'list'=>[
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-01T18:15:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-01T18:30:00+0:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
				]
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>''],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingTemplateId','year','month','day'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['bookingTemplateId'].'/bookingSlot/year/'.$urlParameter['year'].'/month/'.$urlParameter['month'].'/day/'.$urlParameter['day'].'/listDay',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * list week
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function listWeek(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$response=$this->httpClient->mockRequest('POST','/listWeek',$expectedResponseCode,[
				'class'=>'RANGE_LIST',
				'rangeStart'=>'2024-01-01T00:00:00+00:00',
				'rangeEnd'=>'22024-01-03T23:59:59+00:00',
				'timeZone'=>'Europe\/Berlin',
				'list'=>[
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-01T18:15:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-02T18:30:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-03T18:45:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
				]
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>''],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingTemplateId','year','week'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['bookingTemplateId'].'/bookingSlot/year/'.$urlParameter['year'].'/week/'.$urlParameter['week'].'/listWeek',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * list month
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function listMonth(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make mock request with dummi content
		if($this->httpClient->getMock()) {
			$response=$this->httpClient->mockRequest('POST','/listMonth',$expectedResponseCode,[
				'class'=>'RANGE_LIST',
				'rangeStart'=>'2024-01-01T00:00:00+00:00',
				'rangeEnd'=>'2024-01-023T23:59:59+00:00',
				'timeZone'=>'Europe\/Berlin',
				'list'=>[
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-01T18:15:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-12T12:30:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
					[
						'class'=>'BOOKING_SLOT',
						'id'=>'4f'.BasicLib::getRandomHash(30),
						'timestamp'=>'2024-01-19T11:35:00+00:00',
						'bookingResourceCombination'=>[
							'brXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
						],
					],
				]
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>''],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['organizationId','bookingTemplateId','year','month'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/bookingTemplate/'.$urlParameter['bookingTemplateId'].'/bookingSlot/year/'.$urlParameter['year'].'/month/'.$urlParameter['month'].'/listMonth',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}
}
