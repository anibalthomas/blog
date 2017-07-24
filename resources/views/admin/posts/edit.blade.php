@extends('admin.layout')
@section('header')
  <h1>
    POSTS
    <small>Crear publicación</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><a href="{{ route('admin.posts.index')}}"><i class="fa fa-list"></i> Posts</a></li>
    <li class="active">Crear</li>
  </ol>
@endsection
@section('content')
  <div class="row">          {{-- row y col-md-7 formato de columnas de 8 de 12 --}}
      @if ($post->photos->count())

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                @foreach ($post->photos as $photo)
                    <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                      {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                      <div class="col-md-2">
                        <button class="btn btn-danger btn-xs" style="position: absolute"><i class="fa fa-remove"></i></button>
                        <img class="img-responsive" src="{{ url($photo->url)}}">
                      </div>
                    </form>

                @endforeach
            </div>
        </div>
      </div>
    </div>
  @endif
    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
      {{ csrf_field() }}  {{ method_field('PUT') }}
    <div class="col-md-8">

      <div class="box box-primary">

          <div class="box-body">

                    <div class="form-group {{ $errors->has('title') ? 'has-error': ''}}">
                    {{-- <div class="form-group {{ $errors->has('title') ? si tiene un error : no tiene error}}"> --}}
                      <label>Título de la publicación</label>
                      <input name="title"
                             class="form-control"
                             value="{{ old('title', $post->title) }}"
                             placeholder="Ingresa aqui el titulo de la publicación">
                      {!! $errors->first('title', '<span class="help-block">:message</span>')!!}
                                  {{-- nombre del cambio                  mensaje automatico --}}
                    </div>

                    <div class="form-group {{ $errors->has('body') ? 'has-error': ''}}">
                      <label>Contenido publicación</label>
                      <textarea rows="10" name="body" id="editor" class="form-control" placeholder="Ingresa el contenido completo de la publicación">
                        {{ old('body', $post->body)}}
                      </textarea>
                      {!! $errors->first('body', '<span class="help-block">:message</span>')!!}
                    </div>
           </div>
      </div>

    </div>
    <div class="col-md-4">
      <div class="box box-primary">
        <div class="box-body">

                <div class="form-group">
                      <label>Fecha de publicación:</label>
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input name="published_at"
                               type="text"
                               class="form-control pull-right"
                               value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') :
                                  null)}}"
                               id="datepicker">
                      </div>
                  </div>

            <div class="form-group {{ $errors->has('category') ? 'has-error': ''}}">
                <label> Categorías</label>
                  <select  name="category" class="form-control" name="">
                      <option value="">Selecciona una categoría</option>
                      @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category', $post->category_id) == $category->id ? 'selected' : ''}}
                              >{{ $category->name }}</option>
                      @endforeach
                  </select>
                  {!! $errors->first('category', '<span class="help-block">:message</span>')!!}
            </div>

                    <div class="form-group {{ $errors->has('tags') ? 'has-error': ''}}">
                      <label>Etiquetas</label>
                      <select name="tags[]" class="form-control select2"
                              multiple="multiple"
                              data-placeholder="Selecciona una o más etiquetas" style="width: 100%;">
                        @foreach ($tags as $tag)
                            <option {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : ''}}
                                    value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                      </select>
                      {!! $errors->first('tags', '<span class="help-block">:message</span>')!!}
                    </div>

          <div class="form-group {{ $errors->has('excerpt') ? 'has-error': ''}} ">
            <label>Extracto publicación</label>
            <textarea name="excerpt"
                      class="form-control"
                      placeholder="Ingresa un extracto de la publicación">{{ old('excerpt', $post->excerpt)}}</textarea>
            {!! $errors->first('excerpt', '<span class="help-block">:message</span>')!!}
          </div>
          <div class="form-group">
            <div class="dropzone">

            </div>
          </div>
          <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
          </div>
        </div>
      </div>

    </div>

  </form>

  </div>


@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/dropzone.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/adminlte/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Select2 -->
<link rel="stylesheet" href="/adminlte/select2/dist/css/select2.min.css">
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>

  <!-- Select2 -->
<script src="/adminlte/select2/dist/js/select2.full.min.js"></script>

  <!-- bootstrap datepicker -->
  <script src="/adminlte/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
      <script>
            $('#datepicker').datepicker({
              autoclose: true
            })
    $('.select2').select2();
      </script>
      <!-- CK Editor -->
      <script src="/adminlte/ckeditor/ckeditor.js"></script>
<script>

CKEDITOR.replace('editor');
CKEDITOR.config.height = 328;   // la altura de editor de texto

var myDropzone = new Dropzone('.dropzone', {
    url: '/admin/posts/{{ $post->url}}/photos',
    // acceptedFiles: 'image/*',
    // mxFilesize: 2,
    // maxFiles: 1,
    paramName: 'photo',
    headers: {
      'X-CSRF-TOKEN': '{{ csrf_token()}}'
    },
    dictDefaultMessage: 'Arrastra las fotos aqui para subirlas',
    // dictMaxFilesExceeded: 'Limite de imagenes excedido'
});

myDropzone.on('error', function(file, res){
  var msg = res.photo[0];
  $('.dz-error-message:last > span').text(msg);
})

Dropzone.autoDiscover = false;

</script>

@endpush
