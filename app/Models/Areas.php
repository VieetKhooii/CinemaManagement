<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'area';
    protected $primaryKey = 'Area_Id';

    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'Area_Id',
        'Name',
        'Number_Of_Branch',
    ];
    

    use HasFactory;
}