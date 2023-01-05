@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissable">
                {{Session::get('message')}}
            </div>
        @endif
        <a href="{{url('podcast/create')}}" class="btn btn-success mb-3">Agregar Podcast</a>
        <table class="table table-light">
            <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Autor</th>
                <th>Título</th>
                <th>Cover</th>
                <th>Thumbnail</th>
                <th>Audio</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($podcasts as $podcast)
                <tr>
                    <td>{{$podcast->id}}</td>
                    <td>{{$podcast->author}}</td>
                    <td>{{$podcast->title}}</td>
                    <td>
                        <img class="img-thumbnail img-fluid" width="100"
                             src="{{ asset('storage').'/'.$podcast->cover }}" alt="">
                    </td>
                    <td>
                        <img class="img-thumbnail img-fluid" width="100" height="200px"
                             src="{{ asset('storage').'/'.$podcast->thumbnail }}" alt="">
                    </td>
                    <td>
                        <audio controls>
                            <source src="{{ asset('storage').'/'.$podcast->audio }}" type="audio/ogg">
                            Your browser does not support the audio element.
                        </audio>
                    </td>
                    <td>
                        <a href="{{url('/podcast/'.$podcast->id.'/edit')}}" class="btn btn-warning">
                            Editar
                        </a> |
                        <form action="{{ url('/podcast/'.$podcast->id) }}" class="d-inline" method="post">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn btn-danger" type="submit" onclick="return confirm('Quieren borrar?')"
                                   value="Borrar">
                        </form>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $podcasts->links() !!}
    </div>
@endsection
