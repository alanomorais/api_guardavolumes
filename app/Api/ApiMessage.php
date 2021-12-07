<?php

namespace App\Api;

class ApiMessage{
    private $massage = [];

    public function __construct(string $message, array $data = [])
    {
        $this->message['message'] = $message;
        if(!empty($data)){
            $this->message['error'] = $data;
        }

    }

    public function getMessage()
    {
        return $this->message;
    }

}