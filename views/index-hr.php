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
    <link href="<?php echo base_url().'bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css'?>" rel="stylesheet" type="text/css">
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
                            <a href="<?php echo site_url("ApplicantController/schedule_plotapplicant"); ?>"><i class="fa fa-calendar fa-fw"></i>Monitor Plot Applicant Sched </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("EmployeeController/request"); ?>"><i class="fa fa-group fa-fw"></i> Deployment Employees</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url("EmployeeController/status_employee"); ?>"><i class="fa fa-group fa-fw"></i> Feedback Employee</a>
                        </li>
                        <li>
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
								<i class="fa fa-user"></i> Plot Schedule
							</li>s
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<h1>Plotting Schedule for the Applicants</h1>
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="searched" action="users">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduserplotmodal" id="adduser">Add Plot for Applicant</button>
								</form>
							</div>
						</div>
					</div>
				</div><br>


            <!-- usser profile modal -->
        <!-- admin profile modal -->
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

      

             <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Plot for the Applicants
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
                                            <th>Schedule</th>
                                            <th>Requirement</th>
                                            <th>Date Hired</th>
                                            <th>Purpose</th>
                                            <th>Action</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table">

                                        <?php
                    
                                        foreach ($applicantplot as $applicant){

                                          echo "<tr>";
                                                echo "<td style='width:90px;'>".$applicant['firstname']. " " .$applicant['lastname']. "</td>";
                                                echo "<td>".$applicant['contact']."</td>";
                                                echo "<td>".$applicant['emailadd']."</td>";
                                                echo "<td>".$applicant['address']."</td>";
                                                echo "<td>".$applicant['schedule']."</td>";
                                                echo "<td>".$applicant['requirement']."</td>";
                                                echo "<td>".$applicant['datehired']."</td>";
                                                switch ($applicant['purpose']) {
                                                    case 1:
                                                         echo "<td>For Screening</td>";
                                                     break;
                                                    case 2:
                                                        echo "<td>For Orientation</td>";
                                                     break;
                                                     case 3:
                                                        echo "<td>For Requirement</td>";
                                                     break;
                                                     case 4:
                                                        echo "<td>Releasing Pay Card</td>";
                                                     break;
                                                    default:
                                                        echo "<td>For Deploy</td>";
                                                    break;
                                                      
                                                }   
                                                switch ($applicant['status']) {
                                                     case 1:
                                                     case 2:
                                                     case 3:
                                                     case 4:
                                                     case 5:
                                                     case 6:
                                                     case 7:
                                                     case 10:
                                                     case 11:
                                                     case 15:
                                                             echo "<td><a href='#' data-toggle='modal' data-target='#updateappactionmodal' class='viewapplicant btn btn-danger btm-sm' data-applicantid='".$applicant["applicantID"]."'>Action</a></td>";
                                                     break;
                                                     case 8:
                                                              echo "<td><a href='#' data-toggle='modal' data-target='#addemployeemodal' class='viewapplicant btn btn-danger btm-sm' data-applicantid='".$applicant["applicantID"]."'>Action</a></td>";
                                                     break;
                                                    default:
                                                             echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm'>Action</a></td>";
                                                    break;
                                                      
                                                }

                                                if ($applicant['status'] == 2  && $applicant['purpose'] == 1){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm'>Done Screening</a></td>";
                                                }
                                                else if ($applicant['status'] == 3  && $applicant['purpose'] == 2){
                                                    echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm'>Done Orientation</a></td>";
                                                }
                                                 else if ($applicant['status'] == 5  && $applicant['purpose'] == 3){
                                                    echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm'>Complete Requirements</a></td>";
                                                }
                                                 else if ($applicant['status'] == 8  && $applicant['purpose'] == 4){
                                                    echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm'>Done Releasing Pay Card</a></td>";
                                                }
                                                 else if ($applicant['status'] == 2  && $applicant['purpose'] == 2){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Done Screening</a></td>";
                                                }
                                                 else if ($applicant['status'] == 3  && $applicant['purpose'] == 3){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Done Orientation</a></td>";
                                                }
                                                 else if ($applicant['status'] == 4  && $applicant['purpose'] == 3){
                                                  echo "<td><a href='#' class='viewarequirementapplicant btn btn-primary btm-sm' data-toggle='modal' id='viewarequirementapplicant' data-target='#updatelackingmodal' data-appid='".$applicant["applicantID"]."'>Lacking Requirement</a></td>";
                                                }  
                                                 else if ($applicant['status'] == 5  && $applicant['purpose'] == 4){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Complete Requirements</a></td>";
                                                }  
                                                else if ($applicant['status'] == 8  && $applicant['purpose'] == 5){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>For Deploy</a></td>";
                                                }  
                                                 else if ($applicant['status'] == 1  && $applicant['purpose'] == 1){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Hired</a></td>";
                                                }
                                                 else if ($applicant['status'] == 15  && $applicant['purpose'] == 1){
                                                  echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm'>Not Qualified</a></td>";
                                                }
                                                 else if ($applicant['status'] == 7  && $applicant['purpose'] == 1){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-primary btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Hired</a></td>";
                                                }
                                                  else if ($applicant['status'] == 7  && $applicant['purpose'] == 2 ){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Not Coming</a></td>";
                                                }
                                                  else if ($applicant['status'] == 7 && $applicant['purpose'] == 3 ){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Not Processed</a></td>";
                                                }
                                                  else if ($applicant['status'] == 7 && $applicant['purpose'] == 4 ){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm' data-toggle='modal' data-target='#updateappstatusmodal' data-applicantid='".$applicant["applicantID"]."'>Not Coming</a></td>";
                                                }
                                                  else if ($applicant['status'] == 6 && $applicant['purpose'] == 3 ){
                                                  echo "<td><a href='#' class='viewarequirementapplicant btn btn-danger btm-sm' data-toggle='modal' id='viewarequirementapplicant' data-target='#updatelackingmodal' data-appid='".$applicant["applicantID"]."'>Not Processed</a></td>";
                                                }
                                                  else if ($applicant['status'] == 10 && $applicant['purpose'] == 4 ){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm'>Terminate</a></td>";
                                                }
                                                else if ($applicant['status'] == 11 && $applicant['purpose'] == 4 ){
                                                     echo "<td><a href='#' class='viewapplicant btn btn-danger btm-sm'>Resign</a></td>";
                                                }
                                                  else{
                                                    echo "<td><a href='#' class='viewapplicant btn btn-success btm-sm' >Deploy</a></td>";
                                                }

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

                <div class="modal fade" id="extendmodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteLabel">Note: This will be Extend Employee.</h4>
                                        </div>
                                        <form method="post" id="extendemployeeform" action="<?php echo base_url();?>ApplicantController/extend_employee">
                                        <div class="modal-body">
                                        <center>
                                                <input name="applicantid" type="hidden">
                                                <input name="employeeid" type="hidden">
                                                <input name="branchid" type="hidden">
                                                <input name="locationid" type="hidden">
                                                <input name="extend" type="hidden">
                                                Are you 
                                                sure you want to extend?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                           <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                           <button  type='button' id="extend_employee"  class='btn btn-primary' >Yes</button>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>  
                                <!-- /.modal-dialog -->
                        </div>

                                 <div class="modal fade" id="updateappactionmodal" tabindex="-1" role="dialog" aria-labelledby="update schedule" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Plotting Schedule for Applicant</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                        <form  id="updateapplicantform" action="<?php echo base_url();?>ApplicantController/update_applicantplot" method="POST"> 
                                          <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                             <input type="hidden" name="applicantid" >
                                             <input type="hidden" name="oldstatus" >
                                             <input type="hidden" name="emailaddress" >
                                           <div class="form-group">
                                            <label>Schedule For Screening, Orientation and Processing Requirement</label>
                                                <div class="input-group date form_datetime"  data-date="" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd HH:ii p ">
                                                <input class="form-control"  type="text" name="scheduleplot" placeholder="Date and Time" readonly>
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                               <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                                </div>
                                             </div>
                                            <div class="form-group">
                                              <label>Purpose</label>
                                              <select name="purpose" class="form-control" id="purpose">

                                            </select>
                                          </div>
                                          </div>
                                       </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="update_applicantplot" name="update_applicantplot"  class="btn btn-primary" value="Save">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete --> 
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>



                                 <div class="modal fade" id="addemployeemodal" tabindex="-1" role="dialog" aria-labelledby="add employee" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Add Employee</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                         <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <form  id="addemployeeform" action="<?php echo base_url();?>EmployeeController/add_employee" method="POST"> 
                                            <input type="hidden" name="applicantid">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" name="fname" class="form-control" readonly>  
                                            </div>
                                             <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" name="lname" class="form-control" readonly>  
                                            </div>

                                            <div class="form-group" >
                                                <label>Branch</label>
                                                <select class="form-control" name="branchname" id="branch">
                                                <option  value=""  selected="selected">Select branch.....</option>
                                                <?php foreach ($locations as $location){?>
                                                <option value="<?php echo $location['branchID']; ?>"><?php echo $location['branchname']; ?></option>
                                                <?php } ?>
                                                </select> 

                                            </div>    
                                            <div class="form-group" >
                                                <label>Department</label>
                                                <select class="form-control" name="department" id="department" >
                                                    <option  value=""  selected="selected">Select department......</option>
                                                </select>   
                                            </div>   
                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="add_employee" name="add_employee"  class="btn btn-primary" value="Save">
                                        </div>
                                        </form>
                                        </div>
                                        </div>
                                    <!-- /.modal-delete --> 
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>  

                                 <div class="modal fade" id="updateappstatusmodal" tabindex="-1" role="dialog" aria-labelledby="update schedule" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="updatestatus">Update Status</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-lg-offset-1">
                                            <form  id="updateapplicantstatusform" action="<?php echo base_url();?>ApplicantController/update_applicantstatus" method="POST"> 
                                         <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type="hidden" name="applicantid" >
                                            <input type="hidden" name="purpose">
                                            <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control" id="status">

                                                    </select>
                                            </div>
                                          <div class="form-group" id="inputrequirement" style="display:none">
                                                  <label>Requirement</label><br>
                                                    <?php foreach ($requirements as $requirement){?>
                                                        <input type="checkbox" class="requirement"  value="<?php echo $requirement['requirement']; ?>" name="requirement[]"> <?php echo $requirement['requirement'] ."<br>"; ?></label>
                                                    <?php } ?>
                                                <div class="form-group">
                                                    <label>File</label>
                                                    <select name="file" id="file" class="form-control"> 
                                                        <option value="box1">Box1</option>
                                                        <option value="box2">Box2</option>
                                                        <option value="box3">Box3</option>
                                                        <option value="box4">Box4</option>
                                                        <option value="box5">Box5</option>
                                                        <option value="box6">Box6</option>
                                                        <option value="box7">Box7</option>
                                                        <option value="box8">Box8</option>
                                                        <option value="box9">Box9</option>
                                                        <option value="box10">Box10</option>
                                                        <option value="box11">Box11</option>
                                                        <option value="box12">Box12</option>
                                                        <option value="box13">Box13</option>
                                                        <option value="box14">Box14</option>
                                                        <option value="box15">Box15</option>
                                                        <option value="box16">Box16</option>
                                                        <option value="box17">Box17</option>
                                                        <option value="box18">Box18</option>
                                                        <option value="box19">Box19</option>
                                                        <option value="box20">Box20</option>
                                                    </select>
                                                 </div>
                                                     <input type="hidden" class="form-control" id="lackingrequirement" value="" name="lackingrequirement">
                                                     <input type="hidden" class="form-control" id="completerequirement" value="" name="completerequirement">
                                                     <input type="hidden" class="form-control" id="numberofUnchecked" value="Processed" name="requirement">

                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="update_applicantstatus" name="update_applicantstatus"  class="btn btn-primary" value="Save">
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                    <!-- /.modal-delete --> 
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>

                            <div class="modal fade" id="updatelackingmodal" tabindex="-1" role="dialog" aria-labelledby="update schedule" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="updatestatus">Update Status</h4>
                                        </div>
                                        <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-10 col-lg-offset-1">
                                            <form  id="updateapplicantlackingstatusform" action="<?php echo base_url();?>ApplicantController/update_applicantlackingstatus" method="POST"> 
                                         <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type="hidden" name="applicantid" >
                                            <input type="hidden" name="requirementapplicantid" >
                                            <input type="hidden" name="oldrequirement" >
                                            <input type="hidden" name="purpose">
                                            <input type="hidden" name="plotschedule">
                                            <div class="form-group">
                                                    <label>Status</label>
                                                    <select name="status" class="form-control" id="status2">

                                                    </select>
                                            </div>
                                          <div class="form-group" id="inputlackingrequirement" >
                                                  <label> Lacking Requirement</label><br>
                                                     <span class="lfrequirement"></span>
                                                     <input type="hidden" class="form-control" id="lackingrequirement2" value="" name="lackingrequirement">
                                                     <input type="hidden" class="form-control" id="completerequirement2" value="" name="completerequirement">
                                                     <input type="hidden" class="form-control" id="numberofUnchecked2" value="Processed" name="requirement">
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="update_applicantlackingstatus" name="update_applicantlackingstatu"  class="btn btn-primary" value="Save">
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
 <script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/dataTables.bootstrap.min.js' ?>"></script>
 <script type="text/javascript" src="<?php echo base_url().'bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js' ?>" charset="UTF-8"></script>
 <script type="text/javascript" src="<?php echo base_url().'bootstrap-datetimepicker-master/js/locales/bootstrap-datetimepicker.fr.js' ?>" charset="UTF-8"></script>
 <script src="<?php echo base_url().'assets/js/myscript.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforapplicant.js' ?>"></script>
  <script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>  

 <script type="text/javascript">
   var nowDate = new Date();
   var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $('.form_datetime').datetimepicker({
        autoclose: true,
        todayBtn:  true,
        startDate: today,
        showMeridian: 1
    });
    $('.form_date').datetimepicker({
        autoclose: true,
        todayBtn:  true,
        startDate: today,
    });

    $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
</script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
