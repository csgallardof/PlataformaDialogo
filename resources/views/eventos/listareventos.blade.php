@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')


@section('content')

<style>
            .wrapper {
                width: 200px;
            }
            
            .progress-bar {
                width: 100%;
                background-color: #e0e0e0;
                padding: 3px;
                border-radius: 3px;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
            }
            
            .progress-bar-fill {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #006100 , #004080);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }


            .progress-bar-fill2 {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #5C5C00, #B30000);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }
        </style>
<!-- NOTAS ESTA ES LA PANTALLA PARA CONSEJO SECTORIAL  / SEBE PROBAR Y MODIFICAR LAS COSAS PARA MEJORAR +++ NOTA +++++  -->
		<!-- begin #content -->
		<!-- begin #content -->
        <div id="content" class="content" width="10%">

<!--PALTAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181026 -->
   
<!--PALTAFORMA DIALOGO NACIONAL END IPIALESO 20181026 -->
            @include('flash::message')
            <div class="row">
                <!-- begin col-8 -->

                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
  
                            </div>
                            <h3 align="left" class="panel-title">Propuestas de Solución</h3>
                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>

                                            <th>Soluci&oacute;n</th>
                                            <th>Institucion</th>
                                            <th>Responsabilidad</th>
                                            <th>Percepci&oacuten Ciudadana</th>
                                            <th>Estado</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $resultados_propuestas as $resultados_propuesta )
                                        <tr>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->id}}
                                            </td>

                                            <td class="text-justify">
                                                {{ $resultados_propuesta->propuesta_solucion}}
                                            </td>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->siglas_institucion}}
                                            </td>
                                            <td class="text-justify">
                                                @if($resultados_propuesta->tipo_actor=1)
                                                	Responsable
                                                @else
                                                	Co-responsable
                                                @endif
                                            </td>
                                            <td class="text-justify">


                                            </td>
                                            <td class="text-justify">
                                               @if($resultados_propuesta->nombre_estado=="Finalizado")
                                                    <span class="label label-success f-s-12"  style="background-color: #28B463">
                                                            {{$resultados_propuesta->nombre_estado}}
                                                    </span>

                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Desarrollo")
                                                <span class="label label-default f-s-12" style="background-color: #CA6F1E">{{$resultados_propuesta->nombre_estado}}</span>

                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Análisis")
                                                <span class="label label-default f-s-12" style="background-color: #A6ACAF">{{$resultados_propuesta->nombre_estado}}</span>


                                                @endif
                                            </td>
                                            <td class="text-justify">

                                                <a href="{{ route('verSolucion.despliegueConsejo',[1,$resultados_propuesta->id]) }}" class="btn btn-link f-s-13 f-w-500"><i class="fa fa-2x fa-eye"></i></a>

                                            </td>


                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->


		@stop
@extends('layouts.consejo-sectorial')

@section('title','Propuestas-Consejo Sectorial')


@section('content')

