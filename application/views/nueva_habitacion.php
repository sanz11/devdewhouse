  <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
    
   <style type="text/css">
       #imgh { 
           width:200px;
           height:120px;
           margin-left: -30px;
           margin-top: 10px;
       }
   </style>
    
   <script>
   
    function save(){
        numero=$('#numero').val();
        piso=$('#piso').val();
        tamanio=$('#tamanio').val();
        precio=$('#precio').val();
        detalle=$('#description').val();
       	banio=$('#banio').val();
        tcuarto=$('#tcuarto').val();
		agua=$('#agua').val();
		cable=$('#cable').val();
		internet=$('#internet').val();
        
       if(numero==''){
           alert('complete el campo NUMERO DE HABITACION');
           $('#numero').focus();
           return false;
       }
      if(tcuarto=='0'){
           alert('seleccione el TIPO DE HABITACION');
           $('#tcuarto').focus();
           return false;
       }
        if(piso==''){
           alert('complete el campo PISO');
           $('#piso').focus();
            return false;
       }
        if(tamanio==''){
           alert('complete el campo TAMAÑO');
           $('#tamanio').focus();
            return false;
       }
        if(precio==''){
           alert('complete el campo PRECIO');
           $('#precio').focus();
            return false;
       }
        if(detalle==''){
           alert('complete DETALLE de la habitacion');
           $('#description').focus();
            return false;
       }
        
           
        //var formData= new FormData($('#room_form')[0]);
       data = $('#room_form').serialize();
        if($('#id').val()==''){
            url='<?php echo base_url();?>habitacion/add_habitacion';
            mensaje="registrado correctamente.";
        }
        else{
            url='<?php echo base_url();?>habitacion/update_habitacion';
            mensaje="Actualizado correctamente.";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'json',
            async: false,
            error: function (data) {
                alert('No se puedo completar la operación.');
            },
            success: function (data) {
               alert(mensaje);
                 window.location.href = "<?php echo base_url()?>habitacion";
                }
        });
        
    }

</script>
                           

	<div class="row">
            <div class="card">
                <div class="card-header" data-background-color="green">
                     <h4 class="title">Registro de habitacion</h4>
                 </div>
                <div class="card-content">
                 <form id="room_form" method="post" action="">
                    <input type="hidden" name="id" id="id"> 
                     <div class="row">     
                         <div class="col-md-3">
				             <div class="form-group ">
					            <label>N° Cuarto</label>
					            <input type="text" name="numero" id="numero">
				             </div>
	                     </div>
	                      <div class="col-md-3">
			            	 <div class="form-group ">
			            		<label>Piso</label>
			            		<input type="text" name="piso" id="piso">
			            	 </div>
	                     </div>
	                      <div class="col-md-3">
			            	 <div class="form-group ">
			            		<label>Tamaño</label>
			            		<input type="text" name="tamanio" id="tamanio">
			            	 </div>
	                     </div>
	                      <div class="col-md-3">
			            	 <div class="form-group ">
			            		<label>Precio</label>
			            		<input type="text" name="precio" id="precio">
			            	 </div>
	                     </div>
	                </div>
         <div class="row">
	         <div class="col-md-6">
				 <div class="form-group ">
					<label>Detalle del cuarto</label>
                     <textarea  rows="7" name="description" id="description"></textarea>
				 </div>
	         </div>
            <div class="col-md-6">
            <div class="row">
                <div class="col-md-4">
				     <div class="form-group ">
					    <label>Tipo de Cuarto</label>
					        <?php echo $tcuarto; ?>
				     </div>
	            </div>
            </div>
            <div class="row">
                <div class="radio">
                  <h4>Servicios</h4>

                  <input type="checkbox" name="banio"  id="banio" value="1"> 
                  <label for="banio" class="alta">Baño Privado</label>
                            
                  <input type="checkbox" name="agua" id="agua" value="1">
                  <label for="agua" class="alta">Agua Caliente</label>
                            
                  <input type="checkbox" name="cable" id="cable" value="1">
                  <label for="cable" class="alta" style="margin-top:5px;">Cable</label>
                            
                  <input type="checkbox" name="internet" id="internet" value="1">
                  <label for="internet" class="alta">Internet</label><br>
                </div>
            </div>
           
             </div>
           
        </div>
	    </div>
		<center><a href="javascript:save();"  class="btn btn-primary" >Guardar</a>&nbsp;<a href="<?php echo base_url();?>habitacion" class="btn btn-success btclose">Cancelar</a></center>
	</form>
          
                <div class="clearfix"></div>
               </div>
             </div>
  </div>
                           
	        