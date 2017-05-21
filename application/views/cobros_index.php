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
     $(function(){
    $('#photo').on("change",function(){
   /*limpiamos vista previa*/ 
      $('#vista-previ').html('');
    $('#mensaje').html('');
    var archivo =   document.getElementById('photo').files;
    var navegador = window.URL || window.webkitURL;
    /*recorrer archivos*/
    for(x=0;x<archivo.length;x++){
        /*  validar tamaño y tipo de archivo*/
        
        var sise = archivo[x].size;
        var type = archivo[x].type;
        var name = archivo[x].name;
        
        if(sise >10240*10240){
             $('#mensaje').append('<p>el archivo es muy grande</p>');
        }
        else if(type != 'image/jpg' && type != 'image/jpeg' && type != 'image/png' ){
             $('#mensaje').append('<p>el archivo'+name+' no es una imagen permitida  pruebe con un .jpg </p>');
        } else{
            var objeto=navegador.createObjectURL(archivo[x]);
             $('#vista-previ').append(' <img src="'+objeto+'" id="imgh" >');
       }
    }
});
    
});
  $( function() {
    $( "#datepay" ).datepicker();
  } );
    function save(){
        
        data = $('#room_form').serialize();
        id= $('#id').val();
        if(id==''){
            url='<?php echo base_url();?>room/add_room';
            mensaje='Registrado correctamente.';
        }else{
            url='<?php echo base_url();?>room/edit_room';
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
                window.location.href = "<?php echo base_url()?>room";
                }
        });
       
    }
    
    function delet(code){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                "coderoom" : code
                };
             url='<?php echo base_url();?>room/delete_room';
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
                    window.location.href = "<?php echo base_url()?>room";
                }
            });
        }
    }
    function editar(codes){
            limpiar();
             var codeparam = {
                "coderoom" : codes
                };
             url='<?php echo base_url();?>room/listedit_room';
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
                $('#number').val(data.room_Number);
                $('#floor').val(data.room_Floor);
                $('#size').val(data.room_Size);
                $('#price').val(data.room_Price);
                $('#description').val(data.room_Description);
                $('#floors').val(data.room_Floors);
                if(data.room_Occupied==1){
                    $('#datepay').val(data.room_DatePay);
                }else{
                     $('#datepay').val('');
                }
                if(data.room_Bath =='1'){
                 $('#bath').prop('checked', true);   
                }
                if(data.room_Laundry =='1'){
                 $('#laundry').prop('checked', true);   
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
             url='<?php echo base_url();?>room/listedit_room';
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
    function desocupa(code){
       
         desocupar=confirm("¿Deseas desocupar el cuarto?");
        if (desocupar){
             var codeparam = {
                "coderoom" : code
                };
             url='<?php echo base_url();?>room/desocupar_room';
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
                    window.location.href = "<?php echo base_url()?>room";
                }
            });
        }
    }
    function print(){
   
   
    var numberb = $("#numberb").val();
    var floorb = $("#floorb").val();
    var stateb = $("#stateb").val();
    
    if(numberb=="")  {numberb="-";}
    if(floorb=="")  {floorb="-";}
        

    url = "<?php echo base_url();?>room/print_pdf/"+numberb+"/"+floorb+"/"+stateb;
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
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Buscar Clientes</h4>
                                        
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>room/search" method="post">


                                            <div class="row">
                                                
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Precio:</label>
                                                        <input type="text" class="form-control" name="precio"  id="precio">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">N° Cuarto:</label>
                                                        <input type="text" class="form-control" name="number" id="cuartob">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Piso:</label>
                                                    <input type="text" class="form-control" name="floor" id="piso" >
                                                    </div>
                                                </div>
											</div>
                                            
                                  <a id="print" class="btn btn-primary pull-right" href="javascript:print();">IMPRIMIR</a>
                                  <a href="<?php echo base_url();?>room/nuevo"id="newtenants"class="btn btn-primary pull-right ">NUEVA</a>
                                  <a href="<?php echo base_url();?>room" class="btn btn-primary pull-right">LIMPIAR</a>
                                  <button type="submit"class="btn btn-primary pull-right">BUSCAR</button>

                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                     
                     
                     <!--TABLA DE HABITACIONES -->
                      <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
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
                                                <th>Precio</th>>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){?>
                                                     <tr>
                                                    <td> </td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                     
                                                   <td>
                                                        
                                                        <a href="javascript:;" onclick="delet();">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/delete.png" title="Eliminar" class="iconocus">
                                                        
                                                        </a>
                                                        <a href="javascript:;" onclick="editar();">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/editar.png" title="Editar Datos" class="iconocus">
                                                        </a>
                                                        <a href="javascript:;" onclick="verdetalle();">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/verdetalle.png" title="Ver Detalle" class="iconocus2">
                                                        </a>
                                                
                                                        
                                                         <a href="javascript:;" onclick="desocupa();">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/desocupar.png" title="DESOCUPAR" style="width:30px">
                                                        </a>
                                                    
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
	<span id="titumodal">REGISTRO DE CUARTO</span>
    <form id="room_form" method="post" action="">
    <input type="hidden" name="id" id="id">
	    <div class="row">
	         <div class="col-md-3">
				 <div class="form-group ">
					<label>Número de Cuarto</label>
					<input type="text" name="number" id="number">
				 </div>
	         </div>
	          <div class="col-md-3">
				 <div class="form-group ">
					<label>Planta</label>
					<input type="text" name="floor" id="floor">
				 </div>
	         </div>
	          <div class="col-md-3">
				 <div class="form-group ">
					<label>Tamaño</label>
					<input type="text" name="size" id="size">
				 </div>
	         </div>
	          <div class="col-md-3">
				 <div class="form-group ">
					<label>Precio</label>
					<input type="text" name="price" id="price">
				 </div>
	         </div>
	    </div>
	    <div class="row">
	         <div class="col-md-6">
				 <div class="form-group ">
					<label>Detalle del cuarto</label>
                     <textarea  rows="8" name="description" id="description"></textarea>
				 </div>
	         </div>
	          <div class="col-md-6">
                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                   <label>Pisos</label><br>
                                   <input type="text" name="floors" id="floors">
                             </div>
                        </div>
                        <div class="col-md-6">
                             <div class="form-group ">
                                   <label>Fecha de pago:</label><br>
                                   <input type="text" name="datepay" id="datepay">
                             </div>
                         </div>
				     </div>
				 <div class="row">
                  <div class="col-md-6">
				 <div class="radio">
                            <h4>Servicios</h4>

                            <input type="checkbox" name="bath"  id="bath" value="1"> 
                            <label for="bath" class="alta">Baño</label>
                            
                            <input type="checkbox" name="laundry" id="laundry" value="1">
                            <label for="laundry" class="alta">Lavadero</label>
                            
                            <input type="checkbox" name="cable" id="cable" value="1">
                            <label for="cable" class="alta" style="margin-top:5px;">Cable</label>
                            
                            <input type="checkbox" name="internet" id="internet" value="1">
                            <label for="internet" class="alta">Internet</label><br>
                             </div>
                        </div>
                  <div class="col-md-6">
                  <label>Imagen</label><br>
					<input type="file" name="photo" id="photo" style="display:none">
					<label class="file" for="photo">Elegir foto</label>
					<label id="mensaje"></label>
                  <div id="vista-previ"> </div>
                   </div>
                </div>
	         </div>
	    </div>
		<center><a href="javascript:save();" class="btn btn-primary">Guardar</a>&nbsp;<a  class="btn btn-success btclose">Cancelar</a></center>
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