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
					
					<a href="{{ url('/admin/participantes/vistaPrevia/'.$nombreArchivo ) }}" class="btn btn-primary pull-right">{{-- <i class="glyphicon glyphicon-plus"></i> --}}&nbsp;Siguiente</a>
				@else
					<div class="panel-heading">
						<h3><b>Hoja:</b> <u>Mesas</u></h3> <br><br>
						<ul>
							@foreach($errores as $error)
								<li>{{ $error  }}</li>
					        @endforeach
				        </ul>
					</div>	
			        <a href="{{ route('soluciones.create') }}" class="btn btn-primary pull-right">Regresar</a>
		        @endif		
					
				
				<div class="panel-heading">
	            	<h4>{{ $nombreEvento }}</h4>
	            	<b>Vista Previa </b>
				</div>
					            
	            <div class="panel-body">
				  	<table class="table table-hover">
				        <thead>
				            <tr>
				                <th># FILA</th>
				                <th class="text-center">EVENTO</th>
				                <th class="text-center">GRUPO</th>
				                <th class="text-center">PROVINCIA</th>
				                <th class="text-center">ESLAB&Oacute;N DE LA CADENA PRODUCTIVA</th>
				                <th class="text-center">PROBLEM&Aacute;TICA</th>
				                <th class="text-center">SOLUCI&Oacute;N</th>
				                <th class="text-center">INSTRUMENTOS NECESARIOS</th>
				                <th class="text-center">CLASIFICACI&Oacute;N EMPRESA RELACIONADA</th>
				                <th class="text-center">&Aacute;MBITO</th>
				                <th class="text-center">RESPONSABLE DE EJECUCI&Oacute;N</th>
				                <th class="text-center">CO-RESPONSABLES DE EJECUCIÓN</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $c=9 ?>
				        	@foreach($datos as $solucion)
							<tr>
								<td class="text-center">{{ $c++ }}</td>
				                <td class="text-center">{{ $nombreEvento}}</td>
				                <td class="text-center">{{ $sector->nombre_sector}}</td>
				                <td class="text-center">{{ $solucion->provincia->nombre_provincia}}</td>
				                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
				                <td class="text-center">{{ $solucion->problema_solucion }}</td>
				                <td class="text-center">{{ $solucion->verbo_solucion." a ".$solucion->sujeto_solucion." a ".$solucion->complemento_solucion }}</td>
				                <td class="text-center">{{ $solucion->instrumento->nombre_instrumento }}</td>
								<td class="text-center">{{ $solucion->tipoEmpresa->nombre_tipo_empresa }}</td>
								<td class="text-center">{{ $solucion->ambit->nombre_ambit }}</td>
								<td class="text-center">{{ $solucion->responsable_solucion }}</td>
								<td class="text-center">{{ $solucion->corresponsable_solucion }}</td>

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

