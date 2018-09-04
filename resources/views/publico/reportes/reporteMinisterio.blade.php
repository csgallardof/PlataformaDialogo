@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading col-md-2">
                   <form target="_blank" method="POST" action="/institucion/reporte-institucional/descargar-excel" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-9">
                                 <button type="submit"  class="btn btn-primary">Descargar Excel</button>
                            </div>
                              
                        </div>
                        <table hidden>
                        <thead>
                        <th class="text-left f-s-18">Seleccionar</th>
                        <th class="text-left f-s-18">id</th>
                        </thead>
                        <tbody>
                        @foreach( $resultadosreporte as $excel)
                        <tr>
                        <td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
                        <td>{{$excel->id}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </form>
                      
                         <form target="_blank" method="POST" action="/institucion/reporte-institucional/descargar-pdf/1" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                                    <div class="col-md-3 ">
                                        
                                        <button type="submit"  class="btn btn-success">Descargar PDF</button>

                                    </div>
                                      
                                </div>
                        <table hidden>
                        <thead>
                        <th class="text-left f-s-18">Seleccionar</th>
                        <th class="text-left f-s-18">id</th>
                        </thead>
                        <tbody>
                        @foreach( $resultadosreporte as $excel)
                        <tr>
                        <td><input type="checkbox" name="check[]" checked id="{{$excel->id}}" value='{{$excel->id}}'> </td>
                        <td>{{$excel->id}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        </table>
                        </form>

                        <br /><br />

                 </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                           <th colspan="3" ><div align="center">  REPORTE DE MINISTERIO DE LA PLATAFORMA DE DIALOGO NACIONAL </div></th>
                        </tr>
                       

                      </thead>
                        <tbody>

                     
                       <tr>
                           <th colspan="3" ><div align="center">Datos Informativos</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">Fecha</div></th>
                            <td colspan="1" ><div align="left">{{$hoy}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">Responsable</div></th>
                            <td colspan="1" ><div align="left">{{$nombreusuario}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">Nombre de la Instituci&oacute;n</div></th>
                            <td colspan="1" ><div align="left">{{$nombreinstitucion}}</div></td>
                        </tr>

                          <tr>
                           <th colspan="2" ><div align="left">Consejo Sectorial</div></th>
                            <td colspan="1" ><div align="left">{{$nombreConsejo}}</div></td>
                        </tr>


                       <tr>
                           <th colspan="3" ><div align="center">Tipo Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Recibidas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasRecibidas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Desestimadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesestimadas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Validadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasValidadas}}</div></td>
                        </tr>


                        <tr>
                           <th colspan="3" ><div align="center">Estado de Propuesta</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Cumplidas o Finalizadas</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasFinalisadas}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en Desarrollo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasDesarrolladas}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en An&aacute;lisis</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasAnalisadas}}</div></td>
                        </tr>



                       <tr>
                           <th colspan="3" ><div align="center">Forma de Cumplimiento</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas en PP</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPolitica}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas leyes</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasLeyes}}</div></td>
                        </tr>

               
                        <tr>
                           <th colspan="3" ><div align="center">Propuestas por Plazo</div></th>
                        </tr>
                       
                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas a Corto</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoCorto}}</div></td>
                        </tr>

                        <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Mediano</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoMediano}}</div></td>
                        </tr>

                         <tr>
                           <th colspan="2" ><div align="left">N° de Propuestas Largo Plazo</div></th>
                            <td colspan="1" ><div align="left">{{$numPropuestasPlazoLargo}}</div></td>
                        </tr>
                         

                        </tbody>
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
