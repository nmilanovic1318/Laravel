@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Reklame</h1></div>
                    <div class="card-body">
                        @if($typeFanPage)
                            @foreach($typeFanPage as $tfp)
                                @foreach($allAds as $ad)

                                    @if(in_array($ad->type, $tfp) && $ageGroup == $ad->age_group)
                                        {{$ad->body}}<br>
                                    @endif
                                @endforeach

                            @endforeach
                        @else
                            <p>Izgleda da trenutno nema reklama!</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
