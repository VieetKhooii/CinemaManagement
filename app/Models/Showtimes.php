<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtimes extends Model
{
    protected $table = 'showtimes';
    protected $primaryKey = 'showtime_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'showtime_id',
        'movie_id',
        'date',
        'start_time',
        'room_id'
    ];

    protected $casts = [
        'date'=> 'datetime',
        'start_time'=> 'datetime',
        'display'=> 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($showTime) {
            $latestId = static::max('showtime_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'ST001';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'ST' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $showTime->showtime_id = $newId;
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

   
    use HasFactory;
}
