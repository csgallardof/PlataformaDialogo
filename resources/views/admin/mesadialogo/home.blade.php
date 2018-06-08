@extends('layouts.app')

@section('content')
			
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-1" style="margin-left: 0%">
            <div class="panel panel-default">
	            <div class="panel-heading">
	            	<h4>Mesas de Dialogo</h4><br>
	       			
	       			@include('flash::message')
                	
                	<a href="{{ route('mesadialogo.create') }}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo</a>&nbsp;
                	<a href="{{ route('mesadialogo.matrizCarga') }}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-th"></i>&nbsp;Cargar Matriz</a>
                	
                	<div class="pull-left" style="padding-bottom: 20px;">
						<form action="{{ url('/admin/mesadialogo') }}" method="GET" class="form-inline" role="search">
                        	<div class="form-group">
								<input type="text" name="parametro" id="mesadialogo" class="" placeholder="Par&aacute;metro" pattern=".{3,}" oninvalid="setCustomValidity('Ingrese al menos 3 caracteres')" onchange="try{setCustomValidity('')}catch(e){} " value="{{ Request::get('parametro') }}" 
								/>
							</div>
							<button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search"></i></button>
						</form>
					</div>
					<br><br>                	
				</div>
				<div class="panel-body table-responsive">
				  	<table class="table table-hover">
				  		<caption><strong>&nbsp;Listado de mesas de dialogo</strong></caption>
				        <thead>
				            <tr>
				                <th>COD</th>
				                <th class="text-center">MESA</th>
				                <th class="text-center">TIPO</th>
				                <th class="text-center">ORGANIZADOR</th>
				                <th class="text-center">CONSEJO SECTORIAL</th>
				                <th class="text-center">LIDER</th>
				                <th class="text-center">COORDINADOR</th>
				                <th class="text-center">ZONA</th>
				                <th class="text-center">PROVINCIA</th>
				                <th class="text-center">CANTON</th>
				                <th class="text-center">PARROQUIA</th>
				                <th class="text-center">LUGAR</th>
				                <th class="text-center">GRUPO</th>
				                <th class="text-center">SECTOR</th>
				                <th class="text-center">FECHA</th>
				                <th class="text-center">OPCIONES</th>
				            </tr>
				        </thead>
				        <tbody>
				        	@if(isset($mesasdialogo))			        	
						        @foreach( $mesasdialogo as $mesadialogo)					        	
									<tr>
						                <td class="text-center">{{ $mesadialogo->id }}</td>
						                <td class="text-left">{{ $mesadialogo->nombre }}</td>
						                <td class="text-left">
						                	@if(isset($mesadialogo->tipo_dialogo_id))
						                		{{ $mesadialogo->tipoDialogo->nombre }}
						                	@endif
						                </td>
						                <td class="text-left">
						                	@if(isset($mesadialogo->organizador_id))
						                		{{ $mesadialogo->organizador->nombre_institucion }}
						                	@endif
						                </td>
						                <td class="text-left">
						                	@if(isset($mesadialogo->consejo_sectorial_id))
						                		{{ $mesadialogo->consejoSectorial->nombre_consejo }}
						                	@endif
						                </td>
						                <td class="text-left">{{ $mesadialogo->lider }}</td>
						                <td class="text-left">{{ $mesadialogo->coordinador }}</td>
						                <td class="text-left">
						                	@if(isset($mesadialogo->zona_id))
						                		{{ $mesadialogo->zona->nombre }}
						                	@endif
						            	</td>
										<td class="text-left">
											@if(isset($mesadialogo->provincia_id))
												{{ $mesadialogo->provincia->nombre_provincia }}
											@endif
										</td>
										<td class="text-left">
											@if(isset($mesa_dialogo->canton_id))
												{{ $mesadialogo->canton->nombre_canton }}
											@endif
										</td>
										<td class="text-left">
											@if(isset($mesa_dialogo->parroquia_id))
												{{ $mesadialogo->parroquia->nombre_parroquia }}
											@endif
										</td>
										<td class="text-left">{{ $mesadialogo->lugar }}</td>
										<td class="text-left">{{ $mesadialogo->organizacion }}</td>
										<td class="text-left">
											@if(isset($mesa_dialogo->sector_id))
												{{ $mesadialogo->sector->nombre_sector }}
											@endif
										</td>
										<td class="text-center">
											@if(isset($mesadialogo->fecha))
												{{ date('Y-m-d', strtotime($mesadialogo->fecha))}}
											@endif
										</td>
										<td>
											<a href="{{ '/admin/mesadialogo/'.$mesadialogo->id.'/edit' }}" class="btn btn-primary" title="Editar Mesa de Dialogo"><span class="glyphicon glyphicon-pencil"></span></a>
											<a href="{{ '/admin/mesadialogo/'.$mesadialogo->id.'/propuestas' }}" class="btn btn-primary" title="Registrar propuestas"><span class="glyphicon glyphicon-th-list"></span></a>
										</td>
						            </tr>
						        @endforeach
						    @else
						    	<tr>
						            <td class="text-center" colspan="16">No existen registros de mesas de dialogo.</td>
						        </tr>
						    @endif		   
				        </tbody>
			    	</table>
			    	
				    <div class="row">
				    	<div class="col-md-offset-5">
				    		{!! $mesasdialogo->appends(["parametro" => Request::get("parametro")])->render() !!} 
				    	</div>
				    </div>
				
				</div>
			</div>
		</div>		
	</div>
</div>

@endsection
