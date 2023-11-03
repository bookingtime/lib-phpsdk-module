#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
use Symfony\Component\Console\Application;



//create cli command
$app=new Application('lib-phpsdk-module','?');
$app->add(new bookingtime\phpsdkmodule\DevelopmentCommand\SdkCommand());
$app->run();
