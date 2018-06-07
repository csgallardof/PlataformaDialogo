@extends('layouts.app')

@section('content')
 

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h4>Actores - Soluci&oacute;n </h4>
                	@include('flash::message')
                	<a href="{{ route('actorSolucion.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>

					<div class="panel-body">
						<table class="table table-hover">
					        <thead>
					            <tr>
					                <th>Fuente</th>
					                <th>Soluci&oacute;n</th>
					                <th>Responsable</th>
					                <th>Tipo</th>
					                <th>Acci&oacute;n</th>
					            </tr>
					        </thead>
					         <tbody>
					        	@foreach($actoresSoluciones as $actorSolucion)
								<tr>
					                <td>
					                	@if($actorSolucion-> tipo_fuente == 1)
					                		{{ "Mesas Competitivas" }}
					                	@else
											{{ "Consejo Consultivo" }}
					                	@endif
					                </td>
					                <td>
					                	
					                		{{ $actorSolucion->verbo_solucion." ".$actorSolucion->sujeto_solucion ." ".$actorSolucion->complemento_solucion }}
					                	
					                	
					                </td>
					                <td>{{ $actorSolucion->name }}</td>
					                <td>@if($actorSolucion->tipo_actor == 1)
					                		{{ "Responsable" }}
					                	@endif
					                	@if($actorSolucion->tipo_actor == 2)
					                		{{ "Corresponsable" }}
					                	@endif
					                </td>
					                <td></td>
					            </tr>
					            @endforeach		            
					        </tbody> 
					    </table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection