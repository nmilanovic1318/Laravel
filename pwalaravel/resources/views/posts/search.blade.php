@extends ('layouts.app')

@section('content')
    @if ($rezCount != 0)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-content-md-center">Pretraženi postovi</div>
                        <div class="card-body">
                            @foreach($rez as $rezultat)
                                <a href="{{route('profilePage', ['user'=>$user->id])}}">{{$userName}}:</a> <br>
                                {{$rezultat->body}}<br>
                            @endforeach
                            <p>Broj pronađenih rezultata je: {{$rezCount}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

            </div>
            <div class="col-md-12">

            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header align-content-md-center">Pretraženi postovi</div>
                        <div class="card-body">
                            <h4>Nažalost nije pronađen nijedan post koji sadrži reči koje ste pretražili.</h4>
                            <form method="get" action="/home">
                                <input type="submit" value="Nazad na naslovnu stranu">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    @endif
@endsection
