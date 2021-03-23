@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Napravi novu reklamu</div>
                <div class="card-body">
                    <form method="POST" action="/create-ad" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            @error('type')
                            {{$message}}<br>
                            @enderror
                            <label for="type">Tip reklame:</label><br>
                            Sport: <input type="radio" name="type" id="type" value="sport">
                            Filmovi: <input type="radio" name="type" id="type" value="film">
                            Muzika: <input type="radio" name="type" id="type" value="music">
                        </div>
                        <div class="form-group">
                            @error('age_group')
                            {{$message}}<br>
                            @enderror
                            <label for="age_group">Ciljana grupa: </label>
                            Tinejdžeri: <input type="radio" name="age_group" id="age_group" value="teenager">
                            Studenti: <input type="radio" name="age_group" id="age_group" value="student">
                            Roditelji: <input type="radio" name="age_group" id="age_group" value="parent">
                        </div>
                        @error('type')
                        {{$message}}<br>
                        @enderror
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <label for="image">Slika</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="image" id="submit">
                                    @error('image')
                                    {{$message}}<br>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="body">Vaša reklama:</label><br>
                            <textarea name="body" id="body" style="resize: none;height: 100px;width:300px;"></textarea>
                        </div>
                        <input type="submit" name="createAd" id="submit" value="Napravi reklamu">
                        @error('body')
                        <br>{{$message}}<br>
                        @enderror
                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection
