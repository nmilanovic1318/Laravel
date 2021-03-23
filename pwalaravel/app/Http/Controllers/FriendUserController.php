<?php

namespace App\Http\Controllers;

use App\FriendUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FriendUserController extends Controller
{
    public function blockUser($id)
    {
        $user = FriendUser::query()->where('friend_id', '=', $id)->where('user_id', '=', Auth::id());
        $user->update(['isBlocked' => 1]);
        return Redirect::back();
    }

    public function unblockUser($id)
    {
        $user = FriendUser::query()->where('friend_id', '=', $id)->where('user_id', '=', Auth::id());
        $user->update(['isBlocked' => 0]);
        return Redirect::back();
    }

}
