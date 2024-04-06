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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $latestId = static::max('transaction_id');

            // Nếu không có ID trước đó, bắt đầu từ TR00000000
            if (!$latestId) {
                $newId = 'TRA0000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 4);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'TRA' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $transaction->transaction_id = $newId;
        });
    }

    use HasFactory;
}
