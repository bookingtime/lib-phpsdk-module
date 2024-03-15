<?php

namespace bookingtime\phpsdkmodule\DevelopmentCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use bookingtime\phpsdkmodule\Sdk;
use bookingtime\phpsdkmodule\Lib\BasicLib;


/**
 * command, see desciption for more infos
 *
 * @author <bookingtime GmbH>
 */
class SdkCommand extends Command {



	/**
	 * {@inheritDoc}
	 */
	protected function configure():void {
		//define command meta data
		$this->setName('development:sdk');
		$this->setDescription('Use the php module-SDK with this command for development');
		$this->setHelp('...');
	}



	/**
	 * {@inheritDoc}
	 */
	protected function execute(InputInterface $input,OutputInterface $output):int {
		if(!file_exists(__DIR__.'/secret.json')) {throw new \RuntimeException(__METHOD__.'() #'.__LINE__.': Abort command, no secret.json found!');}
		$secret=json_decode(file_get_contents(__DIR__.'/secret.json'),TRUE);
		$sdk=new Sdk($secret['client_id'],$secret['client_secret'],[
			'moduleApiUrl'=>'http://host.docker.internal:4102/module/v3/',
			'oauthUrl'=>'http://host.docker.internal:4101/oauth/token',
			'locale'=>'de',
			'timeout'=>15,
			'mock'=>FALSE,
		]);

		#APPOINTMENT
		// $data=[
		// 	'customId'=>'sdk',
		// 	'notes'=>'sdk test appointment',
		// 	'address'=>[
		// 		'name'=>'Familie Mustermann',
		// 		'extra'=>'1. OG',
		// 		'street'=>'teststreet 10',
		// 		'zip'=>'22453',
		// 		'city'=>'Hamburg',
		// 		'country'=>'DE',
		// 		'geoCoordinates'=>[
		// 			'latitude'=>53.6059747,
		// 			'longitude'=>9.9841561
		// 		],
		// 	],
		// 	'bookingSlotId'=>'',// muss immer neu "generiert" werden
		// 	'sendAppointmentAddEventEmail'=>TRUE,
		// 	'sendAppointmentStartEventEmail'=>TRUE,
		// 	'sendAppointmentEndEventEmail'=>TRUE,
		// 	'additionalData'=>[
		// 		'testKey'=>['testvalue1','testvalue2'],
		// 		'bktest_color'=>['#123456'],
		// 	],
		// 	'customer'=>[
		// 		'customId'=>'sdkKunde',
		// 		'gender'=>'MALE',
		// 		'title'=>'',
		// 		'firstName'=>'Max',
		// 		'lastName'=>'Mustermann',
		// 		'birthday'=>'',
		// 		'email'=>'modulesdk@bookingtime.com',
		// 		'mobile'=>'',
		// 		'notes'=>'',
		// 		'address'=>[
		// 			'name'=>'Familie Mustermann',
		// 			'extra'=>'1. OG',
		// 			'street'=>'teststreet 10',
		// 			'zip'=>'22453',
		// 			'city'=>'Hamburg',
		// 			'country'=>'DE',
		// 			'geoCoordinates'=>[
		// 				'latitude'=>53.6059747,
		// 				'longitude'=>9.9841561
		// 			],
		// 		],
		// 		'locale'=>'de',
		// 	],
		// ];
		// $appointment=$sdk->appointment_add(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO'],$data);
		#die(BasicLib::debug($appointment));

		// $appointment=$sdk->appointment_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','appointmentId'=>'eddXX23behodfOJck69hZW1y8dJYbDkX']);
		// $appointment=$sdk->appointment_showProtected(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','appointmentId'=>'eddXX23behodfOJck69hZW1y8dJYbDkX']);
		// $appointment=$sdk->appointment_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customId'=>'123']);
		// $data=['bookingSlotId'=>'4f6gl70xpd6oeqis236e1f80ac7acd54'];
		// $appointment=$sdk->appointment_move(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','appointmentId'=>'eddXX23behodfOJck69hZW1y8dJYbDkX'],$data);
		// $this->assertEquals($appointment['mock-content'],1);
		// $appointment=$sdk->appointment_cancel(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','appointmentId'=>'edajSu6iILuxTaFX3OfOx2axWHoFFWOG']);
		#die(BasicLib::debug($appointment));

		#BOOKINGRESOURCE
		#$bookingResource=$sdk->bookingResource_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingResourceId'=>'brOayV9d7lcj5vjeG0Pl1qFuK92v4Uaf']);
		#$bookingResource=$sdk->bookingResource_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customId'=>'dk']);
		#$bookingResourceArray=$sdk->bookingResource_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO']);
		#$bookingResourceArray=$sdk->bookingResource_customEntity_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityId'=>'6TW0kOIdHlZh0EzwtWODyMatn7fU3Aox','customEntityType'=>'rentalCar']);
		#die(BasicLib::debug($bookingResource));
		#die(BasicLib::debug($bookingResourceArray));

		#BOOKINGSLOT
		// $bookingSlotArray=$sdk->bookingSlot_earliest(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcH6XzCnbhf5Ih5ISFMOtQTvFpTDxItv']);
		// $bookingSlotArray=$sdk->bookingSlot_listDay(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcH6XzCnbhf5Ih5ISFMOtQTvFpTDxItv','year'=>'2022','month'=>'12','day'=>'12']);
		// $bookingSlotArray=$sdk->bookingSlot_listWeek(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcrVx2aWQzDnd1MZkEeVbVDt6wuFCJIL','year'=>'2023','week'=>'39']);
		// $bookingSlotArray=$sdk->bookingSlot_listMonth(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcrVx2aWQzDnd1MZkEeVbVDt6wuFCJIL','year'=>'2023','month'=>'9']);
		#die(BasicLib::debug($bookingSlotArray));

		#BOOKINGTEMPLATE
		// $bookingTemplate=$sdk->bookingTemplate_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcrVx2aWQzDnd1MZkEeVbVDt6wuFCJIL']);
		// $bookingTemplate=$sdk->bookingTemplate_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customId'=>'666']);
		// $bookingTemplateArray=$sdk->bookingTemplate_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO']);
		// $bookingTemplateArray=$sdk->bookingTemplate_bookingResource_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingResourceId'=>'browuBQJWSylERkRQIHHrlXHVpCeyfqN']);
		#$bookingTemplateArray=$sdk->bookingTemplate_customEntity_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityId'=>'6TW0kOIdHlZh0EzwtWODyMatn7fU3Aox','customEntityType'=>'rentalCar']);
		#die(BasicLib::debug($bookingTemplate));
		#die(BasicLib::debug($bookingTemplateArray));

		#CUSTOMENTITY
		// $data=['customId'=>'667','name'=>'CB Testentity'];
		// $customEntity=$sdk->customEntity_add(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityType'=>'rentalCar'],$data);
		// $customEntity=$sdk->customEntity_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityType'=>'rentalCar','customEntityId'=>'6TERR8P5ovAqeCLavx1cRJkxhOpaeoiM']);
		// $customEntity=$sdk->customEntity_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityType'=>'rentalCar','customId'=>'666']);
		// $customEntityArray=$sdk->customEntity_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityType'=>'rentalCar']);
		// $customEntityArray=$sdk->customEntity_appointment_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','appointmentId'=>'eddXX23behodfOJck69hZW1y8dJYbDkX','customEntityType'=>'rentalCar']);
		// $customEntityArray=$sdk->customEntity_bookingResource_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingResourceId'=>'brDqyrfum3JUiBUni0o70wyeoMiIpRLG','customEntityType'=>'rentalCar']);
		// $customEntityArray=$sdk->customEntity_bookingTemplate_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','bookingTemplateId'=>'fcrVx2aWQzDnd1MZkEeVbVDt6wuFCJIL','customEntityType'=>'rentalCar']);
		// $customEntityArray=$sdk->customEntity_customEntity_list(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customEntityId'=>'6TW0kOIdHlZh0EzwtWODyMatn7fU3Aox','customEntityType'=>'rentalCar']);
		#die(BasicLib::debug($customEntity));
		#die(BasicLib::debug($customEntityArray));

		#FILE
		#$file=$sdk->file_download(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','fileId'=>'w1VB8G2bwvKPcgVvxBvgvsMCAt1dLKlg']);
		#die(BasicLib::debug($file));

		#MODULECONFIG
		// $moduleConfig=$sdk->moduleConfig_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','moduleConfigId'=>'5fEtkv5f4geSzfivc8rbMcfvh36NHSg9']);
		// $moduleConfig=$sdk->moduleConfig_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customId'=>'666']);
		// $moduleConfig=$sdk->moduleConfig_module_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','moduleId'=>'23wJv4LyFBK5eGGiyIkDFb9uaVPdr5Vm']);
		#die(BasicLib::debug($moduleConfig));

		#ORGANIZATION
		// $organization=$sdk->organization_show(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO']);
		// $organization=$sdk->organization_identify(['organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO','customId'=>'123-1-a']);
		// $organizationArray=$sdk->organization_filter(['moduleId'=>'23wJv4LyFBK5eGGiyIkDFb9uaVPdr5Vm','searchQuery'=>'test']);
		// $organizationArray=$sdk->organization_list(['moduleId'=>'23wJv4LyFBK5eGGiyIkDFb9uaVPdr5Vm','organizationId'=>'f6dS3eSezWO4ohcznIzoTb5JzzMB9nsO']);
		#die(BasicLib::debug($organization));
		#die(BasicLib::debug($organizationArray));

		#STATIC
		// $countryList=$sdk->static_country_list([]);
		// $currencyList=$sdk->static_currency_list([]);
		// $languageList=$sdk->static_language_list([]);
		// $sectorList=$sdk->static_sector_list([]);
		// $timeZoneList=$sdk->static_timeZone_list([]);
		// $error=$sdk->static_error_show(['errorCode'=>400]);
		// $error=$sdk->static_error_show(['errorCode'=>403]);
		// $error=$sdk->static_error_show(['errorCode'=>404]);
		// $error=$sdk->static_error_show(['errorCode'=>405]);
		// $error=$sdk->static_error_show(['errorCode'=>500]);
		#die(BasicLib::debug($error));

		$output->writeln('last message: '."\n".$sdk->getMessageArrayAsString());
		$output->writeln('last request: '."\n".print_r($sdk->getLastRequestInfo(),TRUE));

		//finish command
		return 0;
	}
}
//
