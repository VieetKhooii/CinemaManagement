<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservation';
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'price',
        'showtime_id',
        'seat_id',
        'transaction_id',
        'display',
    ];

    protected $casts = [
        'display'=> 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            $latestId = static::max('id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'RE00000000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'RE' . str_pad($nextNumber, 8, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $reservation->id = $newId;
        });
    }

    use HasFactory;
}
