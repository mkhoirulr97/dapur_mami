<?php

namespace App\Models;

use App\Scopes\HasActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Scope
    protected static function booted()
    {
        static::addGlobalScope(new HasActiveScope);
    }

    const FOOD_CATEGORY  = 1;
    const DRINK_CATEGORY = 2;
    const SNACK_CATEGORY = 3;

    const FOOD_CATEGORY_MEANING  = 'Makanan';
    const DRINK_CATEGORY_MEANING = 'Minuman';
    const SNACK_CATEGORY_MEANING = 'Camilan';

    const CATEGORIES = [
        [
            'id'   => self::FOOD_CATEGORY,
            'name' => self::FOOD_CATEGORY_MEANING
        ],
        [
            'id'   => self::DRINK_CATEGORY,
            'name' => self::DRINK_CATEGORY_MEANING
        ],
        [
            'id'   => self::SNACK_CATEGORY,
            'name' => self::SNACK_CATEGORY_MEANING
        ]
    ];

    const ACTIVE_STATUS   = 1;
    const INACTIVE_STATUS = 2;

    public $table = 'menus';

    protected $fillable = [
        'name',
        'price',
        'category',
        'description',
        'weight',
        'image',
        'active'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::ACTIVE_STATUS);
    }

    public function getCategoryNameAttribute()
    {
        return self::CATEGORIES[$this->category - 1]['name'];
    }

    // RELATIONSHIP

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'menus_id', 'id');
    }

    public function detailDeliveryOrders()
    {
        return $this->hasMany(DetailDeliveryOrder::class, 'menu_id', 'id');
    }
}
