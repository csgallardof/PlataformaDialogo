@extends('layouts.cspAgenda') 

@section('content')

<!-- begin #content -->
		<div id="content" class="content" width="10%">
			<!-- begin breadcrumb -->
			
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			
			<!-- end page-header -->
			
			<!-- begin row -->
			<div class="row">
				<!-- begin col-12 -->
				<div class="col-md-12 col-sm-12">
					<div class="widget widget-stats bg-green-darker">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4 class="modal-title">Reportes Consejo Sectorial de la Producción</h4>
							<br>	
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
							<h4 class="panel-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Nuevo Agenda Territorial CSP</h4>
						</div>
						<div class="panel-body">
							
								<div class="media-body">
									<div class="col-md-10">

									<a href="/institucion/ver-agenda-territorial" class="btn btn-warning pull-right">Regresar</a>
									</div>
									
									<br>
									<hr>

									<form  method="POST" action="{{ route('guardarAgendaTerritorialCsp') }}" enctype="multipart/form-data">
										{{ csrf_field() }}
              							<div class="form-group">
									 			<div class="row">
									 				<div class="col-md-2"></div>
									 				<div class="col-md-4">
									 					<label for="responsable">Responsable</label>
									 					 <input type="text" required name="responsable" class="form-control" >			
									 				</div>
									 				<div class="col-md-4">
									 					<label for="responsable">Tipo Comunicacional</label>
									 					 
														<select name="tipo_comunicacional"  class="form-control"  data-size="10" data-live-search="true"   required  data-style="btn-default">
			                                            <option value="" disabled selected>Seleccionar Tipo</option>
			                                            <option value="Institucional">Institucional</option>
			                                            <option value="Presidencia">Presidencia</option>
			                                            <option value="Institucional y Presidencia">Institucional y Presidencia</option>
			                                            
			                                        </select> 
									 				</div>
									 			</div>
									 			
									  	</div>
									  	<div class="form-group">
									  		<div class="row">
									  			<div class="col-md-2"> </div>
									  			<div class="col-md-4">
                                   		 <label for="agenda_fecha">Fecha de Agenda</label>
		                                    
		                                        <div class="input-group date" id="datepicker-disabled-past" required data-date-format="yyyy-mm-dd" data-date-start-date="Date.default">
		                                            <input type="text" readonly name="agenda_fecha" class="form-control" value="{{ date('Y-m-d') }}" placeholder="Seleccione Fecha" />
		                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                                        </div>
		                                   				
		                                   				
													
		                                      	</div>
		                                      	<div class="col-md-4">
														<label for="hora_agenda">Hora de Agenda</label>
														
															<div class="input-group bootstrap-timepicker">
																<input id="timepicker" type="text" name="hora_agenda" required class="form-control" />
																<span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
															</div>
														
												</div>
		                                      	<div class="col-md-3">
									 					 <label for="institucion_id"></label>	
					                                	<input id="institucion_id"  type="hidden" name="institucion_id" value="{{$usuario_institucion_id}}">
					                                		
									 				</div>
		                                    </div>
                                		</div>
                                		<div class="form-group">
									 			<div class="row">
									 				<div class="col-md-2"></div>
									 				<div class="col-md-4">
									 					<label for="responsable">Lugar</label>
									 					 <input type="text" required name="lugar" class="form-control" >			
									 				</div>
									 				
									 			</div>
									 			
									  	</div>
								<div class="form-group">
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
										
									<label for="select-provincia">Provincia</label>
									
									    <select id="select-provincia" onchange="getSelectValue();" name="select-provincia" class="form-control selectpicker" data-size="10" data-live-search="true" required="Seleccione una opcion" data-style="btn-primary">
                                            <option value="" selected>Seleccionar Provincia</option>
                                            @foreach($provincias as $provincias)
                                            <option value="{{$provincias['id']}}">{{$provincias['nombre_provincia']}}
					                        </option>
					                         @endforeach
                                        </select>
									</div>

									</div>
								</div>
								

								<div class="form-group ">
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8 ">
									<label for="select-canto">Cantones</label>
										 
									    <select  id="select-canto" class="form-control" name="select_canton"  data-size="10" required="" data-live-search="true" data-style="btn-inverse">
                                            <option value="" >Seleccione Canton</option>
                                            
                                        </select>
                                        
									</div>
									
									</div>
								</div>
								<div class="form-group">
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
									<label for="tipo_agenda_id">Tipo Agenda</label>
									
									    <select class="form-control selectpicker" data-size="10" data-live-search="true" required="Seleccione una opcion" name="tipo_agenda_id" data-style="btn-info">
                                            <option value="" selected>Seleccione una Opcion</option>
                                            @foreach($cspTipoAgenda as $cspTipoAgenda)
                                            <option value="{{$cspTipoAgenda['id']}}">{{$cspTipoAgenda['nombre_tipo_agenda']}}
					                        </option>
					          
					                         @endforeach
                                            
                                        </select>
									</div>
									
									</div>
									<div class="col-md-3"></div>
								</div>
								<div class="form-group ">
									 		
									 		<div class="row">
													
													<div class="col-md-2"></div>
									 				<div class="col-md-8"> 
									 					
									 				<label for="descripcion_tipo_agenda" class=>Descripción  Agenda</label>
									 				
									 				</div>
									 			
									 		</div>
									 			<div class="col-md-2"></div>
									 			<div class="col-md-8">
									 			
												<textarea class="ckeditor" id="editor1" required name="descripcion_tipo_agenda" rows="6"></textarea>	
									 			</div>
									    	
									  	</div>	
									  	<div class="from-group">
											<div class="row"></div>
											
										</div>
								<div class="form-group">
									<div class="row">
									<div class="col-md-2"></div>
									<div class="col-md-8">
									<label for="tipo_impacto_id"><br><br>Tipo Impacto</label>
									
									    <select class="form-control selectpicker" data-size="10" data-live-search="true" required name="tipo_impacto_id" data-style="btn-info">
                                            <option value="" selected>Seleccione una Opcion</option>
                                            @foreach($cspTipoImpactoAgenda as $cspTipoImpactoAgenda)
                                            <option value="{{$cspTipoImpactoAgenda['id']}}">{{$cspTipoImpactoAgenda['nombre_impacto']}}
					                        </option>
					          
					                         @endforeach
                                            
                                        </select>
									</div>
									
									</div>
								</div>
								<div class="form-group">
									 		
									 		<div class="row">
									 			<div class="col-md-2"></div>
									 			<div class="col-md-8">
									 				<label for="descripcion_tipo_impacto">Descripción Impacto</label>		
									 			</div>
									 			<div class="col-md-3">
									 				<div id="descripcion_tipo_impacto" class="pull-right"></div>
									 			</div>
									 		</div>
									 			<div class="col-md-2"></div>
									 			<div class="col-md-8">

									 			<textarea class="ckeditor" id="editor1" required name="descripcion_tipo_impacto" rows="6"></textarea>	
									 			</div>

									    	
								</div>
								
								
										<div class="from-group">
											<div class="row"></div>
											
										</div>
									  	
									  	<div class="form-group">
									 			
									 			
									  	
									 	
										
												

									  		  
									  	
	
									  	<hr>
									  	<div class="col-md-10">
									  	<button type="submit" class="btn btn-primary pull-right">Registrar</button>
									  	</div>
									</form>		

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
                            <h4 class="panel-title">Notificaciones<br> (&uacute;ltima semana)</h4>
                        </div>
                        <h6 align="center" style="color:green"> No existe notificaciones</h6>
                        <div class="panel-body">
                            
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


		@stop
		