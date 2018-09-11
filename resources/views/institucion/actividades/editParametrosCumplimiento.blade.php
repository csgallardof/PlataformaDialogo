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
									{{ $solucion->verbo_solucion." ".$solucion->sujeto_solucion." ".$solucion->complemento_solucion }}
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
                            <h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i>  Editar Parametros de Cumplimiento</h4>
                        </div>
                        <div class="panel-body">
                            <div class="height-lg" data-scrollbar="true">
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
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-5">
                                                       <label for="plazo_cumplimiento">Plazo de Porpuesta</label>   
                                                        <select name="plazo_cumplimiento" class="form-control"  required="">
                                                    
                                                             <option value="{{ $solucion->plazo_cumplimiento }}" >{{ $solucion->plazo_cumplimiento }}</option>
                                                             <option value="Corto" >Corto</option>
                                                             <option value="Mediano" >Mediano</option>
                                                             <option value="Largo" >Largo</option>
                                                        </select>  
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-5">
                                                        <label for="fecha_cumplimimento">Fecha de Cumplimiento (Opcional)</label>	
									 					<div class="input-group date" id="datepicker-disabled-past"  data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
		                                            <input type="text" readonly name="fecha_cumplimimento" class="form-control" value="
                                                    @if (isset($solucion) )
                                                        {{ $solucion->fecha_cumplimiento }}
                                                    @endif

                                                    " placeholder="Seleccione Fecha" />
                                                    
		                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                        </div>


                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                       <label for="riesgos_cumplimiento">Riesgos</label> 	
									 					<textarea  required class="form-control" id="acciones" name="riesgos_cumplimiento" rows="6" onKeyDown="cuenta()" onKeyUp="cuenta()">@if (isset($solucion) ){{ $solucion->riesgos_cumplimiento }}@endif
                                                    </textarea>  
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                        </div>

                                        <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8">
                                                       <label for="supuestos_cumplimientos">Supestos</label> 	
									 					<textarea  required class="form-control" id="acciones" name="supuestos_cumplimientos" rows="6" onKeyDown="cuenta()" onKeyUp="cuenta()">@if (isset($solucion) ){{ $solucion->supuestos_cumplimientos }}@endif</textarea>  
                                                    </div>
                                                    
                                                    
                                                </div>
                                                
                                        </div>
                                        
                                        <div class="form-group">
                                                
                                                
                                        
                                        
                                        
                                                <div class="from-group">
                                            <div class="row"></div>
                                            
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
            <div class="col-md-12" >
                    <div class="panel panel-inverse" data-sortable-id="index-6">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">Actividades</h4>
                        </div>
                        
                        <div class="panel-body">
                            @if( isset( $actividades ) && count($actividades) > 0)
										<?php $count=1; ?>
										@foreach( $actividades as $actividad)
											<h4>
												<label class="label label-danger label-lg"><i class="fa fa-file-text-o" aria-hidden="true"></i> Actividad {{ $count }}</label><br><br>
											</h4>
											<p class="text-justify">
												{!! $actividad-> comentario !!}
												<br><br>

												@if( $actividad-> ejecutor_id > 0 )
													<b> Ejecutor: </b> {{ $actividad-> usuario-> name }}<br>
												@endif
												
											</p>
											<hr>
											<?php $count++; ?>
										@endforeach
									@else
										@if( count($actividades) == 0)
											{{ "No hay actividades registradas"}}
										@endif
									@endif
                        </div>
                    </div>
                    <!-- <div class="panel panel-inverse" data-sortable-id="index-7">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                            </div>
                            <h4 class="panel-title">&Uacute;ltimas actividades</h4>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </div> -->
                    
                </div>
            <!-- end row -->
        </div>
        <!-- end #content -->

        @stop
