<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    private $balance = 0;

    function getBalance(){
        return $this->balance;
    }

    function deposit($value){

        if($value <= 0){
            return false;
        }

        $this->balance += $value;

        return true;
    }

    function withdraw($value){

        if($value <= 0){
            return -1;  // Error, cantidad negativa
        }

        if ($value > $this->balance) {
            return -2;
        }

        $this->balance -= $value;

        return true;
    }
}