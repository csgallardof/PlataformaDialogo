
function getSelectValue(){

				var selectedValue= document.getElementById("select-provincia").value;
				//alert(selectedValue);
				console.log(selectedValue);
				if(selectedValue==""){
					//alert("no exite id");
					var html_select_vacio = '<option value="">Seleccione Canton</option>';
					document.getElementById("select-canto").innerHTML = html_select_vacio;
					console.log(html_select_vacio);
					
				}else
			$.get('/api/provincia/'+selectedValue+'/cantones',function(data){
				
				
				//console.log(data)
				//alert(selectedValue);
				//alert("si exite id");
					var html_select = '<option value="">Seleccione Canton</option>';
				for (var i = 0; i <data.length; i++) {

					 	html_select += '<option value="'+data[i].id+'">'+data[i].nombre_canton+'</option>';
					 //html_select += '<option value="'+data[i].id+'">'+data[i].nombre_canton+'</option>';
				}
				document.getElementById("select-canto").innerHTML = html_select;
				//console.log(html_select);
				
				

			});
			} 




