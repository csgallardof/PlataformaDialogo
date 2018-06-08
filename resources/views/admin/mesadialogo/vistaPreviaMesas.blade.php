@extends('layouts.app')

@section('content')
			
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1" style="margin-left: 0%">
            <div class="panel panel-default">

	            <div class="panel-heading">
	            	@include('flash::message')
				</div>
				
				@if (count($errores) === 0 && count($errores_participante) === 0 && count($errores_solucion) === 0)					
					<form action="{{ url('/admin/mesadialogo') }}" method="POST" id="formGuardarDatos">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="mesa_dialogo" value="{{ $mesa_dialogo }}">
						<input type="hidden" name="datos_participante" value="{{ $datos_participante }}">
						<input type="hidden" name="datos_solucion" value="{{ $datos_solucion }}">
						<button type="submit" form="formGuardarDatos" value="Guardar" class="btn btn-success pull-right">&nbsp;Guardar</button>
					</form>					
				@else
					<div class="panel-heading">
						@if(isset($errores) && count($errores) > 0)
							<h3><b>Errores Hoja:</b> <u>Datos de la Mesa</u></h3>
							<ul>
								@foreach($errores as $error)
									<li>{{ $error }}</li>
						        @endforeach
					        </ul>
				        @endif
				        @if(isset($errores_participante) && count($errores_participante) > 0)				        	
							<h3><b>Errores Hoja:</b> <u>Participantes</u></h3>
							<ul>
								@foreach($errores_participante as $error)
									<li>{{ $error }}</li>
						        @endforeach
					        </ul>
				        @endif
				        @if(isset($errores_solucion) && count($errores_solucion) > 0)				        	
							<h3><b>Errores Hoja:</b> <u>Propuestas</u></h3>
							<ul>
								@foreach($errores_solucion as $error)
									<li>{{ $error }}</li>
						        @endforeach
					        </ul>
				        @endif
					</div>	
			        <a href="{{ route('mesadialogo.matrizCarga') }}" class="btn btn-primary pull-right">Regresar</a>
		        @endif		
					
				
				<div class="panel-heading">
	            	<h4>Vista previa Mesa de Di&aacute;logo</h4>
	            	<div class="row">
	            		<div class="col-md-2"><b>Nombre:</b></div>
	            		<div class="col-md-5">{{ $mesa_dialogo->nombre }}</div>
	            		<div class="col-md-2"><b>Tipo:</b></div>
	            		<div class="col-md-3">
	            			@if(isset($mesa_dialogo->tipo_dialogo_id))
	            				{{ $mesa_dialogo->tipoDialogo->nombre }}
	            			@endif
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Organizador:</b></div>
	            		<div class="col-md-5">
	            			@if(isset($mesa_dialogo->organizador_id))
	            				{{ $mesa_dialogo->organizador->nombre_institucion }}
	            			@endif
	            		</div>
	            		<div class="col-md-2"><b>Consejo Sectorial:</b></div>
	            		<div class="col-md-3">
	            			@if(isset($mesa_dialogo->consejo_sectorial_id))
	            				{{ $mesa_dialogo->consejoSectorial->nombre_consejo }}
	            			@endif
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>L&iacute;der:</b></div>
	            		<div class="col-md-5">{{ $mesa_dialogo->lider }}</div>
	            		<div class="col-md-2"><b>Coordinador:</b></div>
	            		<div class="col-md-3">{{ $mesa_dialogo->coordinador }}</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Zona:</b></div>
	            		<div class="col-md-5">	            			
	            			@if(isset($mesa_dialogo->zona_id))
	            				{{ $mesa_dialogo->zona->nombre }}
	            			@endif
	            		</div>
	            		<div class="col-md-2"><b>Provincia:</b></div>
	            		<div class="col-md-3">
	            			@if(isset($mesa_dialogo->provincia_id))
	            				{{ $mesa_dialogo->provincia->nombre_provincia }}
	            			@endif
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Cant&oacute;n:</b></div>
	            		<div class="col-md-5">
	            			@if(isset($mesa_dialogo->canton_id))
	            				{{ $mesa_dialogo->canton->nombre_canton }}
	            			@endif
	            		</div>
	            		<div class="col-md-2"><b>Parroquia:</b></div>
	            		<div class="col-md-3">
	            			@if(isset($mesa_dialogo->parroquia_id))
	            				{{ $mesa_dialogo->parroquia->nombre_parroquia }}
	            			@endif
	            		</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Lugar:</b></div>
	            		<div class="col-md-5">{{ $mesa_dialogo->lugar }}</div>
	            		<div class="col-md-2"><b>Grupo:</b></div>
	            		<div class="col-md-3">{{ $mesa_dialogo->organizacion }}</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Sector:</b></div>
	            		<div class="col-md-5">
							@if(isset($mesa_dialogo->sector_id))
	            				{{ $mesa_dialogo->sector->nombre_sector }}
	            			@endif
	            		</div>
	            		<div class="col-md-2"><b>Fecha:</b></div>
	            		<div class="col-md-3">{{ $mesa_dialogo->fecha }}</div>
	            	</div>
	            	<div class="row">
	            		<div class="col-md-2"><b>Descripci&oacute;n:</b></div>
	            		<div class="col-md-10">{{ $mesa_dialogo->descripcion }}</div>
	            	</div>
				</div>
				
				<div class="panel-body table-responsive">
				  	<table class="table table-hover">
				  		<caption><strong>&nbsp;Listado de participantes validados</strong></caption>
				        <thead>
				            <tr>
				                <th>Fila</th>
				                <th class="text-center">Nombres</th>
				                <th class="text-center">Apellidos</th>
				                <th class="text-center">Email</th>
				                <th class="text-center">Celular</th>
				                <th class="text-center">Tel&eacute;fono y ext</th>
				                <th class="text-center">Grupo en el que participar&aacute;</th>
				                <th class="text-center">Tipo participante</th>
				                <th class="text-center">Empresa</th>
				                <th class="text-center">Cargo</th>
				                <th class="text-center">Sector empresa</th>
			            	</tr>
				        </thead>
				        <tbody>
				        	<?php $c=2 ?>
				        	@if(isset($datos_participante))
					        	@foreach($datos_participante as $participante)
									<tr>
										<td class="text-center">{{ $c++ }}</td>
						                <td class="text-left">{{ $participante->nombres }}</td>
						                <td class="text-left">{{ $participante->apellidos }}</td>
						                <td class="text-left">{{ $participante->email }}</td>
						                <td class="text-right">{{ $participante->celular }}</td>
						                <td class="text-right">{{ $participante->telefono_ext }}</td>
						                <td class="text-left">
						                	@if(isset($participante->sector_id))
							                	{{ $participante->sector->nombre_sector }}
							                @endif
						                </td>
						                <td class="text-left">
						                	@if(isset($participante->tipo_participante_id))
						                		{{ $participante->tipoParticipante->nombre }}
						                	@endif
						                </td>
										<td class="text-left">{{ $participante->empresa }}</td>
										<td class="text-left">{{ $participante->cargo }}</td>
										<td class="text-left">
											@if(isset($participante->sector_empresa_id))
												{{ $participante->sectorEmpresa->nombre_sector }}
											@endif
										</td>
						            </tr>
					            @endforeach
				            @endif            
				        </tbody>
			    	</table>			    	
				</div>

	            <div class="panel-body table-responsive">
				  	<table class="table table-hover">
				  		<caption><strong>&nbsp;Listado de propuestas validadas</strong></caption>
				        <thead>
				            <tr>
				                <th>Fila</th>
				                <th class="text-center">Eslab&oacute;n de la cadena productiva</th>
				                <th class="text-center">Propuesta de soluci&oacutr;n</th>
				                <th class="text-center">Propuesta ajustada</th>
				                <th class="text-center">palabras clave</th>
				                <th class="text-center">&Aacute;mbito</th>
				                <th class="text-center">Responsable de ejecuci&oacute;n</th>
				                <th class="text-center">Co-responsables de ejecuci&oacute;n</th>
				                <th class="text-center">Fecha cumplimiento</th>
				                <th class="text-center">Plazo cumplimiento</th>
				                <th class="text-center">Riesgos</th>
				                <th class="text-center">Supuestos</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php $c=3 ?>
				        	@if(isset($datos_solucion))
					        	@foreach($datos_solucion as $solucion)
									<tr>
										<td class="text-center">{{ $c++ }}</td>
						                <td class="text-left">
						                	@if(isset($solucion->sipoc_id))
												{{ $solucion->sipoc->nombre_sipoc }}
											@endif						                	
						                </td>
						                <td class="text-left">{{ $solucion->propuesta_solucion }}</td>
						                <td class="text-left">{{ $solucion->pajustada }}</td>
						                <td class="text-left">{{ $solucion->palabras_clave }}</td>
										<td class="text-left">
											@if(isset($solucion->ambit_id))
												{{ $solucion->ambit->nombre_ambit }}
											@endif
										</td>
										<td class="text-left">{{ $solucion->responsable_solucion }}</td>
										<td class="text-left">{{ $solucion->corresponsable_solucion }}</td>
										<td class="text-center">{{ $solucion->fecha_cumplimiento }}</td>
										<td class="text-center">{{ $solucion->plazo_cumplimiento }}</td>
										<td class="text-left">{{ $solucion->riesgos_cumplimiento }}</td>
										<td class="text-left">{{ $solucion->supuesto_cumplimientos }}</td>
						            </tr>
					            @endforeach	
					        @endif	            
				        </tbody>
			    	</table>			    	
				</div>
			</div>
		</div>		
	</div>
</div>
	
@endsection

