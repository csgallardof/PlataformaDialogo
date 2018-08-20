@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rol Usuario</div>
                <div class="panel-body">
                    <form  action="{{route('rolUsuario.index')}}">
                        <div class="form-group">
                            <input class ="form-control" name="search"/>
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>C&eacute;dula</th>
                                <th>Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                          

                        </tbody>
                    </table>
            
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
