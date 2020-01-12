<?php
trait HTTP {

    protected $available_endpoints = array(
        'send-sms' => 'https://api.wermark.com/sms/send/',
        'get-balance' => 'https://api.wermark.com/user/get-balance/'
    );

    protected function post($data, $url, $array = false) {

        $tam_data = count($data);

        if ($tam_data <= 4) {

            $post = http_build_query($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Origin: sdk-wermark-php'));
            curl_setopt($ch, CURLOPT_USERAGENT, 'sdk-wermark-php');
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
            $result = curl_exec($ch);
            curl_close($ch);

            var_dump($result);

            if ($this->validateJSON($result)) {

                $json = $this->proccessJSON($result, $array);

                if ($json !== null) {
                    return $json;
                } else {
                    return false;
                }

            } else {
                return false;
            }

        } else {
            return false;
        }

        return false;

    }

    protected function get($data, $url, $array = false) {

        $tam_data = count($data);

        if ($tam_data <= 3) {

            $get = http_build_query($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_FAILONERROR, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $get);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Origin: sdk-wermark-php'));
            curl_setopt($ch, CURLOPT_USERAGENT, 'sdk-wermark-php');
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $result = curl_exec($ch);
            curl_close($ch);

            if ($this->validateJSON($result)) {

                $json = $this->proccessJSON($result, $array);

                if ($json !== null) {
                    return $json;
                } else {
                    return false;
                }

            } else {
                return false;
            }

        } else {
            return false;
        }

        return false;

    }

    protected function request($action) {

        $status = false;

        switch ($action) {

            case 'send-sms':
                $status = $this->callSendSMS();
                break;

            case 'get-balance':
                $status = $this->callGetBalance();
                break;

            default:
                $status = false;
                break;

        }

        return $status;

    }

    protected function callSendSMS() {

        $url = $this->available_endpoints['send-sms'];

        $phones = implode(',', $this->phones);
        $phones = str_replace('Array, ', '', $phones);
        $phones = trim($phones, ',');

        $data_send = array(
            'phones' => $phones,
            'scheduled_date' => $this->scheduled_date,
            'public_key' => $this->public_key,
            'message' => $this->message
        );

        $result = $this->post($data_send, $url, true);

        if ($result !== false) {
            return $result;
        } else {
            return false;
        }

    }

    protected function callGetBalance() {

        $url = $this->available_endpoints['get-balance'];

        $data_send = array(
            'public_key' => $this->public_key
        );

        $result = $this->get($data_send, $url, true);

        if ($result !== false) {
            return $result;
        } else {
            return false;
        }

    }

}
?>