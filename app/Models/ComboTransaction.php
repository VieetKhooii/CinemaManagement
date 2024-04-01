<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComboTransaction extends Model
{
    protected $table = 'combo_transaction';
    protected $primaryKey = ['combo_id', 'transaction_id'];

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'combo_id',
        'transaction_id',
        'price_on_amount',
        'display',
    ];
    
    protected $casts = [
        'display' => 'boolean',
    ];

    use HasFactory;
}
