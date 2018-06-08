
function getSelectProvincias(){

	var selectedValue= document.getElementById("select-zona").value;	
	console.log(selectedValue);

	if(selectedValue==""){
		var html_select_vacio = '<option value="">Seleccione una Provincia</option>';
		document.getElementById("select-provincia").innerHTML = html_select_vacio;
		console.log(html_select_vacio);
		
	}else{
		$.get('/api/zona/'+selectedValue+'/provincias',function(data){		
			var html_select = '<option value="">Seleccione una Provincia</option>';
			for (var i = 0; i <data.length; i++) {
				html_select += '<option value="'+data[i].id+'">'+data[i].nombre_provincia+'</option>';			
			}
			document.getElementById("select-provincia").innerHTML = html_select;
		});
	}		
}