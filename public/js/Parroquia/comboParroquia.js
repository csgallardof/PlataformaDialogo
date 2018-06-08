
function getSelectParroquias(){

	var selectedValue= document.getElementById("select-canto").value;	
	console.log(selectedValue);

	if(selectedValue==""){
		var html_select_vacio = '<option value="">Seleccione una parroquia</option>';
		document.getElementById("select-parroquia").innerHTML = html_select_vacio;
		console.log(html_select_vacio);
		
	}else{
		$.get('/api/canton/'+selectedValue+'/parroquias',function(data){		
			var html_select = '<option value="">Seleccione una parroquia</option>';
			for (var i = 0; i <data.length; i++) {
				html_select += '<option value="'+data[i].id+'">'+data[i].nombre_parroquia+'</option>';			
			}
			document.getElementById("select-parroquia").innerHTML = html_select;
		});
	}		
}