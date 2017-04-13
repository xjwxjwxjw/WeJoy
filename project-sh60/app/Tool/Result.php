<?php
namespace App\Tool;
class Result
{
    public $status;
    public $message;

    public function toJosn()
    {
        return json_encode($this);
    }
}