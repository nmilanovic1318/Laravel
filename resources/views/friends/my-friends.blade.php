@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Moji prijatelji</div>
                    <div class="card-body">
                        @if ($friendCount > 0)
                            @foreach($bezBlokiranih as $friend)
                                @foreach($ulogovanUser->friends as $prijatelj)
                                    @if($prijatelj->id == $friend->friend_id)
                                        <div class="align-content-md-center">
                                            <a href="{{route('profilePage', ['user'=>$prijatelj->id])}}">{{ $prijatelj->getFullName() }}</a><br>
                                            <a href="{{ route('deleteFriend', ['id'=>$prijatelj->id]) }}">Obriši
                                                prijatelja</a><br>
                                            <a href="{{ route('blockUser', ['id'=>$prijatelj->id]) }}">Blokiraj
                                                prijatelja</a><br>
                                            <br>
                                        </div>

                                    @endif
                                @endforeach

                            @endforeach
                        @else
                            <div class="align-content-center">
                                <h4>Žao nam je, izgleda da trenutno nemate nijednog korisnika kao prijatelja na svom
                                    nalogu!</h4>
                                <p>Ovo možete rešiti pritiskom na dugme ispod i dodavanjem nekog korisnika za
                                    prijatelja:</p>
                                <form method="get" action="/add-friends">
                                    <input type="submit" value="Dodaj prijatelja">
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>





@endsection
