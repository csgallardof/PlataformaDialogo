@extends('layouts.app')

@section('start_css')
  @parent
    <link href="{{ asset('plugins/DataTablesv2/datatables.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style-after.css') }}" rel="stylesheet" />

@endsection

@section('content')
			
<div id="content" class="content">
    <div class="row">
    	<div class="col-md-12">
   			@include('flash::message')
        	
        	<a href="{{ route('mesadialogo.create') }}" class="btn btn-default pull-right"><i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo</a>&nbsp;
        	<a href="{{ route('mesadialogo.matrizCarga') }}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-th"></i>&nbsp;Cargar Matriz</a>  
    	</div>
    	<!--<div class="col-md-12">   			
			<div class="pull-left" style="padding-bottom: 20px;">
				<form action="{{ url('/admin/mesadialogo') }}" method="GET" class="form-inline" role="search">
                	<div class="form-group">
						<input type="text" name="parametro" id="mesadialogo" class="" placeholder="Par&aacute;metro" pattern=".{3,}" oninvalid="setCustomValidity('Ingrese al menos 3 caracteres')" onchange="try{setCustomValidity('')}catch(e){} " value="{{ Request::get('parametro') }}" 
						/>
					</div>
					<button type="submit" class="btn btn-sm btn-default"><i class="glyphicon glyphicon-search"></i></button>
				</form>
			</div>
    	</div>-->
        <div class="col-md-12">
            <div class="panel panel-inverse">
	            <div class="panel-heading">
	            	<h4 class="panel-title">Mesas de Di&aacute;logo</h4>   	
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					  	<table id="data-table" class="table table-striped table-bordered">
					        <thead>
					            <tr>
					                <th>Cod.</th>
					                <th class="text-center">Nombre</th>
					                <th class="text-center">Tipo</th>
					                <th class="text-center">Organizador</th>
					                <th class="text-center">Consejo Sectorial</th>
					                <th class="text-center">L&iacute;der</th>
					                <th class="text-center">Coordinador</th>
					                <th class="text-center">Lugar</th>
					                <th class="text-center">Sector</th>
					                <th class="text-center">Fecha</th>
					                <th class="text-center">Zona</th>
					                <th class="text-center">Provincia</th>
					                <th class="text-center">Cant&oacute;n</th>
					                <th class="text-center">Parroquia</th>
					                <th class="text-center">Organizaci&oacute;n</th>
					                <th class="text-center">Opciones</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@if(isset($mesasdialogo))			        	
							        @foreach( $mesasdialogo as $mesadialogo)					        	
										<tr>
							                <td class="text-center">{{ $mesadialogo->id }}</td>
							                <td class="text-left">{{ $mesadialogo->nombre }}</td>
							                <td class="text-justify">
							                	@if(isset($mesadialogo->tipo_dialogo_id))
							                		{{ $mesadialogo->tipoDialogo->nombre }}
							                	@endif
							                </td>
							                <td class="text-justify">
							                	@if(isset($mesadialogo->organizador_id))
							                		{{ $mesadialogo->organizador->nombre_institucion }}
							                	@endif
							                </td>
							                <td class="text-justify">
							                	@if(isset($mesadialogo->consejo_sectorial_id))
							                		{{ $mesadialogo->consejoSectorial->nombre_consejo }}
							                	@endif
							                </td>
							                <td class="text-justify">{{ $mesadialogo->lider }}</td>
							                <td class="text-justify">{{ $mesadialogo->coordinador }}</td>	                
											<td class="text-justify">{{ $mesadialogo->lugar }}</td>
											<td class="text-justify">
												@if(isset($mesadialogo->sector_id))
													{{ $mesadialogo->sector->nombre_sector }}
												@endif
											</td>
											<td class="text-center">
												@if(isset($mesadialogo->fecha))
													{{ date('Y-m-d', strtotime($mesadialogo->fecha))}}
												@endif
											</td>
							                <td class="text-justify">
							                	@if(isset($mesadialogo->zona_id))
							                		{{ $mesadialogo->zona->nombre }}
							                	@endif
							            	</td>
											<td class="text-justify">
												@if(isset($mesadialogo->provincia_id))
													{{ $mesadialogo->provincia->nombre_provincia }}
												@endif
											</td>
											<td class="text-justify">
												@if(isset($mesadialogo->canton_id))
													{{ $mesadialogo->canton->nombre_canton }}
												@endif
											</td>
											<td class="text-justify">
												@if(isset($mesadialogo->parroquia_id))
													{{ $mesadialogo->parroquia->nombre_parroquia }}
												@endif
											</td>
											<td class="text-justify">{{ $mesadialogo->organizacion }}</td>
											<td>
												<a href="{{ '/admin/mesadialogo/'.$mesadialogo->id.'/edit' }}" class="btn btn-xs btn-primary" title="Editar Mesa de Di&aacute;logo"><span class="glyphicon glyphicon-pencil"></span></a>
												<a href="{{ '/admin/mesadialogo/'.$mesadialogo->id.'/propuestas' }}" class="btn btn-xs btn-primary" title="Propuestas de la mesa"><span class="glyphicon glyphicon-th-list"></span></a>
											</td>
							            </tr>
							        @endforeach
							    @else
							    	<tr>
							            <td class="text-center" colspan="16">No existen registros de mesas de di&aacute;logo.</td>
							        </tr>
							    @endif		   
					        </tbody>
				    	</table>
			    	</div>
				
				</div>
			</div>
		</div>		
	</div>

    <div class="row">
    	<div class="col-md-offset-5">
    		{!! $mesasdialogo->appends(["parametro" => Request::get("parametro")])->render() !!} 
    	</div>
    </div>
</div>

@endsection
