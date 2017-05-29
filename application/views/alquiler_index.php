  <link href="<?php echo base_url();?>assets/css/alquiler.css" rel="stylesheet">
   <link rel="stylesheet" href="<?php echo base_url();?>assets/css/jquery.datetimepicker.min.css">
   <script src="<?php echo base_url();?>assets/js/jquery.datetimepicker.full.min.js"></script>
   
   <link rel="stylesheet" href="<?php echo base_url();?>assets/css/autocaplete.css">
  <script src="<?php echo base_url();?>assets/js/autocomplete.js"></script>
  
    
   <style type="text/css">
      
   </style>
 
   
<script>
  $( function() {
    $( "#fechai" ).datetimepicker({
	formatTime:'H:i',
	formatDate:'Y-m-d'});
    $('#fechaf').datetimepicker({
	formatTime:'H:i',
	formatDate:'Y-m-d'});
    $('#fecharb').datetimepicker({
        timepicker:false,
        format:'Y-m-d',
        formatDate:'Y-m-d'
    });
      $("#cliente").autocomplete({
        source: function (request, response) {
            $.ajax({
         	   url: "<?php echo base_url();?>cliente/cliente_autocomplete",
                type: "POST",
                data: {
                    name:$("#cliente").val()
                },
                dataType: "json",
                success: function (data) {
                    response(data);
                    
                },
                error: function (data) {
						alert($("#cliente").val());
                }
            });
        },
        select: function (event, ui) {
	            $("#clienteid").val(ui.item.code);
	            $("#cliente").val(ui.item.nombre);
        },
        minLength: 1
    });
      $("#clientenameb").autocomplete({
        source: function (request, response) {
            $.ajax({
         	   url: "<?php echo base_url();?>cliente/cliente_autocomplete",
                type: "POST",
                data: {
                    name:$("#clientenameb").val()
                },
                dataType: "json",
                success: function (data) {
                    response(data);
                    
                },
                error: function (data) {
						alert($("#clientenameb").val());
                }
            });
        },
        select: function (event, ui) {
	            $("#clienteb").val(ui.item.code);
	            $("#clientenameb").val(ui.item.nombre);
        },
        minLength: 1
    });
  } );
    function save(){
        data = $('#room_form').serialize();
        id= $('#id').val();
        if(id==''){
            url='<?php echo base_url();?>alquiler/add_alquiler';
            mensaje='Registrado correctamente.';
        }else{
            url='<?php echo base_url();?>alquiler/edit_alquiler';
            mensaje='Actualizado correctamente';
        }
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'json',
            async: false,
            error: function (data) {
                alert('No se puedo completar la operación, por favor comunicarse con el administrador.');
            },
            success: function (data) {
               alert(mensaje);
                window.location.href = "<?php echo base_url()?>alquiler";
                }
        });
       
    }
    function select(Ccodigo,tdescrip,Number,tcodigo,precio,banio,AguaCaliente,Cable,Internet){
        $('#cuarto').val(Number);
        $('#cuartoid').val(Ccodigo);
        $('#precio').val(precio);
        $('#tipoid').val(tcodigo);
        
        $('#tipo').val(tdescrip);
         detalle='Con servicio de baño compartido';
        if(banio==1){
         detalle ='Con servicio de baño propio';  
        }
         if(AguaCaliente==1){
          detalle+=', Agua caliente';   
        }
         if(Cable==1){
           detalle+=', TV con cable'; 
        }
         if(Internet==1){
          detalle+=', internet';  
        }
       
        $('#detalle').val(detalle);
        calculartotal();
    }
   function calculartotal(){
    precio=$('#precio').val(); 
    aumento=$('#aumento').val();
    decuento=$('#descuento').val();
    
   
    total=precio-decuento+parseFloat(aumento);
     $('#total').val(total.toFixed(2));
   }
    function eliminar(code,cuartoid,inquilinoid){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                "codealquiler" : code,
                 "cuartoid" : cuartoid,
                 "inquilinoid" : inquilinoid
                };
             url='<?php echo base_url();?>alquiler/delete_alquiler';
            $.ajax({
                type: "POST",
                url: url,
                data: codeparam,
                dataType: 'json',
                async: false,
                error: function (data) {
                    alert('No se puedo completar la operación, por favor comunicarse con el administrador.');
                },
                success: function (data) {
                   alert('Eliminado correctamente.');
                    window.location.href = "<?php echo base_url()?>alquiler";
                }
            });
        }
    }
    function editar(codes){
            limpiar();
        
     $.post("<?php echo base_url();?>alquiler/hab_libres", {
                        "variable" : 1
                    }, function(data) {
                        var c = JSON.parse(data);
                         $('#hab_libres').html('');
                        $.each(c,function(i,item){
                            decripcion="'"+item.tcuarto_Descripcion+"'";
                            $('#hab_libres').append(' <tr><th scope="row">'+(i+1)+'</th><td>'+item.room_Number+'</td><td>'+item.tcuarto_Descripcion+'</td><td>'+item.room_Floor+'</td><td>'+item.room_Price+'</td><td> <a href="javascript:select('+item.room_Code+','+decripcion+','+item.detalle+');"><img src="<?php echo base_url();?>assets/img/iconos/derecha.png" title="Enviar Datos" class="iconocus"></a></td></tr>');

                    });

                });
             var codeparam = {
                "codealquiler" : codes
                };
             url='<?php echo base_url();?>alquiler/listedit_alquiler';
            $.ajax({
                type: "POST",
                url: url,
                data: codeparam,
                dataType: 'json',
                async: false,
                error: function (data) {
                    alert('No se puedo completar la operación, por favor comunicarse con el administrador.');
                },
                success: function (data) {
                $('#snumero').val(data.alquiler_Numero);
                $('#serie').val(data.alquiler_Serie);
                $('#cuarto').val(data.room_Number);
                $('#cuartoid').val(data.room_Code);
                $('#precio').val(data.alquiler_SubTotal);
                $('#tipo').val(data.tcuarto_Descripcion);
                $('#tipoid').val(data.room_Code);
                $('#fechai').val(data.inquilino_FechaInicio);
                $('#fechaf').val(data.inquilino_FechaFin);
                $('#descuento').val(data.alquiler_Descuento);
                 $('#aumento').val(data.alquiler_aumento);
                $('#clienteid').val(data.inquilino_Code);
                $('#cliente').val(data.person_Name+' '+data.person_LastName+' - '+data.person_Dni);
                $('#total').val(data.alquiler_Total);
                $('#detalle').val(data.alquiler_detalle);
               
                if(data.alquiler_tDocumento =='B'){
                 $('#boleta').prop('checked', true);   
                }
                if(data.alquiler_tDocumento =='F'){
                 $('#factura').prop('checked', true);   
                }
                
                  
                  $('#id').val(codes);
        
                  $('#titumodal').html('');
                 $('#titumodal').append('MODIFICAR ALQUILER: '+2+'');
                  $('.modal').css('display','block');
		          $('#modal-bg').fadeIn();
                  $( "#bodys").scrollTop( 0 );
                }
            });
    
        
    }
    function cobrar(code,cuartoid,inquilinoid){
       
         desocupar=confirm("¿Deseas Cobrar el cuarto?");
        if (desocupar){
             var codeparam = {
               "codealquiler" : code,
                 "cuartoid" : cuartoid,
                 "inquilinoid" : inquilinoid
                };
             url='<?php echo base_url();?>alquiler/cobrar_alquiler';
            $.ajax({
                type: "POST",
                url: url,
                data: codeparam,
                dataType: 'json',
                async: false,
                error: function (data) {
                    alert('No se puedo completar la operación, por favor comunicarse con el administrador.');
                },
                success: function (data) {
                   alert('Cuarto Desocupado.');
                    window.location.href = "<?php echo base_url()?>alquiler";
                }
            });
        }
    }
    function anular(code){
         desocupar=confirm("¿Deseas Anular el Documento?");
        if (desocupar){
             var codeparam = {
               "codealquiler" : code
                };
             url='<?php echo base_url();?>alquiler/anular_documento';
            $.ajax({
                type: "POST",
                url: url,
                data: codeparam,
                dataType: 'json',
                async: false,
                error: function (data) {
                    alert('No se puedo completar la operación, por favor comunicarse con el administrador.');
                },
                success: function (data) {
                   alert('Documento Anulado.');
                    window.location.href = "<?php echo base_url()?>alquiler";
                }
            });
        }
    }
    function limpiarauto(){
          $("#clienteb").val('');
	     $("#clientenameb").val('');
        $("#clienteid").val('');
	   $("#cliente").val('');
    }
    function vercomprobante(code){

    url = "<?php echo base_url();?>alquiler/vercomprobante/"+code;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
    
    function limpiar(){
        $('#id').val('');
         $('#aumento').val('');
        $('#snumero').val('');
        $('#serie').val('');
         $('#cuarto').val('');
        $('#cuartoid').val('');
        $('#precio').val('');
        $('#tipo').val('');
         $('#tipoid').val('');
        $('#fechai').val('');
        $('#fechaf').val('');
        $('#descuento').val(0);
        $('#clienteid').val('');
         $('#cliente').val('');
         $('#total').val('');
         $('#detalle').val('');
    }
</script>  
                    
                                             <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">Buscar Alquiler</h4>
                                        
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>alquiler/search" method="post">

                                            <div class="row">
                                                
                                                <div class="col-md-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Serie:</label>
                                                        <input type="text" class="form-control" name="serieb"  id="serieb" value="<?php echo $serieb; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Numero:</label>
                                                        <input type="text" class="form-control" name="numerob"  id="numerob" value="<?php echo $numerob; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Cliente:</label>
                                                    <input type="hidden" class="form-control" name="clienteb" id="clienteb" value="<?php echo $clienteb; ?>" >
                                                    <input type="text" class="form-control" name="clientenameb" id="clientenameb" value="<?php echo $clientenameb; ?>" onclick="limpiarauto();">
                                                    </div>
                                                </div>
                                                 <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Fecha R.:</label>
                                                    <input type="text" class="form-control" name="fecharb" id="fecharb" value="<?php echo $fecharb; ?>">
                                                    </div>
                                                </div>
											</div>
                                            <div class="row">
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">T. Documento:</label>
                                                        <?php echo $documentob; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">N° Cuarto:</label>
                                                       <?php echo $cuartob; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Estado:</label>
                                                    <?php echo $estadob; ?>
                                                    </div>
                                                </div>
											</div>
                                            
                                  <!--<a id="print" class="btn btn-success pull-right" href="javascript:print();">IMPRIMIR</a>-->
                                  <a id="newtenants"class="btn btn-success pull-right button">NUEVO ALQUILER</a>
                                  <a href="<?php echo base_url();?>alquiler" class="btn btn-success pull-right">LIMPIAR</a>
                                  <button type="submit"class="btn btn-success pull-right">BUSCAR</button>

                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                     
                     
                     <!--TABLA DE HABITACIONES -->
                      <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">LISTA DE COMPROBANTE</h4>
                                        <p class="category"> <?php echo count($list);?> Habitaciones encontradas</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Item</th>
                                                <th>Serie</th>
                                                <th>Numero</th>
                                                <th>Tipo</th>
                                                <th>Cliente</th>
                                                <th>Habitación</th>
                                                <th>Fecha R.</th>
                                                <th>Total</th>
                                                <th>Opción</th>
                                            </thead>

                                            <tbody>
                                                   <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){?>
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo  $value[1]; ?></td>
                                                    <td><?php echo  $value[2];?></td>
                                                <?php if( $value[3]=='B'){?>
                                                      <td><span class="tag">BOLETA</span></td>      
                                                <?php }else{?>
                                                       <td><span class="tag2">FACTURA</span></td> 
                                                <?php }?>
                                                    <td><?php echo  $value[7]; ?></td>
                                                    <td><?php echo  $value[8]; ?></td>
                                                    <td><?php echo  $value[4]; ?></td>
                                                    <td>S/.<?php echo  $value[5] ?></td>
                                                    <td>
                                                         <?php if( $value[6]==1){?>
                                                       <a href="javascript:;" onclick="editar(<?php echo $value[0]; ?>);">
                                                         <img src="<?php echo base_url();?>assets/img/iconos/update.png" title="Editar Datos" class="iconocus">
                                                       </a>
                                                       <a href="javascript:;" onclick="eliminar(<?php echo $value[0]; ?>,<?php echo $value[9]; ?>,<?php echo $value[10]; ?>);">
                                                         <img src="<?php echo base_url();?>assets/img/iconos/delete.png" title="Eliminar" class="iconocus">
                                                       </a> 
                                                        <a href="javascript:;" onclick="cobrar(<?php echo $value[0]; ?>,<?php echo $value[9]; ?>,<?php echo $value[10]; ?>);">
                                                         <img src="<?php echo base_url();?>assets/img/iconos/cobrar.png" title="Aprobar" class="iconocus">
                                                       </a>     
                                                        <?php }else{?>
                                                         
                                                       <a href="javascript:;" onclick="vercomprobante(<?php echo $value[0]; ?>);">
                                                         <img src="<?php echo base_url();?>assets/img/iconos/pdf.png" title="Ver comprobante" class="iconocus">
                                                       </a>
                                                        <?php if( $value[6]==2){?>
                                                           <a href="javascript:;" onclick="anular(<?php echo $value[0]; ?>);">
                                                             <img src="<?php echo base_url();?>assets/img/iconos/anular.jpg" title="Anular" class="iconocus">
                                                           </a>   
                                                       <?php }else{?>
                                                             <img src="<?php echo base_url();?>assets/img/iconos/anulado.jpg" title="Anulado" class="iconocus2">
                                                        <?php }}?>
                                                    </td>
                                                </tr>


                                        <?php  }} else{?>  
                                           <tr>
                                               <td colspan="6">Ningun dato encontrado para la búsqueda</td>
                                           </tr>
                                        <?php  }?>   


                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>


                        </div>
	                

 <!-- MODAL DETALLE-->
 <div class="row">
                            
