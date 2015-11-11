<?php

require_once '../a_ctr/c_news.php';
require_once '../addons/php-upload-multi/src/class.upload.php';


$getCalendar = new ExchangeMessages;
$getCalendar->getZabutoCalendarData($pdo);




