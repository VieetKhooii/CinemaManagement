<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtimes extends Model
{
    protected $table = 'showtime';
    protected $primaryKey = 'showtime_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'showtime_id',
        'movie_id',
        'date',
        'start_time',
        'display',
    ];

    protected $casts = [
        'date'=> 'datetime',
        'start_time'=> 'datetime',
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
