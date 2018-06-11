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
                        	<form action="{{ url('dashboard/almacen/'.$item->id) }}" method="POST">
                        		@csrf
                        		@method('PUT')
                        		<div class="form-row">
                        			<div class="col">
                        				<label for="">Nombre del item</label>
                        				<input type="text" value="{{ $item->nombre_equipo }}" required="" class="form-control" name="nombre_equipo" id="nombre_equipo" >
                        			</div>
                        			<div class="col">
                        				<label for="">Observacion</label>
                        				<input type="text" value="{{ $item->observacion }}" required="" class="form-control" name="observacion" id="observacion" >
                        			</div>
                        			<div class="col">
                        				<label for="">Unidad de medida</label>
                        				<select name="unidad_medidas" id="unidad_medidas" required="" class="form-control">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					@foreach(  App\UnidadMedida::all() as $unidad)
												<option {{ $item->unidad_medidas == $unidad->id ? 'selected' : '' }}  value="{{ $unidad->id }}">{{ $unidad->codigo }} ( {{ $unidad->descripcion }} )</option>
                        					@endforeach
                        				</select>
                        			</div>
                        			<div class="col">
                        				<label for="">Adquirido mediante</label>
                        				<select name="tipo_adquisicion" id="tipo_adquisicion" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>	
                        					<option {{ $item->tipo_adquisicion == 'COMPRA' ? 'selected' : '' }} value="COMPRA">
                        						COMPRA
                        					</option>
                        					<option {{ $item->tipo_adquisicion == 'DONACION' ? 'selected':'' }} value="DONACION">DONACION</option>
                        					<option {{ $item->tipo_adquisicion == 'COMODATO' ? 'selected':'' }} value="COMODATO">COMODATO</option>
                        				</select>
                        			</div>
                        		</div>
                        		<div class="form-row">
                        			<div class="col">
                        				<label for="">Tipo de equipo</label>
                        				<select name="tipo_equipo" id="tipo_equipo" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					<option {{ $item->tipo_equipo == 'SEMOVIENTE' ? 'selected' : '' }} value="SEMOVIENTE">
                        						SEMOVIENTE
                        					</option>
                        					<option {{ $item->tipo_equipo == 'MUEBLE' ? 'selected' : '' }}  value="MUEBLE">
                        						MUEBLE
                        					</option>
                        					<option {{ $item->tipo_equipo == 'INMUEBLE' ? 'selected' : '' }}  value="INMUEBLE">
                        						INMUEBLE
                        					</option>
                        					<option  {{ $item->tipo_equipo == 'MATERIAL_MEDICO' ? 'selected' : '' }}  value="MATERIAL_MEDICO">
                        						MATERIAL MEDICO
                        					</option>
                        					<option {{ $item->tipo_equipo == 'COMBUSTIBLES' ? 'selected' : '' }}  value="COMBUSTIBLES">
                        						COMBUSTIBLE
                        					</option>
                        					<option {{ $item->tipo_equipo == 'ALIMENTO' ? 'selected' : '' }}  value="ALIMENTO">
                        						ALIMENTO
                        					</option>
                        				</select>
                        			</div>
                        			<div class="col">
                        				<label for="">Fuente</label>
                        				<select name="fuente_adquisicion" id="fuente_adquisicion" class="form-control" required="">
                        					<option value="">-- SELECCIONE UNO --</option>
                        					<option {{ $item->fuente_adquisicion == 'PUBLICA' ? 'selected' : '' }}  value="PUBLICA">INSTITUCION PUBLICA</option>
                        					<option {{ $item->fuente_adquisicion == 'PRIVADA' ? 'selected' : '' }} value="PRIVADA">EMPRESA PRIVADA</option>
                        					<option {{ $item->fuente_adquisicion == 'MIXTA' ? 'selected' : '' }} value="MIXTA">EMPRESA MIXTA</option>
                        					<option {{ $item->fuente_adquisicion == 'INTERNACIONAL' ? 'selected' : '' }} value="INTERNACIONAL">ORIGEN INTERNACIONAL</option>
                        				</select>
                        			</div>
                        			<div class="col">
                        				<label for="">Codigo de documento de adquisicion</label>
                        				<input value="{{ $item->documento_adquisicion }}" type="text" name="documento_adquisicion" class="form-control" id="documento_adquisicion">
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