<?php

namespace bookingtime\phpsdkmodule\Tests;
use PHPUnit\Framework\TestCase;
use bookingtime\phpsdkmodule\Sdk;
use bookingtime\phpsdkmodule\Lib\BasicLib;



/**
 * a test
 *
 * @author <bookingtime GmbH>
 */
class SdkTest extends TestCase {



	/**
	 * test all SDK methods with mock data
	 *
	 * @return void
	 */
	public function testSdk():void {
		//init SDK
		$sdk=new Sdk('xxx','xxx',[
			'locale'=>'de_DE',
			'timeout'=>15,
			'mock'=>TRUE,
		]);

		#APPOINTMENT
		$data=[
			'customId'=>'sdk',
			'notes'=>'sdk test appointment',
			'address'=>[
				'name'=>'Familie Mustermann',
				'extra'=>'1. OG',
				'street'=>'teststreet 10',
				'zip'=>'22453',
				'city'=>'Hamburg',
				'country'=>'DE',
				'geoCoordinates'=>[
					'latitude'=>53.6059747,
					'longitude'=>9.9841561
				],
			],
			'bookingSlotId'=>'4fxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
			'sendAppointmentAddEventEmail'=>TRUE,
			'sendAppointmentStartEventEmail'=>TRUE,
			'sendAppointmentEndEventEmail'=>TRUE,
			'additionalData'=>[
				'testKey'=>['testvalue1','testvalue2'],
				'bktest_color'=>['#123456'],
			],
			'customer'=>[
				'customId'=>'sdkKunde',
				'gender'=>'MALE',
				'title'=>'',
				'firstName'=>'Max',
				'lastName'=>'Mustermann',
				'birthday'=>'',
				'email'=>'modulesdk@bookingtime.com',
				'mobile'=>'',
				'notes'=>'',
				'address'=>[
					'name'=>'Familie Mustermann',
					'extra'=>'1. OG',
					'street'=>'teststreet 10',
					'zip'=>'22453',
					'city'=>'Hamburg',
					'country'=>'DE',
					'geoCoordinates'=>[
						'latitude'=>53.6059747,
						'longitude'=>9.9841561
					],
				],
				'locale'=>'de',
			],
		];
		$appointment=$sdk->appointment_add(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'],$data);
		$this->assertEquals($appointment['class'],'APPOINTMENT');

		$appointment=$sdk->appointment_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','appointmentId'=>'edxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($appointment['mock-content'],1);
		$appointment=$sdk->appointment_showProtected(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','appointmentId'=>'edxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($appointment['mock-content'],1);
		$appointment=$sdk->appointment_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customId'=>'123']);
		$this->assertEquals($appointment['mock-content'],1);
		$appointment=$sdk->appointment_cancel(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','appointmentId'=>'edxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($appointment['mock-content'],1);

		#BOOKINGRESOURCE
		$bookingResource=$sdk->bookingResource_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingResourceId'=>'brxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingResource['mock-content'],1);
		$bookingResource=$sdk->bookingResource_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customId'=>'dk']);
		$this->assertEquals($bookingResource['mock-content'],1);
		$bookingResourceArray=$sdk->bookingResource_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingResourceArray['class'],'LIST');
		$bookingResourceArray=$sdk->bookingResource_customEntity_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityId'=>'6Txxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($bookingResourceArray['mock-content'],1);

		#BOOKINGSLOT
		$bookingSlotArray=$sdk->bookingSlot_earliest(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingSlotArray['mock-content'],1);
		$bookingSlotArray=$sdk->bookingSlot_listDay(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','year'=>'2022','month'=>'12','day'=>'12']);
		$this->assertEquals($bookingSlotArray['class'],'RANGE_LIST');
		$bookingSlotArray=$sdk->bookingSlot_listWeek(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','year'=>'2023','week'=>'39']);
		$this->assertEquals($bookingSlotArray['class'],'RANGE_LIST');
		$bookingSlotArray=$sdk->bookingSlot_listMonth(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','year'=>'2023','month'=>'9']);
		$this->assertEquals($bookingSlotArray['class'],'RANGE_LIST');

		#BOOKINGTEMPLATE
		$bookingTemplate=$sdk->bookingTemplate_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingTemplate['class'],'BOOKING_TEMPLATE');
		$bookingTemplate=$sdk->bookingTemplate_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customId'=>'666']);
		$this->assertEquals($bookingTemplate['mock-content'],1);
		$bookingTemplateArray=$sdk->bookingTemplate_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingTemplateArray['class'],'LIST');
		$bookingTemplateArray=$sdk->bookingTemplate_bookingResource_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingResourceId'=>'brxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($bookingTemplateArray['mock-content'],1);
		$bookingTemplateArray=$sdk->bookingTemplate_customEntity_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityId'=>'6Txxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($bookingTemplateArray['mock-content'],1);

		#CUSTOMENTITY
		$data=['customId'=>'667','name'=>'CB Testentity'];
		$customEntity=$sdk->customEntity_add(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar'],$data);
		$this->assertEquals($customEntity['mock-content'],1);
		$customEntity=$sdk->customEntity_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar','customEntityId'=>'6Txxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($customEntity['mock-content'],1);
		$customEntity=$sdk->customEntity_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar','customId'=>'666']);
		$this->assertEquals($customEntity['mock-content'],1);
		$customEntityArray=$sdk->customEntity_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($customEntityArray['mock-content'],1);
		$customEntityArray=$sdk->customEntity_appointment_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','appointmentId'=>'edxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($customEntityArray['mock-content'],1);
		$customEntityArray=$sdk->customEntity_bookingResource_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingResourceId'=>'brxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($customEntityArray['mock-content'],1);
		$customEntityArray=$sdk->customEntity_bookingTemplate_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($customEntityArray['class'],'LIST');
		$customEntityArray=$sdk->customEntity_customEntity_list(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityId'=>'6Txxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customEntityType'=>'rentalCar']);
		$this->assertEquals($customEntityArray['mock-content'],1);

		#FILE
		$data=[
			'name'=>'testDatei2',
			'fileName'=>'testDatei2',
			'fileContent'=>'xxxxxx',
			'customId'=>'1234',
			'appointmentId'=>'edxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
		];
		$file=$sdk->file_add(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'],$data);
		$this->assertEquals($file['mock-content'],1);
		$file=$sdk->file_download(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','fileId'=>'w1xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);

		#MODULECONFIG
		$moduleConfig=$sdk->moduleConfig_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','moduleConfigId'=>'5fxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($moduleConfig['mock-content'],1);
		$moduleConfig=$sdk->moduleConfig_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customId'=>'666']);
		$this->assertEquals($moduleConfig['mock-content'],1);
		$moduleConfig=$sdk->moduleConfig_module_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','moduleId'=>'23xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($moduleConfig['mock-content'],1);

		#ORGANIZATION
		$organization=$sdk->organization_show(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($organization['mock-content'],1);
		$organization=$sdk->organization_identify(['organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','customId'=>'123-1-a']);
		$this->assertEquals($organization['mock-content'],1);
		$organizationArray=$sdk->organization_filter(['moduleId'=>'23xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','searchQuery'=>'test']);
		$this->assertEquals($organizationArray['mock-content'],1);
		$organizationArray=$sdk->organization_list(['moduleId'=>'23xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx']);
		$this->assertEquals($organizationArray['class'],'LIST');

		#STATIC
		$countryList=$sdk->static_country_list([]);
		$this->assertEquals($countryList['mock-content'],1);
		$currencyList=$sdk->static_currency_list([]);
		$this->assertEquals($currencyList['mock-content'],1);
		$error400=$sdk->static_error_show(['errorCode'=>400]);
		$this->assertEquals($error400['mock-content'],1);
		$error401=$sdk->static_error_show(['errorCode'=>401]);
		$this->assertEquals($error401['mock-content'],1);
		$error403=$sdk->static_error_show(['errorCode'=>403]);
		$this->assertEquals($error403['mock-content'],1);
		$error404=$sdk->static_error_show(['errorCode'=>404]);
		$this->assertEquals($error404['mock-content'],1);
		$error405=$sdk->static_error_show(['errorCode'=>405]);
		$this->assertEquals($error405['mock-content'],1);
		$error500=$sdk->static_error_show(['errorCode'=>500]);
		$this->assertEquals($error500['mock-content'],1);
		$languageList=$sdk->static_language_list([]);
		$this->assertEquals($languageList['mock-content'],1);
		$sectorList=$sdk->static_sector_list([]);
		$this->assertEquals($sectorList['mock-content'],1);
		$timeZoneList=$sdk->static_timeZone_list([]);
		$this->assertEquals($timeZoneList['mock-content'],1);
	}
}
