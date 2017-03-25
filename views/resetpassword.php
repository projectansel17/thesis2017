<!DOCTYPE HTML>
<html>
<head>
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tekton Employee System - Cebu | Forgot Password</title>
   <script type="text/javascript">
    var base_url= "<?php echo base_url(); ?>";
    </script>
    <link href="<?php echo base_url(); ?>hotelpage/css/bootstrap.min.css" rel="stylesheet">
    <!--Icon-->
    <link href="<?php echo base_url(); ?>hotelpage/images/westview.png" type="image/png" rel="icon">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>hotelpage/css/modern-business.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>hotelpage/css/westview.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>hotelpage/css/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>hotelpage/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #B71515; background-image: linear-gradient(to bottom, #7CAEFF, #22262d);">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="nav-bar-head">
                <div class="head-logo">
                <div class=" logo">
                            <a href="index.php">
                                <img id="header-logo" src="<?php echo base_url(); ?>tektonimage/tekton.png">
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
 
                     <li>
                        <h4 style="color:#fff">Tekton Management - Cebu  <i class="fa fa-phone"> </i> +63(32)266-9548/412-1586 </h4 >
                    </li>
       
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<div class="container" style="margin-top:65px;">
		<div class="col-lg-8 col-lg-offset-2">

	<div class="row">
		<div class="col-lg-12">
                    <h1 class="page-header">Reset Password</h1>
                </div>
     <div class="row">
	 <div class="col-lg-12">
	 <div class="panel-body">
	 <div class="row">
	 <div class="col-lg-7 col-lg-offset-2">
	 <div class="form-group">
	<form  method="post" id="resetform" action="<?php echo base_url();?>/UserController/updateuser_password">
		<label>New Password </label>
		<blockquote style="border-color:green">
        <input class="form-control" type="hidden" id="username" name="username" value="<?php echo $data['username']; ?>"/>
        <input class="form-control" type="hidden" id="emailaddress" name="emailaddress" value="<?php echo $data['emailaddress']; ?>"/>
		<input class="form-control" type="password" id="password" name="password" placeholder="New Password" required/>
		</blockquote>
	 </div>
	 </div>
	 <div class="col-lg-7 col-lg-offset-2">
	 <div class="form-group">
	 	<blockquote style="border-color:orange">
		<input class="form-control" type="password" id="retypepass" name="retypepass" placeholder="Retype Password" required/>
		</blockquote>
		<p class="result"></p>
	 </div>
	 </div>
	  <div class="col-lg-7 col-lg-offset-7">
	 <div class="form-group">
	 	
		<input class="btn btn-primary" type="submit" id="reset" name="reset" value="Save">
		
	</div>
	 </div></div>
	</form>
	
	 </div>
	</div>     	
	</div>
		</div>
	 </div>
	</div>	
	  <footer>
	<div class="container">
            <div class="row">
                <div class="col-lg-6">
                      <p>Copyright 2017 by Tekton Management. All Rights Reserved.</p>
                </div>
                 
            </div>
        </footer>
       </div>

 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>
</body>
</html>