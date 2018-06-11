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
                            <strong class="card-title">Gestion de inventario</strong>
                        </div>
                        <div class="card-body">
                        	<form action="{{ url('dashboard/movimientos?item='.$item->id) }}" method="POST">
                        		@csrf
                        		@method('POST')
                        		<input type="hidden" name="inventario_id" value="{{ $item->id }}">
                        		<div class="form-row">
                        			<div class="col">
                        				<label for="">Fecha del movimiento</label>
                        				<input type="date" required="" class="form-control" name="fecha_movimiento" id="fecha_movimiento"  >
                        			</div>
                        			<div class="col">
                        				<label for="">Observacion</label>
                        				<input type="text" required="" class="form-control" name="observacion" id="observacion" >
                        			</div>
                        			<div class="col-2">
                        				<label for="">Cantidad</label>
                        				<input type="number" required="" class="form-control" name="cantidad" id="cantidad" >
                        			</div>
                        		</div>
                        		<div class="form-row">
                        			<div class="col">
                        				<label for="">Tipo de movimiento</label>
                        				<select name="tipo_movimiento" id="tipo_movimiento" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					<option value="INGRESO">INGRESO</option>
                        					<option value="EGRESO">EGRESO</option>
                        				</select>
                        			</div>
                        			<div class="col-4">
                        				<label for="">Costo (SOLO SI GENERO COSTO)</label>
                        				<input type="text" required="" class="form-control" name="cantidad" id="cantidad" >
                        			</div>
                        		</div>
                        		<br>
                        		<div class="form-row">
                        			<hr>
                        			<br>
                        			<div class="col">
                        				<input type="submit" class="btn btn-block btn-large btn-success" value="Guardar">
                        			</div>
                        		</div>
                        	</form>
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