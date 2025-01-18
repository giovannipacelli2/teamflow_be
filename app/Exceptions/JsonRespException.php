<?php

namespace App\Exceptions;

use Exception;
use App\Http\Controllers\ResponseJson;

class JsonRespException extends Exception
{
    protected $resourceType;
    protected $data;

    public function __construct($message = "", $code = 400, $resourceType = null, $data=[])
    {
        $this->resourceType = $resourceType;
        $this->data = $data;
        
        $message = $resourceType ? $resourceType . ': ' . $message : $message;
        parent::__construct($message, $code);
    }

    public function getData(){
        return $this->data;
    }

    public function render()
    {
        return ResponseJson::response($this->getData(), $this->getCode(), $this->getMessage());
    }
}
