@extends('layouts.app')

@section('content')

			
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista Variable Sectorial <a href="{{ route('vsectors.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>


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

					        	@foreach($vsectors as $vsector)
								<tr>
					                <td>{{ $vsector->id }}</td>
					                <td>{{ $vsector->nombre_vsector }}</td>
					                <td><a href="{{ '/vsectors/'.$vsector->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
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
    