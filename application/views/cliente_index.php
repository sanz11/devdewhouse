    <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
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
                         <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header" data-background-color="purple">
                                        <h4 class="title">Buscar Clientes</h4>
                                        <!--<p class="category"></p>-->
                                    </div>
                                    <div class="card-content">
                                        <form action="<?php echo base_url();?>tenants/search" method="post">


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
                                                <div class="col-md-3">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">N° Cuarto:</label>
                                                        <input type="text" class="form-control" name="cuarto"  id="cuartob" value="<?php echo $cuarto;?>">
                                                    </div>
                                                </div>
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

                                  <a id="print" class="btn btn-primary pull-right" href="javascript:print();">IMPRIMIR</a>
                                  <a href="<?php echo base_url();?>tenants/nuevo"id="newtenants"class="btn btn-primary pull-right button">NUEVA</a>
                                  <a href="<?php echo base_url();?>tenants" class="btn btn-primary pull-right">LIMPIAR</a>
                                  <button type="submit"class="btn btn-primary pull-right">BUSCAR</button>

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
                                    <div class="card-header" data-background-color="purple">
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
                                                <th>Cuarto</th>
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
                                                    <td><?php echo $value->room_Number; ?></td>
                                                   <td>
                                                        <a href="javascript:;" onclick="delet(<?php echo $value->tnt_Code; ?>,<?php echo $value->room_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/deleteuser.png" title="Eliminar" class="iconocus">
                                                        </a>
                                                        <a href="javascript:;" onclick="editar(<?php echo $value->tnt_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/editar.png" title="Editar" class="iconocus">
                                                        </a>
                                                        <a href="javascript:;" onclick="contrato(<?php echo $value->tnt_Code; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/pdf.png" title="Generar contrato" class="iconocus">
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
	                
 
</script>      