<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FriendUser;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Post;
use App\User;
use App\UserPost;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        return view('user.users');
    }

    public function edit(User $user)
    {
        return view('user.edit', ['user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        if ($request->hasFile('image')) {

            $filenameExt = $request->file('image')->getClientOriginalName();

            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);

            $ext = $request->file('image')->getClientOriginalExtension();

            $filenameStore = $filename . '_' . time() . '.' . $ext;

            $path = $request->file('image')->storeAs('public/user_images', $filenameStore);
        }
        if ($request->hasFile('image')) {
            if ($user->image != 'noimage.jpg') {
                Storage::delete('public/user_images/' . $user->image);
            }
            $user->image = $filenameStore;
            $user->save();
        }
        $user->update($request->only('name', 'surname', 'email', 'date_of_birth'));

        return Redirect::route('profilePage', ['user' => Auth::id()]);
    }

    public function delete(user $user)
    {
        $user->posts()->delete();
        $userAds = Ad::where('user_id', '=', Auth::id())->get();
        foreach ($userAds as $userAd) {
            if ($userAd->image != 'placeholder.jpg') {
                Storage::delete('/public/ad_images' . '/' . $userAd->image);
            }
        }
        $user->fanPages()->delete();
        $user->ads()->delete();
        if ($user->image != 'noimage.jpg') {
            Storage::delete('public/user_images/' . $user->image);
        }
        $user->delete();
        return redirect('register');
    }

    public function browseFriends()
    {

        $not_friends = User::where('id', '!=', Auth::user()->id);
        if (Auth::user()->friends()->count()) {
            $not_friends->whereNotIn('id', Auth::user()->friends->modelKeys());
        }
        $not_friends = $not_friends->get();
        $ulogovanUser = Auth::user();
        $allFriendships = FriendUser::where('user_id', '!=', Auth::user()->id)->get();
        $bezBlokiranih = FriendUser::where('user_id', '=', Auth::user()->id)->where('isBlocked', '=', 0)->get();
        $friendCount = FriendUser::where('user_id', '=', Auth::user()->id)->where('isBlocked', '=', 0)->count();

        return view('friends.my-friends', ['not_friends' => $not_friends, 'ulogovanUser' => $ulogovanUser, 'allFriendships' => $allFriendships, 'bezBlokiranih' => $bezBlokiranih, 'friendCount' => $friendCount]);
    }

    public function blockedUsers()
    {
        $ulogovanUser = Auth::user();
        $samoBlokirani = FriendUser::where('user_id', '=', Auth::user()->id)->where('isBlocked', '=', 1)->get();
        $blockedCount = FriendUser::where('user_id', '=', Auth::user()->id)->where('isBlocked', '=', 1)->count();
        return view('friends.blocked-users', ['ulogovanUser' => $ulogovanUser, 'samoBlokirani' => $samoBlokirani, 'blockedCount' => $blockedCount]);
    }

    public function addFriends()
    {
        $not_friends = User::where('id', '!=', Auth::user()->id);
        if (Auth::user()->friends()->count()) {
            $not_friends->whereNotIn('id', Auth::user()->friends->modelKeys());
        }
        $not_friends = $not_friends->get();
        $ulogovanUser = Auth::user();
        $notFriendsCount = $not_friends->count();
        return view('friends.add-friends', ['not_friends' => $not_friends, 'ulogovanUser' => $ulogovanUser, 'notFriendsCount' => $notFriendsCount]);
    }

    public function getAddFriend($id)
    {
        $user = User::find($id);
        Auth::user()->addFriend($user);
        return Redirect::back();
    }

    public function getDeleteFriend($id)
    {
        $user = User::find($id);
        Auth::user()->deleteFriend($user);
        return Redirect::back();
    }

    public function profilePage(User $user)
    {
        $friendCount = $user->friendCount();
        $ulogovanUser = Auth::user();
        return view('user.profile', ['user' => $user, 'fc' => $friendCount, 'ulogovanUser' => $ulogovanUser]);
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function searchUsers(SearchRequest $request)
    {
        $pretraga = $request['searchUser'];
        $rez = User::WhereRaw("concat(name, ' ', surname) like '%{$pretraga}%'")->get();
        $rezCount = User::where('name', 'LIKE', "%{$pretraga}%")->orWhere('surname', 'LIKE', "%{$pretraga}%")->count();
        return view('user.search-users', ['rez' => $rez, 'rezCount' => $rezCount]);
    }


}
