<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TransactionController
 *
 * @property int $id
 * @property int $from_wallet_id
 * @property int $to_wallet_id
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Wallet|null $FromWallet
 * @property-read \App\Models\Wallet|null $ToWallet
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFromWalletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereToWalletId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereValue($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
      'value'
    ];

    public function FromWallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'from_wallet_id');
    }

    public function ToWallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'to_wallet_Id');
    }
}
