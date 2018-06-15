@extends('layouts.index')
@section('titulo', 'Modulo  de configuracion')

@section('body')
		
        <div class="content mt-3">
        	@if(\Session::has('success'))

                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Tarea realizada</h4>
                    <p{{ \Session::get('success') }}</p>
                </div>
        	@endif
            <div class="animated fadeIn">
                <div class="row">
				@csrf
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Data Table</strong>
                        </div>
                        <div class="card-body">
                        	<div class="container">
	                        	<div class="row">
	                        		<a href="{{ url('dashboard/plantaciones/create?reserva='.request()->reserva ) }}" class="btn btn-success">NUEVO</a>
	                        	</div>
                        	</div>
		                  <table id="bootstrap-data-table" align="center" class="table table-striped table-bordered">
		                    <thead>
		                    	<tr align="center">
		                    		<th>ID #</th>
		                    		<th>ETIQUETA</th>
		                    		<th>FECHA DE INICIALIZACION</th>
		                    		<th>FECHA DE FINALIZACION</th>
		                    		<th>MEDIDA</th>
                                    <th>PRODUCCION APROX.</th>
		                    		<th>OPCIONES</th>
		                    	</tr>
		                    </thead>
		                    <tbody>
		                    	@foreach(App\Plantacion::all() as $plantacion)
									<tr align="center">
										<td>{{ $plantacion->id }}</td>
										<td>{{ $plantacion->etiqueta }}</td>
										<td>{{ $plantacion->fecha_inicio->format('d-m-Y') }}</td>
                                        <td>{{ $plantacion->fecha_aprox_fin->format('d-m-Y') }}</td>
										<td>{{ $plantacion->medida->codigo }}</td>
                                        <td>{{ $plantacion->produce_aprox }}</td>
										<td>
											<button href="{{ url('dashboard/patios/'.$plantacion->id) }}" onclick="eliminar(event, this)" id="eliminar" class="btn btn-sm btn-danger">
												<i class="fa fa-trash-o"></i>
											</button>
                                            <button class="btn btn-primary btn-sm" id="printer" plantacion-id="{{ $plantacion->id }}">
                                                <i class="fa fa-print"></i>
                                            </button>
										</td>
									</tr>
		                    	@endforeach
		                    </tbody>
		                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
@endsection

@section('js')
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
              $('#bootstrap-data-table-export').DataTable();
              $("#printer").one('click', function(){
                    let plantacion = $(this).attr('plantacion-id');
                    var url = "http://"+location.host+"/dashboard/plantaciones/"+plantacion;
                    window.open(url, '' ,'width=800,height=900')
              });
        } );

        function eliminar(e, btn){
        	e.preventDefault();
        	var token = $("[name=_token]").val();
        	if( confirm('¿Seguro que desea eliminar este registro?') )
	        	$.post(btn.getAttribute('href'), {_token: token, _method: 'DELETE'}, function(resp){
	        		alert(resp.message);
	        		if( !resp.error )
	        			location.reload();
	        	});
        }
    </script>
@endsection