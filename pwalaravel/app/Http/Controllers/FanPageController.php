<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FanPage;
use App\Http\Requests\FanPageRequest;
use App\Http\Requests\MakePostRequest;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class FanPageController extends Controller
{
    public function index()
    {
        return view('fanPages.index');
    }

    public function makeFanPage(FanPageRequest $request)
    {
        $user = Auth::user();
        $user->fanPages()->create($request->only('name', 'type', 'body'));
        return Redirect::back();
    }

    public function makeFanPost(MakePostRequest $request)
    {
        $user = Auth::user();
        $user->posts()->create($request->only('body', 'is_fan_post', 'fan_page_id'));
        return Redirect::back();
    }

    public function show()
    {
        $fanPages = FanPage::all();
        $fanPageCount = $fanPages->count();
        return view('fanPages.fan-pages', ['fanPages' => $fanPages, 'fanPageCount'=>$fanPageCount]);
    }

    public function pageProfile(FanPage $fanPage)
    {
        $posts = Post::where('is_fan_post', '=', 1)->where('fan_page_id', '=', $fanPage->id)->get();
        $like = Like::where('user_id', '=', Auth::id())->where('fan_page_id', '=', $fanPage->id)->first();
        if ($like) {
            $eligiblePosters = User::where('id', '=', $like->user_id)->get();
        } else {
            $eligiblePosters = null;
        }
        return view('fanPages.page-profile', ['fanPage' => $fanPage, 'posts' => $posts, 'eligiblePosters' => $eligiblePosters]);
    }

    public function likeFanPage(FanPage $fanPage)
    {
        $user = Auth::user();
        $isLiked = $user->likes()->where('fan_page_id', '=', $fanPage->id)->first();
        if (!$isLiked) {
            $like = new Like(['fan_page_id' => $fanPage->id, 'user_id' => Auth::id()]);
            $fanPage->likes++;
            $fanPage->update();
            $like->save();
        } else if ($isLiked) {
            $like = $user->likes()->where('fan_page_id', '=', $fanPage->id)->first();
            $like->delete();
        }
        return Redirect::back();

    }
}
