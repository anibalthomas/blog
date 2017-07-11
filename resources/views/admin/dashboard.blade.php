@extends('admin.layout')

@section('header')
  <h1>
    Page Header
    <small>Optional description</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
  </ol>
@endsection
@section('content')
  <h1>Dashboard</h1>
  <p>Usuario Autenticado: {{ auth()->user()->email }}</p>
@endsection
