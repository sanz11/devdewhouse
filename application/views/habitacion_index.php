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
    
  $( function() {
    $( "#datepay" ).datepicker();
  } );
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
            url='<?php echo base_url();?>habitacion/edit_habitacion';
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

    function delet(code){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                "coderoom" : code
                };
             url='<?php echo base_url();?>habitacion/delete_habitacion';
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
                    window.location.href = "<?php echo base_url()?>habitacion";
                }
            });
        }
    }
    function editar(codes){
            limpiar();
             var codeparam = {
                "coderoom" : codes
                };
             url='<?php echo base_url();?>habitacion/listedit_habitacion';
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
                //alert(data.room_Code);
                $('#numero').val(data.room_Number);
                $('#piso').val(data.room_Floor);
                $('#tamanio').val(data.room_Size);
                $('#precio').val(data.room_Price);
                $('#description').val(data.room_Description);
                $('#tcuarto').val(data.tcuarto_Codigo);
                
                if(data.room_Bath =='1'){
                 $('#banio').prop('checked', true);   
                }
                if(data.room_AguaCaliente =='1'){
                 $('#agua').prop('checked', true);   
                }
                if(data.room_Cable =='1'){
                 $('#cable').prop('checked', true);   
                }
                if(data.room_Internet =='1'){
                 $('#internet').prop('checked', true);   
                }
                
                  $('#id').val(codes);
                  $('#titumodal').html('');
                  $('#titumodal').append('MODIFICAR DATOS DEL CUARTO: '+data.room_Number+'');
                  $('.modal').css('display','block');
		          $('#modal-bg').fadeIn();
                  $( "#bodys").scrollTop( 0 );
                }
            });
    
        
    }
    function verdetalle(codes){
            limpiardetalle();
             var codeparam = {
                "coderoom" : codes
                };
             url='<?php echo base_url();?>habitacion/listedit_room';
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
                //alert(data.room_Code);
                $('#number-d').append(data.room_Number);
                $('#floor-d').append(data.room_Floor);
                $('#size-d').append(data.room_Size);
                $('#price-d').append(data.room_Price);
                $('#description-d').append(data.room_Description);
                $('#floors-d').append(data.room_Floors);
                
                if(data.room_Bath =='1'){
                 $('#Baño-d').append('<div class="col-md-6">Baño </div>');   
                }
                if(data.room_Laundry =='1'){
                 $('#Lavadero-d').append('<div class="col-md-6">lavadero </div>');   
                }
                if(data.room_Cable =='1'){
                 $('#Cable-d').append('<div class="col-md-6">Cable </div>');   
                }
                if(data.room_Internet =='1'){
                 $('#Internet-d').append('<div class="col-md-6">Internet </div>');   
                }
                
                  $('#id').val(codes);
                  $('#titumodal').html('');
                  $('#titumodal').append('MODIFICAR DATOS DEL CUARTO: '+data.room_Number+'');
                  $('.modal-d').css('display','block');
		          $('#modal-detalle').fadeIn();
                  $( "#bodys").scrollTop( 0 );
                }
            });
    
            $.post("<?php echo base_url();?>tenants/get_person_room", {
                        "room" : codes
                    }, function(data) {
                        var c = JSON.parse(data);
                         $('#tabladetalle').html('');
                        $.each(c,function(i,item){
                            $('#tabladetalle').append(' <tr><th scope="row">'+i+1+'</th><td>'+item.person_Name+'</td><td>'+item.person_Dni+'</td><td>'+item.person_Email+'</td><td>'+item.person_Cellphone+'</td></tr>');

                    });

                });
    }
    function print(){
   
   
    var numberb = $("#numerob").val();
    var floorb = $("#pisob").val();
    var stateb = $("#estado").val();
    
    if(numberb=="")  {numberb="-";}
    if(floorb=="")  {floorb="-";}
        

    url = "<?php echo base_url();?>habitacion/print_pdf/"+numberb+"/"+floorb+"/"+stateb;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
    
    function limpiar(){
        $('#titumodal').val('');
        $('#number').val('');
        $('#floor').val('');
        $('#datepay').val('');
        $('#size').val('');
        $('#price').val('');
        $('#description').val('');
        $('#floors').val('');
        $('#bath').prop('checked', false);  
        $('#laundry').prop('checked', false); 
        $('#cable').prop('checked', false);
        $('#internet').prop('checked', false);  
    }
    function limpiardetalle(){
        $('#titumodal-d').html('');
        $('#number-d').html('');
        $('#floor-d').html('');
        $('#size-d').html('');
        $('#price-d').html('');
        $('#description-d').html('');
        $('#floors-d').html('');
        $('#Baño-d').html('');  
        $('#Lavadero-d').html(''); 
        $('#Cable-d').html('');
        $('#Internet-d').html('');
        $('#tabladetalle').html('');
    }
</script>  
                    
                                             <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">Buscar Habitaciones</h4>
                                        
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>habitacion/search" method="post">


                                            <div class="row">
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Estado:</label>
                                                       <?php echo $estado;?>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">N° Cuarto:</label>
                                                        <input type="text" class="form-control" name="numerob" id="numerob" value="<?php echo $number;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Piso:</label>
                                                    <input type="text" class="form-control" name="pisob" id="pisob" value="<?php echo $floor;?>">
                                                    </div>
                                                </div>
											</div>
                                            
                                  <a id="print" class="btn btn-success pull-right" href="javascript:print();">IMPRIMIR</a>
                                  <a href="<?php echo base_url();?>habitacion/nuevo"id="newtenants"class="btn btn-success pull-right ">NUEVA</a>
                                  <a href="<?php echo base_url();?>habitacion" class="btn btn-success pull-right">LIMPIAR</a>
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
                                        <h4 class="title">LISTA DE HABITACIONES</h4>
                                        <p class="category"> <?php echo count($list);?> Habitaciones encontradas</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Item</th>
                                                <th>Número</th>
                                                <th>Piso</th>
                                                <th>Medida</th>
                                                <th>Precio</th>
                                                <th>Ocupado</th>
                                                <th>Opción</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){?>
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo $value->room_Number; ?></td>
                                                    <td><?php echo $value->room_Floor; ?></td>
                                                    <td><?php echo $value->room_Size; ?> m</td>
                                                     <td>S/.<?php echo $value->room_Price; ?></td>
                                                   <?php if($value->room_Occupied==0){?>
                                                        <td><span class="tag">Disponible</span></td>
                                                     <?php }else{?>
                                                         <td><span class="tag2">Ocupado</span></td>
                                                      <?php }?>
                                                   <td>
                                                        <?php if($value->room_Occupied==0){?>
                                                        <a href="javascript:;" onclick="delet(<?php echo $value->room_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/delete.png" title="Eliminar" class="iconocus">
                                                        <?php }?>
                                                        </a>
                                                        <a href="javascript:;" onclick="editar(<?php echo $value->room_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/editar.png" title="Editar Datos" class="iconocus">
                                                        </a>
                                                      <!--  <a href="javascript:;" onclick="verdetalle(<?php echo $value->room_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/verdetalle.png" title="Ver Detalle" class="iconocus2">
                                                        </a>-->
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
	<span id="titumodal">EDITAR HABITACION</span>
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
		<center><a href="javascript:save();" class="btn btn-success">Guardar</a>&nbsp;<a  class="btn btn-info btclose">Cancelar</a></center>
	</form>
</div>
</div>
 

<script>
$(document).ready(function(){
     $('#modal-bg').fadeOut();		
	$('.modal').fadeOut();
    
$('.button').click(function(){
    $("#bodys").scrollTop( 0 );
    limpiar();
     
    $('#titumodal').html('');
    $('#titumodal').append('REGISTRO DE CUARTO');
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
     
 //<button type="submit" class="btn btn-primary">Guardar</button>  <a href="javascript:save();" class="btn btn-primary">Guardar</a>
     
     
     
     
</script>      