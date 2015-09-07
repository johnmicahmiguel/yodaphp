<?php

class Globals {

    
    function __construct() {

    }
    
    
    // =======================================================================// 
    // !                        GLOBAL METHODS                                //        
    // =======================================================================//

    //on^2 algo - recursive 
    public static function in_array_r($needle, $haystack, $strict = false){
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && Globals::in_array_r($needle, $item, $strict))) {
                return true;
            }
        }
        return false;
    }

    public static function sort_assoc_arr($arr, $sort_type, $identifier){
        $col = array();

        foreach($arr as $key => $rows){
            $col[$key] = $rows[$identifier];
        }

        array_multisort($col, ($sort_type == "DESC") ? SORT_DESC : SORT_ASC, $arr);

        return $arr;
    }
    
    /**
     * @name OutputArray()
     * @desc For outputting array on a nice way
     * @param array $arr
     */
    public static function OutputArray($arr){
        
        echo '<pre>';
        echo print_r($arr);
        echo '</pre>';
        
    }
    
    /**
     * @name HashGenerator()
     * @desc For generating random hash value
     * @param string $val
     * @return arrray
     */
    public static function HashGenerator($val){
        $hash_arr = array();
        foreach($val as $v){
            $hash_arr[$v] = md5($v);
        }
        
        return $hash_arr;
    }
    
    /**
     * @name GenerateRandomPassword()
     * @desc for generating random string. applicable for forgot password functionalities
     * @return string
     */
    public static function GenerateRandomPassword(){
        
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        
        return implode($pass); //turn the array into a string
    }
    
    
    /**
     * @name timeAgo()
     * @desc will compute the time passed relative to the current time it has been loaded.
     * @param int $time
     * @return string
     */
    public static function timeAgo($time) 
    {
        $time = time() - $time; // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }
    }
    
    
    /**
     * @name processDatetime()
     * @desc will convert a time to ISO8601:UTC format and adjust time according to the desired datetime
     * @param int $val
     * @param string $dt_type
     * @param bool $is_time_defined
     * @param int $t
     * @param bool $is_sub
     * @return string - ISO8601:UTC format
     */
    public static function processDatetime($val = 0, $dt_type = "", $is_time_defined = false, $t = 0, $is_sub = false){
        
        switch($dt_type){
            case 'Y': //years
                $pattern = "P{$val}Y";
                break;
            case 'PM': //months
                $pattern = "P{$val}M";
                break;
            case 'D': //days
                $pattern = "P{$val}D";
                break;
            case 'W': //weeks
                $pattern = "P{$val}W";
                break;
            case 'H': //hours
                $pattern = "PT{$val}H";
                break;
            case 'PTM': //minutes
                $pattern = "PT{$val}M";
                break;
            case 'S':
                $pattern = "PT{$val}S";
                break;
            default:
                $pattern = "PT0M";
                break;
        }
        
        $curr_date = date("Y-m-d H:i:s", (!$is_time_defined) ? time() : $t);
        $datetime = new DateTime($curr_date);
        if($is_sub){
            $datetime->sub(new DateInterval($pattern));
        }
        else{
            $datetime->add(new DateInterval($pattern));
        }
        
        $dt = $datetime->format(DateTime::ISO8601);

        list($new_time, $suffix) = explode("+", $dt);

        $n_time2 = $new_time . "Z";
        
        return $n_time2;
    }
    
    /**
     * @name processSQLPagingLimit
     * @desc for mysql paging
     * @param int $items_per_page
     * @param int $page_number
     * @return string
     */
    public static function processSQLPagingLimit($items_per_page, $page_number){
        $limit = "";
        if($page_number == 0){
            $limit = "LIMIT " . $page_number . "," . $items_per_page;
        }
        else{
            $limit = "LIMIT " . ($page_number * $items_per_page) . "," . $items_per_page;
        }
        
        return $limit;
    }
    
    /**
     * @name doCustomComboboxOption
     * @desc for dynamic display of combobox selected relative to database data
     * @param array $args
     * @param string $identifier
     */
    public static function doCustomComboboxOptions($args = array(), $identifier = NULL){
        foreach($args as $a){
            $selected = ($a == $identifier) ? "selected" : "";

            echo '<option value = "'.$a.'" '.$selected.'>'.$a.'</option>';
        }
    }
    
    /**
     * @name base_encode
     * @desc for generating coupon based string set
     * @param int $num
     * @param string $alphabet
     * @return string
     */
    public static function base_encode($num, $alphabet) {
        $base_count = strlen($alphabet);
        $encoded = '';
        while ($num >= $base_count) {
        $div = $num/$base_count;
        $mod = ($num-($base_count*intval($div)));
        $encoded = $alphabet[$mod] . $encoded;
        $num = intval($div);
        }

        if ($num) $encoded = $alphabet[$num] . $encoded;

        return $encoded;
    }
    
    /**
     * @name base_decode
     * @desc decoding coupon based string set
     * @param int $num
     * @param string $alphabet
     * @return string
     */
    public static function base_decode($num, $alphabet) {
        $decoded = 0;
        $multi = 1;
        while (strlen($num) > 0) {
        $digit = $num[strlen($num)-1];
        $decoded += $multi * strpos($alphabet, $digit);
        $multi = $multi * strlen($alphabet);
        $num = substr($num, 0, -1);
        }

        return $decoded;
    }
    
    /**
     * @name parse_mobile
     * @desc parsing PH based number to 63* format
     * @param string $str
     * @return string
     */
    public static function parse_mobile($str = ""){
        $final_str = "";
        
        $first = mb_substr($str, 0, 1, "utf-8");
        $prefix = mb_substr($str, 0, 2, "utf-8");
        
        if($prefix != "63"){
            if($first == "0"){
                $final_str = "63" . mb_substr($str, 1, strlen($str) - 1, "utf-8");
            }
            else if($first == "+"){
                $final_str = mb_substr($str, 1, strlen($str) - 1, "utf-8");
            }
            else if($first == "*"){
                $final_str = "63" . mb_substr($str, 6, strlen($str) - 1, "utf-8");
            }
            else{
                $final_str = "";
            }
        }
        else{
            $final_str = $str;
        }
        
        return $final_str;
    }
    
    /**
     * @name convertDate
     * @desc for converting date to another timezone
     * @param DateTime $date
     * @param string $format
     * @return string
     */
    public static function convertDate($date = "", $format = ""){
        $date = new DateTime($date);
        $date->setTimezone(new DateTimeZone('Asia/Manila')); 
        return $date->format($format); 
    }
    
}