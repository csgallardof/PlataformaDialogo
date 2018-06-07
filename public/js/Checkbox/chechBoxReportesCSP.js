//alert("hola");
function seleccionar_todo(){ 
	document.getElementById('seleccionar').style.display='none'
	document.getElementById('deseleccionar').style.display='inline'
   for (i=0;i<document.f1.elements.length;i++) 

      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
	document.getElementById('seleccionar').style.display='inline'
	document.getElementById('deseleccionar').style.display='none'
   for (i=0;i<document.f1.elements.length;i++) 
      if(document.f1.elements[i].type == "checkbox")	
         document.f1.elements[i].checked=0 
}
