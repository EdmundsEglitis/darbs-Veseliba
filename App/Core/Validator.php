<?php
class Validator {

 
    static public function string($data, $min = 0, $max = INF) {
        $data = trim($data);

        return  !empty($data) && 
                is_string($data) && 
                strlen($data) >= $min && 
                strlen($data) <= $max;
    }

 
    static public function number($data, $min = 0, $max = INF) {
        $data = trim($data);

        return  is_numeric($data) && 
                $data >= $min && 
                $data <= $max;
    }

    static public function date($date) {
        if (empty($date)) {
            return false;
        }
        $date = explode('-', $date);
        if (count($date) !== 3) {
            return false;
        }
        $day = explode('T', $date[2])[0];
        return  checkdate((int)$date[1], (int)$day, (int)$date[0]);
    }

 
    static public function email($data) {
        return  filter_var($data, FILTER_VALIDATE_EMAIL);
    }


    static public function password($data) {
        if (empty($data)) { 
            return false;
        }

        $minLength = 8;

        $uppercaseRegex = '/[A-Z]/';
        $lowercaseRegex = '/[a-z]/';
        $numberRegex = '/[0-9]/';
        $specialCharRegex = '/[!@#$%^&*()-_=+{};:,<.>}]/';

        return  strlen($data) >= $minLength && 
                preg_match($uppercaseRegex, $data) && 
                preg_match($lowercaseRegex, $data) && 
                preg_match($numberRegex, $data) && 
                preg_match($specialCharRegex, $data);
    }
}
?>
