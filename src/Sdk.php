<?php

namespace bookingtime\phpsdkmodule;
use bookingtime\phpsdkmodule\Sdk\ApiRoute;
use bookingtime\phpsdkmodule\Sdk\HttpClient;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * main SDK
 *
 *                         *,,,*    /*,*
 *                     ,,,(((((,,,/&%%%##/,,.
 *                  ,,,((//,,,&&&&((((((((((,,,,,,,,,,,,,,,,,,,,,,,,,,,,*
 *          .,,,,*(%&&&&&#&&&%((((((((((((((((,(%%%%%%%%%%%%%%%%%%%%%%%%%#*,,,.
 *      ,,,/&&&&&&&&&&%&&&((((((((((((((((((((*,(((((((((((((//////////////%%%%,,,           ,,,,(,,
 *    ,,(&&&&&%##########((((((((((((((((((((((,,((((((((((((///////////////////(#,,,,,,,,,,,,,**,,,
 *   ,*&&&&#,,,,(###/####((((((((((((((((((((((,,((((((((((/////////////////////////,,,,,,,,,,,,,,,,,,,
 *  ,*&&&##((############((((((((((((((((((((((*,((((((((/@,,,#@//////////////////////,,     .,,,,,,,
 * ,,%&&#######,,,(######((((((((((((((((((((((*,@@@#/(((@(,,.@@@@@&(///&@@@@@@@@&/////,,
 * ,,%&%######,,@@,/%*###((((((((((((((((((((((,,,,,,,*@/@,,,,,,,,,,,(@@,,,,,,,,,,,.@(//,,
 * ,,%&########,&@&(*####(#((((/*(((((((((((((*,((%@,,,,@(,,,@///@.,,.@@,,,,/@@@,,,,,@//,,
 * ,,%&##################(((*,*((((((((((((((,,(((&@,,,#@,,,(@//#@,,,@@*,,,,@@@@,,,,.@//,,
 * ,,%&##################(((#,(((((((((/,,,,,@@@&/,,,,&@(,,,@///@.,,.@@,,,,,,,,,,,,*@ //,,
 * ,,%&##################(((,/((((((,,((@.,,,,,,,,/@@#/@.,,#@///@,,,@@*,,,,,,,,*&@&/////,,
 * ,,%&##################(#,(((((((*.((@#,,,@((((((((((((((((////////@,,,%&////////////,,
 * ,,%&##############(((*,(((((((((((((@@@@@@((((((((((((((((///////#@@@@@/////////////,,
 * ,,%&##########*,,    ,*(/,,,,*((((((((((((((((((((((((((((//////////////////////////,,
 * ,,%&#########,,      ,*((((#,*((((((((((((((((((((((((((((//////////////////////////,,
 * ,,%&########/,       ,*((((#,*((((((((((((((((((((((((((((//////////////////////////,,
 * ,,%%########,,       ,*((((#,*((((((((((((((((((((,,(((((((///,/////////////////////,,
 * ,,%%########,,       ,*((((#,*((((((((((((((((((((,,   ,,////(,/////////////////////,,
 * ,,%%########,,       ,,##,(#,*((((((((((((((((((((,,   ,,((//(,/////////////////////,,
 * ,,%%#######(,        ,/#/,.#,*((((,/((((((((((((((,,   ,*(**,(,////##(//////////////,,
 * ,,%########*,        ,,/*##.,*,%,####.((((((((((((,,   ,**(((,,/.#,####,////////////,,
 * ,,#########.,         ,,###(,,#.####.##.((((((((((,,   ,,,(((*,,#.###,###.//////////,,
 * *,#########,,          ,,,*#.,#,###.####/(((((((((,,     ,,,((,,#.###,#####/////////,,
 *   ,,,,,,,,,.                .,,,###.####/(((((((,,/          .,,,,*##.###(///////,,,
 *                                 ,,,,,,,,,,,,,,,*                    ,,,,,,,,,,,,
 *
 * @author <bookingtime GmbH>
 */
class Sdk {
	//class properties
	protected $httpClient;
	protected $config=[];//current config
	const DEFAULT_CONFIG=[
		'moduleApiUrl'=>'https://api.bookingtime.com/module/v3/',
		'oauthUrl'=>'https://auth.bookingtime.com/oauth/token',
		'locale'=>'en_EN',
		'timeout'=>30,
		'mock'=>FALSE,
	];



