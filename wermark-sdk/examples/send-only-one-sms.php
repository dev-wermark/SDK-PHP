<?php
require_once('/path/to/wermark-sdk/src/class/class.load.php');
$load = new Load;
$load->autoLoad();

$wermark = new WerMark;
$wermark->setPublicKey('...');

$response = $wermark->sendOneByOne('Test Message!', '317...');

if ($response->status) {
    //Success Send!
} else {
    //Fail Send!
}
?>