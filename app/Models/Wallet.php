<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    // colocar o tipo de transacao permitida na carteira ?
    // lgpd
    public $fillable=[
        'balance', 'allowReceive', 'allowSend'
    ];

    public function Account() : Account
    {
        return $this->belongsTo('App\Models\Account', 'conta_id');
    }

    /***
     * @return Transaction[]
     */
    public function Transactions() : array {
        return $this->hasMany('App\Models\Transaction', 'transacao_id');
    }
}
