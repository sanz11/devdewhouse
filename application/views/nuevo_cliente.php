<!--<link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">-->
<link href="<?php echo base_url();?>assets/css/tenants.css" rel="stylesheet">
<script>
    $( function() {
    $( "#nacimiento" ).datepicker();
  } );
    function save(){
        id=$('#id').val();
        nombre=$('#nombre').val();
        apellidop=$('#apellidop').val();
        apellidom=$('#apellidom').val();
        
       if(edad==''){
           alert('complete el campo EDAD');
           return false;
           $('#dni').focus();
       }
        if(nombre==''){
           alert('complete el campo NOMBRE');
            return false;
           $('#nombre').focus();
       }
        if(apellidop==''){
           alert('complete el campo APELLIDO PATERNO');
            return false;
           $('#apellidos').focus();
       }
        if(apellidom==''){
           alert('complete el campo APELLIDO MATERNO');
            return false;
           $('#apellidos').focus();
       }
        
        
        if(id==''){
          url='<?php echo base_url();?>tenants/add_tenants';
            mensaje='Registrado correctamente.';
       }
        else{
            url='<?php echo base_url();?>tenants/update_tenants';
            mensaje='Actualizado correctamente.';
        }
        
       data = $('#inquilino_form').serialize();
        
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
                 window.location.href = "<?php echo base_url()?>tenants";
                }
        });
       
    }
    
    function delet(code,roomcode){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                "codetenants" : code,
                 "room" : roomcode
                };
             url='<?php echo base_url();?>tenants/delete_tenants';
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
                    window.location.href = "<?php echo base_url()?>tenants";
                }
            });
        }
    }
    function editar(codes){
            limpiar();
             var codeparam = {
                "codetenants" : codes
                };
             url='<?php echo base_url();?>tenants/listedit_tenants';
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
                $('#dni').val(data.person_Dni);
                $('#nombre').val(data.person_Name);
                $('#apellidop').val(data.person_LastName);
                $('#apellidom').val(data.person_LastName2);
                $('#telefono').val(data.person_Cellphone);
                $('#telefono2').val(data.person_Cellphone2);
                $('#direccion').val(data.person_DirectionOc);
                $('#correo').val(data.person_Email);  
                $('#ncuarto').val(data.room_Number); 
                $('#nacimiento').val(data.person_BirthDate);
               
                
                if(data.person_sex =='1'){
                 $('#masculino').prop('checked', true);   
                }
                if(data.person_sex =='0'){
                 $('#femenino').prop('checked', true);   
                }
                
                  $('#id').val(codes);
                  $('#titumodal').html('');
                  $('#titumodal').append('MODIFICAR DATOS DEL INQUILINO: '+data.person_Name+'');
                  $('.modal').css('display','block');
		          $('#modal-bg').fadeIn();
                  $( "#bodys").scrollTop( 0 );
                }
            });
    
        
    }
    function contrato(codes){
    url = "<?php echo base_url();?>tenants/contrato/"+codes;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
    }

    function limpiar(){
        $('#id').val('');
        $('#dni').val('');
        $('#nombre').val('');
        $('#apellidop').val('');
        $('#apellidom').val('');
        $('#telefono').val('');
        $('#telefono2').val('');
        $('#direccion').val('');
        $('#correo').val('');  
        $('#nacimiento').val('');
    }
    function print(){
   
   
    var name = $("#nameb").val();
    var apellido = $("#apellidob").val();
    var cuarto = $("#cuartob").val();
    var sexo = $("#sexob").val();
    var dni = $("#dnib").val();
    var estado = $("#estadob").val();
    
    if(name=="")  {name="-";}
    if(apellido=="")  {apellido="-";}
    if(cuarto=="")  {cuarto="-";}
    if(dni=="")  {dni="-";}
        
//
//    var datafechaIni="";var datafechafin="";
//
//    if(fech1=="") {
//        fech1="--";
//    }else{
//        fechai=$("#fech1").val().split("/"); 
//        fech1=fechai[2]+"-"+fechai[1]+"-"+fechai[0];
//    }
//
//    if(fech2=="") {
//        fech2="--";
//    }else{
//        fechaf=$("#fech2").val().split("/");
//        fech2=fechaf[2]+"-"+fechaf[1]+"-"+fechaf[0];
//
//    }

    url = "<?php echo base_url();?>tenants/print_pdf/"+name+"/"+apellido+"/"+cuarto+"/"+sexo+"/"+dni+"/"+estado;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
</script>


<div class="modal-bg" id="modal" >
<div id="moda" class="moda">
	<span  id="titumoda">REGISTRO DE CLIENTES</span>
    <form id="inquilino_form" method="post" action="">
    <input type="hidden" id="id" name="id">
	    <div class="row">
	         
	          <div class="col-md-3">
				 <div class="form-group ">
					<label>Nombre</label>
					<input type="text" name="nombre" id="nombre">
				 </div>
	         </div>
	         <div class="col-md-3">
				 <div class="form-group ">
					<label>Apellido Paterno</label>
					<input type="text" name="apellidop" id="apellidop">
				 </div>
	         </div>
	         <div class="col-md-3">
				 <div class="form-group ">
					<label>Apellidos Materno</label>
					<input type="text" name="apellidom" id="apellidom">
				 </div>
	         </div>
	    </div>
	    <div class="row">
         <div class="col-md-3">
				 <div class="form-group ">
					<label>Telefono</label>
					<input type="text" name="telefono" id="telefono">
				 </div>
	         </div>
            <div class="col-md-3">
				 <div class="form-group ">
					<label>Edad</label>
					<input type="number" name="edad" id="edad">
				 </div>
	       </div>
	          <div class="col-md-6">
				 <div class="radio2">
                            <h4>Sexo</h4>
                            <input type="radio" name="sexo" id="masculino" value="1" checked> 
                            <label for="masculino" class="alta">Masculino</label>
                            
                            <input type="radio" name="sexo" id="femenino" value="0">
                            <label for="femenino" class="alta">Fenenino</label><br><br>
                            
                  </div>
	         </div>
	    </div>
	    
		<center><a onclick="save();" class="btn btn-primary">Guardar</a>&nbsp;<a href="<?php echo base_url();?>tenants" id="btclose" class="btn btn-success btclose">Cancelar</a></center>
	</form>
</div>
</div>