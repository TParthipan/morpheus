<?php

namespace App\Converter;

class JsonConverter
{
    public static function isJson($string) {
        json_decode($string, true);
        if(json_last_error() != JSON_ERROR_NONE){
            print_r("Le fichier n'est pas au format JSON!");
            die;

        }
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public static function jsonToArray(string $filepath): array
    {   $content= file_get_contents($filepath);
        self::isJson($content);
        $json = json_decode($content, true);
        return $json;
    }
}
