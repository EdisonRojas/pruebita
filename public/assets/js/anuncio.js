$(document).ready(function(){

	







	$("#enlace-addtelefono").click(function(e){
 	    e.preventDefault();
        $('#telefono_contenedor').show();
        $('#addtelefono_contenedor').hide();
    });
    
    $('#delete').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmoddelete').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#publish').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmodpublicar').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#deactivate').on('show.bs.modal', function(e) { 
    	$(this).find('.btnmoddesactivar').attr('href', $(e.relatedTarget).data('href'));
    });

	

	$('input[name="options"]').change(function(){ 
		seccion_id=$( 'input[name="options"]:checked' ).val();
		
			if(seccion_id==1){
				$("#opcion2").removeClass();
				$("#opcion3").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}else if(seccion_id==2){
				$("#opcion1").removeClass();
				$("#opcion3").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}else if(seccion_id==3){
				$("#opcion1").removeClass();
				$("#opcion2").removeClass();
				$("#opcion"+seccion_id).addClass("glyphicon glyphicon-ok");
			}
		
		$.ajax({
			url: 'categorias',
			type: 'POST',
			data: 'seccion2='+seccion_id, //enviamos el id
			dataType: 'json',
			success: function(categoria){
				$('select#subcategoria').html('');
				$('select#subcategoria').append($('<option></option>').text('- Subcategorias -').val(''));
				
				$('input:hidden[name=seccion_id]').val(seccion_id );
			
				$('select#categoria').html('');
				$('select#categoria').append($('<option></option>').text('-Categorias-').val('')); 
						
				$.each(categoria, function(i) {
					$('select#categoria').append("<option class='opciones_categorias' value=\""+categoria[i].id+"\">"+categoria[i].categoria+"<\/option>");
				});
			}
		})
	});
 	//El metodo Change sobre el select categorias y permitir cargar las subcategorias
	$("#categoria").change(function(event){
		var categoria_id = $("#categoria option:selected").val(); 
		//Por medio de AJAX consultamos la ruta creada en laravel llamada estados la cual recibe el id del país
		$.ajax({
			url: 'subcategorias',
			type: 'POST',
			data: 'categoria='+categoria_id, //enviamos el id
			dataType: 'json',
			success: function(subcategoria){
				$('select#subcategoria').html('');
				$('select#subcategoria').append($('<option></option>').text('- Subcategorías -').val('')); 

				$('select#opcion_seccion').html('');
				$('select#opcion_seccion').append($('<option></option>').text('- Pregunta -').val(''));
				//recorremos con el metodo each el objeto
				$.each(subcategoria, function(i) {
					//Con los parametros que recibimos en nuestro objeto estado creamos las opciones
					$('select#subcategoria').append("<option value=\""+subcategoria[i].id+"\">"+subcategoria[i].subcategoria+"<\/option>");
				});
			}
		})
	});

	$("#subcategoria").change(function(event) {
		//var seccion_id = $("#seccion option:selected").val();  //obtenemos el id del pais que se mantiene seleccionado
		var seccion_id=$( 'input[name="options"]:checked' ).val();

		$.ajax({
			url: 'opcion',
			type: 'POST',
			data: 'seccion='+seccion_id, //enviamos el id
			dataType: 'json',
			success: function(opcion){
				$('select#opcion_seccion').html('');
				$('select#opcion_seccion').append($('<option></option>').text('- Pregunta -').val('')); 
				//$('select#opcion-seccion').append("<option value='0'>"+"Elegir opción"+"</option>");
				$.each(opcion, function(i) {
					
					$('select#opcion_seccion').append("<option value=\""+opcion[i].id+"\">"+opcion[i].opcion+"<\/option>");
				});
				$('#pregunta_seccion').show();
			}
		})
	});


	$("#enviarcomentario").click(function(e){
		var anuncio_id = $("#anuncio_id").val(); 
	//	alert(anuncio_id);
		ruta= anuncio_id+'/'+'comentario';
		

       	$.ajax({
			url:ruta,
			type:'POST',
			data: $("#form").serialize(),
			//dataType: 'json',
			beforeSend: function(respuesta) {
           		 //$("#mensaje").text("enviando....");
   				 //$("#mensaje").text("enviando....");

   				 $("#img-cargando").show();

   				 $("#enviarcomentario").hide(200);
        	},
			success: function (comentarios){
				//$("#_email, #_name, #_subject, #_msg, #_g-recaptcha-response").text('');
			
				document.getElementById('form').reset();

				if(comentarios.success==true){
					$("#enviarcomentario").show(200);	
					$("#img-cargando").hide();
					$("#mensaje").html('');
					$("#mensaje").append("<p class='bg-info'>"+"Tu comentario fue publicado"+"<\/p>");
					$("#_comentario").html('');


					$('.chat').append("<li class='left clearfix'>"+"<span class='chat-img pull-left'>"
						+"<img src='"+comentarios.foto+"' class='img-circle img-comentario' \/>"
						+"<\/span>"

						+"<div class='chat-body clearfix'>"+"<div class='header'>"
							+"<strong class='primary-font'>"+comentarios.nombres+"<\/strong>"
							+"<small class='pull-right text-muted'>"
								+"<span class='glyphicon glyphicon-time'>"+"<\/span>"+comentarios.fecha
							+"<\/small>"
						+"<\/div>"	
							+"<p>"+comentarios.comentario+"<\/p>"
						+"<\/div>"
						+"<\/li>");
				}else if(comentarios.success==false){
					$("#img-cargando").hide();
					$("#enviarcomentario").show(200);
					$("#mensaje").html('');
					$.each(comentarios.errors, function(index, value){
						$("#_"+index).text(value);
					});
							//$("#reca").;
				}//else{
					//document.getElementById('form').reset();
                   // $("#mensaje").text("Mensaje enviado con éxito");
				//}
			},
			error: function(response){
		          //alert('Error');
		        console.log(response);
		    }
		})    
    });

	$(".respuesta").click(function(e){
		e.preventDefault();
		alert('soy el boton responder');

		var estetituloes= $(this).data('title');
		alert(estetituloes);

		$('.ocultisimo').hide();
		$('.cajaresponder_'+estetituloes).show();

		$(this).hide();
		/*Aqui termina, solo muestra lA CAJA CORRESPONDIENTE*/
	});
	
	$(".cancelarespuesta").click(function(e){
		e.preventDefault();
		alert('soy ecancelar');

		$('.ocultisimo').hide();
		$('.respuesta').show();

		
		/*Aqui termina, solo muestra lA CAJA CORRESPONDIENTE*/
	});


	$(".enviarrespuesta").click(function(e){
		alert('hola soy enviado respuesta');
		var anuncio_id = $("#anuncio_id").val(); 

		var comentariotitulo= $(this).data('title');
		alert(comentariotitulo);
	//	alert(anuncio_id);
		ruta= anuncio_id+'/'+'respuesta';
		alert(ruta);

		$.ajax({
			url:ruta,
			type:'POST',
			data: $("#formrespuesta_"+comentariotitulo).serialize(),
			//dataType: 'json',
			beforeSend: function(respuesta) {
           		
        	},
			success: function (respuestas){
				//$("#_email, #_name, #_subject, #_msg, #_g-recaptcha-response").text('');
			
				document.getElementById('formrespuesta_'+comentariotitulo).reset();
				$('.ocultisimo').hide();
				$('.respuesta').show();
				$(".respuesta-enviada"+comentariotitulo).html('');
				
				if(respuestas.success==true){

					$(".respuesta-enviada"+comentariotitulo).append("<p class='bg-info'>"+"Tu respuesta fue publicada"+"<\/p>");
					$('.listarespuesta_'+comentariotitulo).append("<li class='left clearfix'>"
						+"<div class='cajita-respuesta'>"
							+"<span class='chat-img pull-left'>"
							+"<img src='"+respuestas.foto+"' class='img-circle img-respuesta' \/>"
							+"<\/span>"

							+"<div class='chat-respuesta clearfix'>"
								+"<div class='header'>"
									+"<strong class='fuente-nombrecomentario'>"+respuestas.nombres+"<\/strong>"
									+"<small class='pull-right text-muted'>"
									+"<span class='glyphicon glyphicon-time'>"+"<\/span>"+respuestas.fecha
									+"<\/small>"
								+"<\/div>"	
								+"<p>"+respuestas.respuesta+"<\/p>"
							+"<\/div>"
						+"<\/div>"
						+"<\/li>");

					

				}else if(respuestas.success==false){
					
					$.each(respuestas.errors, function(index, value){

						//$("#_"+index).text(value);
						alert('ehh');
						$(".respuesta-enviada"+comentariotitulo).append("<p class='bg-danger'>"+"Tu respuesta no pudo ser publicada"+"<\/p>");
					});
							//$("#reca").;
				}
			},
			error: function(response){
		          //alert('Error');
		        console.log(response);
		    }
		})    






	});

	
});        