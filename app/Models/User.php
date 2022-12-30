<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        $createdUser = self::create($data);

        if (!$createdUser) {
            return false;
        }

        return $createdUser;
    }

    public static function getUser($userId)
    {
        $query = User::where('id', $userId)->first()->toArray();
        unset($query['password']);
        unset($query['remember_token']);
        unset($query['created_at']);
        unset($query['updated_at']);

        return $query;
    }

    public static function updateUserById($id, $data): bool
    {
        $updatedUser = self::where([
            ['id', $id]
        ])->update($data);

        if (!$updatedUser) {
            return false;
        }

        return true;
    }
}
