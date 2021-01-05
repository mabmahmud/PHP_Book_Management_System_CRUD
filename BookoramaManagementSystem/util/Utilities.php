<?php


class Utilities
{
    static private $errorText;

    /**
     * @return mixed
     */
    public static function getErrorText()
    {
        return self::$errorText;
    }

    public static function setInputField($value){
        return $value;
    }
    public static function isEmpty($input){
        if (empty($input) || $input == ""){
            self::$errorText = "Cannot be empty!";
            return true;
        }else{
            return false;
        }
    }

    public static function test_input($data)
    {
        //Strip unnecessary characters (extra space, tab, newline) from the user input data (with the PHP trim() function)//Remove backslashes (\) from the user input data (with the PHP stripslashes() function)
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}