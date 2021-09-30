<?php

namespace App\Resources;

class Winning
{
    private $rules = [
        3 => 0.2,
        4 => 2,
        5 => 10,
    ];

    private $bet = null;
    private $winners = [];
    private $amount = 0;

    public function __construct($winners, $bet){
        $this->bet = $bet;
        $this->winners = $winners;
        $this->amount = $this->getAmount();
    }

    public function getAmount(){
        $amount = 0;
        foreach ($this->winners as $line) {
            $occurrence = array_values($line)[0];
            $amount = $amount + ($this->bet * $this->rules[$occurrence]);
        }
        return $amount;
    }

    public function getTotal(){
        return $this->amount;
    }
}
