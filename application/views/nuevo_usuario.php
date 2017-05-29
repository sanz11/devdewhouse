<link href="<?php echo base_url();?>assets/css/tenants.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
<script>
     $( function() {
    $( "#nacimiento" ).datepicker();
  } );
    function save(){
        dni=$('#dni').val();
        nombre=$('#nombre').val();
        apellidop=$('#apellidop').val();
        apellidom=$('#apellidom').val();
        nacimiento=$('#nacimiento').val();
        user=$('#user').val();
        password=$('#password').val();
        
       if(dni==''){
           alert('complete el campo DNI');
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
        if(nacimiento==''){
           alert('seleccione FECHA DE NACIMIENTO');
            return false;
           $('#nacimiento').focus();
       }
        if(user==''){
           alert('complete el campo USUARIO');
            return false;
           $('#user').focus();
       }
        if(password==''){
           alert('complete el campo CONTRASEÑA');
            return false;
           $('#password').focus();
       }
           
        var formData= new FormData($('#user_form')[0]);
       //data = $('#user_form').serialize();
        if($('#id').val()==''){
            url='<?php echo base_url();?>users/add_users';
            mensaje="registrado correctamente.";
        }
        else{
            url='<?php echo base_url();?>users/update_users';
            mensaje="Actualizado correctamente.";
        }
        alert(url);
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
                 window.location.href = "<?php echo base_url()?>users";
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
    
     function limpiar(){
        $('#id').val('');
        $('#dni').val('');
        $('#nombre').val('');
        $('#apellidop').val('');
        $('#apellidom').val('');
        $('#password').val('');
        $('#nacimiento').val('');
        $('#user').val('');
        $('#telefono').val('');
        $('#correo').val(''); 
        $('#vista-previa').html('');
    }

</script>

<div class="row col-md-1"></div>
<div class="row col-md-10">
            <div class="card">
                <div class="card-header" data-background-color="green">
                     <h4 class="title">Registro de Usuario</h4>
                 </div>
                <div class="card-content">
   
    <form id="user_form" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="idperson" id="idperson">
	    <div class="row">
	         <div class="col-md-3">
				 <div class="form-group ">
					<label>DNI</label>
					<input type="text" name="dni" id="dni">
				 </div>
	         </div>
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
					<label>Correo</label>
					<input type="text" name="correo" id="correo">
				 </div>
	         </div>
	          <div class="col-md-3">
				 <div class="form-group">
					<label>Fecha de nacimiento</label><br>
					<input type="text" name="nacimiento" id="nacimiento">
				 </div>
	         </div>
	          <div class="col-md-3">
				 <div class="form-group">
					<label>FOTO</label><br>
					<input type="file" name="photo" id="photo" style="display:none">
					<label class="file" for="photo">Elegir foto</label>
					<label id="mensaje"></label>
				 </div>
	         </div>
	    </div>
	    <div class="row">
	          <div class="col-md-3">
				 <div class="radio2">
                            <h4>Genero</h4>
                            <input type="radio" name="genero" id="masculino" value="1" checked> 
                            <label for="masculino" class="alta">Masculino</label>
                            
                            <input type="radio" name="genero" id="femenino" value="2">
                            <label for="femenino" class="alta">Fenenino</label><br><br>
                            
                  </div>
	         </div>
	         <div class="col-md-3">
				<div class="form-group ">
					<label>Usuario</label>
					<input type="text" name="user" id="user">
				 </div>
	         </div>
	          <div class="col-md-3">
	              <div class="form-group ">
					<label>Password</label>
					<input type="text" name="password" id="password">
				 </div>
	          </div>
	         <div class="col-md-3 " id="vista-previa"> </div>
	    </div>
	    
		<center><a href="javascript:save();" class="btn btn-primary">Guardar</a>&nbsp;
		<a href="<?php echo base_url();?>users" id="btclose" class="btn btn-success btclose">Cancelar</a></center>
	</form>
</div>
</div>

<div class="clearfix"></div>
               </div>
             </div>
  </div>
                           
	        
<script src="<?php echo base_url();?>assets/js/upload.js"></script>