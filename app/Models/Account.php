<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string $cpf
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property int $is_seller
 * @property int|null $wallet_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $Transacoes
 * @property-read int|null $transacoes_count
 * @property-read \App\Models\Wallet|null $Wallet
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereIsSeller($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereWalletId($value)
 * @mixin \Eloquent
 * @property string $first_name
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFirstName($value)
 */
class Account extends Model
{
    use HasFactory;

    protected $table="accounts";

    protected $fillable = [
        'name',
        'lastName',
        'cpf',
        'email',
        'password',
        'is_seller'
    ];

    protected $with=['Wallet'];

    public function Wallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }

    public function Transacoes(){
        return $this->hasManyThrough('App\Models\Transaction', 'App\Models\Wallet');
    }

    public function getFullName() : string {
        return $this->first_name . " " . $this->last_name;
    }
}
