@extends('layouts.app')
@section('title','Inicio')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Inicio</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li> --}}
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">

    <div class="container">
      <div class="row justify-content-center">
          <div class="col-lg-6 col-6 mx-auto">
              <div class="callout callout-success">
                  <h5>BIENVENIDO {{Auth::user()->name}}</h5>
                  <p>Sistema de control de finanzas (entradas y salidas)</p>
              </div>
          </div> 
      </div>    
    </div>

  </section>
@endsection