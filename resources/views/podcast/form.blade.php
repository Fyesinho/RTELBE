<h1>{{$mode === 'edit' ? 'Editar' : 'Crear' }} podcast</h1>

@if(count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif

<div class="form-group">
    <label for="author">Autor</label>
    <input type="text" class="form-control" name="author" value="{{isset($podcast->author) ? $podcast->author : ''}}">
</div>
<div class="form-group">
    <label for="title">Título</label>
    <input type="text" class="form-control" name="title" value="{{isset($podcast->title) ? $podcast->title : ''}}">
</div>
<div class="form-group">
    <label for="cover">Cover</label>
    @if(isset($podcast->cover))
        <img class="img-thumbnail img-fluid" width="100" src="{{ asset('storage').'/'.$podcast->cover }}" alt="">
    @endif
    <input class="form-control" type="file" name="cover" value="">
</div>
<div class="form-group">
    <label for="thumbnail">Imagen pequeña</label>
    @if(isset($podcast->thumbnail))
        <img class="img-thumbnail img-fluid" width="100"  src="{{ asset('storage').'/'.$podcast->thumbnail }}" alt="">
    @endif
    <input class="form-control" type="file" name="thumbnail">
</div>
<div class="form-group">
    <label for="audio">Audio</label>
    @if(isset($podcast->audio))
        <img class="img-thumbnail img-fluid" width="100"  src="{{ asset('storage').'/'.$podcast->audio }}" alt="">
    @endif
    <input class="form-control" type="file" name="audio">
</div>
<input class="btn btn-success" type="submit" value="{{$mode === 'edit' ? 'Editar' : 'Guardar' }}">
<a class="btn btn-primary" href="{{url('podcast')}}">Regresar</a>



