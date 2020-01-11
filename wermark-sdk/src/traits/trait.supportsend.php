<?php
trait SupportSend {

    protected function validateNumber($phone, $country = 'col') {

        $status = false;

        switch ($country) {

            case 'col':
                $status = $this->validateNumberCol($phone);
                break;

            default:
                $status = false;
                break;

        }

        return $status;

    }

    protected function validateLengthMessage($message) {

        $tam_msg = strlen($message);

        if ($tam_msg <= 320) {
            return true;
        } else {
            return false;
        }

    }

    protected function validateNumberCol($phone) {

        if ( (preg_match("/^3+[0-9]{2}+[0-9]{7}$/", $phone)) || (preg_match("/^573+[0-9]{2}+[0-9]{7}$/", $phone)) ) {
            return true;
        } else {
            return false;
        }

    }

    protected function deleteBlankSpaces($phone) {

        $phone = trim(str_replace(' ', '', $phone));

        return $phone;

    }

    protected function validateTamPhones() {

        $tam_phones = count($this->phones);

        if ($tam_phones <= 2000) {
            return true;
        } else {
            return false;
        }

    }

    public function cleanMessage($message) {

        $message = trim($message);

        $message = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $message
        );

        $message = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $message
        );

        $message = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $message
        );

        $message = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $message
        );

        $message = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $message
        );

        $message = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C',),
            $message
        );

        return $message;

    }

}
?>