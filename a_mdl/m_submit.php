<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once '../a_ctr/c_news.php';
require_once '../addons/php-upload-multi/src/class.upload.php';


if ($_POST['form'] == 'addnews' ) {
    
$dataIn = array();
$dataIn['post'] = $_POST;
$dataIn['files'] = $_FILES;

$addnews = new ExchangeMessages();
$addnews ->sendToDb($dataIn['post']['form'],'записано','post', $dataIn, $pdo);

$dir_dest = '../img/news';
$dir_pics = 'ordim/img/news';
$files = $dataIn['files'];

$addnews->uploadImg($dir_dest, $dir_pics, $files, $pdo);
exit();
 
}

if ($_POST['form'] == 'getnews') {
    
    $getNews = new ExchangeMessages();
    $page = $_POST['page'] - 1;   
    $getNews ->getAllMessage($page,'3','',$pdo);
  exit();
}


if ($_POST['form'] == 'connections') {
  
  $dataIn = array();
  $dataIn['post'] = $_POST;  
  $sendMessage = new ExchangeMessages();
  $sendMessage->sendToDb($dataIn['post']['form'], 'записано', 'post', $dataIn['post'], $pdo);
  $a = $sendMessage->getLastIdMessage('записано', $pdo);
 
  $sendMessage->sendAdminMessage('ознакомление', 'отправлено',$a ,$pdo);
  exit();
}

 

