<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'phone',
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


    public function isAdministrator()
    {
        return $this->is_admin;
    }


    public function messageThreads(): HasManyThrough
    {
        return $this->hasManyThrough(MessageThread::class, ContactPerson::class);
    }

    public function ownsThreadMessage(MessageThread $messageThread): bool
    {
        //checks if the id of any of the message threads created by the user matches the one they want to reply to
        $messageThread = User::query()->whereRelation('messageThreads', 'id', $messageThread->id)->first();

        if (is_null($messageThread))
            return false;
        return true;
    }

}
