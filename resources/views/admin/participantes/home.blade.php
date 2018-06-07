@extends('layouts.app')

@section('content')

			
	<div class="container">
	    <div class="row">
	        <div class="col-md-10 col-md-offset-1">
	            <div class="panel panel-default">
		            <div class="panel-heading">
		            	<h4>Participantes</h4><br>
		       			@include('flash::message')
		       			<a href="{{ route('soluciones.create') }}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo</a>
		       			<div class="pull-left" style="padding-bottom: 20px;"">
							<form action="{{ url('/admin/participantes') }}" method="GET" class="form-inline" role="search">
	                        	<div class="form-group">
									<input type="text" name="parametro" id="solucion" class="" placeholder="Par&aacute;metro" pattern=".{3,}" oninvalid="setCustomValidity('Ingrese al menos 3 caracteres')" onchange="try{setCustomValidity('')}catch(e){} " value="{{ Request::get('parametro') }}" 
									/>
								</div>
								<button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search"></i></button>
							</form>
						</div>
						<br><br>

	           		</div>

		            <div class="panel-body" style="overflow:scroll;">
					  	
						<table class="table table-hover">
					        <thead>
					            <tr>
					                <th class="text-center">APELLIDOS</th>
					                <th class="text-center">NOMBRES</th>
					                <th class="text-center">C&Eacute;DULA</th>
					                <th class="text-center">MAIL</th>
					                <th class="text-center">CELULAR</th>
					                <th class="text-center">TEL&Eacute;FONO Y EXT</th>
					                <th class="text-center">GRUPO EN EL QUE PARTICIPAR&Aacute;</th>
					                <th class="text-center">TIPO PARTICIPANTE</th>
					                <!--  <th>Acci&oacute;n</th>  -->

					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($participantes as $user)
								<tr>
					                <td class="text-center">{{ $user->apellidos}}</td>
					                <td class="text-center">{{ $user->name}}</td>
					                <td class="text-center">{{ $user->cedula }}</td>
					                <td class="text-center">{{ $user->email }}</td>
					                <td class="text-center">{{ $user->celular }}</td>
					                <td class="text-center">{{ $user->telefono }}</td>
									<td class="text-center">{{ $user->sector->nombre_sector }}</td>
									<td class="text-center">{{ $user->vsector->nombre_vsector }}</td>

									<!--
					                <td>
					                	<a href="   '/soluciones/'.$solucion->id.'/edit' }}" class="btn btn-primary">Editar</a>  
					                	<button type="button" onclick="borrarSolucion(  $solucion->id }} , $solucion->verbo_solucion." a ".$solucion->sujeto_solucion." a ".$solucion->complemento_solucion }});" class="btn btn-danger" data-toggle="modal" data-target="#ventanaBorrarSolucion">Borrar</button>
					                	
					                </td>
					            	-->
					            </tr>
					            @endforeach		            
					        </tbody>
				    	</table>
					    <div class="row">
					    	<div class="col-md-offset-5">
					    		{!! $participantes->appends(["parametro" => Request::get("parametro")])->render() !!}
					    	</div>
					    </div>
					</div>
				</div>
			</div>				    
		
			
		</div>
	</div>

		
	<!-- VENTANA MODAL PARA ELIMINAR SOLUCION -->

	<div class="modal fade" id="ventanaBorrarSolucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<p id="nombre_solucion"></p>
				</div>
				<div class="modal-body">
					<div id="nombre_solucion2"></div>
					
				</div>
				<br><br>
				<div class="modal-footer">
					
					<input id="botonBorrarSolucion" type="button" class="btn btn-primary" value="Borrar">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>   					
				</div>

			</div>
		</div>
	</div>
	<!-- FIN VENTANA MODAL -->
@endsection
