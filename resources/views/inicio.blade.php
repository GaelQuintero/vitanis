@extends('templates.base')

@section('title', env('APP_NAME') . ' Inicio')
@extends('templates.nav')
@section('body')
    <div class=" container p-4 animate__animated animate__fadeIn" data-bs-theme="dark">
        <div class="row">
            <div class="col-md-12 mb-3 ">
                <h4>Inicio</h4>
            </div>
            <form class="row" id="filterForm">
                <div class="col-md-4 mb-3">
                    <label class="form-label filtro-label">Producto</label>
                    <select class="form-control" id="producto_id" name="producto_id">
                        <option value="" selected>Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="col-md-12 mb-3 text-end">
                <button class="btn me-2 btn-primary" onclick="drawChart();" id="buscarBtn">Buscar</button>
            </div>
            <div class="col-md-12 mb-3 animate__animated animate__fadeIn">
                <div id="chart_div" style="width: 100%; height: 100%;"></div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('lib/charts/chart.js') }}"></script>
    <script type="text/javascript">
        if (typeof google === 'undefined' || typeof google.charts === 'undefined') {
            console.error("Google Charts no está disponible. Asegúrate de cargarlo localmente.");
        } else {
            google.charts.load('current', {
                packages: ['corechart', 'bar']
            });
        }
        google.charts.setOnLoadCallback(drawChart);

        async function drawChart() {
            try {
                const producto_id = document.getElementById('producto_id').value;
                if (!producto_id) {
                    console.error("Error: No se ha seleccionado un producto.");
                    return;
                }

                const url = route("movimientos.show", producto_id);
                const response = await fetch(url);
                const result = await response.json();
                console.log("Datos recibidos:", result);

                if (!result.data || result.data.length === 0) {
                    document.getElementById('chart_div').innerHTML =
                        "<p style='text-align:center;color:red;'>No hay datos disponibles.</p>";
                    return;
                }

                let data = new google.visualization.DataTable();
                data.addColumn('string', 'Fecha');
                data.addColumn('number', 'Entradas');
                data.addColumn('number', 'Salidas');
                data.addRows(result.data);

                var options = {
                    title: 'Movimientos del Producto',
                    backgroundColor: '#222', // Fondo oscuro
                    titleTextStyle: {
                        color: '#fff'
                    }, // Título blanco
                    width: '100%',
                    height: 500,
                    chartArea: {
                        width: '80%',
                        height: '70%',
                        backgroundColor: '#222'
                    },
                    hAxis: {
                        title: 'Cantidad',
                        textStyle: {
                            color: '#fff'
                        },
                        titleTextStyle: {
                            color: '#fff'
                        }
                    },
                    vAxis: {
                        title: 'Fecha',
                        textStyle: {
                            color: '#fff'
                        },
                        titleTextStyle: {
                            color: '#fff'
                        }
                    },
                    legend: {
                        position: 'top',
                        textStyle: {
                            color: '#fff'
                        }
                    }, // Etiquetas debajo del título
                    bars: 'horizontal', // Cambia a barras horizontales
                    colors: ['#4CAF50', '#F44336'], // Verde para entradas, rojo para salidas
                };

                var chart = new google.visualization.BarChart(document.getElementById('chart_div')); // Usa BarChart
                chart.draw(data, options);

                window.addEventListener('resize', function() {
                    chart.draw(data, options);
                });

            } catch (error) {
                console.error('Error al cargar datos del gráfico:', error);
                document.getElementById('chart_div').innerHTML =
                    "<p style='text-align:center;color:red;'>Error al cargar la gráfica.</p>";
            }
        }
    </script>
@endpush
