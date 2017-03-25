
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=2">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tekton Management - Cebu City</title>
    <script type="text/javascript">var base_url="<?php echo base_url(); ?>"</script>
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
                    <li>
                        <a href="<?php echo base_url(); ?>HomeController/index">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>HomeController/location">Location</a>
                    </li>
                        <li class="active">
                        <a href="<?php echo base_url(); ?>HomeController/apply">Apply Now</a>
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
                <h3>Fill out the Form</h3>
                <form name="sentMessage" id="uploadForm"  action="<?php echo base_url(); ?>HomeController/add_student" method="POST" enctype="multipart/form-data">
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                     <div class="controls">
                            <label>Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Phone Number:</label>
                            <input type="text" class="form-control" id="contact" name="contact">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Email Address:</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                    </div>
                      <div class="control-group form-group">
                        <div class="controls">
                            <label>Address:</label>
                            <input type="address" class="form-control" id="address" name="address">
                        </div>
                    </div>
                      <div class="control-group form-group">
                        <div class="controls">
                            <label>State:</label>
                            <input type="state" class="form-control" id="state" name="state">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Description:</label>
                            <textarea name="description" rows="10" cols="100" class="form-control" id="message"></textarea>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Upload File:</label>
                                <input name="file" id="userFile" type="file"/>
                                <p class="errorMsg"></p> <!-- para ni sa errors, pero atong i hide -->
                        </div>
                    </div>
                    <button type="button"  id="add_student" class="btn btn-primary">Apply <i class="fa  fa-send "> </i></button>
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
  <script src="<?php echo base_url().'assets/js/jquery.form.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
  <script src="<?php echo base_url().'js/validateforstudent.js' ?>"></script>
    <!--<script src="<?php echo base_url(); ?>hotelpage/js/contact_me.js"></script>-->

</body>

</html>
