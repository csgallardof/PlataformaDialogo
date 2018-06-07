@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Instituciones<a href="{{ route('instituciones.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>

					<div class="panel-body">
						<table class="table table-hover">
					        <thead>
					            <tr>
					                <th>Instituci&oacute;n</th>
					                <th>Email</th>
					                <th>Acci&oacute;n</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($instituciones as $institucion)
								<tr>
					                <td>
					                	{{ $institucion-> name}}
					                </td>
					                <td>
					                	{{ $institucion-> email}}
					                	
					                </td>
					                
					                 <td><a href="{{ '/admin/instituciones/'.$institucion->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
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