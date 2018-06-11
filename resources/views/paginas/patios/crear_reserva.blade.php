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
                            <strong class="card-title">Gestion de patios</strong>
                        </div>
                        <div class="card-body">
                        	<form action="{{ url('dashboard/patios') }}" method="POST" onsubmit="formSubmit(event, this)">
                        		@csrf
                        		@method('POST')
                        		<div class="form-row justify-content-center">
                        			<div class="col-4 justify-content-center">
                        				<label for="">Descripcion</label>
                        				<input type="text" class="form-control" name="descripcion" id="descripcion">
                        			</div>
                        			<div class="col-3">
                        				<label for="">Costo en mercado</label>
                        				<input type="text" class="form-control" name="costo_rubro_mercado" required="" data-mask="000.000.000.000.000,00" data-mask-reverse="true">
                        			</div>
                        		</div>
                        		<div class="form-row justify-content-center">
                        			<div class="col">
                        				<label for="">Unidad de medida</label>
                        				<select name="unidad_medida_id" id="unidad_medida_id" class="form-control" required="">
	                        				<option value="">-- SELECCIONE UNO --</option>
	                        				@foreach(App\UnidadMedida::all() as $unidad)
	                        					<option value="{{ $unidad->id }}">{{ $unidad->codigo }} ( {{ $unidad->descripcion }} )</option>
	                        				@endforeach
                        				</select>
                        			</div>
                        			<div class="col">
                        				<label for="">Tipo de reserva</label>
                        				<select name="tipo_material_id" id="tipo_material_id" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					@foreach( App\TipoMaterial::all() as $tipo)
												<option value="{{ $tipo->id }}">{{ $tipo->nombre_tipo }}</option>
                        					@endforeach
                        				</select>
                        			</div>
                        			<div class="col">
                        				<label for="">Produccion a</label>
                        				<select name="tiempos_duracion_id" id="tiempos_duracion_id" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					@foreach(App\TiemposDuracion::all() as $tiempo)
												<option value="{{ $tiempo->id }}">
													{{ $tiempo->descripcion }} ( de {{ $tiempo->semanas_inicial }} a {{ $tiempo->semanas_final }} semanas )
												</option>
                        					@endforeach
                        				</select>
                        			</div>
                        		</div>
                        		<div class="form-row justify-content-center">
                        			<div class="col-3">
                        				<label for="">Tipo de rubro</label>
                        				<select name="tipo_rubro" id="tipo_rubro" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					<option value="CRIA">CRIA DE ANIMALES</option>
                        					<option value="VEGETAL">VEGETALES Y/O ORTALIZAS</option>
                        					<option value="FRUTAL">FRUTAL</option>
                        					<option value="FLORAL">FLORAL</option>
                        					<option value="OTROS">OTROS</option>
                        				</select>
                        			</div>
                        			<div class="col-3">
                        				<label for="">Destinado a</label>
                        				<select name="finalidad" id="finalidad" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					<option value="CONSUMO_INTERNO"> CONSUMO INTERNO DE LA ORGANIZACION </option>
                        					<option value="VENTA">VENTAS</option>
                        					<option value="DONACION">DONACIONES</option>
                        					<option value="CONSUMO_COMUNIDAD">CONSUMO DE LA COMUNIDAD</option>
                        				</select>
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
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
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