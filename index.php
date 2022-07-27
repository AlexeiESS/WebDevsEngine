<?php
require_once("Engine/php/class.temp.php");

$temp->unmanule['userballss'] = (isset($_SESSION['login'])) ? 'yes' : 'no';  // no
$template = $temp->parsein($temp->create('index'));

$temp->parseprint(array('temp'=>$set['temp']),$template); 

?>