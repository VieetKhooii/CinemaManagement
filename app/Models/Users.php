<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Auth\Passwords\CanResetPassword;
// use Illuminate\Auth\Notifications\ResetPassword;
// use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
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
        'full_name',
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
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'status' => 'boolean',
    ];

    use HasApiTokens, HasFactory, Notifiable;

    
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

    // use Notifiable;

    // Other model code...

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new ResetPassword($token));
    // }

    /**
     * Determine if the user can reset the password.
     *
     * @param string $token
     * @return bool
     */
    // public function canResetPassword($token)
    // {
    //     // Add your logic here to determine if the user can reset the password
    //     // For example, check if the token is still valid or if the user is active

    //     return true; // Return true if the user can reset the password, false otherwise
    // }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];
    // public function getEmailForPasswordReset()
    // {
        
    // }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $rolePrefix = '';
            switch ($user->role_id) {
                case '1':
                    $rolePrefix = 'AD';
                    break;
                case '2':
                    $rolePrefix = 'EMP';
                    break;
                case '4':
                    $rolePrefix = 'VIP';
                    break;
                case '5':
                    $rolePrefix = 'PLA';
                    break;
                // Add more cases for other roles if needed
                default:
                    $rolePrefix = 'CLI'; // Default to client
            }
            $latestId = static::where('role_id', $user->role_id)->max('user_id');
            // Nếu không có ID trước đó, bắt đầu từ CA0000
            if (!$latestId) {
                $newId = $rolePrefix . '000';
            } else {
                // Tách phần số từ ID cuối cùng
                $numberPart = substr($latestId, strlen($rolePrefix));
                // Increment the number part by 1
                $nextNumber = intval($numberPart) + 1;
                // Generate the new ID
                $newId = $rolePrefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
            }

            // Gán ID mới cho model
            $user->user_id = $newId;
        });
    }
}
