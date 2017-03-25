<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tekton Management - Cebu | Philippines</title>
    <!--Must be first-->
    <script type="text/javascript"> 
    var base_url="<?php echo base_url(); ?>"</script>
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
        <div class="container" >
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
                           <a href="#">
                                <img id="header-logo" src="<?php echo base_url(); ?>tektonimage/tekton.png">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                      <li class="active">
                        <a href="<?php echo base_url(); ?>HomeController/index">Home</a>
                    </li>
                    <li >
                        <a href="<?php echo base_url(); ?>HomeController/location">Location</a>
                    </li>
                        <li>
                        <a href="<?php echo base_url(); ?>HomeController/apply">Apply Now</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>     
                        

    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="<?php echo base_url(); ?>hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default">
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title">Sign In to continue</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="loginform" method="POST" action="<?php echo base_url() ?>actions/User/login_user">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><div class="circle-mask"> <canvas id="canvas" class="circle" width="96" height="96"></canvas></div></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Password" name="password" value="" type="password">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <a class="portfolio-link" data-toggle="modal" href="#forgotpassword">Forgot Password</a>
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" name="login" id="login" type="submit" value="Sign In" />
                                <a href="#registrationForm" data-toggle="modal" class="btn  btn-default btn-block">Create account</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!--Modal Forgot Password-->
    <div class="portfolio-modal modal fade" id="forgotpassword" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h4><img src="<?php echo base_url(); ?>hotelpage/images/westview.png"></h4>
                            <div class="col-md-8 col-md-offset-2">

                <div class="login-panel panel panel-default" >
                    <div style="background-image: linear-gradient(to bottom, #12B4FF, #0C7BE9);; color: rgb(255, 255, 255);" class="panel-heading">
                        <h3 class="panel-title" id="forgotpasswordmodal">Forgot Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="forgotpasswordform" method="POST" action="actions/User/forgot_password">
                            <fieldset>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                    <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Email Address" name="emailaddress" autofocus="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input class="btn  btn-promo2 btn-block" id="forgotpass" name="forgotpass" type="submit" value="Submit" />
                                <a href="?" data-dismiss="modal" class="btn btn-default btn-block">Cancel</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide" style="margin-top:50px;">
        <!-- Wrapper for slides Note Images should be 1900x1080& -->
        <div class="carousel-inner" >
            <div class="item active">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>tektonimage/t-1.jpg');"></div>
                <div class="carousel-caption">                                              
                </div>  
                
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>tektonimage/t-2.jpg');"></div>
                <div class="carousel-caption">                      
                </div>  
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>tektonimage/t-3.jpg');"></div>
                <div class="carousel-caption">          
             </div>  
            </div>
             <div class="item">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>tektonimage/t-4.jpg');"></div>
                <div class="carousel-caption">                      
                </div>  
            </div>
             <div class="item">
                <div class="fill" style="background-image:url('<?php echo base_url(); ?>tektonimage/t-5.jpg');"></div>
                <div class="carousel-caption">                      
                </div>  
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>

<br>
<br>
    <div class="container" >
<h1 class="text-center">Welcome to our website!</h1>
                <h4 class="text-center">We introduce Tekton Management  website</h4>
               <p class="text-center" style="font-size:14px;">In TEKTON, industrial peace is naturally fostered by the workers and experienced by clients. There is harmonious relationship between client’s management and our workers.Client has more time to spend on planning business strategies and on improving operating system for better efficiency and profitability.</p>
        <!-- Call to Action Section -->
        <div class="well">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Do you have comments? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i  class="fa fa-phone fa-3x "></i>
                    <p>+63(32)266-9548/412-1586</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i   class="fa fa-envelope-o fa-3x " ></i>
                    <p><a href="<?php echo base_url(); ?>contact.php">tekton@gmail.com</a></p>
                </div>
            </div>
        </div>
    </br>

        <!-- Footer -->
            <footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright 2017 by Tekton Management System. All Rights Reserved.</p>

                </div>
            </div>
        </footer>

    </div>
 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
