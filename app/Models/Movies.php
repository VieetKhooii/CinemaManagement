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

    public function category(){
        return $this->belongsTo(Categories::class);
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movie) {
            $latestId = static::max('movie_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'MV000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'MV' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $movie->movie_id = $newId;
        });
    }

    public function scopeSearch($query, $name, $minPrice, $maxPrice, $category)
    {
        $query = $this->query();   

        if ($name) {
            $query->where('movie_name', 'LIKE', "%$name%");
        }

        if ($minPrice) {
            $query->where('bonus_price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('bonus_price', '<=', $maxPrice);
        }

        if($category != "All"){
            $categoryId = Categories::where('category_name', 'LIKE', "%$category%")->first()->category_id;
            $query->where('category_id', $categoryId);
        }


        return $query;
    }

    protected $casts = [
        'display' => 'boolean',
    ];
    use HasFactory;
}
