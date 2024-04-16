<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'vouchers';
    protected $primaryKey = 'voucher_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $fillable = [
        'voucher_id',
        'voucher_discount',
        'voucher_condition',
        'description',
        'display'
    ];
    protected $casts = [
        'voucher_condition' => 'date',
        'display'=> 'boolean'
    ];
    
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
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($voucher) {
            $latestId = static::max('voucher_id');
            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'VC000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'VC'. str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $voucher->voucher_id = $newId;
        });
    }
    use HasFactory;
}
