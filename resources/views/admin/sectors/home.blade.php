@extends('layouts.app')

@section('content')

			
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista Sectores <a href="{{ route('sectors.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>


					<div class="panel-body">
						  <table class="table table-hover">
					        <thead>
					            <tr>
					                <th>#</th>
					                <th>Nombre</th>
					                <th>Acción</th>
					            </tr>
					        </thead>
					        <tbody>
					        	@foreach($sectors as $sector)
								<tr>
					                <td>{{ $sector->id }}</td>
					                <td>{{ $sector->nombre_sector }}</td>
					                <td><a href="{{ '/sectors/'.$sector->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
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
    