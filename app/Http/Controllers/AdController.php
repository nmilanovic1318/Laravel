<?php

namespace App\Http\Controllers;

use App\Ad;
use App\FanPage;
use App\Http\Requests\CreateAdRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class AdController extends Controller
{
    public function index()
    {
        return view('ads.index');
    }

    public function createAd(CreateAdRequest $request)
    {
        $user = Auth::user();
        $ad = new Ad();
        $ad->type = $request->get('type');
        $ad->body = $request->get('body');
        $ad->age_group = $request->get('age_group');
        $ad->user_id = Auth::id();
        if($request->hasFile('image')){
            // File sa ekstenzijom
            $filenameExt = $request->file('image')->getClientOriginalName();
            // Filename bez ekst
            $filename = pathinfo($filenameExt, PATHINFO_FILENAME);
            // Samo ekst
            $ext = $request->file('image')->getClientOriginalExtension();
            //Filename za store
            $filenameStore = $filename . '_' . time() . '.' . $ext;
            // Upl image
            $path = $request->file('image')->storeAs('public/ad_images', $filenameStore);
        }
        else{
            $filenameStore = 'placeholder.jpg';
        }
        $ad->image = $filenameStore;
        $ad->save();
        return Redirect::back();
    }

    public function showAd()
    {
        $user = Auth::user();
        $fanPageLikes = $user->likes()->where('fan_page_id', '<>', 'null')->get();
        if ($fanPageLikes->count()) {
            foreach ($fanPageLikes as $fanPageLike) {
                $typeFanPage [] = FanPage::where('id', '=', $fanPageLike->fan_page_id)->pluck('type')->toArray();
            }
        } else {
            $typeFanPage = null;
        }
        $allAds = Ad::all();
        $adTypes = Ad::all()->pluck('type');
        $userAge = Carbon::make($user->date_of_birth);
        if ($userAge->age >= 13 && $userAge->age < 20) {
            $ageGroup = 'teenager';
        } else if ($userAge->age >= 20 && $userAge->age < 30) {
            $ageGroup = 'student';

        } else if ($userAge->age >= 30 && $userAge->age <= 100) {
            $ageGroup = 'parent';
        }
        return view('ads.show-ads', ['adTypes' => $adTypes, 'typeFanPage' => $typeFanPage, 'allAds' => $allAds, 'ageGroup' => $ageGroup]);
    }
}
