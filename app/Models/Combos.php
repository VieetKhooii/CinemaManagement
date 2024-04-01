<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combos extends Model
{
    protected $table = 'combo';
    protected $primaryKey = 'combo_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'combo_id',
        'price',
        'name',
        'description',
        'image',
        'display',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $latestId = static::max('combo_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'CB0000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'CB' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $category->combo_id = $newId;
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
    
    protected $casts = [
        'display' => 'boolean',
    ];

    use HasFactory;
}
