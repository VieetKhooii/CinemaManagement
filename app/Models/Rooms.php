<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'room';
    protected $primaryKey = 'room_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'room_id',
        'room_name',
        'name',
        'status',
        'number_of_seat',
        'display',
    ];

    protected $casts = [
        'status'=> 'boolean',
        'display'=> 'boolean',
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
