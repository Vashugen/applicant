<?php

namespace frontend\models\engine;

class Common
{

    public static function prepareValidateError($error = [])
    {
        $message = "";

        foreach ($error as $item){
            foreach ($item as $text){
                $message .= $text . "<br>";
            }
        }

        return $message;
    }

}