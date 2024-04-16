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
                $newId = 'BN0000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'BN' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $category->combo_id = $newId;
        });
    }

    public function scopeSearch($query, $name, $minPrice, $maxPrice)
    {
        $query = $this->query();

        if ($name) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }
    
    protected $casts = [
        'display' => 'boolean',
    ];

    use HasFactory;
}
