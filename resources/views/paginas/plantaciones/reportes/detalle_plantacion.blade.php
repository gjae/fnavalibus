<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalles de la plantacion</title>
</head>
<body>
	<style>
		*{
			font-family: Helvetica;
		}
		table#table1{
			border: 1px solid #000000;
		}
		tr#head_detail > th {
			border: 1px  solid #000000;
		}
		table#detalles {
			border-bottom: 1px solid #000000;
		}
		table#datos_rubros{
			border: 1px solid #000000;
		}
		tr#datos_rubro > th{
			border: 1px solid #000000;
		}
		tr#comparaciones > td{
			border-bottom: 1px solid #000000;
			border-right: 1px solid #000000;
			border-left: 1px solid #000000;
		}
	</style>
	
	<table id="table1" border="0" width="100%" cellpadding="0" cellspacing="0">
		<thead id="header">
			<tr>
				<th>
					AMBULATORIO EL PEDREGAL
				</th>
			</tr>
			<tr>
				<th>
					REPORTE DE DETALLE DE PLANTACION
				</th>
			</tr>
		</thead>
	</table>
	<table border="0" cellpadding="0" width="100%" cellspacing="0">
		<thead align="center">
			<tr>
				<th>
					<strong>PLANTACION: {{ $plantacion->etiqueta }}</strong>
				</th>
				<th>
					<strong>UNIDAD DE MEDIDA: {{ $plantacion->medida->codigo }}</strong>
				</th>
			</tr>
			<tr>
				<th>
					<strong>INICIO DE PLANTACION: {{ $plantacion->fecha_inicio->format('d-m-Y') }}</strong>
				</th>
				<th>
					<strong>FINALIZACION DE LA PLANTACION: {{ $plantacion->fecha_aprox_fin->format('d-m-Y') }}</strong>
				</th>
			</tr>
		</thead>
	</table>
	<table id="detalles" border="0" width="100%" cellspacing="0" cellpadding="0">
		<thead align="center">
			<tr id="head_detail">
				<th>Material</th>
				<th>U. Medida</th>
				<th>P. Unitario</th>
				<th>Cantidad</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			@php
				$total = 0;
			@endphp
			@foreach( $plantacion->detalles as $detalle )
				<tr align="center">
					<td>{{ $detalle->inventario->nombre_equipo }}</td>
					<td>{{ $detalle->inventario->medida->codigo }}</td>
					@php $total+= $detalle->monto_total; @endphp
					<td>{{ number_format($detalle->costo_material, 2, ',', '.') }}</td> 
					<td>{{ $detalle->cantidad_usada }}</td>
					<td>{{ number_format( $detalle->monto_total, 2, ',','.') }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<thead>
			<tr align="right">
				<th width="80%">
					<strong>TOTAL Bs: </strong>
				</th>
				<th align="center">
					<strong>{{ number_format($total, 2, ',', '.') }}</strong>
				</th>
			</tr>
		</thead>
	</table>
	<hr>
	<table border="0" width="100%" cellspacing="0" cellpadding="0">
		<thead>
			<tr id="datos_rubro" align="center">
				<th>RUBRO</th>
				<th>VALOR COMERCIAL</th>
				<th>TOTAL A PRODUCIR</th>
				<th>DIFERENCIA</th>
			</tr>
		</thead>
		<tbody align="center" >
			<tr id="comparaciones">
				<td>
					{{ $plantacion->reserva->descripcion }}
				</td>
				<td>
					{{ 'Bs '.number_format( $plantacion->reserva->costo_rubro_mercado, 2, ',', '.' ) }} / {{ $plantacion->reserva->medida->codigo }}
				</td>
				<td>
					{{ number_format( $plantacion->produce_aprox, 2, ',', '.' ) }} / {{ $plantacion->medida->codigo }}
					<hr>
					@php
						$equivalente_mercado = ($plantacion->produce_aprox * $plantacion->reserva->costo_rubro_mercado);
					@endphp
					{{ 'Bs '.number_format( $equivalente_mercado , 2, ',','.' ) }} 
					<br>
					<small style="font-size: 9px; color: red;"> 
						{{ $plantacion->reserva->medida->codigo .' PRODUCIDOS * VALOR COMERCIAL'  }} 
					</small>
				</td>
				<td>
					{{ 'Bs '.number_format( ( $total - $equivalente_mercado ), 2, ',', '.' ) }}
					<br>
					<small style="font-size: 8px; color: red;">
						TT. INVERTIDO - (V. COMERCIAL * {{ $plantacion->reserva->medida->codigo }} A PRODUCIR)
					</small>
				</td>
			</tr>
		</tbody>
	</table>

</body>
</html>