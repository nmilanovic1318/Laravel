@extends ('layouts.app')

@section('content')

    @if(Auth::user()->isFriend($user->id) || Auth::id() == $user->id)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-content-md-center"><h1>{{$user->name}} {{$user->surname}}</h1>
                        </div>
                        <div class="card-body">

                        </div>
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-md-offset-3">
                                    <div class="text-center">
                                        <img style="width:60%;" src="/storage/user_images/{{$user->image}}" class="img-responsive img-thumbnail rounded mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="align-content-md-center">
                                <p>Email adresa: {{$user->email}}</p>
                                <p>Datum rođenja: {{$user->date_of_birth}}</p>
                                <p>Registrovao/la se: {{$user->created_at}}</p>
                                <p>Broj prijatelja: {{$fc}}</p>
                                @if(Auth::id() == $user->id)
                                    <form method="get" action="/users/{{$user->id}}/edit">
                                        <input type="submit" value="Izmeni profil" name="submit" id="submit">
                                    </form>
                                    <form method="get" name="edit" id="edit" action="/my-friends">
                                        <input type="submit" value="Moji prijatelji" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/add-friends">
                                        <input type="submit" value="Dodaj prijatelje" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/blocked-users">
                                        <input type="submit" value="Blokirani korisnici" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/my-posts">
                                        <input type="submit" value="Moji postovi" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/fan-pages">
                                        <input type="submit" value="Fan stranice" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/create-fan-page">
                                        <input type="submit" value="Napravi fan stranicu" name="submit" id="submit">
                                    </form>
                                    <form method="get" action="/ads-index">
                                        <input type="submit" value="Napravi novu reklamu" name="submit" id="submit">
                                    </form>

                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card-header">Greška</div>
                    <div class="card">
                        <div class="align-content-center">
                            <h4>Morate biti prijatelji sa ovim korisnikom da bi videli njihove podatke!</h4>
                            <form method="get" action="/add-friends">
                                <input type="submit" value="Nazad na stranicu za dodavanje prijatelja">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    @endif


@endsection

