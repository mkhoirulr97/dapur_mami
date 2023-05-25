<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $table = 'setting';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'bank_name',
        'bank_account',
        'bank_account_name',
        'open_at',
        'close_at',
    ];
}
