@extends('layouts.app')
@section('content')
    <div class="container">
        <form method="post" action="{{ url('/podcast/'.$podcast->id) }}" enctype="multipart/form-data">
            @csrf
            {{method_field('PATCH')}}
            @include('podcast.form', ['mode' => 'edit'])
        </form>
    </div>
@endsection
