<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastName',
        'cpf',
        'email',
        'password'
    ];

    protected $with=['Wallet'];

    public function Wallet()
    {
        return $this->hasOne('App\Models\Wallet');
    }

    public function Transacoes(){
        return $this->hasManyThrough('App\Models\Transaction', 'App\Models\Wallet');
    }

    public function getFullName() : string {
        return $this->name . " " . $this->lastName;
    }
}
