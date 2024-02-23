<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name', 'middle_name', 'last_name',
        'email',
        'password',
        'phone_number',
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

    public function pages()
    {
        return $this->belongsTo(User::class);
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function routeNotificationForVonage($notification)
    {
        return $this->phone_number;
    }

    public function getImageAttribute($value)
    {
        if (Str::contains(Request()->route()->getPrefix(), 'api')) {

            if ($value == null) {
                return asset('assets/frontend/images/profiles/avatar.png');
            } else {
                return asset('assets/frontend/images/profiles') . '/' . $value;
            }
        }


        return $value;
    }


    public function teams()
    {
        return $this->belongsToMany(Team::class, 'team_player',  'player_id', 'team_id');
    }
}
