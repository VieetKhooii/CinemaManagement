<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherOfUser extends Model
{
    protected $table = 'voucher_of_user';
    protected $primaryKey = ['voucher_id', 'user_id'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'voucher_id',
        'user_id',
        'amount',
        'display'
    ];
    protected $casts = [
        'display'=> 'boolean'
    ];
    
    use HasFactory;
}
