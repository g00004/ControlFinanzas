@extends('layouts.app')
@section('title','Balance')
@section('css')

@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Balance</h1>
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
      <div class="row justify-content-center pb-5">
          <div class="col-md-7 col-lg-7 col-7 mx-auto">
            
            <div id="tablareport">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mt-2">
                            Reporte Mensual {{$inicioMes}} / {{$finMes}}
                        </h3>
                    </div>
                    <div class="card-body">
    
                        <table class="table">
                            <tr>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-center" colspan="2">Entradas</th>
                                        </tr>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Monto</th>
                                        </tr>
                                        @php
                                            $sumTrada = 0;
                                        @endphp
                                        @foreach ($entradas as $entrada)
                                            <tr>
                                                <td>{{ $entrada->tipo_entrada }}</td>
                                                <td>${{ $entrada->monto }}</td>
                                            </tr>
                                            @php
                                                $sumTrada = $sumTrada +$entrada->monto;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <th>TOTAL</th>
                                            <th>${{ number_format($sumTrada,2) }}</th>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-center" colspan="2">Salidas</th>
                                        </tr>
                                        <tr>
                                            <th>Tipo</th>
                                            <th>Monto</th>
                                        </tr>
                                        @php
                                            $sumLida = 0;
                                        @endphp
                                        @foreach ($salidas as $salida)
                                            <tr>
                                                <td>{{ $salida->tipo_salida }}</td>
                                                <td>{{ $salida->monto }}</td>
                                            </tr>
                                            @php
                                                $sumLida = $sumLida + $salida->monto;
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <th>TOTAL</th>
                                            <th>${{ number_format($sumLida,2) }}</th>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        @php
                            $operacion = number_format($sumTrada - $sumLida,2);
                            $balance = ($operacion>=0)? $operacion : 0;
                        @endphp
                        <h3 class="text-center">Balance Mensual: ${{ $balance }}</h3>
                    </div>
                </div>
            </div>
            
            <div id="graficoreport">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center mt-2">
                        Gráfico de balance mensual Entradas vs Salidas
                        </h3>
                    </div>
                    <div class="card-body">
                        <canvas id="chartEntradasSalidas"></canvas>
                    </div>
                </div>
            </div>

            <a href="#" class="btn btn-danger" onclick="exportar()"><i class="fa fa-file-pdf-o"></i> Exportar</a>
          </div> 
      </div>    
    </div>

  </section>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    function exportar() {
        const tabla = document.getElementById('tablareport');
        const grafico = document.getElementById('graficoreport');

        html2canvas(tabla, {
            scale:3,
            onrendered: function(canvas1) {
            html2canvas(grafico, {
                scale:3,
                onrendered: function(canvas2) {
                var pdf = new jsPDF();
                pdf.addImage(canvas1.toDataURL('image/png',1), 'PNG', 10, 10, 150, 140);
                pdf.addImage(canvas2.toDataURL('image/png',1), 'PNG', 10, 160, 150, 110);
                pdf.save('reporte_balance.pdf');
                }
            });
            }
        });
    }


    var ctx = document.getElementById('chartEntradasSalidas').getContext('2d');
    var chartEntradasSalidas = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Entradas', 'Salidas'],
            datasets: [{
                data: [{{$totalEntradas}},{{$totalSalidas}}],
                backgroundColor: [
                    '#3498DB',
                    '#E74C3C'
                ],
                borderColor: [
                    '#3498DB',
                    '#E74C3C'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            width: 400,
            height: 400,  
        }
    });
</script>
@endsection