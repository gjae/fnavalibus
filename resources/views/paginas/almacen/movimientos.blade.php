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
	                        		<a href="{{ url('dashboard/movimientos/create?item='.$item->id) }}" class="btn btn-success">NUEVO</a>
	                        	</div>
                        	</div>
		                  <table id="bootstrap-data-table" class="table table-striped table-bordered">
		                    <thead>
		                    	<tr>
		                    		<th>ID #</th>
		                    		<th>FECHA</th>
		                    		<th>OBSERVACION</th>
		                    		<th>CANTIDAD</th>
		                    		<th>TIPO</th>
		                    		<th>COSTO</th>
		                    	</tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($item->movimientos as $movimiento)
									<tr>
										<td>{{ $movimiento->id }}</td>
										<td>{{ $movimiento->fecha_movimiento->format('d-m-Y') }}</td>
										<td>{{ $movimiento->observacion }}</td>
										<td>{{ $movimiento->cantidad }}</td>
										<td>{{ $movimiento->tipo_movimiento }}</td>
										<td>{{ number_format($movimiento->costo_movimiento, 2) }}</td>
										<td>
											<a href="{{ url('dashboard/almacen/'.$item->id.'/edit') }}" class="btn btn-sm btn-warning">EDITAR</a>
											<button href="{{ url('dashboard/almacen/'.$item->id) }}" onclick="eliminar(event, this)" id="eliminar" class="btn btn-sm btn-danger">ELIMINAR</button>
                                            <a href="{{ url('dashboard/movimientos?item='.$item->id) }}" class="btn btn-sm btn-primary">MOVIMIENTOS</a>
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