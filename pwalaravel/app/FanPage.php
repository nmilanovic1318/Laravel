<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FanPage extends Model
{
    protected $guarded = ['id'];

    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
