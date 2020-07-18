<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
   
   
    <title> Login</title>
   
     <!-- GLOBAL MAINLY STYLES-->
     <link href="<?php echo  base_url()?>public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
            <link href="<?php echo  base_url()?>public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
            <link href="<?php echo  base_url()?>public/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
            <link href="<?php echo  base_url()?>public/vendors/sweetalert/sweetalert.css" rel="stylesheet">
            <!-- PLUGINS STYLES-->
            <link href="<?php echo  base_url()?>public/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
            <!-- THEME STYLES-->
            <link href="<?php echo  base_url()?>public/css/main.min.css" rel="stylesheet" />
         
            <link href="<?php echo  base_url()?>public/css/themes/white.css" rel="stylesheet" />
         
            <link href="<?php echo  base_url()?>public/css/estilos.css" rel="stylesheet" />
            <link href="<?php echo  base_url()?>public/css/css-circular-prog-bar.css" rel="stylesheet" />

            <link href="<?php echo  base_url()?>public/css/pages/auth-light.css" rel="stylesheet" />

            <!-- PAGE LEVEL STYLES-->
            <link href="<?php echo  base_url()?>public/css/css-circular-prog-bar.css" rel="stylesheet" />

   
    <!-- GLOBAL MAINLY STYLES-->
         
    
    <!-- THEME STYLES-
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES
    <link href="./assets/css/pages/auth-light.css" rel="stylesheet" />-->
</head>

<body class="bg-silver-300"style='background-image: url("<?php echo  base_url()?>public/images/alcaldia.jpg");' >
    <div class="content">
    <img src="" alt="" width="200px">
        <div class="brand">
        
        </div>
        <form id="login-form" action="javascript:;" method="post">
            <h2 class="login-title">Ingresar</h2>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-user"></i></div>
                    <input class="form-control" type="text" id="email" name="email" placeholder="usuario" autocomplete="off" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required>
                </div>
            </div>
        
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Acceder</button>
            </div>
            <div class="social-auth-hr">
                <span>Soporte</span>
            </div>
  
           
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
  
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->

    <script src="<?php echo  base_url()?>public/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
            <script src="<?php echo  base_url()?>public/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        

    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">

$( "#login-form" ).submit(function( event ) {
   
    var urlBase="<?php echo  base_url()?>"
    $.post('verificar', {
		
			"usuario": $("#email").val(),
			"clave": $("#password").val(),
		

		}).done(function (response) {

            console.log(response)
            if(response.pasa){
                location.href = urlBase;
            }else{
                    alert("usuario o contraseña incorrecta")
            }

			//location.href = urlBase;

		
		}).fail(function (error) {


            console.log(error)


        });

    
});



     
 
    </script>
</body>

</html>