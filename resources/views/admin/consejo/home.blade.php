@extends('layouts.app')

@section('title') Soluciones - Consejo Consultivo Productivo Tributario @endsection

@section('content')
			
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
	            <div class="panel-heading">
	            	<h4>Consejo Consultivo Productivo Tributario - Soluciones</h4><br>
	       			@include('flash::message')
                	<a href="{{ route('ccpt.create') }}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo</a>	
                	<div class="pull-left" style="padding-bottom: 20px;"">
						<form action="{{ url('/admin/ccpt') }}" method="GET" class="form-inline" role="search">
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
				        	@foreach($soluciones as $solucion)
							<tr>
								<td class="text-center">{{ $solucion->mesa->nombre_mesa}}</td>
				                <td class="text-center">{{ $solucion->solucion_ccpt}}</td>
				                <td class="text-center">{{ $solucion->thematic->nombre_thematic}}</td>
				                <td class="text-center">{{ $solucion->ambit->nombre_ambit}}</td>
				                <td class="text-center">{{ $solucion->sector->nombre_sector }}</td>
				                <td class="text-center">{{ $solucion->responsable_solucion }}</td>
				                <td class="text-center">{{ $solucion->corresponsable_solucion }}</td>
				                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
								<td class="text-center">{{ $solucion->pajustada->nombre_pajustada }}</td>
				            </tr>
				            @endforeach		            
				        </tbody>
			    	</table>
			    	
				    <div class="row">
				    	<div class="col-md-offset-5">
				    		{!! $soluciones->appends(["parametro" => Request::get("parametro")])->render() !!}
				    	</div>
				    </div>
				
				</div>
			</div>

		</div>				    
	
		
	</div>
</div>

@endsection

