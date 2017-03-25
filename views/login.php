<!DOCTYPE html>
<html>
<head>
	<title>Tekton Employee System</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript"> 
    var base_url="<?php echo base_url(); ?>"</script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<link href="<?php echo base_url().'assets/css/sb-admin.css'?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-theme.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'; ?>">	
		<link href="<?php echo base_url().'assets/css/styles.css'?>" rel="stylesheet" type="text/css">

</head>
<body>
	<div class="main-wrapper">
		<div class="inner-bg">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-2">
						<h1 style="color:white;"><strong>Tekton Employee and File Management System</strong></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3 form">
						<div class="form-wrapper">
							<div>
								<h1>Login Form</h1>
								<p>Enter your Username and Password</p>
							</div>
							<form role="form" action="<?php echo base_url();?>UserController/login_user" method="POST" class="login-form" id="frmlogin">
								<div class="form-group">
									<label class="sr-only" for="form-username">Username</label>
									<input type="text" name="username" placeholder="Username..." class="form-input form-control" id="form-username">
								</div>
								<div class="form-group">
									<label class="sr-only" for="form-password">Password</label>
									<input type="password" name="password" placeholder="Password..." class="form-input form-control" id="password">
								</div>
								<p>
                                    <a class="portfolio-link"  data-toggle="modal" href="#forgotpasswordmodal">Forgot Password</a>
                                </p>
                                <button class="btn" name="login" id="login">Sign In</button>
							</form>
						</div>
							<div style="line-height:18px; margin-top:30px; background-color:#3f6786; color:black; border-style:solid; box-shadow:5px 5px 5px #401414; border-color:#401414;">
     						 <h3> Instruction</h3>
     						 <p><b>1.</b> Log in using your username.</p>
							 <p><b>2.</b> Initial password in your family Name.</p>
							 <p><b>3.</b> It is advisible to change your password after initial login</p>
				</div>
			</div>
		</div>
	</div>

	       <div class="modal fade" id="forgotpasswordmodal" tabindex="-1" role="dialog" aria-labelledby="changepass" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Forgot Password</h4>
                                        </div>
                                        <form id="forgotpasswordform" action="<?php echo base_url();?>UserController/forgot_password" method="POST"> 
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input name="username"  class="form-control"  type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Email Address</label>
                                                <input name="emailaddress" type="text" class="form-control" >
                                            </div>
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="forgot_pass" name="forgot_pass"  class="btn btn-primary" value="Submit">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->	
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
                            </div>
                              
<script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
<script src="<?php echo base_url().'assets/js/jquery.backstretch.min.js' ?>"></script>
<script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>
	
</body>
</html>