<div class="modal-bg" id='modal-bg' style="display:none">
<div id="modal" class="modal">
	<span id="titumodal">Comprobante nuevo</span>
      <form id="room_form" method="post" action="">
       <div class="col-md-6">
         <div class="responsive">
           <h4>Habitaciones disponibles</h4>
            <table class="table table-sm table-striped">
              <thead>
                <tr class="bg-primary">
                 <th>#</th>
                 <th>Numero</th>
                 <th>Tipo</th>
                 <th>Piso</th>
                 <th>Precio</th>
                  <th>Opción</th>
                </tr>
              </thead>
              <tbody id="hab_libres">
              </tbody>
            </table>
         </div> 
          <div class="row">
           <div class="col-md-4">
				 <div class="form-group ">
					<label>serie.</label>
					<input type="text" name="serie" id="serie">
				 </div>
	         </div>
	       <div class="col-md-4">
				 <div class="form-group ">
					<label>N° Doc.</label>
					<input type="text" name="snumero" id="snumero" >
				 </div>
	       </div>
	         <div class="col-md-4">
				 <div class="form-group ">
					<label>N° Hab.</label>
					<input type="text" name="cuarto" id="cuarto" >
					<input type="hidden" name="cuartoid" id="cuartoid">
				 </div>
	       </div>
	      
	    </div> 
       </div>
       <div class="col-md-6">
            <input type="hidden" name="id" id="id">
	    <div class="row">
	       <div class="col-md-4">
				 <div class="form-group ">
					<label>Precio.</label>
					<input type="text" name="precio" id="precio" onblur="calculartotal();">
				 </div>
	         </div>
	       <div class="col-md-4">
				 <div class="form-group ">
					<label>Tipo</label>
					<input type="hidden" name="tipoid" id="tipoid" readonly>
					<input type="text" name="tipo" id="tipo" readonly>
				 </div>
	         </div>
	          <div class="col-md-4">
                <div class="form-group ">
                      <label>Descuento:</label><br>
                      <input type="text" name="descuento" id="descuento" value="0" onblur="calculartotal();">
                </div>
            </div>
	    </div>
	    <div class="row">
           <div class="col-md-4">
                <div class="form-group ">
                    <label>fecha Inicio</label><br>
                    <input type="text" name="fechai" id="fechai" onblur="calculartotal();">
                </div>
           </div>
           <div class="col-md-4">
                <div class="form-group ">
                      <label>Fecha de Fin:</label><br>
                      <input type="text" name="fechaf" id="fechaf" onblur="calculartotal();">
                </div>
            </div>
             <div class="col-md-4">
                <div class="form-group ">
                      <label>Aumento:</label><br>
                      <input type="text" name="aumento" id="aumento" value="0" onblur="calculartotal();">
                </div>
            </div>
         </div>
        <div class="row">
            <div class="col-md-8">
				 <div class="form-group ">
					<label>Cliente:</label>
					<input type="hidden" name="clienteid" id="clienteid">
					<input type="text" name="cliente" id="cliente" onblur="calculartotal();" onclick="limpiarauto();">
				 </div>
            </div>
            <div class="col-md-4">
				 <div class="form-group ">
					<label>Total: </label><a href="javascript:calculartotal();"><img src="<?php echo base_url();?>assets/img/iconos/rec.png" title='Recargar'  style="width:16px"></a>
					<input type="text" name="total" id="total" readonly style="border:1.5px solid #333">
				 </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
				 <div class="form-group ">
					<label>Detalle </label>
                     <textarea  rows="3" name="detalle" id="detalle"></textarea>
				 </div>
	       </div>
	        <div class="col-md-4">
				 <div class="radio">
                            <label>T. Doc. </label>
                            <input type="radio" name="documento" id="boleta" value="B" checked> 
                            <label for="boleta" class="alta">Boleta</label>
                            
                            <input type="radio" name="documento" id="factura" value="F">
                            <label for="factura" class="alta">Factura</label>
                            
                  </div>
	       </div> 
        </div>
		<center><a href="javascript:save();" class="btn btn-primary">Guardar</a>&nbsp;<a  class="btn btn-success btclose">Cancelar</a></center>
	
       </div>
    </form>
