    <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
    
<script>
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
    function cobrar(code,precio){
         var cobra = prompt("¿Deseas registrar el cobro del cuarto? \n S/.",precio);
    
        if (cobra != null && cobra != ''){
             var codeparam = {
                "coderoom" : code,
                  "precio" : cobra
                };
             url='<?php echo base_url();?>cobros/cobrar';
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
                   alert('cobro registrado.');
                    window.location.href = "<?php echo base_url()?>cobros";
                }
            });
        }
    }
     function reporte(codes){
        $('#precio').css('display','none');
        $('#btguardar').css('display','none');
        $('#emes').css('display','none');
        $('#efecha').css('display','none');
          
            tabla();
             url='<?php echo base_url();?>cobros/reportecobros';
          $.post(url, {
                        "codecobros" : codes
                    }, function(data) {
                        var suma=0;
                        var c = JSON.parse(data);
                        $.each(c,function(i,item){
                            var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                            var array_fecha = item.cob_DatePay.split("-")  
                            var mes = parseInt(array_fecha[1]);
                            $('#'+mes).html('');
                            $('#'+mes).append(' <th scope="row">'+mes+'</th><td>'+meses[mes-1]+'</td><td>'+item.cob_DatePay+'</td><td>S/.'+item.cob_Total+'</td><td><a href="javascript:;" onclick="editar('+item.cob_Code+','+item.cob_Total+','+mes+');"><img src="<?php echo base_url();?>assets/img/iconos/editar.png" title="Editar Datos" class="iconocus"></a></td>');
                          suma= parseFloat(item.cob_Total)+parseFloat(suma);
                          $('#total').html('');$('#total').append('TOTAL: S/.'+suma);
                    });

                });
                  
                  $('#titumodal').html('');
                  $('#titumodal').append('DETALLE DE PAGOS');
                  $('.modal').css('display','block');
		          $('#modal-bg').fadeIn();
                  $( "#bodys").scrollTop( 0 );
        
    }
    function editar(code,valor,mes){
        var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $('#cobcode').val(code);
        $('#precio').val(valor);
        $('#precio').css('display','block');
        $('#btguardar').css('display','');
        $('#emes').html('');
        $('#emes').append(meses[mes-1]);
        $('#emes').css('display','');
        $('#efecha').css('display','');
    }
    function update(){
        code=$('#cobcode').val();
        precio=$('#precio').val();
        if(precio==''){
            alert('Ingrese el precio');
            return false;
        }
        modificar=confirm("¿Deseas Modificar el Cobro?");
        if (modificar){
             var codeparam = {
                "codecob" : code,
                "precio" : precio
                };
             url='<?php echo base_url();?>cobros/update';
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
                   alert('Cobro modificado.');
                    window.location.href = "<?php echo base_url()?>cobros";
                }
            });
        }
    }
    function tabla(){
        $('#tabladetalle').html('');
        $('#tabladetalle').append('<tr id="1"><th scope="row">1</th><td>Enero</td><td></td><td></td><td></td></tr><tr id="2"><th scope="row">2</th><td>Febrero</td><td></td><td></td><td></td></tr><tr id="3"><th scope="row">3</th><td>Marzo</td><td></td><td></td><td></td></tr><tr id="4"><th scope="row">4</th><td>Abril</td><td></td><td></td><td></td></tr><tr id="5"><th scope="row">5</th><td>Mayo</td><td></td><td></td><td></td></tr><tr id="6"><th scope="row">6</th><td>Junio</td><td></td><td></td><td></td></tr><tr id="7"><th scope="row">7</th><td>Julio</td><td></td><td></td><td></td></tr><tr id="8"><th scope="row">8</th><td>Agosto</td><td></td><td></td><td></td></tr><tr id="9"><th scope="row">9</th><td>Septiembre</td><td></td><td></td><td></td></tr><tr id="10"><th scope="row">10</th><td>Octubre</td><td></td><td></td><td></td></tr><tr id="11"><th scope="row">11</th><td>Noviembre</td><td></td><td></td><td></td></tr><tr id="12"><th scope="row">12</th><td>Diciembre</td><td></td><td></td><td></td></tr>');
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
   
</script>
                    

                   <!--tabla-->
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
                                                <th>Precio</th>
                                                <th>Dia de Pago</th>
                                                <th>Estado</th>
                                                <th>Opción</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                foreach($list as $indice => $value){ 
                                                    
                                                        $dia=date("d", strtotime($value[1]));
                                                    
                                                ?>
                                                  <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo $value[0]; ?></td>
                                                     <td>S/.<?php echo $value[2]; ?></td>
                                                   <?php if($value[3]==0){?>
                                                         <td></td>
                                                         <td></td>
                                                     <?php }else{?>
                                                          <td>
                                                          <?php 
                                                            if($value[1]=='0000-00-00'){echo '<span style="background:crimson;padding:4px; color:white">fecha no especificada </span>';}
                                                            else{echo $dia;}
                                                                 
                                                          if($dia==date('d')&& $value[1]!='0000-00-00'){
                                                                echo '<img src="'.base_url().'assets/img/iconos/hoy.svg" class="iconocus" title="HOY">hoy';
                                                           }if($dia==date('d', strtotime('+1 day')) && $value[1]!='0000-00-00'){
                                                                echo '<img src="'.base_url().'assets/img/iconos/manana.png" class="iconocus" title="Mañana">';
                                                           }if($dia==date('d', strtotime('+2 day')) && $value[1]!='0000-00-00'){
                                                                echo '<img src="'.base_url().'assets/img/iconos/pasmanana.png" class="iconocus" title="Pasado mañana">';
                                                            }
                                                            ?>
                                                            
                                                          </td>
                                                        <td>
                                                            <?php echo $value[5]; ?>
                                                        </td>
                                                      <?php }?>
                                                   <td>
                                                        <?php if($value[3]==1){?>
                                                        <a href="javascript:;" onclick="cobrar(<?php echo $value[4]; ?>,<?php echo $value[2];?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/cobrar.png" title="Cobrar" class="iconocus3"></a>
                                                        <?php }?>
                                                        
                                                        
                                                        <a href="javascript:;" onclick="reporte(<?php echo $value[4]; ?>);">
                                                        <img src="<?php echo base_url();?>assets/img/iconos/reporte.png" title="Ver Detalle" class="iconocus3">
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

    <div class="modal-bg" id="modal-bg" style="display:none">
<div id="modalcobro" class="modal">
	<span  id="titumodal">REGISTRO DE INQUILINOS</span>
    <form id="inquilino_form" method="post" action="">
         <div class="table-responsive" style="width:96% !important; margin:auto; height:300px;">          
            <table class="table table-sm table-striped">
              <thead>
                <tr class="bg-primary">
                 <th>#</th>
                 <th>Numero</th>
                 <th>Fecha de Pago</th>
                 <th>Total</th>
                 <th>Opcion</th>
                </tr>
              </thead>
              <tbody id="tabladetalle">
              </tbody>
            </table>
          </div>
          <div class="table-responsive" style="width:96% !important; margin:auto;">          
            <table class="table table-sm table-striped" style="width:98% !important; margin:auto; border:1px solid #545454 ">
                <tr>
                <th><input type="hidden" id="cobcode" value="">E</th>
                <td><section id="emes"style="display:none"></section></td>
                <td><section id="efecha"style="display:none"><?php echo date('Y-m-d');?></section></td>
                <td><input type="text" id="precio" value="" style="display:none"></td>
                <td id="total" scope="row" ></td></tr>
            </table>
          </div>
	    
		<center><a href="javascript:update();" class="btn btn-primary" id="btguardar" style="display:none">Guardar</a>&nbsp;<a id="btclose" class="btn btn-success btclose">Cancelar</a></center>
	</form>
</div>
</div>


<script>
$(document).ready(function(){
     $('#modal-bg').fadeOut();		
	$('.modal').fadeOut();
    

    $('.btclose').click(function(){
			  $('#modal-bg').fadeOut();		
			  $('.modal').fadeOut();
		  return false;
		});
});  
</script>      