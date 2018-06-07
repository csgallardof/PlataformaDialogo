@extends('layouts.app')

@section('content')

			
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1" style="margin-left: 0%">
            <div class="panel panel-default">
	            
	            

	            <div class="panel-heading">
	            	<h3>Detalle de n&oacute;mina de participantes.</h3>
	            	@include('flash::message')
				
					@if (count($errores) === 0)
						<form action="{{ url('/admin/participantes') }}" method="POST" id="formSubida">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="nombreArchivo" value="{{ $nombreArchivo }}">
						</form>	
						<button type="submit" form="formSubida" value="Subir" class="btn btn-success pull-right"><i class="fa fa-plus"></i> &nbsp;Cargar datos</button>
					@else
						<h3><b>Hoja:</b> <u>Registro</u></h3> <br><br>
						<ul>
							@foreach($errores as $error)
								<li>{{ $error  }}</li>
					        @endforeach
				        </ul>
						<b><ins>Nota:</ins></b>&nbsp; Los campos de celular y tel&eacute;fono/ext no son obligatorios.
						{{-- <a href="{{ route('participantes.create') }}" class="btn btn-primary pull-right">Regresar</a> --}}
						<a href="{{ route('soluciones.create') }}" class="btn btn-primary pull-right">Regresar</a>
			        @endif

		        </div>	
					
				
				<div class="panel-heading">
	            	<h4>{{ $nombreEvento }}</h4>
	            	<b>Vista Previa</b><br>
	            	A continuaci&oacute;n se muestra el listado de los nuevos participantes v&aacute;lidos no existentes.
				</div>
					            
	            <div class="panel-body">
				  	<table class="table table-hover">
				        <thead>
				            <tr>
				                <th class="text-center">NOMBRE EVENTO</th>
				                <th class="text-center">NOMBRES</th>
				                <th class="text-center">APELLIDOS</th>
				                <th class="text-center">C&Eacute;DULA</th>
				                <th class="text-center">MAIL</th>
				                <th class="text-center">CELULAR</th>
				                <th class="text-center">TELEFONO Y EXT</th>
				                <th class="text-center">GRUPO EN EL QUE PARTICIPAR&Aacute;</th>
				                <th class="text-center">TIPO PARTICIPANTE</th>
				            </tr>
				        </thead>
				        <tbody>
				        	@foreach($datos as $user)
							<tr>
								<td class="text-center">{{ $nombreEvento}}</td>
				                <td class="text-center">{{ $user->name}}</td>
				                <td class="text-center">{{ $user->apellidos }}</td>
				                <td class="text-center">{{ $user->cedula }}</td>
				                <td class="text-center">{{ $user->email }}</td>
				                <td class="text-center">{{ $user->celular }}</td>
								<td class="text-center">{{ $user->telefono }}</td>
								<td class="text-center">{{ $user->sector->nombre_sector }}</td>
								<td class="text-center">{{ $user->vsector->nombre_vsector }}</td>

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
