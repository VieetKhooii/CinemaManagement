<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumes extends Model
{
    protected $table = 'consume';
    protected $primaryKey = 'consume_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'consume_id',
        'name',
        'amount',
        'price',
        'image',
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
