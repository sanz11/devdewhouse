    <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
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
    
    function editar(codes){
            limpiar();
             var codeparam = {
                "codeuser" : codes
                };
             url='<?php echo base_url();?>users/listedit_user';
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
                $('#id').val(data.user_Code);
                $('#idperson').val(data.person_Code);
                $('#dni').val(data.person_Dni);
                $('#nombre').val(data.person_Name);
                $('#apellidop').val(data.person_LastName);
                $('#apellidom').val(data.person_LastName2);
                $('#password').val(data.user_Password);
                $('#nacimiento').val(data.person_BirthDate);
                $('#user').val(data.user_User);
                $('#telefono').val(data.person_Cellphone);
                $('#correo').val(data.person_Email);
                $('#vista-previa').append(' <img src="<?php echo base_url();?>images/'+data.person_Photo+'" id="foto">');
               
                
                if(data.person_sex =='1'){
                 $('#masculino').prop('checked', true);   
                }
                if(data.person_sex =='0'){
                 $('#femenino').prop('checked', true);   
                }
                
                  $('#id').val(codes);
                  $('#titumodal').html('');
                  $('#titumodal').append('MODIFICAR DATOS DEL ADMINISTRADOR: '+data.person_Name+'');
                  $('.modal').css('display','block');
		          $('#modal-bg').fadeIn();
                  $( "#bodys").scrollTop( 0 );
                }
            });
    
        
    }
    function delet(code){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                 "code" : code
                };
             url='<?php echo base_url();?>users/delete_users';
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
                    window.location.href = "<?php echo base_url()?>users";
                }
            });
        }
    }
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
                         <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">Buscar Administrador</h4>
                                        <!--<p class="category"></p>-->
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>users/search" method="post">


                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Nombre:</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Usuario:</label>
                                                        <input type="text" class="form-control" name="user" value="<?php echo $userusu;?>">
                                                    </div>
                                                </div>
                                            </div>

                                 <!-- <a id="print" class="btn btn-primary pull-right">IMPRIMIR</a>-->
                                  <a href="<?php echo base_url();?>users/nuevo"id="newusers"class="btn btn-success pull-right ">NUEVA</a>
                                  <a href="<?php echo base_url();?>users" class="btn btn-success pull-right">LIMPIAR</a>
                                  <button type="submit"class="btn btn-success pull-right">BUSCAR</button>

                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-profile">
                                    <div class="content">
                                        <!--<h6 class="category text-gray">Información</h6>-->
                                        <h4 class="card-title">Información</h4>
                                        <p class="card-content">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum fuga, ipsa aperiam a dolorem optio error necessitatibus 
                                        </p>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                   <!--tabla-->
                      <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">LISTA DE USUARIOS</h4>
                                        <p class="category"> <?php echo count($list);?> Usuarios encontrados</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Item</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Usuario</th>
                                                <th>Opción</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){?>
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo $value->person_Name; ?></td>
                                                    <td><?php echo $value->person_LastName." ".$value->person_LastName2; ?></td>
                                                    <td><?php echo $value->user_User; ?></td>
                                                   <td>
                                                       <?php if($value->user_Code!=1){?>
                                                        <a href="javascript:;" onclick="delet(<?php echo $value->user_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/deleteuser.png" title="Eliminar" class="iconocus">
                                                        </a>
                                                        <?php }else{?>
                                                        <a href="javascript:;">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/nodelete.png" title="Eliminar" class="iconocus">
                                                        </a>
                                                         <?php }?>
                                                        <a href="javascript:;" onclick="editar(<?php echo $value->user_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/editar.png" title="Editar" class="iconocus">
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
	                
<div class="modal-bg" id='modal-bg' style="display:none">
<div id="modal" class="modal">
	<span  id="titumodal">REGISTRO DE ADMINISTRADORES</span>
   
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
	    
		<center><a href="javascript:save();" class="btn btn-success">Guardar</a>&nbsp;
		<a href="<?php echo base_url();?>users" id="btclose" class="btn btn-info btclose">Cancelar</a></center>
	</form>
</div>
</div>
<script src="<?php echo base_url();?>assets/js/upload.js"></script>

 

<script>
$(document).ready(function(){
     $('#modal-bg').fadeOut();		
	$('.modal').fadeOut();
    
$('.button').click(function(){
    $("#bodys").scrollTop( 0 );
    limpiar();
     
    $('#titumodal').html('');
    $('#titumodal').append('REGISTRO DE ADMINISTRADOR');
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
<script src="<?php echo base_url();?>assets/js/upload.js"></script>