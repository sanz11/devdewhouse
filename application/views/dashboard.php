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
										<!--<i class="material-icons">assignment</i><a href="">20 HOMBRES / 12 MUJERES</a>-->
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
										<!--<i class="material-icons">filter_1</i> piso: 9   / <i class="material-icons">filter_2</i> piso: 12-->
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
									<h3 class="title">4</h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">local_offer</i> Próximos Cobros del mes
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
										<i class="material-icons">update</i> Habitaciones libres
									</div>
								</div>
							</div>
						</div>
					</div>
<!--
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="green">
									<div class="ct-chart" id="dailySalesChart"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Daily Sales</h4>
									<p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> 55%  </span> increase in today sales.</p>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> updated 4 minutes ago
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="orange">
									<div class="ct-chart" id="emailsSubscriptionChart"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Email Subscriptions</h4>
									<p class="category">Last Campaign Performance</p>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> campaign sent 2 days ago
									</div>
								</div>

							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="red">
									<div class="ct-chart" id="completedTasksChart"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Completed Tasks</h4>
									<p class="category">Last Campaign Performance</p>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> campaign sent 2 days ago
									</div>
								</div>
							</div>
						</div>
					</div>
-->
					<div class="row">
			<!--			<div class="col-lg-6 col-md-12">
							<div class="card card-nav-tabs">
								<div class="card-header" data-background-color="purple">
									<div class="nav-tabs-navigation">
										<div class="nav-tabs-wrapper">
											<span class="nav-tabs-title">Tasks:</span>
											<ul class="nav nav-tabs" data-tabs="tabs">
												<li class="active">
													<a href="#profile" data-toggle="tab">
														<i class="material-icons">bug_report</i>
														Bugs
													<div class="ripple-container"></div></a>
												</li>
												<li class="">
													<a href="#messages" data-toggle="tab">
														<i class="material-icons">code</i>
														Website
													<div class="ripple-container"></div></a>
												</li>
												<li class="">
													<a href="#settings" data-toggle="tab">
														<i class="material-icons">cloud</i>
														Server
													<div class="ripple-container"></div></a>
												</li>
											</ul>
										</div>
									</div>
								</div>

								<div class="card-content">
									<div class="tab-content">
										<div class="tab-pane active" id="profile">
											<table class="table">
												<tbody>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes" checked>
																</label>
															</div>
														</td>
														<td>Sign contract for "What are conference organizers afraid of?"</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes">
																</label>
															</div>
														</td>
														<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes">
																</label>
															</div>
														</td>
														<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
														</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes" checked>
																</label>
															</div>
														</td>
														<td>Create 4 Invisible User Experiences you Never Knew About</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="messages">
											<table class="table">
												<tbody>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes" checked>
																</label>
															</div>
														</td>
														<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
														</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes">
																</label>
															</div>
														</td>
														<td>Sign contract for "What are conference organizers afraid of?"</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="tab-pane" id="settings">
											<table class="table">
												<tbody>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes">
																</label>
															</div>
														</td>
														<td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes" checked>
																</label>
															</div>
														</td>
														<td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
														</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
													<tr>
														<td>
															<div class="checkbox">
																<label>
																	<input type="checkbox" name="optionsCheckboxes">
																</label>
															</div>
														</td>
														<td>Sign contract for "What are conference organizers afraid of?"</td>
														<td class="td-actions text-right">
															<button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-simple btn-xs">
																<i class="material-icons">edit</i>
															</button>
															<button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
																<i class="material-icons">close</i>
															</button>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
-->
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
                                                <th>Número</th>
                                                <th>Medida</th>
                                                <th>Estado</th>
                                                <th>Fecha de Pago</th>
                                                <th>Precio</th>
                                            </thead>

                                            <tbody>
                                        <?php if(count($list)>0){ 
                                                    $suma=0;
                                                foreach($list as $indice => $value){
                                                    $suma=$value->room_Price+$suma;?>
                                                    
                                                     <tr>
                                                    <td> <?php echo $indice+1; ?>  </td>
                                                    <td><?php echo $value->room_Number; ?></td>
                                                    <td><?php echo $value->room_Size; ?> m</td>
                                                   <?php if($value->room_Occupied==0){?>
                                                        <td><span class="tag">Disponible</span></td>
                                                         <td></td>
                                                     <?php }else{?>
                                                         <td><span class="tag2">Ocupado</span></td>
                                                          <td><?php echo $value->room_DatePay; ?></td>
                                                      <?php }?>
                                                      <td>S/.<?php echo $value->room_Price; ?></td>
                                                </tr>

                                            <?php  }
                            echo  '<tr><th></th><th></th><th></th><th></th><th>Total Mensual:</th><th>S/. '.$suma.'</th></tr>';
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
