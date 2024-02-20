<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'User_Id';
    
    public $incrementing = false; // Assuming User_Id is not auto-incrementing
    protected $keyType = 'string'; // Assuming User_Id is a varchar
    public $timestamps = false;


    protected $fillable = [
        'User_Id',
        'User_Name',
        'Email',
        'Phone',
        'Date_Of_Birth',
        'Gender',
        'Address',
        'Score',
        'Status',
        'Role_Id',
    ];

    protected $casts = [
        'Date_Of_Birth' => 'date',
        'Status' => 'boolean',
    ];

    use HasFactory;
}
