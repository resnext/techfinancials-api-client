<?php

namespace TechFinancials;

class Response
{
    CONST FIELD_RESULT = 'result';

    CONST FIELD_SUCCESS = 'success';

    CONST FIELD_ERROR_CODES = 'errorCodes';

    protected $success;

    protected $errorCodes;

    protected $result = [];

    public function __construct(Payload $payload){
        $this->success = isset($payload[static::FIELD_SUCCESS]) ? $payload[static::FIELD_SUCCESS] : 0;
        $this->errorCodes = isset($payload[static::FIELD_ERROR_CODES]) ? $payload[static::FIELD_ERROR_CODES] : '';
        $this->result = isset($payload[static::FIELD_RESULT]) ? $payload[static::FIELD_RESULT] : [];
    }

    public function isSuccess(){
        return $this->success;
    }

    public function getErrorCodes(){
        return $this->errorCodes;
    }

    public function getResult(){
        return $this->result;
    }
}