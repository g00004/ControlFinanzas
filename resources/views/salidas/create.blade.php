@extends('layouts.app')
@section('title', 'Crear Salida')
@section('css')
    <style>
        .error{
            color:brown;
        }
    </style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Crear Salida</h1>
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
                <div class="card-body">
                    <form id="formSalida" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="tipo_salida" class="form-label">Tipo de salida</label>
                                <input type="text" class="form-control" id="tipo_salida" name="tipo_salida" data-rule-required="true" data-msg-required="Requerido" autocomplete="off">
                            </div>
                        
                            <div class="col-md-4">
                                <label for="monto" class="form-label">Monto</label>
                                <input type="number" step="0.01" class="form-control" id="monto" name="monto" data-rule-required="true" data-msg-required="Requerido" autocomplete="off">
                            </div>
                        
                            <div class="col-md-4">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" data-rule-required="true" data-msg-required="Requerido" autocomplete="off">
                            </div>
                        
                            <div class="col-md-4">
                                <label for="factura" class="form-label">Factura</label>
                                <input type="file" class="form-control" id="factura" name="factura" accept="image/*" data-rule-required="true" data-msg-required="Requerido" autocomplete="off">
                            </div>
                        </div>
                        
                        <button type="button" onclick="GuardarSalida()" class="btn btn-primary">Guardar Salida <span id="loader"></span> </button>
                        <a href="{{ url()->previous() }}" class="btn btn-dark">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('js')
<script>
    function GuardarSalida(){
        if ($("#formSalida").valid()) {
            var datos = new FormData($("#formSalida")[0]);
            $.ajax({                  
                type: "POST",
                url: "/guardar_salida",
                data: datos,
                async: true,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $("#loader").addClass('fa fa-refresh fa-spin');
                }
            })
            .done(function (response) {
                $("#loader").removeClass('fa fa-refresh fa-spin');
                Swal.fire({
                    icon: response.tipo,
                    text: response.mensaje,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar'
                }).then((result) => {
                    if(response.tipo == 'success'){
                        $('#formSalida')[0].reset();
                    }else{

                    }
                })
            })
        }
    }
</script>
@endsection