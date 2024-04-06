<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = [
        'category_id',
        'category_name',
        'display',
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

        static::creating(function ($category) {
            $latestId = static::max('category_id');

            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = 'CA0000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, 2);
                // Tăng số lên 1 đơn vị
                $nextNumber = intval($numberPart) + 1;
                // Tạo ID mới
                $newId = 'CA' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $category->category_id = $newId;
        });
    }

    protected $casts = [
        'display' => 'boolean',
    ];



    use HasFactory;
}
