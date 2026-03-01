<?php

class DatabaseConnectionException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}

?>