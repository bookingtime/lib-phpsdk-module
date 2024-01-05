<?php

namespace bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\Route;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * handle specific API requests
 *
 * @author <bookingtime GmbH>
 */
class OrganizationRoute extends Route {



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
		$this->checkUrlParameters(['organizationId'],$urlParameter);
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/show',[],$expectedResponseCode);
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
		$response=$this->httpClient->request('GET','/organization/'.$urlParameter['organizationId'].'/organization/'.$urlParameter['customId'].'/identify',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * filter
	 *
	 * @param	array		$urlParameter: list of url paramerts like ids
	 * @param	integer	$expectedResponseCode: expected http response code for http-client
	 * @return	array		reponse content
	 */
	public function filter(array $urlParameter,$expectedResponseCode) {
		//check submitted parameters
		BasicLib::checkType('integer',$expectedResponseCode,__METHOD__.'(): expectedResponseCode');

		//make request to API
		$this->checkUrlParameters(['moduleId',],$urlParameter);
		$response=$this->httpClient->request('GET','/module/'.$urlParameter['moduleId'].'/organization/filter?searchQuery='.$urlParameter['searchQuery'],[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}



	/**
	 * list
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
			$fakeId='f6'.BasicLib::getRandomHash(30);
			$response=$this->httpClient->mockRequest('POST','organization/list',$expectedResponseCode,[
				'class'=>'LIST',
				'recordTotal'=>'1',
				'recordLimit'=>9999,
				'recordList'=>[[
					'class'=>'ORGANIZATION',
					'id'=>$fakeId,
					'customId'=>'222222222',
					'name'=>'Organization from SDK',
					'address'=>[
						'class'=>'ADDRESS',
						'name'=>'Organization from SDK',
						'street'=>'SDK Ally',
						'zip'=>'12345',
						'city'=>'SDK Town',
					],
					'telephone'=>'040411883939',
					'email'=>'development@bookingtime.com',
					'description'=>'This is an organization shown in moduleSdk',
					'logo'=>'image.png',
					'imageList'=>[],
					'openingHours'=>[],
					'timeZone'=>'Europe/Berlin',
					'currency'=>'EUR',
					'sector'=>'01ab',
				]],
			],[
				['class'=>'MESSAGE','type'=>'success','parameter'=>NULL,'text'=>'branch found'],
			]);
			return $response['content'];
		}

		//make request to API
		$this->checkUrlParameters(['moduleId','organizationId'],$urlParameter);
		$response=$this->httpClient->request('GET','/module/'.$urlParameter['moduleId'].'/organization/'.$urlParameter['organizationId'].'/organization/list',[],$expectedResponseCode);
		#die(BasicLib::debug($response));
		return $response['content'];
	}
}
