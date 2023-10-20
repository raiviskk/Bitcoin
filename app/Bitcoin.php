<?php

namespace App;
class Bitcoin
{
    private string $date;
    private float $price;

    public function __construct(string $date, float $price)
    {
        $this->date = $date;
        $this->price = $price;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
