$("#tipo_fuente").change(event => {
	$.get("../soluciones_por_tipo/"+event.target.value+"", function(response, state){
		$("#soluciones").empty();
		if( event.target.value == 1 ){
			$("#soluciones").append(`<option selected="selected" class="select_placeholder">Seleccione una solucion</option>`);
			response.forEach(element => {
				$("#soluciones").append(`<option value=${element.id}> ${element.verbo_solucion}&nbsp;${element.sujeto_solucion}&nbsp;${element.complemento_solucion}</option>`);
			});	
		}
		if( event.target.value == 2 ){
			$("#soluciones").append(`<option selected="selected" class="select_placeholder">Seleccione una solucion</option>`);
			response.forEach(element => {
				$("#soluciones").append(`<option value=${element.id}> ${element.nombre_pajustada}</option>`);
			});	
		}
		
	});
});