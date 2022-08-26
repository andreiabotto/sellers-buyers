<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Wallet
 *
 * @property int $id
 * @property int|null $account_id
 * @property string $balance
 * @property int $allow_receive
 * @property int $allow_send
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAllowReceive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereAllowSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Models\Account|null $Account
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $Transactions
 * @property-read int|null $transactions_count
 */
class Wallet extends Model
{
    use HasFactory;

    public $fillable=[
        'balance', 'allow_receive', 'allow_send'
    ];

    public function Account()
    {
        return $this->belongsTo('App\Models\Account', 'account_id');
    }

    /***
     * @return Transaction[]
     */
    public function Transactions() {
        return $this->hasMany('App\Models\Transaction', 'transaction_id');
    }
}
