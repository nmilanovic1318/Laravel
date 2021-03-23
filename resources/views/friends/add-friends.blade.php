@extends ('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width:80%;">
                <div class="card-header">Dodaj prijatelje</div>
                <div class="card-body">


                    <div class="col-md-12">
                        @if ($notFriendsCount != 0)
                            @foreach ($not_friends as $friend)
                                <div class="align-content-md-center">
                                    <a href="{{route('profilePage', ['user'=>$friend->id])}}">{{ $friend->getFullName() }}</a><br>
                                    <a href="{{ route('addFriend', ['id'=>$friend->id]) }}">Dodaj prijatelja</a><br>
                                    <br>
                                </div>

                            @endforeach
                        @else
                            <div class="align-content-center">
                                <h4>Žao nam je, izgleda da trenutno ne možete dodati nijednog korisnika za svog
                                    prijatelja!</h4>
                            </div>
                        @endif

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
