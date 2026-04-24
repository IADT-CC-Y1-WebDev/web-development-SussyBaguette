<?php
    function isValidEmail($email) {
        if (str_contains($email, '@gmail.com')) {
            return strtolower($email) . ", is valid.";
        }
        else {
            $email = "has an error";
            return strtolower($email) . ", it is not valid.";
        }
    }


?>