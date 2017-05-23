<!--<link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">-->
<link href="<?php echo base_url();?>assets/css/tenants.css" rel="stylesheet">
<script>
    $( function() {
    $( "#nacimiento" ).datepicker();
  } );
    function save(){
       dni=$('#dni').val();
        nombre=$('#nombre').val();
        apellidop=$('#apellidop').val();
        apellidom=$('#apellidom').val();
        telefono=$('#telefono').val();
        edad=$('#edad').val();
        
       if(dni==''){
           alert('complete el campo DNI');
           $('#dni').focus();
           return false;
       }
        if(nombre==''){
           alert('complete el campo NOMBRE');
           $('#nombre').focus();
           return false;
       }
        if(apellidop==''){
           alert('complete el campo APELLIDO PATERNO');
           $('#apellidos').focus();
           return false;
       }
        if(apellidom==''){
           alert('complete el campo APELLIDO MATERNO');
           $('#apellidos').focus();
           return false;
       }
        if(telefono==''){
           alert('seleccione FECHA DE TELEFONO');
           $('#telefono').focus();
           return false;
       }
         if(edad==''){
           alert('ingrese la edad');
           $('#edad').focus();
           return false;
       }
           
       data = $('#user_form').serialize();
        if($('#id').val()==''){
            url='<?php echo base_url();?>cliente/add_cliente';
            mensaje="registrado correctamente.";
        }
        else{
            url='<?php echo base_url();?>cliente/update_cliente';
            mensaje="Actualizado correctamente.";
        }
        //alert(url);
        data=$('#inquilino_form').serialize();
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
                 window.location.href = "<?php echo base_url()?>cliente";
                }
        });
        
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
</script>
<br>
<br>
<div class="row col-md-1"></div>
<div class="row col-md-10">
            <div class="card">
                <div class="card-header" data-background-color="green">
                     <h4 class="title">Registro de Cliente</h4>
                 </div>
                <div class="card-content">
    <form id="inquilino_form" method="post" action="" enctype="multipart/form-data">
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
					<label>Edad</label>
					<input type="number" name="edad" id="edad">
				 </div>
            </div>
             <div class="col-md-3">
				 <div class="form-group ">
					<label>Telefono</label>
					<input type="text" name="telefono" id="telefono">
				 </div>
            </div>
	         <div class="col-md-6">
				 <div class="radio2">
                            <h4>Genero</h4>
                            <input type="radio" name="genero" id="masculino" value="1" checked> 
                            <label for="masculino" class="alta">Masculino</label>
                            
                            <input type="radio" name="genero" id="femenino" value="2">
                            <label for="femenino" class="alta">Fenenino</label><br><br>
                            
                  </div>
	         </div>
	    </div>
		<center><a href="javascript:save();" class="btn btn-success">Guardar</a>&nbsp;
		<a href="<?php echo base_url();?>cliente" id="btclose" class="btn btn-info btclose">Cancelar</a></center>
	</form>
  <div class="clearfix"></div>
               </div>
             </div>
  </div>
                           
	        