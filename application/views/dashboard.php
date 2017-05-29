 <link href="<?php echo base_url();?>assets/css/habitaciones.css" rel="stylesheet">
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="orange">
									<i class="material-icons">wc</i>
								</div>
								<div class="card-content">
									<p class="category">Inquilinos</p>
									<h3 class="title"><?php echo $ntenants; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">assignment</i><a href="<?php echo base_url();?>cliente">CLIENTES OCUPANDO</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="green">
									<i class="material-icons">home</i>
								</div>
								<div class="card-content">
									<p class="category">Habitaciones</p>
									<h3 class="title"><?php echo $nroom; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">home</i><a href="<?php echo base_url();?>habitacion">TOTAL DE HABITACIONES</a>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="red">
									<i class="material-icons">attach_money</i>
								</div>
								<div class="card-content">
									<p class="category">Cobros</p>
									<h3 class="title"><?php echo $cobros; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">local_offer</i><a href="<?php echo base_url();?>alquiler">Anteriores y cobros en 1h</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="blue">
									<i class="material-icons">flip_to_front</i>
								</div>
								<div class="card-content">
									<p class="category">Hts. Libres</p>
									<h3 class="title"><?php echo $nfreeroom; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">home</i><a href="<?php echo base_url();?>habitacion">HABITACIONES LIBRES</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
			
						<div class="col-lg-12 col-md-12">
							<div class="card">
	                            <div class="card-header" data-background-color="green">
	                                <h4 class="title">Lista de cuartos</h4>
	                                <!--<p class="category">New employees on 15th September, 2016</p>-->
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table class="table table-hover">
	                                    <thead >
                                                <th>Item</th>
                                                <th>Serie</th>
                                                <th>Numero</th>
                                                <th>Tipo</th>
                                                <th>Cliente</th>
                                                <th>Habitación</th>
                                                <th>Fecha F.</th>
                                                <th>Total</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                $total=0;
                                                foreach($list as $indice => $value){
                                                $total= $value[5]+$total; ?>
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo  $value[1]; ?></td>
                                                    <td><?php echo  $value[2];?></td>
                                                <?php if( $value[3]=='B'){?>
                                                      <td><span class="tag">BOLETA</span></td>      
                                                <?php }else{?>
                                                       <td><span class="tag2">FACTURA</span></td> 
                                                <?php }?>
                                                    <td><?php echo  $value[7]; ?></td>
                                                    <td><?php echo  $value[8]; ?></td>
                                                    <td><?php echo  $value[4]; ?></td>
                                                    <td>S/.<?php echo  number_format($value[5],2) ?></td>
                                                </tr>


                                        <?php  }
                            echo  '<tr><th></th><th></th><th></th><th></th><th></th><th></th><th>Total Mensual:</th><th>S/. '.number_format($total,2).'</th></tr>';
                                          }else{?>  
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
				</div>
			</div>
