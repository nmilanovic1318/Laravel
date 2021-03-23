@extends ('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="/users/{{ $user->id }}/edit" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @error('name')
                                    {{$message}}
                                    @enderror
                                    <label for="name">Ime:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="{{$user->name}}" id="name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @error('surname')
                                    {{$message}}
                                    @enderror
                                    <label for="surname">Prezime:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="surname" value="{{$user->surname}}" id="surname">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                    <label for="email">Email:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" value="{{$user->email}}" id="email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @error('date_of_birth')
                                    {{$message}}
                                    @enderror
                                    <label for="date_of_birth">Datum rođenja:</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="date_of_birth" value="{{$user->date_of_birth}}"
                                           id="date_of_birth">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    @error('image')
                                    {{$message}}
                                    @enderror
                                    <label for="image">Avatar</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="file" name="image" id="submit" value="{{ route('account.image', ['filename' => $user->name . '-' . $user->id . '.jpg']) }}" class="hidden"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input type="submit" name="edit" value="Izmeni profil" id="submit">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/users/{{ $user->id }}/edit">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <input type="submit" id="submit" name="delete"
                                           value="Obriši profil"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
