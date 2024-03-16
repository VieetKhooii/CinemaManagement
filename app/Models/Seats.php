<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'seat';
    protected $primaryKey = 'seat_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'seat_id',
        'seat_row',
        'seat_number',
        'is_reserved',
        'seat_type_id',
        'room_id',
        'display',
    ];

    protected $casts = [
        'display'=> 'boolean',
        'is_reserved'=> 'boolean',
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

    use HasFactory;
}
