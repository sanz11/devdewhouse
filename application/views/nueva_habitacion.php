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
 /* $( function() {
    $( "#datepay" ).datepicker();
  } );*/
    function save(){
        numero=$('#number').val();
        piso=$('#floor').val();
        tamaño=$('#size').val();
        precio=$('#price').val();
        detalle=$('#description').val();
       baño=$('#bath').val();
		 agua=$('#laundry').val();
		cable=$('#cable').val();
		internet=$('#internet').val();
        
       if(numero==''){
           alert('complete el campo NUMERO DE HABITACION');
           return false;
           $('#number').focus();
       }
        if(piso==''){
           alert('complete el campo PISO');
            return false;
           $('#floor').focus();
       }
        if(tamaño==''){
           alert('complete el campo TAMAÑO');
            return false;
           $('#size').focus();
       }
        if(precio==''){
           alert('complete el campo PRECIO');
            return false;
           $('#price').focus();
       }
        if(detalle==''){
           alert('complete DETALLE de la habitacion');
            return false;
           $('#description').focus();
       }
        
           
        var formData= new FormData($('#room_form')[0]);
       //data = $('#user_form').serialize();
        if($('#id').val()==''){
            url='<?php echo base_url();?>room/add_room';
            mensaje="registrado correctamente.";
        }
        else{
            url='<?php echo base_url();?>room/update_room';
            mensaje="Actualizado correctamente.";
        }
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            dataType: 'json',
            async: false,
            cache:false,
            contentType:false,
            processData:false,
            error: function (data) {
                alert('No se puedo completar la operación.');
            },
            success: function (data) {
               alert(mensaje);
                 window.location.href = "<?php echo base_url()?>room";
                }
        });
        
    }
    
    $(function(){
    $('#photo').on("change",function(){
   /*limpiamos vista previa*/ 
      $('#vista-previa').html('');
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
             $('#vista-previa').append(' <img src="'+objeto+'" id="foto">');
       }
    }
});
    
});
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
					<label>Piso</label>
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
                        <!--<div class="col-md-6">
                             <div class="form-group ">
                                   <label>Fecha de pago:</label><br>
                                   <input type="text" name="datepay" id="datepay">
                             </div>
                         </div>-->
				     
				 
                  <div class="col-md-2">
				 <div class="radio">
                            <h4>Servicios</h4>

                            <input type="checkbox" name="bath"  id="bath" value="1"> 
                            <label for="bath" class="alta">Baño</label>
                            
                            <input type="checkbox" name="laundry" id="laundry" value="1">
                            <label for="laundry" class="alta">Agua</label>
                            
                            <input type="checkbox" name="cable" id="cable" value="1">
                            <label for="cable" class="alta" style="margin-top:5px;">Cable</label>
                            
                            <input type="checkbox" name="internet" id="internet" value="1">
                            <label for="internet" class="alta">Internet</label><br>
                             </div>
                        </div>
                  <div class="col-md-4">
                  <label>Imagen</label><br>
					<input type="file" name="photo" id="photo" style="display:none">
					<label class="file" for="photo">Elegir foto</label>
					<label id="mensaje"></label>
                  <div id="vista-previ"> </div>
                   </div>
                </div>
	    </div>
		<center><a href="" onclick="save();" class="btn btn-primary" >Guardar</a>&nbsp;<a href="<?php echo base_url();?>room" class="btn btn-success btclose">Cancelar</a></center>
	</form>
