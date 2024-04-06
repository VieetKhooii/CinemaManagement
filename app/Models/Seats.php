<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seats extends Model
{
    protected $table = 'seats';
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
