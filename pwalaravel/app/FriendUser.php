<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendUser extends Model
{
    protected $table = 'friend_user';
    protected $fillable = ['isBlocked'];

    public function isBlocked($friendId)
    {
        return (boolean)$this->where('user_id', $friendId)->count();
    }
}
