<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logotip.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Tesis | Sistema Hotelero</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <script src="<?php echo base_url();?>assets/js/jquery-3.2.0.min.js"></script> 
     <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS   -->
    <link href="<?php echo base_url();?>assets/css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, dont include it in your project    --> 
    <link href="<?php echo base_url();?>assets/css/demo.css" rel="stylesheet" />
    

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons" rel='stylesheet' type='text/css'>
    
    <!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-filestyle.min.js"> </script>-->
    <script>
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '< Ant',
 nextText: 'Sig >',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'yy-mm-dd',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

</script>
</head>

<body>


	<div class="wrapper" >

	    <div class="sidebar" data-color="purple"  >
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->
          <style type="text/css">
              .logo2{ 
                  position: relative;
                  padding: 15px 15px 0px 15px;
                  z-index: 4;
                  text-align:center;
              }
              .igusme{
                  width:110px; height:115px; margin-top:5px;border:0.3px solid white;
              }
          </style>
           <div class="logo2">
                <img src="<?php echo base_url();?>assets/img/logotipe.png" class="igusme" >
            </div>
			<div class="logo" >
				<a  class="simple-text">
					HOTEL DOMINICOS
				</a>
			</div>

	    	<div class="sidebar-wrapper" style='height:65vh;'>
                <div style="margin:20px auto; width:80%">
                    Dirección: <strong>Tomas valle</strong><br><br>
                    Telefono: <strong> 999 999 999</strong><br><br>
                    Fijo: <strong>756 266 23</strong><br><br>
                    Hora de Atención: <strong>24h</strong><br><br>
                   
                    <br>
                    <br>
                     <img src="<?php echo base_url();?>images/<?php echo $imagen?>" style="width:50px" >
                     <?php echo $user?>
                </div>
                
	            <ul class="nav navbar-nav navbar-right" style="text-align:center">
                    <li ></li>
                 </ul>
	    	</div>
	    </div>
	    
	   
	  