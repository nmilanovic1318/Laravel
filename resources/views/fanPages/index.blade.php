@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="POST" action="/create-fan-page">
            @csrf
            <div class="form-group">
                @error('name')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
                <label for="name">Unesite željeni naziv Vaše fan stranice</label><br>
                <input type="text" name="name" id="name">
            </div>
            <div class="form-group">
                @error('body')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
                <label for="body">Unesite kratak opis o Vašoj stranici:</label><br>
                <textarea style="resize: none;height: 100px;width:300px;" name="body" id="body"></textarea>
            </div>
            <div class="form-group">
                @error('type')
                <span role="alert">
                    <strong>{{ $message }}</strong><br>
                </span>
                @enderror
                <label for="type">Odaberite kategoriju za Vašu fan stranicu</label><br>
                Sport: <input type="radio" name="type" id="type" value="sport">
                Filmovi: <input type="radio" name="type" id="type" value="film">
                Muzika: <input type="radio" name="type" id="type" value="music">
            </div>
            <input type="submit" name="makeFanPage" id="submit" value="Napravi fan stranicu">
        </form>
    </div>

@endsection
