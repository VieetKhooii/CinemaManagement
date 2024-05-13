<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Movies;
use Carbon\Carbon;

class Helper
{
    // admin add
    public static function getRow($tableName)
    {
        $rerult = DB::table($tableName)->count() + 1;
        return $rerult;
    }

    public static function getDescription($tableName){
        return DB::select("DESCRIBE $tableName");
    }

    public static function getSpecificColumn($tableTextCombobox, $columnName, $nameTextCombobox){
        return DB::table($tableTextCombobox)
        ->select($columnName, $nameTextCombobox)
        ->get();
    }


    //user 
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
        
}
