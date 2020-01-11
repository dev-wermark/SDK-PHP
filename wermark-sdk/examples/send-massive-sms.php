<?php
require_once('/path/to/wermark-sdk/src/class/class.load.php');
$load = new Load;
$load->autoLoad();

$wermark = new WerMark;

//Set the message to send
$wermark->setMessage('Test Message!');

$phones = array(
    '317...',
    '318...',
    '320...',
    '301...'
);

$tam_phones = count($phones);

for ($i = 0; $i < $tam_phones; $i++) {

    //Validate if we reach the limit of phones per request -> max 2000 number phones per request.
    if ($wermark->checkLimitSentPhones()) {

        if ($wermark->addPhone($phones[$i])) {
            continue;
        } else {
            //Error with the phone or we reach the limit of phones.
            break;
        }

    } else {
        //reach the limit per request -> 2000.
        break;
    }

}

$response = $wermark->sendSMS();

if ($response->status) {
    //Success Send!
} else {
    //Error Send!
}
?>