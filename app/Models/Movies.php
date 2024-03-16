<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $table = 'movie';
    protected $primaryKey = 'movie_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';


    public $fillable = [
        'movie_id',
        'movie_name',
        'movie_description',
        'image',
        'duration',
        'bonus_price',
        'category_id',
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
