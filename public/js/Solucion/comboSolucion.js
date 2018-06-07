
function getSelectValue(){
				
				var selectedValue= document.getElementById("select-tipo-fuente").value;

				if(selectedValue==""){
					//alert("no exite id");
					var html_select_vacio = '<option value="">Seleccione Propuesta</option>';
					document.getElementById("select-solucion").innerHTML = html_select_vacio;
					console.log(html_select_vacio);
					
				}else
			$.get('/api/propuestas/'+selectedValue,function(data){
				
				
				console.log(data)
				//alert(selectedValue);
				

					var html_select = '<option value="">Seleccione Propuesta</option>';
				for (var i = 0; i <data.length; i++) {

				html_select += '<option value="'+data[i].id+'">'+data[i].verbo_solucion+data[i].sujeto_solucion+cortarTextoConPuntos(data[i].complemento_solucion,100)+'</option>';

					 //html_select += '<option value="'+data[i].id+'">'+data[i].nombre_canton+'</option>';
				}

				document.getElementById("select-solucion").innerHTML = html_select;
				console.log(html_select);
				
				

			});
				
}

function cortarTextoConPuntos(texto, limite)
					{
					  var puntosSuspensivos = "...";
					  if(texto.length > limite)
					  {
					    texto = texto.substring(0,limite) + puntosSuspensivos;
					  }

					    return texto;
					}





