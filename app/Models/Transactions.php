<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'transaction_id',
        'user_id',
        'total_cost',
        'voucher_id',
        'payment_method',
        'purchase_date',
        'display',
    ];

    protected $casts = [
        'purchase_date'=> 'datetime',
        'display'=> 'boolean',
    ];

    public static function search(array $searchParams)
    {
        $query = static::query();

        foreach ($searchParams as $key => $value) {
            if ($value !== null) {
                $query->where($key, 'like', '%' . $value . '%');
            }
        }

        return $query->paginate(10);
    }
    use HasFactory;
}
