@extends('layouts.app')

@section('content')
			
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
	            <div class="panel-heading">
	            	<h4>Propuestas</h4><br>
	       			@include('flash::message')
                	<a href="{{ route('soluciones.create') }}" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-plus"></i>&nbsp;Nuevo</a>	
                	
                	<div class="pull-left" style="padding-bottom: 20px;"">
						<form action="{{ url('/admin/soluciones') }}" method="GET" class="form-inline" role="search">
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
				            <tr class="active">
				                <th>#</th>
				                <th class="text-center">EVENTO</th>
				                <th class="text-center">GRUPO</th>
				                <th class="text-center">PROVINCIA</th>
				                <th class="text-center">ESLAB&Oacute;N DE LA CADENA PRODUCTIVA</th>
				                <th class="text-center">PROBLEM&Aacute;TICA</th>
				                <th class="text-center">PROPUESTA</th>
				                <th class="text-center">INSTRUMENTOS NECESARIOS</th>
				                <th class="text-center">CLASIFICACI&Oacute;N EMPRESA RELACIONADA</th>
				                <th class="text-center">&Aacute;MBITO</th>
				                <th class="text-center">RESPONSABLE DE EJECUCI&Oacute;N</th>
				                <th class="text-center">CO-RESPONSABLES DE EJECUCI&Oacute;N</th>
				                <!--  <th>Acci&oacute;n</th>  -->

				            </tr>
				        </thead>
				        <tbody>				        	
					        	@foreach( $soluciones as $solucion)
					        	
								<tr>
					                <td class="text-center">{{ $solucion->id }}</td>
					                <td class="text-center">{{ $solucion->evento->nombre_evento}}</td>
					                <td class="text-center">{{ $solucion->sector->nombre_sector}}</td>
					                <td class="text-center">{{ $solucion->provincia->nombre_provincia}}</td>
					                <td class="text-center">{{ $solucion->sipoc->nombre_sipoc }}</td>
					                <td class="text-center">{{ $solucion->problema_solucion }}</td>
					                <td class="text-center">{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion."  ".$solucion->complemento_solucion }}</td>
					                <td class="text-center">{{ $solucion->instrumento->
					                nombre_instrumento }}</td>
									<td class="text-center">{{ $solucion->tipoEmpresa->nombre_tipo_empresa }}</td>
									<td class="text-center">{{ $solucion->ambit->nombre_ambit }}</td>
									<td class="text-center">{{ $solucion->responsable_solucion }}</td>
									<td class="text-center">{{ $solucion->corresponsable_solucion }}</td>
					            </tr>
					            @endforeach		   
				        </tbody>
			    	</table>
			    	
				    <div class="row">
				    	<div class="col-md-offset-5">
				    		{!! $soluciones->appends(["parametro" => Request::get("parametro")])->render() !!} 
				    	</div>
				    </div>

				    <div class="row">

				    </div>

				
				</div>
			</div>

		</div>				    
	
		
	</div>
</div>

@endsection

