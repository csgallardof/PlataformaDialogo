
  window.setInterval(function(){
  /// call your function here
        $('#backg').fadeTo('slow', 0.3, function()
      {
          var ind_img = Math.floor(Math.random() * (3+1));
          var imgs = ["../imagenes/dialogo_nacional/nueva_imagen/bg_header.jpg", "../imagenes/dialogo_nacional/nueva_imagen/bg_header2.jpg", "../imagenes/dialogo_nacional/nueva_imagen/bg_header3.jpg","../imagenes/dialogo_nacional/nueva_imagen/bg_header4.jpg"];
          img_ac = imgs[ind_img];
          $(this).css('background-image', 'url(' + img_ac + ')');
      }).delay(1000).fadeTo('slow', 1);
}, 5000);
