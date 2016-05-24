<?php
namespace php_rutils\doc\examples;

use php_rutils\Dt;
use php_rutils\RUtils;
use php_rutils\struct\TimeParams;

require '_begin.php';

$dateTime = $_GET['time'];



function getTimeDistace($dateTime) {
    
   
$toTime = ($dateTime);
$fromTime = null; //now
$accuracy = RUtils::ACCURACY_MINUTE; //years, months, days, hours, minutes
echo RUtils::dt()->distanceOfTimeInWords($toTime, $fromTime, $accuracy), PHP_EOL;
//Result: 68 лет, 4 месяца, 21 день, 19 часов, 12 минут назад
}



getTimeDistace($dateTime);









require '_end.php';

