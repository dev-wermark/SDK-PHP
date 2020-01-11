<?php
trait Response {

    protected function validateJSON($string = '') {

        $result = json_decode($string);

        if (json_last_error() === JSON_ERROR_NONE) {
            return true;
        } else {
            return false;
        }

    }

    protected function proccessJSON($json) {

        return json_decode($json, false, 512, JSON_UNESCAPED_UNICODE);

    }

}
?>