<?php
final class WerMark {

    use SupportSend;
    use Response;
    use HTTP;

    /**
     * Replace this value with the key found in your account: https://www.wermark.com/dash/dev
     * @var string
     */
    protected $public_key = '';

    /**
     * NO TOUCH
     * @var string
     */
    protected $message = '';
    protected $phones = array();
    protected $scheduled_date = '';

    /**
     * For multiple send. Up to 2000 numbers.
     * @param string $phone Phone number to send SMS
     * return true in case there is no problem with the cell number and false
     * in case there is a problem with the format of the cell number
     */
    public function addPhone($phone = '') {

        $phone = $this->deleteBlankSpaces($phone);

        if ( ($this->validateNumber($phone)) && ($this->validateTamPhones()) ) {
            $this->phones[] = $phone;
            return true;
        } else {
            return false;
        }

    }

    /**
     * Method to check if reach the limit of phones per request
     * MAX NUMBER PHONES: 2000
     * @return [type] [description]
     */
    public function checkLimitSentPhones() {

        return $this->validateTamPhones();

    }

    /**
     * Set and clean the message to send. This message, in case of multiple numbers, will be general.
     * @param [type] $message text with 320 characters of length, without ñ and accents
     */
    public function setMessage($message) {

        $message = $this->cleanMessage($message);

        if ($message !== false) {

            if ($this->validateLengthMessage($message)) {
                $this->message = $message;
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    public function sendOneByOne($message, $phone) {

        $message = $this->cleanMessage($message);

        if ($message !== false) {

            if ( ($this->validateLengthMessage($message)) &&($this->validateNumber($phone)) && ($this->validateTamPhones()) ) {

                $this->message = $message;

                $this->phones = array();
                $this->phones[0] = $phone;

                return $this->request('send-sms');

            } else {
                return false;
            }

        } else {
            return false;
        }

    }

    /**
     * Only send the message to one phone number.
     * @return [type] [description]
     */

    public function sendSMS() {

        return $this->request('send-sms');

    }

    public function getBalanceSMS() {

        return $this->request('get-balance');

    }

    public function setPublicKey($public_key) {

        if (!empty($public_key)) {
            $this->public_key = $public_key;
        }

        return;

    }

    /**
     * @param string $date Format: Y/m/d H:i:s exactly
     */
    public function setScheduledDate($date = '') {
        $this->scheduled_date = $date;
    }

}
?>