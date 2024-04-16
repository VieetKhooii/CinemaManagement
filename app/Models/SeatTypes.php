<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatTypes extends Model
{
    protected $table = 'seattypes';
    protected $primaryKey = 'seat_type_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'seat_type_id',
        'type',
        'bonus_price',
        'display',
    ];

    public function scopeSearch($query, $type, $minPrice, $maxPrice)
    {
        $query = $this->query();

        if ($type) {
            $query->where('type', 'LIKE', "%$type%");
        }

        if ($minPrice) {
            $query->where('bonus_price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('bonus_price', '<=', $maxPrice);
        }

        return $query;
    }
    
    protected $casts = [
        'display' => 'boolean',
    ];


    use HasFactory;
}