<script>
  $(function() {
    $( "#fechai" ).datepicker();
    $( "#fechaf" ).datepicker();
    $( "#fechai2" ).datepicker();
    $( "#fechaf2" ).datepicker();
  } );
    
function reportediario(){
    var fechai = $("#fechai").val();
    var fechaf = $("#fechaf").val();
    if(fechai==''||fechaf==''||fechai>fechaf){
        alert('Rango de fechas invalidas');
        return false;
    }
    url = "<?php echo base_url();?>reporte/reportediario/"+fechai+"/"+fechaf;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
 function reportecuarto(){
    var fechai = $("#fechai2").val();
    var fechaf = $("#fechaf2").val(); 
    var cuarto = $("#cuartob").val();
     
     if(fechai==''||fechaf==''||fechai>fechaf){
         alert('Rango de fechas invalidas');
         return false;
     }
     if(cuarto=='0'|| cuarto==0){
         alert('Seleccione un cuarto');
         return false;
     }
    url = "<?php echo base_url();?>reporte/reportecuarto/"+cuarto+"/"+fechai+"/"+fechaf;
    window.open(url, '', "width=800,height=600,menubars=no,resizable=no;");
 
    }
</script>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">REPORTE DIARIO</h4>
                                        <!--<p class="category"></p>-->
                                    </div>
                                    <div class="card-content">
                                        <form action="" method="post">


                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Fecha Inicio:</label>
                                                    <input type="text" class="form-control" id="fechai" value="<?php echo $fechai;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Fecha Fin:</label>
                                                        <input type="text" class="form-control" id="fechaf" value="<?php echo $fechaf;?>">
                                                    </div>
                                                </div>
                                            </div>
                                  <a  onclick="reportediario();" class="btn btn-success pull-right ">Imprimir</a>

                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header" data-background-color="green">
                                        <h4 class="title">REPORTE DE HABITACION</h4>
                                        <!--<p class="category"></p>-->
                                    </div>
                                    <div class="card-content">
                                        <form action="" method="post">

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Habitacion:</label>
                                                    <?php echo $cuartob;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                    <label class="control-label">Fecha Inicio:</label>
                                                    <input type="text" class="form-control" id="fechai2" value="<?php echo $fechai2;?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Fecha Fin:</label>
                                                        <input type="text" class="form-control" id="fechaf2" value="<?php echo $fechaf2;?>">
                                                    </div>
                                                </div>
                                            </div>
                                  <a  onclick="reportecuarto();" class="btn btn-success pull-right ">Imprimir</a>

                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>

                   <!--tabla-->
                     