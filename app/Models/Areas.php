<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'area_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'area_id',
        'name',
        'number_of_branch',
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