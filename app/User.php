<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_user', 'user_id', 'friend_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function fanPages()
    {
        return $this->hasMany(FanPage::class);
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
    }

    public function deleteFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }

    public function friendCount()
    {
        return $this->friends()->count();
    }

    public function isFriend($friendId)
    {
        return (boolean)$this->friends()->where('id', $friendId)->where('isBlocked', '=', 0)->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
