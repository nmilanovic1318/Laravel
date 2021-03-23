@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Fan stranice</h1>
                    </div>
                    <div class="card-body">
                        @if($fanPageCount > 0)
                        @foreach($fanPages as $fanPage)
                            <form method="post" id="postForm{{$fanPage->id}}"
                                  action="{{route('likeFanPage', ['fanPage'=>$fanPage->id])}}">
                                @csrf
                                <div class="form-group">
                                    <a href="{{ route('pageProfile', ['fanPage'=>$fanPage->id]) }}">{{$fanPage->name}}</a><br>
                                    {{$fanPage->body}}<br>
                                    <a href="#" onclick="document.getElementById('postForm{{$fanPage->id}}').submit();"><i
                                            class="fas fa-thumbs-up"></i></a>{{$fanPage->likes()->count()}}
                                </div>
                            </form>
                        @endforeach
                            @else
                            <p>Izgleda da trenutno ne postoji fan stranica na sajtu! Budite prvi koji će to promeniti:</p>
                            <form method="get" action="/create-fan-page">
                                <input type="submit" id="submit" value="Napravi fan stranicu">
                            </form>
                            @endif
                    </div>
                </div>
            </div>

        </div>

@endsection