</div>
</div>
 

<script>
$(document).ready(function(){
     $('#modal-bg').fadeOut();		
	$('.modal').fadeOut();
    
$('.button').click(function(){
    $("#bodys").scrollTop( 0 );
    
    
     $.post("<?php echo base_url();?>alquiler/hab_libres", {
                        "variable" : 1
                    }, function(data) {
                        var c = JSON.parse(data);
                         $('#hab_libres').html('');
                        $.each(c,function(i,item){
                            decripcion="'"+item.tcuarto_Descripcion+"'";
                            $('#hab_libres').append(' <tr><th scope="row">'+(i+1)+'</th><td>'+item.room_Number+'</td><td>'+item.tcuarto_Descripcion+'</td><td>'+item.room_Floor+'</td><td>'+item.room_Price+'</td><td> <a href="javascript:select('+item.room_Code+','+decripcion+','+item.detalle+');"><img src="<?php echo base_url();?>assets/img/iconos/derecha.png" title="Enviar Datos" class="iconocus"></a></td></tr>');

                    });

                });
    
    
    limpiar();
     
    $('#titumodal').html('');
    $('#titumodal').append('Comprobante nuevo');
		  $('.modal').css('display','block');
		  $('#modal-bg').fadeIn();
         
	});
    $('.btclose').click(function(){
			  $('#modal-bg').fadeOut();		
			  $('.modal').fadeOut();
              $('#modal-detalle').fadeOut();		
			  $('.modal-d').fadeOut();
		  return false;
		});
});
     
    
     
     
</script>      