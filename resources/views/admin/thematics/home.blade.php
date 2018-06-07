@extends('layouts.app')

@section('content')

			
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Lista Eje temático <a href="{{ route('thematics.create') }}" class="btn btn-primary pull-right">Nuevo</a></div>


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
					        	@foreach($thematics as $thematic)
								<tr>
					                <td>{{ $thematic->id }}</td>
					                <td>{{ $thematic->nombre_thematic }}</td>
					                <td><a href="{{ '/thematics/'.$thematic->id.'/edit' }}" class="btn btn-primary">Editar</a>  <a href="" class="btn btn-danger">Eliminar</a></td>
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
    