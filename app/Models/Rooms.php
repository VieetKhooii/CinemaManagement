<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'room_id',
        'room_name',
        'number_of_seat',
        'display',
    ];

    protected $casts = [
        'status'=> 'boolean',
        'display'=> 'boolean',
    ];

    public function showtimes(){
        return $this->hasMany(Showtimes::class);
    }

    public function showtimeRoom(){
        return $this->hasMany(ShowtimeRoom::class, 'room_id', 'room_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($room) {
            $latestId = static::max('room_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'R0';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 4);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'R' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $room->room_id = $newId;
        });
    }

    public function scopeSearch($query, $name, $minSeat, $maxSeat)
    {
        $query = $this->query();

        if ($name) {
            $query->where('room_name', 'LIKE', "%$name%");
        }

        if ($minSeat) {
            $query->where('number_of_seat', '>=', $minSeat);
        }

        if ($maxSeat) {
            $query->where('number_of_seat', '<=', $maxSeat);
        }

        return $query;
    }



    use HasFactory;
}
