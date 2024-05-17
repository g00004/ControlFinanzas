@extends('layouts.app')
@section('title', 'Entradas')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Entradas</h1>
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
                    <a href="{{ url('entrada') }}" class="btn btn-primary">Agregar Entrada</a>
                </div>
                <div class="card-body">
                     <table id="entradas" class="table">
                        <thead>
                            <tr>
                                <th style="width: 150px">Factura</th>
                                <th>Tipo Entrada</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($entradas as $entrada)
                            <tr>
                                <td>
                                    <a href="{{ asset($entrada->factura) }}" data-lightbox="Factura">
                                        <img src="{{ asset($entrada->factura) }}" alt="factura" width="50px">
                                    </a>
                                </td>
                                <td>{{ $entrada->tipo_entrada }}</td>
                                <td>{{ $entrada->monto }}</td>
                                <td>{{ $entrada->fecha }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{$entrada->id}})">Eliminar</button>
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
        $('#entradas').DataTable();
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Advertencia',
            text: "¿Estás seguro que deseas eliminar esta entrada?",
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
                    url: "{{url('entrada_destroy')}}",
                    data: { 'id':id,'_token':'{{csrf_token()}}'} 
                })
                .done(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Entrada Eliminada',
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
