@extends('admin.layout')

@section('header')
  <h1>
    POSTS
    <small>Listado</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li class="active">Posts</li>
  </ol>
@endsection
@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Listado de publicaciones</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="posts-table" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Titulo</th>
          <th>Estracto</th>
          <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->excerpt }}</td>
              <td>
                <a href="#" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                <a href="#" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
              </td>
            </tr>


          @endforeach
        </tbody>


      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
@endsection

@push('styles')
  <!-- Datatables -->
 <link rel="stylesheet" href="/adminlte/datatables.net-bs/css/dataTables.bootstrap.min.css">

@endpush
@push('scripts')
  <!-- Datatables -->

  <script src="/adminlte/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="/adminlte/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script>
    $(function () {
      $('#posts-table').DataTable();

    });
  </script>
@endpush