<style>
            .wrapper {
                width: 200px;
            }
            
            .progress-bar {
                width: 100%;
                background-color: #e0e0e0;
                padding: 3px;
                border-radius: 3px;
                box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
            }
            
            .progress-bar-fill {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #006100 , #004080);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }


            .progress-bar-fill2 {
                display: block;
                height: 22px;
                /*background-color: #005252;*/
                background-image: linear-gradient(to right, #5C5C00, #B30000);
                border-radius: 3px;
                
                transition: width 500ms ease-in-out;
            }
        </style>
<!-- NOTAS ESTA ES LA PANTALLA PARA CONSEJO SECTORIAL  / SEBE PROBAR Y MODIFICAR LAS COSAS PARA MEJORAR +++ NOTA +++++  -->
        <!-- begin #content -->
        <!-- begin #content -->
        <div id="content" class="content" width="10%">

<!--PALTAFORMA DIALOGO NACIONAL BEGIN IPIALESO 20181026 -->
         
<!--PALTAFORMA DIALOGO NACIONAL END IPIALESO 20181026 -->
            @include('flash::message')
            <div class="row">
                <!-- begin col-8 -->

                <div class="col-md-12">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
                            </div>
                            <h3 align="left" class="panel-title">Propuestas de Solución</h3>
                        </div>

                        <div class="panel-body">

                            <div class="table-responsive">
                                <table id="data-table" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>

                                            <th>Soluci&oacute;n</th>
                                            <th>Institucion</th>
                                            <th>Responsabilidad</th>
                                            <th>Percepci&oacuten Ciudadana</th>
                                            <th>Estado</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $resultados_propuestas as $resultados_propuesta )
                                        <tr>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->id}}
                                            </td>

                                            <td class="text-justify">
                                                {{ $resultados_propuesta->propuesta_solucion}}
                                            </td>
                                            <td class="text-justify">
                                                {{ $resultados_propuesta->siglas_institucion}}
                                            </td>
                                            <td class="text-justify">
                                                @if($resultados_propuesta->tipo_actor=1)
                                                    Responsable
                                                @else
                                                    Co-responsable
                                                @endif
                                            </td>
                                            <td class="text-justify">

                                                <div class="wrapper">
                                                                        
                                                                            <?php
                                                                               $total_buenas =0;
                                                                               $total_malas =0;



                                                                               foreach ($evaluaciones as $ev) {
                                                                                 if($resultados_propuesta->id==$ev->ev_solicitud_id){
                                                                                    if($ev->ev_semaforo=='BUENA'){
                                                                                        $total_buenas = $ev->total; 
                                                                                    }else{
                                                                                        $total_malas = $ev->total;  
                                                                                    }
                                                                                    
                                                                                 }//end of if($solucionD->id==$ev
                                                                                
                                                                               }//end of  foreach ($ev

                                                                               $total_ev= $total_buenas+$total_malas;
                                                                               $percentage=0;
                                                                               $percentage_malas=0;
                                                                               if($total_ev>0){
                                                                               $percentage = round(($total_buenas*100)/$total_ev, 1);   

                                                                               $percentage_malas = round(($total_malas*100)/$total_ev, 1);  
                                                                               }
                                                                               
                                                                               if($percentage!=0){
                                                                                  echo '<div class="progress-bar"><span class="progress-bar-fill" style="width: '.$percentage.'%;font-weight: bold;">
                                                                                    '.$percentage.'% BUENO
                                                                                </span></div>';

                                                                               }elseif ($percentage_malas!=0 && $percentage==0) {
                                                                                    echo '<div class="progress-bar"><span class="progress-bar-fill2" style="width: '.$percentage_malas.'%;font-weight: bold;">
                                                                                        '.$percentage_malas.'% MALAS
                                                                                    </span></div>';
                                                                               }
                                                                               else{

                                                                                   echo "No se ha registrado";
                                                                               }


                                                                            ?>
                                                                            <!--<span class="progress-bar-fill" style="width: 70%;font-weight: bold;">
                                                                                70% BUENO
                                                                            </span>-->


                                                                        
                                                                    </div>

                                            </td>
                                            <td class="text-justify">
                                               @if($resultados_propuesta->nombre_estado=="Finalizado")
                                                    <span class="label label-success f-s-12"  style="background-color: #28B463">
                                                            {{$resultados_propuesta->nombre_estado}}
                                                    </span>

                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Desarrollo")
                                                <span class="label label-default f-s-12" style="background-color: #CA6F1E">{{$resultados_propuesta->nombre_estado}}</span>

                                                @endif

                                                @if($resultados_propuesta->nombre_estado=="En Análisis")
                                                <span class="label label-default f-s-12" style="background-color: #A6ACAF">{{$resultados_propuesta->nombre_estado}}</span>


                                                @endif
                                            </td>
                                            <td class="text-justify">

                                                <a href="{{ route('verSolucion.despliegueConsejo',[1,$resultados_propuesta->id]) }}" class="btn btn-link f-s-13 f-w-500"><i class="fa fa-2x fa-eye"></i></a>

                                            </td>


                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end panel -->
                </div>
                <!-- end col-10 -->


            </div>
            <!-- end row -->
        </div>
        <!-- end #content -->


        @stop
