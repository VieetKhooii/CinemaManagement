<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'seat';
    protected $primaryKey = 'seat_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'seat_id',
        'seat_row',
        'seat_number',
        'is_reserved',
        'seat_type_id',
        'room_id',
        'display',
    ];

    protected $casts = [
        'display'=> 'boolean',
        'is_reserved'=> 'boolean',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($seat) {
            $latestId = static::max('seat_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'S001';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 1);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'S' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $seat->seat_id = $newId;
        });
    }

    public function scopeSearch($query, $row, $number, $reserve, $seatType, $room)
    {
        $query = $this->query();

        if ($row) {
            $query->where('seat_row', 'LIKE', "%$row%");
        }

        if ($number) {
            $query->where('seat_number', $number);
        }

        if ($reserve) {
            $query->where('is_reserved', $reserve);
        }

        if($seatType != "All"){
            $typeId = SeatTypes::where('type', 'LIKE', "%$seatType%")->first()->seat_type_id;
            $query->where('seat_type_id', $typeId);
        }

        if($room != "All"){
            $roomId = Rooms::where('room_name', 'LIKE', "%$room%")->first()->room_id;
            $query->where('room_id', $roomId);
        }

        return $query;
    }


    use HasFactory;
}
