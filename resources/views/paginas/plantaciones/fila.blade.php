@php 
	$class = md5( \Carbon\Carbon::now()->format('Y-m-d H:m:s A') );
@endphp
<section >
	<hr>
    <div class="form-row" id="fila-{{$class}}">
        <div class="col">
            <a class="btn btn-danger remove-row" data-row="{{$class}}">
                Quitar <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
   <div class="form-row"  id="{{$class}}">
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
							@endphp
							@if( $resta > 0 )
								<option value="{{ $inventario->id }}">{{ $inventario->nombre_equipo }}</option>
							@endif
		            @endforeach
	            </select>
	    </div>
	    <div class="col">
	        <label for="">Costo del material</label>
	        <input type="text" value="0.00" data-mask="00000000.00" data-mask-reverse="true" name="costo_material[]"  class="form-control {{ $class }}-costo costo_material" data-util="costo_material">
	    </div>
	    <div class="col">
	    	<label for="">Cantidad usada</label>
	        <input type="text" value="0.00" data-mask="000000000.00" data-mask-reverse="true" class="form-control {{ $class }}-usado cantidad_usada" name="cantidad_usada[]" data-util="cantidad_usada">
		</div>
	    <div class="col">
	    	<label for="">Total </label>
	        <input type="text" value="0.00" data-mask="000000000.00" data-mask-reverse="true" class="form-control {{ $class }}-total" name="monto_total[]" id="monto_total-{{$class}}" readonly>

	 	</div>
   </div>
</section>
@include('paginas.plantaciones.js')