@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width:80%">
                <div class="card-header">Blokirani korisnici</div>
                <div class="card-body">
                </div>
                <div class="col-md-12">


                    @if($blockedCount == 0)
                        <div class="align-content-center">
                            <h4>Trenutno nemate blokiranih korisnika.</h4>
                        </div>
                    @endif
                    @foreach($samoBlokirani as $blokirani)
                        @foreach($ulogovanUser->friends as $prijatelj)
                            @if($prijatelj->id == $blokirani->friend_id)
                                <div class="align-content-md-center">
                                    <a href="{{route('profilePage', ['user'=>$prijatelj->id])}}">{{ $prijatelj->getFullName() }}</a><br>
                                    <a href="{{ route('unblockUser', ['id'=>$prijatelj->id]) }}">Odblokiraj
                                        prijatelja</a><br>
                                    <br>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div></div>
            </div>
        </div>

@endsection
