
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Westview Pensione House - Cebu | Contact Us</title>
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
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
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
                    <li >
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="room.php">Rooms</a>
                    </li>
                    <li >
                        <a href="promotions.php">Promotions</a>
                    </li>
                    <li>
                        <a href="location.php">Location</a>
                    </li>
                    
                    <li class="active">
                        <a href="contact.php">Contact Us</a>
                    </li>
                  </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
     <!--Modal Login-->
    <!-- Page Content -->
    <div class="container" style="margin-top:65px;">

        <div class="row">
            <div class="col-md-8">
                <h3>Send us a Message</h3>
                <form name="sentMessage" id="contactForm" action="adminpage/room/sendmessage.php" method="POST" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Full Name:</label>
                            <input value="<?php echo $session?>" type="hidden" name="customerid" class="form-control" id="cusid">
                            <input type="text" class="form-control" id="name" name="fname" required data-validation-required-message="Please enter your name.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required data-validation-required-message="Please enter your phone number.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="email" class="form-control" id="email" name="email" required data-validation-required-message="Please enter your email address.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Message:</label>
                            <textarea name="comment" rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button name="submit" type="submit" class="btn btn-primary">Send Message <i class="fa  fa-send "> </i></button>
                </form>
            </div>

        <!-- /.row -->

       <div class="row">
            <ul class="pager">
                <!--<li class="previous"><a href="#">&larr; Older</a>
                </li>
                <li class="next"><a href="#">Next &rarr;</a>
                </li>-->
                <legend></legend>
            </ul>
        </div>
        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-6">
                    <p>Copyright &copy; Tekton Management System</p>
                </div>
                 <div class="col-lg-6">
                    <div class="text-right">                 
                       Social Account: <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                        <a class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->
 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
    <!--<script src="<?php echo base_url(); ?>hotelpage/js/contact_me.js"></script>-->

</body>

</html>
