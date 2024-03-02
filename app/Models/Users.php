<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model implements Authenticatable
{
    protected $table = 'users'; // The name must match the table name in database
    protected $primaryKey = 'user_id';
    
    public $incrementing = false; // Assuming User_Id is not auto-incrementing
    protected $keyType = 'string'; // Assuming User_Id is a varchar
    public $timestamps = false;

    public function setPasswordAttribute($value)
    {
       $this->attributes['password'] = bcrypt($value);
    }
    
    protected $fillable = [
        'user_id',
        'user_name',
        'email',
        'password',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'score',
        'status',
        'role_id',
    ];

    // 
    protected $casts = [
        'date_of_birth' => 'date',
        'status' => 'boolean',
    ];

    use HasFactory;

    
    public function getAuthIdentifierName()
    {
        return 'user_id'; // The name of the primary key column
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
