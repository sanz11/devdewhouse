    <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
     <link href="<?php echo base_url();?>assets/css/tenants.css" rel="stylesheet">
<script>
    $( function() {
    $( "#nacimiento" ).datepicker();
  } );
  
    
    function delet(code){
         eliminar=confirm("¿Deseas eliminar este registro?");
        if (eliminar){
             var codeparam = {
                "codetenants" : code
                };
             url='<?php echo base_url();?>cliente/delete_cliente';
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
                    window.location.href = "<?php echo base_url()?>cliente";
                }
            });
        }
    }
    function editar(codes){
            limpiar();
             var codeparam = {
                "codetenants" : codes
                };
             url='<?php echo base_url();?>cliente/listedit_cliente';
        alert(url);
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
               /* $('#telefono2').val(data.person_Cellphone2);
                $('#direccion').val(data.person_DirectionOc);
                $('#correo').val(data.person_Email);  
                $('#ncuarto').val(data.room_Number); 
                $('#nacimiento').val(data.person_BirthDate);*/
               
                
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
    var sexo = $("#sexob").val();
    var dni = $("#dnib").val();
    var estado = $("#estadob").val();
    
    if(name=="")  {name="-";}
    if(apellido=="")  {apellido="-";}
    if(dni=="")  {dni="-";}
        

    url = "<?php echo base_url();?>cliente/print_pdf/"+name+"/"+apellido+"/"+sexo+"/"+dni+"/"+estado;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
</script>
<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">Buscar Clientes</h4>
                                        <!--<p class="category"></p>-->
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>cliente/search" method="post">


                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Nombre:</label>
                                                    <input type="text" class="form-control" name="name" id="nameb" value="<?php echo $name;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Apellidos:</label>
                                                        <input type="text" class="form-control" name="apellido"  id="apellidob" value="<?php echo $apellido;?>">
                                                    </div>
                                                </div>
                                                <!--<div class="col-md-3">
                                                     <div class="form-group label-floating">
                                                        <label class="control-label">N° Cuarto:</label>
                                                        <input type="text" class="form-control" name="cuarto"  id="cuartob" value="<?php echo $cuarto;?>">
                                                    </div>
                                                </div>-->
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Sexo:</label>
                                                       <?php echo $sexo;?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">DNI:</label>
                                                    <input type="text" class="form-control" name="dni"  id="dnib" value="<?php echo $dni;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Estado:</label>
                                                       <?php echo $estado;?>
                                                    </div>
                                                </div>

                                            </div>

                                  <a id="print" class="btn btn-success pull-right" href="javascript:print();">IMPRIMIR</a>
                                  <a href="<?php echo base_url();?>cliente/nuevo"id="newtenants"class="btn btn-success pull-right">NUEVA</a>
                                  <a href="<?php echo base_url();?>cliente" class="btn btn-success pull-right">LIMPIAR</a>
                                  <button type="submit"class="btn btn-success pull-right">BUSCAR</button>

                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                   <!--tabla-->
<div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">LISTA DE CLIENTES</h4>
                                        <p class="category"> <?php echo count($list);?> Inquilinos encontrados</p>
                                    </div>
                                    <div class="card-content table-responsive">
                                        <table class="table">
                                            <thead class="text-primary">
                                                <th>Item</th>
                                                <th>DNI</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <!--<th>Cuarto</th>-->
                                                <th>Opción</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){?>
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo $value->person_Dni; ?></td>
                                                    <td><?php echo $value->person_Name; ?></td>
                                                    <td><?php echo $value->person_LastName." ".$value->person_LastName2; ?></td>
                                                   <td>
                                                        <a href="javascript:;" onclick="delet(<?php echo $value->tnt_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/deleteuser.png" title="Eliminar" class="iconocus">
                                                        </a>
                                                        <a href="javascript:;" onclick="editar(<?php echo $value->tnt_Code; ?>);">
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