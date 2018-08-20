@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                     <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                 <th>Nombre Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $rol)
                            <tr>
                                <td>
                                    {{ $rol-> id}} 
                                </td>
                                 <td>
                                    {{ $rol-> nombre_role}} 
                                </td>
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