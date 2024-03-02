<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'area_id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'area_id',
        'name',
        'number_of_branch',
    ];
    

    use HasFactory;
}