@extends('layouts.cspAgenda')

@section('content')

			
<!-- end page-header -->

<!-- begin #content -->
        <div id="content" class="content" width="10%">
            <!-- begin breadcrumb -->
            
            <!-- end breadcrumb -->
            <!-- begin page-header -->
            
            <!-- end page-header -->
            
            <!-- begin row -->
            <ol class="breadcrumb pull-right">
				<li><a href="{{ url('institucion/home') }}">Inicio</a></li>
				<li class="active"><a href="javascript:window.history.back()">Propuesta</a></li>
				<li class="active">Parametros de Cumplimiento</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<div class="brand">
                <img src="{{ asset('imagenes/inteligencia_productiva_home.png') }}" class="left-block img-responsive" alt="Cinque Terre" width="337px" height="55px"><br>
            </div>
            <div class="row">
                <!-- begin col-12 -->
                <div class="col-md-12 col-sm-12">
                    <div class="widget widget-stats bg-green-darker">
                        <div class="stats-icon"><i class="fa fa-desktop"></i></div>
                        <div class="stats-info">
                            <h4>Soluci&oacute;n</h4>
								<p class="f-s-20">
								@if (isset($solucion) )
									{{ $solucion->propuesta_solucion }}
								@endif
							</p>
                              
                        </div>
                        <div class="stats-link">
                            <a href="javascript:;">&nbsp;</a>
                        </div>
                    </div>
                </div>
                <!-- end col-12 -->
            </div>
            <!-- end row -->
            <!-- begin row -->
            <div class="row">
                <!-- begin col-8 -->
                <div class="col-md-12">
                    
                    <div class="panel panel-inverse" data-sortable-id="index-5">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                
                            </div>
                            <h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i>  Definir Parametros de Cumplimiento</h4>
                        </div>
                        <div class="panel-body">
                            <div class="height-lg">
                                <div class="media-body">
                                    <div class="col-md-12">
                                        
                                   <a href="javascript:window.history.back();" class="btn btn-default pull-right">&laquo; Regresar</a>
                                    </div>
                                    
                                    <br>
                                    <hr>

                                    <form  method="POST" action="{{route('crear.ParametrosCumplimiento',$solucion->id)}}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
              
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="indice_competitividad" class="pull-right" >Indice de Competitividad:</label>  </div>
                                                <div class="col-md-5">
                                                    <select name="indice_competitividad" class="form-control"  required="">
                                                        <option value="" >Selecciones una opción de indice</option>
                                                        @if( isset($politica) )
                                                            @foreach( $indice_competitividad as $indice_competitividad )
                                                                <option value="{{ $indice_competitividad->id}}">
                                                                    {{ $indice_competitividad->nombre_indice_competitividad }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="politica" class="pull-right" >Política:</label>  </div>
                                                <div class="col-md-5">
                                                    <select name="politica" class="form-control"  required="">
                                                        <option value="" >Selecciones una opción de política</option>
                                                        @if( isset($politica) )
                                                            @foreach( $politica as $politica )
                                                                <option value="{{ $politica->id}}">
                                                                    {{ $politica->nombre_politica }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="plan_nacional" class="pull-right">Plan Nacional:</label>   </div>
                                                <div class="col-md-5">
                                                    <select name="plan_nacional" class="form-control"  required="">
                                                        <option value="" >Selecciones una opción del plan</option>
                                                        @if( isset($plan_nacional) )
                                                            @foreach( $plan_nacional as $plan_nacional )
                                                                <option value="{{ $plan_nacional->id}}">
                                                                    {{ $plan_nacional->nombre_plan_nacional }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="planificado" class="pull-right">Planificado ( SI / NO )</label>  </div>
                                                <div class="col-md-5">
                                                    <select name="planificado" class="form-control"  required="">
                                                         <option value="" >Selecciones una opción</option>
                                                         <option value="SI" >SI</option>
                                                         <option value="NO" >NO</option>
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="instrumento" class="pull-right">Instrumento de Planificación / Descripción</label></div>
                                                <div class="col-md-8">
                                                    <textarea  required class="form-control" id="acciones" name="instrumento" placeholder="Describa el instrumento de planificación o describa el motivo de no planificación" rows="2" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>  
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2"><label for="plazo_cumplimiento" class="pull-right">Plazo de Propuesta</label> </div>
                                                <div class="col-md-5">
                                                     
                                                    <select name="plazo_cumplimiento" class="form-control"  required="">
                                                         <option value="" >Selecciones una opción</option>
                                                         <option value="Corto" >Corto</option>
                                                         <option value="Mediano" >Mediano</option>
                                                         <option value="Largo" >Largo</option>
                                                    </select>  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"><label for="fecha_cumplimimento" class="pull-right">Fecha de Cumplimiento (Opcional)</label></div>
                                                    <div class="col-md-5">
                                                        	
									 					<div class="input-group date" id="datepicker-disabled-past"  data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
		                                            <input type="text" readonly name="fecha_cumplimimento" class="form-control" value="" placeholder="Seleccione Fecha" />
		                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                        </div>


                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"><label for="riesgos_cumplimiento" class="pull-right">Riesgos</label></div>
                                                    <div class="col-md-8">
                                                       
									 					<textarea  required class="form-control" id="acciones" name="riesgos_cumplimiento" rows="2" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>  
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                        </div>

                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"><label for="supuestos_cumplimientos" class="pull-right">Supestos</label></div>
                                                    <div class="col-md-8">
                                                       
									 					<textarea  required class="form-control" id="acciones" name="supuestos_cumplimientos" rows="2" onKeyDown="cuenta()" onKeyUp="cuenta()"></textarea>  
                                                    </div>
                                            </div>
                                                
                                        </div>
                                        
                                        <hr>
                                        <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary pull-right">Registrar</button>
                                        </div>
                                    </form>     

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end col-8 -->
                
            </div>
            
        </div>
        <!-- end #content -->

        @stop
