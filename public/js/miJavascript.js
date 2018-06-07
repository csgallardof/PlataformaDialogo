
function borrarSolucion( id, nombre_solucion ){   ///   AJAX

	document.getElementById("nombre_solucion").innerHTML= "<h4>Eliminar soluci&oacute;n <strong>"+nombre_solucion+"</strong></h4>";
			
	var xmlhttp;
	if (window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
	else
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp.onreadystatechange=function()
		{
					
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
					document.getElementById("nombreCategoria2").innerHTML=xmlhttp.responseText;

					document.getElementById("botonBorrarSolucion").onclick = function(){
						location= "{{ '/soluciones/'"+id+" }}";
						//location= "çç../../../../solucion/"+id;
					};
				}

		}
			xmlhttp.open("GET","../../../../soluciones/verDatosSolucionAJAX/"+id,true);
			xmlhttp.send();
}
