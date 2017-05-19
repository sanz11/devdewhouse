  <div class="main-panel" id="bodys">
			<nav class="navbar navbar-transparent navbar-absolute" style="background:#dfdfdf">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" ><?php echo $titulo;?></a>
					</div>
					<div class="collapse navbar-collapse ">
						<ul class="nav navbar-nav navbar-right" style="text-align:center">
        
        <li class='active'>
 
	                    <a href="<?php echo base_url()."dashboard";?>">
	                        <i class="material-icons">dashboard</i>
	                        <p>Inicio</p>
	                    </a>
	                </li>
        <li <?php if($active=="alquiler"){ echo " class='active'";}?>>
	                    <a href="<?php echo base_url()."cobros";?>">
	                        <i class="material-icons">attach_money</i>
	                        <p>Alquiler</p>
	                    </a>
	     </li>
	      
         <li <?php if($active=="habitacion"){ echo " class='active'";}?>>
	                    <a href="<?php echo base_url()."room";?>">
	                        <i class="material-icons">home</i>
	                        <p>Habitación</p>
	                    </a>
	                </li>
         
          <li <?php if($active=="cliente"){ echo " class='active'";}?>>
	                    <a href="<?php echo base_url()."tenants";?>">
	                        <i class="material-icons">group</i>
	                        <p>Cliente</p>
	                    </a>
	                </li>
	                
          <li <?php if($active=="personal"){ echo " class='active'";}?>>
	                    <a href="<?php echo base_url()."users";?>">
	                        <i class="material-icons">person</i>
	                        <p>Usuario</p>
	                    </a>
	                </li>
	   <li <?php if($active=="reporte"){ echo " class='active'";}?>>
	                    <a href="<?php echo base_url()."users";?>">
	                        <i class="material-icons">flip_to_front</i>
	                        <p>Reporte</p>
	                    </a>
	                </li>
	                
          <li class="dropdown" style="margin-top:15px;">
				<a href="<?php echo base_url(); ?>cobros" class="dropdown-toggle" data-toggle="dropdown">
				<i class="material-icons">attach_money</i>
				    <span class="notification"><?php echo $npay; ?></span>
				<p class="hidden-lg hidden-md">Proximos Cobros</p>
				</a>
<ul class="dropdown-menu">
        <li><a href="<?php echo base_url(); ?>cobros">Tiene <?php echo $npay; ?> Cobros en este mes</a></li>
</ul>
        </li>
        
        <li style="margin-top:13px;">
								<a href="<?php echo base_url();?>Clogin/Logout">
	 							   <i class="material-icons">power_settings_new</i>Salir
	 							<!--   <p class="hidden-lg hidden-md">Salir</p>-->
		 						</a>
							</li>
        </ul>
<!--
						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>-->
					</div>
				</div>
			</nav>

			<div class="content" >
				<div class="container-fluid">