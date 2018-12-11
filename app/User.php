<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use SoftDeletes,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function sentTransactions() {
        return $this->hasMany(Transaction::class, 'sender_id')->withTrashed();
    }

    public function receivedTransactions() {
        return $this->hasMany(Transaction::class, 'receiver_id')->withTrashed();
    }

    public function getTransactionsAttribute() {
        return $this->sentTransactions->merge($this->receivedTransactions)->sortByDesc('created_at')->values()->all();
    }
}
