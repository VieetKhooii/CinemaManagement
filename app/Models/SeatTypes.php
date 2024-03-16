<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatTypes extends Model
{
    protected $table = 'seat_type';
    protected $primaryKey = 'seat_type_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'seat_type_id',
        'type',
        'bonus_price',
        'display',
    ];

    public static function search(array $searchParams)
    {
        $query = static::query();

        foreach ($searchParams as $key => $value) {
            if ($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        return $query->get();
    }
    
    protected $casts = [
        'display' => 'boolean',
    ];


    use HasFactory;
}