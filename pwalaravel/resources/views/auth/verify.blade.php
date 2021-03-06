@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Potvrdite svoju email adresu') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Novi verifikacioni link je poslat na Vašu adresu.') }}
                            </div>
                        @endif

                        {{ __('Pre nego što nastavite dalje, molimo proverite svoj mejl i iskoristite verifikacioni link.') }}
                        {{ __('Ukoliko niste primili verifikacioni link') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknite ovde da zatražite novi') }}</button>
                            .
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
