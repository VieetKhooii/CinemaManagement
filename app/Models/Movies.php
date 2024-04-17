<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movies extends Model
{
    protected $table = 'movies';
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

    public static function getMoviesForCustomer1(){
        
        return Movies::select('movies.*', 'categories.category_name', DB::raw('MIN(showtimes.date) as start_time'))
        ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
        ->join('categories', 'categories.category_id', '=', 'movies.category_id')
        ->whereIn('movies.movie_id', function($query) {
            $query->select('movie_id')
                ->from('showtimes')
                ->whereDate('date', '<=', now()->toDateString());
        })
        ->whereIn('movies.movie_id', function($query) {
            $query->select('movie_id')
                ->from('showtimes')
                ->whereDate('date', '>', now()->toDateString());
        })
        ->where('movies.display', '1')
        ->groupBy('movies.movie_id')
        ->get()->toArray();
    }
    
    public static function getMoviesForCustomer0(){

        return Movies::select('movies.*', 'categories.category_name', DB::raw('MIN(showtimes.date) as start_time'))
        ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
        ->join('categories', 'categories.category_id', '=', 'movies.category_id')
        ->whereNotIn('movies.movie_id', function($query) {
            $query->select('movie_id')
                ->from('showtimes')
                ->whereDate('date', '<=', now()->toDateString());
        })
        ->where('movies.display', '1')
        ->groupBy('movies.movie_id')
        ->get()->toArray();
    }

    use HasFactory;
}
