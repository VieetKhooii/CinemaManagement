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
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            $latestId = static::max('movie_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'MO0000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'MO' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $movie->movie_id = $newId;
        });
    }


    protected $casts = [
        'display' => 'boolean',
    ];
    use HasFactory;
}
