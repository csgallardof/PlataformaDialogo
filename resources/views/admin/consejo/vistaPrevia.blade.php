@extends('layouts.app')

@section('content')

			
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1" style="margin-left: 0%">
            <div class="panel panel-default">
	            
	            

	            <div class="panel-heading">
	            	@include('flash::message')
				</div>
				
				@if (count($errores) === 0)
					
					<form action="{{ url('admin/ccpt') }}" method="POST" id="formSubida">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="nombreArchivo" value="{{ $nombreArchivo }}">
					</form>	
					<button type="submit" form="formSubida" value="Subir" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Cargar datos</button>
					
					
					{{-- <a href="{{ url("participantes/vistaPrevia/".$nombreArchivo ) }}" class="btn btn-primary pull-right">&nbsp;Siguiente</a> --}}

				@else
					<div class="panel-heading">
						<ul>
							@foreach($errores as $error)
								<li>{{ $error  }}</li>
					        @endforeach
				        </ul>
					</div>	
			        <a href="{{ route('ccpt.create') }}" class="btn btn-primary pull-right">Regresar</a>
		        @endif		
					
				
				<div class="panel-heading">
	            	<h4>Consejo Consultivo Productivo Tributario</h4>
	            	<b>Vista Previa </b>
				</div>
					            
	            <div class="panel-body">
				  	<table class="table table-hover">
				        <thead>
				            <tr>
				                <th># FILA</th>
				                <th class="text-center">MESA</th>
				                <th class="text-center">PROPUESTA ORIGINAL</th>
				                <th class="text-center">FOMENTO DE LA PRODUCCI&Oacute;N NACIONAL</th>
				                <th class="text-center">&Aacute;MBITO</th>
				                <th class="text-center">SECTOR</th>
				                <th class="text-center">RESPONSABLE</th>
				                <th class="text-center">CORRESPONSABLES</th>
				                <th class="text-center">ESLAB&Oacute;N DE LA CADENA</th>
				                <th class="text-center">PROPUESTAS UNIFICADAS</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $c=2 ?>
				        	@foreach($datos as $solucion)
							<tr>
								<td class="text-center">{{ $c++ }}</td>
				                <td class="text-center">{{ $solucion->mesa->nombre_mesa}}</td>
				                <td class="text-center">{{ $solucion->solucion_ccpt}}</td>
				                <td class="text-center">{{ $solucion->thematic->nombre_thematic}}</td>
				                <td class="text-center">{{ $solucion->ambit->nombre_ambito}}</td>
				                <td class="text-center">{{ $solucion->sector->nombre_sector }}</td>
				                <td class="text-center">{{ $solucion->responsable_solucion }}</td>
				                <td class="text-center">{{ $solucion->corresponsable_solucion }}</td>
				                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
								<td class="text-center">{{ $solucion->pajustada->nombre_pajustada }}</td>

				            </tr>
				            @endforeach		            
				        </tbody>
			    	</table>
			    	
				</div>
			</div>
		</div>				    
	
		
	</div>
</div>

	
@endsection

