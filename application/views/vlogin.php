<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login form</title>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        
  </head>

  <body style="background: url(<?php echo base_url();?>assets/img/home.jpg); background-size:cover;">
<?php if($this->session->userdata('home_user')!=null || $this->session->userdata('home_user')!=''){
    header('location:'.base_url().'dashboard');
}?>
    <div class="login-form">
<!--     <h1 style="color:#333 !important; font-size:70px"></h1>-->
      <form  action="<?php echo base_url();?>clogin/Login" method="post">
      <div class="error-msg" style="display: <?php echo $show;?>"> <i class="fa fa-times-circle"></i> <strong> Error </strong> usuario o contraseña incorrecta</div>
     <div class="form-group ">
       <img src="<?php echo base_url();?>assets/img/iconos/usu.png" class="img"> <input type="text" class="form-control" placeholder="Usuario " id="user" name="user">
       <i class="fa fa-user"></i>
     </div>
     <div class="form-group log-status">
        <img src="<?php echo base_url();?>assets/img/iconos/contra.png" class="img" ><input type="password" class="form-control" placeholder="Contraseña" id="pass" name="pass">
       <i class="fa fa-lock"></i>
     </div>
      <a class="link" href="#">Ólvide mi contraseña?</a>
     <input type="submit" class="log-btn" value="Ingresar">
        </form>
    
   </div>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
     <script src="<?php echo base_url();?>assets/js/index.js"></script>
    
  </body>
</html>