	/**
	 * set client_id, client_secret and optional configuration
	 *
	 * @param	string	$client_id: from module
	 * @param	string	$client_secret: empty string
	 * @param	array		$config: configuration for the sdk - optional
	 * @return	void
	 */
	public function __construct($client_id,$client_secret,array $config=[]) {
		//check submitted parameters
		BasicLib::checkType('string',$client_id,__METHOD__.'(): client_id');
		BasicLib::checkType('string',$client_secret,__METHOD__.'(): client_secret');

		//merge submitted configuration with default config
		$config=array_merge(self::DEFAULT_CONFIG,$config);
		$this->config=$config;
		#die(BasicLib::debug($config));

		//make http client and start authentication
		$this->httpClient=new HttpClient($client_id,$client_secret,$config);
	}



	/**
	 * get all messages from last api call
	 *
	 * @return	array		messages like [["type":"failure","parameter":"firstName","text":"This parameter is missing."], ...]
	 */
	public function getMessageArray():array {
		return $this->httpClient->messageArray;
	}



	/**
	 * get all messages from last api call as string seperated by newlines
	 *
	 * @return	string		like "failure[firstName]: This parameter is missing.\n ..."
	 */
	public function getMessageArrayAsString():string {
		$content='';
		foreach($this->httpClient->messageArray as $item) {
			$content.=$item['type'].(!empty($item['parameter'])?'['.$item['parameter'].']':'').': '.$item['text']."\n";
		}
		return $content;
	}



	/**
	 * get last request method, url and responseCode
	 *
	 * @return	array		like ['method'=>'POST','requestUrl'=>'...','responseCode'=>201]
	 */
	public function getLastRequestInfo():array {
		return $this->httpClient->lastRequestInfo;
	}



	/**
	 * get current config
	 *
	 * @return	array		self::config
	 */
	public function getConfig():array {
		return $this->config;
	}



