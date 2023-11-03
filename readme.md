# lib-phpsdk-module
php SDK for bookingtime module-API

<img src="https://github.com/bookingtime/lib-phpsdk-module/blob/master/aws/logo_php.png" alt="logo php" width="150" height="100" />



## Requirements
- PHP >= 7.3
- A PSR-4 implementation



## How To Install
The recommended way to install the SDK is through Composer.
```bash
composer require bookingtime/lib-phpsdk-module
```
see: https://packagist.org/packages/bookingtime/lib-phpsdk-module



## Getting Started
```php
<?php
use bookingtime\phpsdkmodule\Sdk;

//create SDK
$sdk=new Sdk(
   '<CLIENT_ID>',
   '',
   ['locale'=>'en','timeout'=>15,'mock'=>FALSE]
);

//load moduleConfig for submitted organizationId/moduleConfigId
$moduleConfig=$sdk->moduleConfig_show([
   'organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
   'moduleConfigId'=>'5fxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
]);

//list all available bookingTemplates
$bookingTemplateArray=$sdk->bookingTemplate_list([
   'organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
]);

//get list of possible bookingSlots for selected bookingTemplate and week
$bookingSlotArray=$sdk->bookingSlot_listWeek([
   'organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
   'bookingTemplateId'=>'fcxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
   'year'=>'2023',
   'week'=>'39',
]);

//book a new appointment
$appointment=$sdk->appointment_add([
   'organizationId'=>'f6xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
],[
   'bookingSlotId'=>'brxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
   'notes'=>'My first appointment',
   'customer'=>[
      'gender'=>'MALE',
      'firstName'=>'Max',
      'lastName'=>'Mustermann',
      'email'=>'m.mustermann@bookingtime.com',
   ],
]);

```



## Help and docs
- Support for developers: https://developer.bookingtime.com
- See the full API documentation under https://service.bookingtime.com/apidoc/module



## Security
If you discover a security vulnerability within this package, please send an email to support@bookingtime.com or create a ticket on https://developer.bookingtime.com/hc/en-us/requests/new. All security vulnerabilities will be promptly addressed.



## License
This SDK is distributed under the MIT License, see LICENSE file for more information.



---
Copyright 2014 bookingtime GmbH. All Rights Reserved.

Made with :blue_heart: by © bookingtime

<img src="https://github.com/bookingtime/lib-phpsdk-module/blob/master/aws/logo_bookingtime.png" alt="logo" width="30" height="44" />
