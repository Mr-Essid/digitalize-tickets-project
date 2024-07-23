<?php

class JsonCustomHelper {
    static function s_camel_to_snake($str) {
        if(! is_string($str)) {
            throw new TypeError();
        }
        
        $string_res = "";
        for($i = 0; $i < strlen($str); $i++) {
         if(ctype_upper($str[$i]) && $i != 0) {
            $string_res .= '_'. strtolower($str[$i]);
         }else {
            $string_res .= strtolower($str[$i]);
         }   
        }
     return $string_res;   
    }

    static function camel_to_snake($data) {
        if(is_array($data)) {
            $res = [];
            foreach($data as $key => $value) {
                $new_key = $key;
                if(is_string($key)) {
                        $new_key = self::s_camel_to_snake($key);            
                }
                    
                $res[$new_key] = (is_array($value)) ? self::camel_to_snake($value) : $value; 
                
            }

            return $res;
        }

        throw new TypeError(message: 'given type should be assoiative array');
    }
    public static function programmer_readable_to_human_readable(string $my_string, bool $is_camel = true) {

        if(strlen($my_string) == 0 ) {
            return '';
        }

        if($is_camel) {
            $res = strtoupper($my_string[0]);
            
            for($index = 1; $index < strlen($my_string); $index++) {
                if(ctype_upper($my_string[$index]) && $index != 0) {
                    $res .= ' ';                               
                }
                $res .= $my_string[$index];
            }
            return trim($res);
        }
        
        return ucwords(trim(str_replace('_', ' ', $my_string)));
    }
}
