<?php

namespace App\Services;

class CurrencyService
{
    private $amount;
    private $subUnit = false;

    public function __construct($amount, $subUnit = false)
    {
        $this->amount = $amount;
        $this->subUnit = $subUnit;
    }

    public function getSubUnitAmount()
    {
        return $this->amount * 100;
    }

    public function getBaseUnitAmount()
    {
        if($this->subUnit)
        {
            return $this->amount / 100;

        }

        return $this->amount;
    }
}