	/**
	 * wrapper for all api calls
	 * NOTE: throw exeption if no 200 http reponse code of api request
	 *
	 * @param	string	$name: name of called method
	 * @param	array		$args: submitted method parameters - args[0]=urlParameter(required) // args[1]=data(optional)
	 * @return	mixed		depends on api call
	 */
	public function __call($name,array $args) {
		//check submitted parameters
		BasicLib::checkType('string',$name,__METHOD__.'(): name');

		//check argument count and type
		if(count($args)<1 || count($args)>2) {throw new \InvalidArgumentException('Expected one or two parameters for method: '.$name);}
		if(!is_array($args[0]) || (count($args)==2 && !is_array($args[1]))) {throw new \InvalidArgumentException('Expected parameters of type array for method: '.$name);}

		//make apiRoute object
		$strpos=strpos($name,'_');
		if($strpos===FALSE || $strpos<1) {throw new \BadMethodCallException('Undefined method called: '.$name);}
		switch(substr($name,0,$strpos)) {
			default: {
				throw new \BadMethodCallException('Undefined method called: '.$name);
			} case('appointment'): {
				$apiRoute=new ApiRoute\AppointmentRoute($this->httpClient);
				break(1);
			} case('bookingResource'): {
				$apiRoute=new ApiRoute\BookingResourceRoute($this->httpClient);
				break(1);
			} case('bookingSlot'): {
				$apiRoute=new ApiRoute\BookingSlotRoute($this->httpClient);
				break(1);
			} case('bookingTemplate'): {
				$apiRoute=new ApiRoute\BookingTemplateRoute($this->httpClient);
				break(1);
			} case('customEntity'): {
				$apiRoute=new ApiRoute\CustomEntityRoute($this->httpClient);
				break(1);
			} case('file'): {
				$apiRoute=new ApiRoute\FileRoute($this->httpClient);
				break(1);
			} case('moduleConfig'): {
				$apiRoute=new ApiRoute\ModuleConfigRoute($this->httpClient);
				break(1);
			} case('organization'): {
				$apiRoute=new ApiRoute\OrganizationRoute($this->httpClient);
				break(1);
			} case('static'): {
				$apiRoute=new ApiRoute\StaticRoute($this->httpClient);
				break(1);
			}
		}

		//appointment
		switch($name) {
			 case('appointment_add'): {
				return $apiRoute->add($args[0],$args[1],201);
			} case('appointment_show'): {
				return $apiRoute->show($args[0],200);
			} case('appointment_showProtected'): {
				return $apiRoute->showProtected($args[0],200);
			} case('appointment_identify'): {
				return $apiRoute->identify($args[0],200);
			} case('appointment_move'): {
				return $apiRoute->move($args[0],$args[1],200);
			} case('appointment_cancel'): {
				return $apiRoute->cancel($args[0],200);
			}
		}

		//bookingResource
		switch($name) {
			 case('bookingResource_show'): {
				return $apiRoute->show($args[0],200);
			} case('bookingResource_identify'): {
				return $apiRoute->identify($args[0],200);
			} case('bookingResource_list'): {
				return $apiRoute->list($args[0],200);
			} case('bookingResource_customEntity_list'): {
				return $apiRoute->customEntityList($args[0],200);
			}
		}

		//bookingSlot
		switch($name) {
			 case('bookingSlot_earliest'): {
				return $apiRoute->earliest($args[0],200);
			} case('bookingSlot_listDay'): {
				return $apiRoute->listDay($args[0],200);
			} case('bookingSlot_listWeek'): {
				return $apiRoute->listWeek($args[0],200);
			} case('bookingSlot_listMonth'): {
				return $apiRoute->listMonth($args[0],200);
			}
		}

		//bookingTemplate
		switch($name) {
			 case('bookingTemplate_show'): {
				return $apiRoute->show($args[0],200);
			} case('bookingTemplate_identify'): {
				return $apiRoute->identify($args[0],200);
			} case('bookingTemplate_list'): {
				return $apiRoute->list($args[0],200);
			} case('bookingTemplate_bookingResource_list'): {
				return $apiRoute->bookingResourceList($args[0],200);
			} case('bookingTemplate_customEntity_list'): {
				return $apiRoute->customEntityList($args[0],200);
			}
		}

		//customEntity
		switch($name) {
			case('customEntity_add'): {
				return $apiRoute->add($args[0],$args[1],201);
			} case('customEntity_show'): {
				return $apiRoute->show($args[0],200);
			} case('customEntity_identify'): {
				return $apiRoute->identify($args[0],200);
			} case('customEntity_list'): {
				return $apiRoute->list($args[0],200);
			} case('customEntity_appointment_list'): {
				return $apiRoute->appointmentList($args[0],200);
			} case('customEntity_bookingResource_list'): {
				return $apiRoute->bookingResourceList($args[0],200);
			} case('customEntity_bookingTemplate_list'): {
				return $apiRoute->bookingTemplateList($args[0],200);
			} case('customEntity_customEntity_list'): {
				return $apiRoute->customEntityList($args[0],200);
			}
		}

		//file
		switch($name) {
			case('file_add'): {
				return $apiRoute->add($args[0],$args[1],201);
			} case('file_download'): {
				return $apiRoute->download($args[0],200);
			}
		}

		//moduleConfig
		switch($name) {
			 case('moduleConfig_show'): {
				return $apiRoute->show($args[0],200);
			} case('moduleConfig_module_show'): {
				return $apiRoute->moduleShow($args[0],200);
			} case('moduleConfig_identify'): {
				return $apiRoute->identify($args[0],200);
			}
		}

		//organization
		switch($name) {
			 case('organization_show'): {
				return $apiRoute->show($args[0],200);
			} case('organization_identify'): {
				return $apiRoute->identify($args[0],200);
			} case('organization_filter'): {
				return $apiRoute->filter($args[0],200);
			} case('organization_list'): {
				return $apiRoute->list($args[0],200);
			}
		}

		//staticc
		switch($name) {
			case('static_country_list'): {
				return $apiRoute->countryList($args[0],200);
			} case('static_currency_list'): {
				return $apiRoute->currencyList($args[0],200);
			} case('static_error_show'): {
				return $apiRoute->errorShow($args[0],intval($args[0]['errorCode']));
			} case('static_language_list'): {
				return $apiRoute->languageList($args[0],200);
			} case('static_sector_list'): {
				return $apiRoute->sectorList($args[0],200);
			} case('static_timeZone_list'): {
				return $apiRoute->timeZoneList($args[0],200);
			}
		}

		//unknown
		throw new \BadMethodCallException('Undefined method called: '.$name);
	}
}
