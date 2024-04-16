<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShowtimeRoom extends Model
{
    protected $table = 'showtime_room';
    protected $primaryKey = ['showtime_id', 'room_id'];

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'showtime_id',
        'room_id',
        'display',
    ];
    
    public function room(){
        $this->belongsTo(Rooms::class, 'room_id', 'room_id');
    }

    public function showtime(){
        $this->belongsTo(Showtimes::class, 'showtime_id', 'showtime_id');
    }

    protected $casts = [
        'display' => 'boolean',
    ];

    use HasFactory;
}
