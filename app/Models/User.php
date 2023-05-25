<?php

namespace App\Models;

use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Scope
    protected static function booted()
    {
        static::addGlobalScope(new HasActiveScope);
    }

    const CASHIER_ROLE    = 1;
    const ADMIN_ROLE      = 2;
    const CUSTOMER_ROLE   = 3;

    const ACTIVE_STATUS  = 1;

    protected $fillable = [
        'first_name',
        'last_name',
        'fullname',
        'email',
        'password',
        'phone',
        'sex',
        'address',
        'birth_date',
        'profile_picture',
        'role',
        'active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELATION

    public function transactions(){
        return $this->hasMany(Transaction::class, 'transactions_id', 'id');
    }

    public function material()
    {
        return $this->hasMany(MaterialTransaction::class);
    }

    public function cashier()
    {
        return $this->hasMany(MaterialTransaction::class, 'cashier_id', 'id');
    }

    // GETTER SETTER

    public function getBirthDate() {
        return date('m/d/Y', strtotime($this->birth_date));
    }

    public function getRole() {
        return $this->role == 1 ? 'Kasir' : 'Admin';
    }

    public function getSex() {
        return  $this->sex == 1 ? 'Pria' : 'Wanita';
    }
}
