@extends ('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card" style="width:80%;">
                <div class="card-header">Moji postovi</div>
                <div class="card-body">
                </div>
                <div class="col-md-12">

                    @if($postsCount > 0)
                        @foreach($posts as $post)
                            <div class="align-content-md-center mb-1">
                                {{$post->body}}<br>
                            </div>

                            <form method="POST" action="deletePost/{{$post->id}}">
                                @csrf
                                @method('DELETE')
                                <div class="align-content-md-center">
                                    <input type="submit" id="submit" value="Obriši post">

                                </div>
                            </form>

                        @endforeach
                    @else
                        <p>Ups! Izgleda da trenutno nemate nijedan post. Bez brige, možete to prepraviti klikom na dugme
                            ispod.</p>
                        <form method="get" action="/home">
                            <input type="submit" value="Nazad na naslovnu stranu">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
