<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FanPage;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        $fanPageLikes = $user->likes()->where('fan_page_id', '<>', 'null')->where('user_id', '=', Auth::id())->get();
        if ($fanPageLikes->count()) {
            foreach ($fanPageLikes as $fanPageLike) {
                $typeFanPage [] = FanPage::where('id', '=', $fanPageLike->fan_page_id)->pluck('type')->toArray();
            }
        } else {
            $typeFanPage = null;
        }
        $userAge = Carbon::make($user->date_of_birth);
        if ($userAge->age >= 13 && $userAge->age < 20) {
            $ageGroup = 'teenager';
        } else if ($userAge->age >= 20 && $userAge->age < 30) {
            $ageGroup = 'student';

        } else if ($userAge->age >= 30 && $userAge->age <= 100) {
            $ageGroup = 'parent';
        }
        $allAds = Ad::all();
        $adTypes = Ad::all()->pluck('type');
        $posts = Post::all()->where('is_fan_post', '<>', 1);
        return view('home', ['postovi' => $posts, 'adTypes' => $adTypes, 'typeFanPage' => $typeFanPage, 'allAds' => $allAds, 'ageGroup' => $ageGroup]);
    }

}
