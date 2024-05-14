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
        'trailer_code',
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

    public static function getMoviesForCustomer1(){
        try {
            return Movies::select('movies.*', 'categories.category_name', DB::raw('MIN(showtimes.date) as start_time'))
    ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
    ->join('categories', 'categories.category_id', '=', 'movies.category_id')
    ->whereIn('movies.movie_id', function($query) {
        $query->select('movie_id')
            ->from('showtimes')
            ->whereDate('date', '>=', now()->toDateString()) // Change here
            ->whereDate('date', '<=', now()->addDays(14)->toDateString());
    })
    ->where('movies.display', '1')
    ->groupBy('movies.movie_id')
    ->get()
    ->toArray();

        }
        catch(\Exception $exception){
            echo("Error get movies 1: " . $exception->getMessage());
            return null;
        }
    }
    
    public static function getMoviesForCustomer0(){
        try{
            $result = Movies::select('movies.*', 'categories.category_name', DB::raw('MIN(showtimes.date) as start_time'))
        ->join('showtimes', 'movies.movie_id', '=', 'showtimes.movie_id')
        ->join('categories', 'categories.category_id', '=', 'movies.category_id')
        ->whereNotIn('movies.movie_id', function($query) {
            $query->select('movie_id')
                ->from('showtimes')
                ->whereDate('date', '<=', now()->toDateString());
        })
        ->whereNotIn('movies.movie_id', function($query) {
            $query->select('movie_id')
                ->from('showtimes')
                ->whereDate('date', '>=', now()->toDateString()) // Change here
                ->whereDate('date', '<=', now()->addDays(14)->toDateString());
        })
        ->where('movies.display', '1')
        ->groupBy('movies.movie_id')
        ->get()->toArray();
        return $result;
        }
        catch(\Exception $exception){
            echo("Error get movies 1: " . $exception->getMessage());
            return null;
        }
    }

    use HasFactory;
}
