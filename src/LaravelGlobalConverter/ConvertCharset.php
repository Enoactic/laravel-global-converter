<?php

namespace LaravelGlobalConverter;

class ConvertCharset
{
    public function UTF8ToTIS612($string)
    {
        return iconv('UTF-8', 'TIS-620//IGNORE', $string);
    }
}
