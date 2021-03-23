@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Rezultati pretrage</div>
                    <div class="card-body">
                        @if($rez->count())
                            @foreach($rez as $result)
                                <div class="row ml-3">
                                    <a href="{{route('profilePage', ['user'=>$result->id])}}">{{$result->getFullName()}}</a>
                                </div>
                                <p class="row mr-4">
                                <div class="col-md-2">
                                    <a href="{{route('profilePage', ['user'=>$result->id])}}"> <img style="width:100%;"
                                                                                                    src="/storage/user_images/{{$result->image}}"
                                                                                                    class="img-responsive img-thumbnail rounded mx-auto d-block">
                                    </a>
                                </div>
                    </div>
                    @endforeach
                    <div class="row ml-4">Broj pronađenih rezultata: {{$rezCount}}</div>
                    @else
                        <p>Nažalost, nije pronađen nijedan korisnik sa traženim imenom.</p>
                    @endif
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection
