<?php

namespace App\Tables;


class CategoryTable
{
    private $instanceId;

    public function __construct()
    {
        $this->instanceId = uniqid();
    }

    public function getInstanceId()
    {
        return $this->instanceId;
    }
}
