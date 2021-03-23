@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Naslovna strana</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="post" class="mt-3" action="/search-users">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        @error('searchUser')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong><br>
                                        </span>
                                        @enderror
                                        <label for="search">Pretraga korisnika:</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="display:inline-block;"><input type="text" name="searchUser"
                                                                                        id="search"></p>
                                                <p style="display:inline-block;"><input type="submit" value="Pretraži">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form method="post" action="/search-posts">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        @error('searchPosts')
                                        <span role="alert">
                                            <strong>{{ $message }}</strong><br>
                                        </span>
                                        @enderror
                                        <label for="search">Pretraga postova:</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p style="display:inline-block;"><input type="text" name="searchPosts"
                                                                                        id="search"></p>
                                                <p style="display:inline-block;"><input type="submit" value="Pretraži">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form method="post" action="/makePost">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                         <textarea style="resize: none;height: 100px;width:300px;" name="body"
                                                   id="body"></textarea><br>
                                        <input type="submit" value="Napravi post">
                                    </div>
                                </div>
                            </div>

                        </form>
                        @foreach($postovi as $post)
                            <form class="mt-3 ml-3" method="post" id="postForm{{$post->id}}"
                                  action="{{route('likePosts', ['post'=>$post->id])}}">
                                @csrf
                                @if(Auth::user()->isFriend($post->user()->first()->id) || Auth::id() == $post->user()->first()->id)
                                    <a href="{{route('profilePage', ['user'=>$post->user()->first()->id])}}">{{$post->user()->first()->getFullName()}}
                                        :<br></a>
                                @endif
                                @if(Auth::id() == $post->user()->first()->id)

                                    {{$post->body}}<br>
                                    <i class="fas fa-thumbs-up"></i>{{$post->likes()->count()}}<br>

                                @endif
                                @if(Auth::user()->isFriend($post->user()->first()->id) && Auth::user() != $post->user()->first())
                                    {{$post->body}}<br>
                                    <a href="#"
                                       onclick="document.getElementById('postForm{{$post->id}}').submit();"><i
                                            class="fas fa-thumbs-up"></i></a>{{$post->likes()->count()}}<br>
                                @endif
                            </form>
                            @csrf

                        @endforeach
                        @if($typeFanPage)
                            @foreach($typeFanPage as $tfp)
                                @foreach($allAds as $ad)
                                    @if(in_array($ad->type, $tfp) && $ageGroup == $ad->age_group)
                                        <div class="row ml-3 mt-2">{{$ad->body}}</div>
                                        <div class="row ml-1 mt-2"><div class="col-md-6"><img style="width:100%;"src="/storage/ad_images/{{$ad->image}}"></div></div>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

