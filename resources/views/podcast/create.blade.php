@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{url('/podcast')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('podcast.form', ['mode' => 'create'])
        </form>
    </div>
@endsection
