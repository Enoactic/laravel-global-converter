<?php

namespace LaravelGlobalConverter;

class ConvertVariable
{
    public static function stringToCamelCase($inputString, $capitalizeFirstCharacter = false)
    {
        $returnString = str_replace('_', '', ucwords($inputString, '_'));

        if (!$capitalizeFirstCharacter) {
            $returnString = lcfirst($returnString);
        }

        return $returnString;
    }

    public static function eloquentToCamelCase($inputObject, $capitalizeFirstCharacter = false)
    {
        $returnObject = new \stdClass();

        if($inputObject != null && $inputObject instanceof \Illuminate\Database\Eloquent\Model){
            foreach($inputObject->getAttributes() as $key => $value){
                $returnObject->{ ConvertVariable::stringToCamelCase($key) } = $value;
            }
        }

        return $returnObject;
    }
}
