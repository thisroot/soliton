<?php

namespace php_rutils\doc\examples;

use php_rutils\RUtils;

require '_begin.php';


$query = $_GET['title'];

function getTransLink($title) {
    

//Prepare to use in URLs or file/dir name
echo RUtils::translit()->slugify($title), PHP_EOL;
//Result: muha-eto-malenkaya-ptichka

}

getTransLink($query);

require '_end.php';

