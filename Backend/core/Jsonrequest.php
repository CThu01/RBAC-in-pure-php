<?php

class JsonRequest
{

    public static function getBody()
    {
        return json_decode(file_get_contents(""), true) ?? [];
    }
}

?>