@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row justify-content-center">
                    <h1>{{$fanPage->name}}</h1><br>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <h3>{{$fanPage->body}}</h3>
                </div>
                @if ($eligiblePosters)
                    <form method="post" class="mt-3" action="{{route('makeFanPost', ['fanPage'=>$fanPage->id])}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <input type="hidden" name="is_fan_post" value="1">
                                    <input type="hidden" name="fan_page_id" value="{{$fanPage->id}}">
                                    <textarea style="resize: none;height: 100px;width:300px;" name="body"
                                              id="body"></textarea><br>
                                    @error('body')
                                    {{$message}}
                                    @enderror
                                    <input type="submit" value="Napravi post">
                                </div>
                            </div>
                        </div>
                    </form>

                    @foreach($posts as $post)
                        <div class="row ml-3 mt-3">
                            <a href="{{route('profilePage', ['user'=>$post->user()->first()->id])}}">{{$post->user()->first()->getFullName()}}
                                :</a><br>
                        </div>
                        <div class="row ml-3">
                            {{$post->body}}
                        </div>
                        @if($post->user()->first()->id == Auth::id())
                            <div class="row ml-3">
                                <form action="{{route('deletePost', ['post'=>$post->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="delete" id="submit" value="Obriši post">
                                </form>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p>Lajkujte stranicu kako bi se pridružili diskusiji!</p>
                    <form method="post" id="postForm{{$fanPage->id}}"
                          action="{{route('likeFanPage', ['fanPage'=>$fanPage->id])}}">
                        @csrf
                        <div class="form-group">
                            <button id="submit" onclick="document.getElementById('postForm{{$fanPage->id}}').submit();">
                                <i style="font-size:14px;" class="fas fa-thumbs-up">LIKE</i></button>
                        </div>

                    </form>
                @endif

            </div>
        </div>
    </div>
@endsection
