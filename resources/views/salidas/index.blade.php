@extends('layouts.app')
@section('title', 'Salidas')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Salidas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li> --}}
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ url('salida') }}" class="btn btn-primary">Agregar Salida</a>
                </div>
                <div class="card-body">
                     <table id="salidas" class="table">
                        <thead>
                            <tr>
                                <th style="width: 150px">Factura</th>
                                <th>Tipo Salida</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salidas as $salida)
                            <tr>
                                <td>
                                    <a href="{{ asset($salida->factura) }}" data-lightbox="Factura">
                                        <img src="{{ asset($salida->factura) }}" alt="factura" width="50px">
                                    </a>
                                </td>
                                <td>{{ $salida->tipo_salida }}</td>
                                <td>{{ $salida->monto }}</td>
                                <td>{{ $salida->fecha }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{$salida->id}})">Eliminar</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#salidas').DataTable();
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Advertencia',
            text: "¿Estás seguro que deseas eliminar esta salida?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({                  
                    type: "POST",
                    url: "{{url('salida_destroy')}}",
                    data: { 'id':id,'_token':'{{csrf_token()}}'} 
                })
                .done(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Salida Eliminada',
                        showConfirmButton: false,
                        timer: 700
                    });
                    location.reload();
                })
            }
        });
    }
</script>
@endsection
