<?php

namespace App\Http\Controllers;

use App\Ad;
use App\Http\Requests\MakePostRequest;
use App\Http\Requests\SearchPostRequest;
use App\Http\Requests\SearchRequest;
use App\Like;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function makePost(MakePostRequest $request, Post $post)
    {
        $user = Auth::user();
        $user->posts()->create($request->only('body'));
        return Redirect::back();
    }

    public function myPosts()
    {
        $posts = Post::where('user_id', '=', Auth::id())->get();
        $postsCount = Post::where('user_id', '=', Auth::id())->count();
        return view('posts.myPosts', ['posts' => $posts, 'postsCount' => $postsCount]);
    }

    public function searchPosts(SearchRequest $request)
    {
        $pretraga = $request['searchPosts'];
        $rez = Post::where('body', 'LIKE', "%{$pretraga}%")->get();
        foreach ($rez as $rezultat) {
            $userName = User::where('id', '=', $rezultat->user_id)->first()->getFullName();
            $user = User::where('id', '=', $rezultat->user_id)->first();
        }
        if (!$rez->count()){
            $userName = null;
            $user = null;
        }
        $rezCount = Post::where('body', 'LIKE', "%{$pretraga}%")->count();
        return view('posts.search', ['rez' => $rez, 'rezCount' => $rezCount, 'userName' => $userName, 'user'=>$user]);
    }

    public function deletePost(Post $post)
    {
        $post = Post::where('id', '=', $post->id);
        $post->delete();
        return Redirect::back();
    }

    public function likePost(Post $post)
    {
        $user = Auth::user();
        $isLiked = $user->likes()->where('post_id', '=', $post->id)->first();
        if (!$isLiked) {
            $like = new Like(['post_id' => $post->id, 'user_id' => Auth::id()]);
            $like->save();
        } else if ($isLiked) {
            $like = $user->likes()->where('post_id', '=', $post->id)->first();
            $like->delete();
        }
        return Redirect::back();

    }
}
