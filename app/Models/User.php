<?php

namespace App\Models;

use App\Models\profile;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'document',
        'email',
        'profile_document',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
  
    // Relationships
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }


    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'ficha_user')->using(FichaUser::class)->withPivot('status');
    }

    /**
     * Relacion polimorfica con 'Files'
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * 1 - n con followUps - aprendices
     */
    public function apFollowUps()
    {
        return $this->hasMany(FollowUp::class, 'apprentice_id');
    }

    /**
     * 1 - n con followUps - instructores
     */
    public function inFollowUps()
    {
        return $this->hasMany(FollowUp::class, 'instructor_id');
    }

    protected function defaultProfilePhotoUrl()
    {
        $name = trim(collect(explode(' ', $this->profile->names . ' ' . $this->profile->surnames))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }
}
