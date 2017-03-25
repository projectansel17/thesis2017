<!DOCTYPE html>
<html>
<head>
	<title>Tekton Employee System</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript"> var base_url="<?php echo base_url(); ?>"</script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
	<link href="<?php echo base_url().'assets/css/sb-admin.css'?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-theme.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'; ?>">
	<link href="<?php echo base_url().'assets/css/'?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url().'assets/datatables/css/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php
              if (isset($this->session->userdata['userlogin']['userID'])) { ?>
                <a href="" class="navbar-brand" href="<?php echo site_url('UserController/dashboard'); ?>">Tekton Employee and File Management System - <?php echo ucfirst($this->session->userdata['userlogin']['username']);?></a>
                <?php 
                }
                ?>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo ucfirst($this->session->userdata['userlogin']['username']);?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="" data-toggle="modal" data-target="#adminprofile"><b class="glyphicon glyphicon-user"></b> Profile</a>
                            </li>
                            <li>
                                <a href="" data-toggle="modal" data-target="#changepwd" ><b class="glyphicon glyphicon-cog"></b>Change Password</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo site_url('UserController/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="<?php echo site_url("UserController/dashboard"); ?>"><i class="fa fa-fw fa-dashboard"></i> Home</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("ApplicantController/viewapply_applicant"); ?>"><i class="fa fa-group fa-fw"></i> Apply Applicant   <span class="applicant badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("UserController/dashboard"); ?>"><i class="fa fa-calendar fa-fw"></i> Plot Applicant Sched </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("EmployeeController/request"); ?>"><i class="fa fa-group fa-fw"></i> Deployment Employees</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("EmployeeController/status_employee"); ?>"><i class="fa fa-group fa-fw"></i> Feedback Employee</a>
                        </li>
                        <li class="active">
                            <a href="<?php echo site_url("ApplicantController/view_extendemployee"); ?>"><i class="fa fa-group fa-fw"></i> Extend Employee</a>
                        </li>
                        <li>
                            <a data-toggle="collapse" data-target="#report"><i class=" fa fa-cogs"></i> Report <span class="badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> <span class="caret"></span></a>
                            <ul id="report" class="collapse">
                            <li>
                            <a href="<?php echo site_url("ApplicantController/report_plotschedule"); ?>"><i class="fa fa-calendar fa-fw"></i> Schedule</a>
                            </li>
                            <li>
                            <a href="<?php echo site_url("ApplicantController/viewapplicant_requirement"); ?>"><i class="fa fa-group fa-fw"></i> Requirement</a>
                            </li>

                            </ul>
                       </li>
 
                    </ul>
                </div>
            </div>
        </nav>
		<div id="page-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li>
								<i class="fa fa-dashboard"></i>  <a href="<?php echo site_url('UserController/dashboard'); ?>">Dashboard</a>
							</li>
							<li>
								<i class="fa fa-user"></i> Extend Employee
							</li>s
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<h1>Extended of Employee</h1>
						<div class="col-xs-2 pull-right">
                            <select name="year" class="form-control">
                            <option  value=""  selected="selected">Select Year.....</option>
                             <?php
                                $year =date("Y");
                                 $oldyear=2010;
                                for ($x = $oldyear; $x <= $year; $x++) {
                                echo "<option value=".$x.">$x</option>";
                        }
                    ?>
                        </select>
                   </div>
					</div>
				</div><br>


            <!-- usser profile modal -->
                            <div class="modal fade" id="adminprofile" tabindex="-1" role="dialog" aria-labelledby="roomDetails" aria-labelledbyia-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Super User Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2">
                                           <form role="form" id="updateprofileform" action="<?php echo base_url(); ?>UserController/update_account"  method="POST">
                                            <?php 
                                                foreach ($userprofile as $profile) 
                                                    if ($profile['gender']=="Male"){
                                                        $gender= "Male";
                                                        $gender2 = "Female";
                                                      }
                                                    else{
                                                        $gender= "Female";
                                                        $gender2 = "Male";
                                         
                                                    }
                                          
                                                    { ?>

                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="id" type="hidden"  class="form-control">
                                            <input name="firstname" type="text" value="<?php echo $profile['firstname']; ?>" class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lastname" value="<?php echo $profile['lastname']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input name="username" value="<?php echo $profile['username']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Contact</label>
                                            <input name="contact" value="<?php echo $profile['contact']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input name="emailadd" value="<?php echo $profile['emailaddress']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input name="address" value="<?php echo $profile['address']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                                <option value="<?php echo $gender2; ?>"><?php echo $gender2; ?></option>                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="type" value="<?php echo $profile['position']; ?>"  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>City</label>
                                            <input name="state" value="<?php echo $profile['state']; ?>" class="form-control">
                                        </div>                                      
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-2 pull-right">
                                         <input type="submit" id="changeprofile" class="btn btn-primary" value="Submit">
                                        </div>
                                        <div class="col-md-2 pull-right">
                                             <input  type="button" class="btn btn-default" data-dismiss="modal" value="Reset">
                                        </div>
                                        </form>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->

                                </div>
                            </div>

                    <div class="modal fade" id="changepwd" tabindex="-1" role="dialog" aria-labelledby="changepass" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Super User Change Password</h4>
                                        </div>
                                        <form id="changepasswordform" action="<?php echo base_url();?>UserController/update_password" method="POST"> 
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="form-group">
                                                <label>Current Password</label>
                                                <input name="oldpassword"  class="form-control"  type="password">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input name="newpassword" type="password" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label>Retype Password</label>
                                                <input name="retypepassword" type="password" class="form-control" >
                                            </div>
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="button" id="changepassword" name="changepassword"  class="btn btn-primary" value="Change Password">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete --> 
                                </div>
                                <!-- /.modal-dialog -->
                                </div>
                            </div>

                        <div class="modal fade" id="adduserplotmodal" tabindex="-1" role="dialog" aria-labelledby="changepass" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Plotting Schedule for Applicant</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                         <form id="addapplicantplotform" action="<?php echo base_url();?>ApplicantController/add_applicantplot" method="POST"> 
                                         <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <div class="form-group">
                                                <label>FirstName</label>
                                                <input name="firstname"   class="form-control"  type="text">
                                            </div>
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input name="lastname" type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                             <label>Contact</label>
                                                <input name="contact" type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">                                            
                                            <label>Email Address</label>
                                                <input name="emailadd" type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input name="address" type="text" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                            <label>Schedule Coming</label>
                                                <div class="input-group date form_datetime " data-date="" data-date-format="yyyy-mm-dd - HH:ii p" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd HH:ii p ">
                                                <input class="form-control"  type="text" placeholder="Date and Time" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                                 <input type="hidden" value="" name="schedule" id="dtp_input1"  />
                                           </div>
                                            <div class="form-group">
                                                <label>Purpose</label>
                                          <select name="purpose" class="form-control">
                                                <option value="1">For Screening</option>
                                            </select>
                                            </div>
                                       </div>

                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="add_applicantplot" name="addapplicantplot"  class="btn btn-primary" value="Save">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete --> 
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                                


             <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Extended of Employee
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" style="overflow:auto">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Applicant Name</th>
                                            <th>Contact</th>
                                            <th>Email Address</th>
                                            <th>Address</th>
                                            <th>Branch Name</th>
                                            <th>Location Name</th>
                                            <th>Date Extend</th>
                                        </tr>
                                    </thead>
                                    <tbody class="monitorextend">
                                        <?php
                                        foreach ($employeeextend as $employee){
                                          echo "<tr>";
                                                echo "<td style='width:90px;'>".$employee['firstname']. " " .$employee['lastname']. "</td>";
                                                echo "<td>".$employee['contact']."</td>";
                                                echo "<td>".$employee['emailadd']."</td>";
                                                echo "<td>".$employee['address']."</td>";
                                                echo "<td>".$employee['branchname']."</td>";
                                                echo "<td>".$employee['locationname']."</td>";
                                                echo "<td>".$employee['dateextend']."</td>";

                                          echo "</tr>";
                                         }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>            
            </div>
         </div>




 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/dataTables.bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/myscript.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforclient.js' ?>"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
