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
                        	<form action="{{ url('dashboard/plantaciones') }}" method="POST" onsubmit="formSubmit(event, this)">
                        		@csrf
                        		@method('POST')
                        		<div class="form-row">
                        			<div class="col">
                        				<h3 class="page-header">Datos de la plantacion</h3>
                        			</div>
                        			<input type="hidden" name="reserva_id" value="{{ request()->reserva }}">
                        		</div>
                        		<div class="form-row justify-content-center">
                        			<div class="col-4 justify-content-center">
                        				<label for="">FECHA INICIO DEL CULTIVO</label>
                        				<input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
                        			</div>
                        			<div class="col-4">
                        				<label for="">FECHA APROXIMADA DE FINALIZACION</label>
                        				<input type="date" class="form-control" name="fecha_aprox_fin" required="" >
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
                        				<label for="">Etiqueto de identificacion</label>
                        				<input required maxlength="18" minlength="1" placeholder="ETIQUETA PARA IDENTIFICAR EL CULTIVO" type="text" name="etiqueta" class="form-control" id="etiqueta">
                        			</div>
                        			<div class="col">
                        				<label for="">Produccion aproximada</label>
                        				<input type="text" data-mask="000.00" data-mask-reverse="true" name="produce_aprox" id="produce_aprox" class="form-control">
                        			</div>
                        		</div>
                        		@php 
                        			$class = md5( \Carbon\Carbon::now()->format('Y-m-d H:m:s A') );
                        		@endphp

                        		<section id="fila-{{$class}}">
                        			<hr>
                        			<div class="form-row">
                        				<div class="col">
                        					<a class="btn btn-danger remove-row" data-row="{{$class}}">
                        						Quitar <i class="fa fa-times"></i>
                        					</a>
                        				</div>
                        			</div>
	                        		<div class="form-row" id="{{ $class }}">
	                        			<div class="col">
	                        				<label for="">Material usado</label>
	                        				<select name="inventario_id[]" id="inventario_id" required class="form-control">
	                        					<option value="">-- SELECCIONE UNO --</option>
		                        				@foreach( App\Inventario::all() as $inventario )
													@php
														$resta = 0;
														$resta += $inventario->movimientos->where('tipo_movimiento', 'INGRESO')->sum('cantidad');
														$resta -= $inventario->movimientos->where('tipo_movimiento', 'EGRESO')->sum('cantidad');
														$resta -= $inventario->usados_en_patio->sum('cantidad_usada');
														var_dump($resta);
													@endphp
													@if( $resta > 0 )
														<option value="{{ $inventario->id }}">{{ $inventario->nombre_equipo }}</option>
													@endif
		                        				@endforeach
	                        				</select>
	                        			</div>
	                        			<div class="col">
	                        				<label for="">Costo del material</label>
	                        				<input type="text" data-mask="00000000.00" data-mask-reverse="true" name="costo_material[]"  class="form-control {{ $class }}-costo costo_material" data-util="costo_material">
	                        			</div>
	                        			<div class="col">
	                        				<label for="">Cantidad usada</label>
	                        				<input type="text" value="0.00" data-mask="000000000.00" data-mask-reverse="true" class="form-control {{ $class }}-usado cantidad_usada" name="cantidad_usada[]" data-util="cantidad_usada">

	                        			</div>
	                        			<div class="col">
	                        				<label for="">Total </label>
	                        				<input type="text"  data-mask="000000000.00" data-mask-reverse="true" class="form-control {{ $class }}-total" name="monto_total[]" id="monto_total-{{$class}}" readonly>

	                        			</div>
	                        		</div>
                        		</section>
                        		<div id="filas"></div>
                        		<br>
                        		<div class="form-row">
                        			<div class="col">
                        				<a id="addData" class="btn btn-primary btn-sm">Agregar otra fila</a>
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
    
    @include('paginas.plantaciones.js')
@endsection