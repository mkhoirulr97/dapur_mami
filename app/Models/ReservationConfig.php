<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationConfig extends Model
{
    use HasFactory;

    public $table = 'reservation_config';

    protected $fillable = [
        'capacity',
        'max_reservation_per_day',
        'is_active',
    ];

    public function setInactive()
    {
        $this->is_active = false;
        $this->save();
    }
}
