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
              <a href="<?php echo site_url('UserController/dashboard'); ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
              <a href="<?php echo site_url('BranchController/branch'); ?>"><i class="fa fa-fw fa-dashboard"></i> Branch</a>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#maintain"><i class=" fa fa-cogs"></i> Maintain <span class="caret"></span></a>
              <ul id="maintain" class="collapse">
                <li>
                  <a href="<?php echo site_url('UserController/users'); ?>"><i class="fa fa-user"></i> User</a>
                </li>
                <li>
                  <a href="<?php echo site_url('ClientController/client'); ?>"><i class="fa fa-child"></i> Client</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url('ApplicantController/viewplotapplicantadmin') ?>"><i class="fa fa-book"></i> Plot Applicant Sched </a>
            </li>
            <li>
              <a href="<?php echo site_url('RequirementController/requirement'); ?>"><i class="fa fa-share-square-o"></i> Requirements</a>
            </li>
            <li>
              <a href="<?php echo site_url('ApplicantController/request'); ?>"><i class="fa fa-share-square-o"></i> Request Applicants <span class="userclient badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span></a>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#monitoring"><i class=" fa fa-cogs"></i> Monitoring<span class="caret"></span></a>
              <ul id="monitoring" class="collapse">
                <li>
                  <a href="<?php echo site_url('EmployeeController/viewemployee'); ?>"><i class="fa fa-group"></i> Deployment details of <span style="margin-left:20px;">employees</span></a>
                </li>
                <li>
                  <a href="<?php echo site_url('ApplicantController/viewapplicant_requirementall'); ?>"><i class="fa fa-group"></i> Requirements</a>
                </li>
                                <li>
                                    <a href="<?php echo site_url('EmployeeController/viewcontract_employee'); ?>"><i class="fa fa-group"></i> Contract</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('EmployeeController/viewfeedback_employee'); ?>"><i class="fa fa-group"></i> Feedback Employees</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('ApplicantController/view_extendemployeeadmin'); ?>"><i class="fa fa-group"></i> Extend</a>
                                </li>
              </ul>
            </li>
            <li>
              <a href="javascript:;" data-toggle="collapse" data-target="#report"><i class=" fa fa-cogs"></i> Report<span class="caret"></span></a>
              <ul id="report" class="collapse">
                <li>
                  <a href="<?php echo site_url('ApplicantController/view_requestclient'); ?>"><i class="fa fa-group"></i> Requested employees from the clients</a>
                </li>
              </ul>
                            <li>
                                <a href="<?php echo site_url('ApplicantController/view_extend'); ?>"><i class="fa fa-group"></i> Extend Employee</a>
                            </li>
            </li> 
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
						</ol>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<h1>Plot Applicant</h1>

					</div>
				</div><br>

        
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

                                                    if ($profile['position']=="Administrator"){
                                                        $position= "Administrator";
                                                        $position2 = "Staff";
                                                      }
                                                    else{
                                                        $position= "Staff";
                                                        $position2 = "Administrator";
                                                      }
                                          
                                                    { ?>

                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="id" type="hidden"  class="form-control">
                                            <input name="firstname" type="text" value="<?php echo $profile['firstname']; ?>" class="form-control">
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lastname" value="<?php echo $profile['username']; ?>"  class="form-control">
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
                                            <label>Position</label>
                                            <select name="type" class="form-control">
                                                <option value="<?php echo $position; ?>"><?php echo $position; ?></option>
                                                <option value="<?php echo $position2; ?>"><?php echo $position2; ?></option>                
                                            </select>
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
                            Current Plot Applicant
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" style="overflow: auto; ">

                               <table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:auto;">
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
                                            <th>User in Charge</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
                                                        echo "<td> For Deploy</td>";
                                                    break;
                                                      
                                                }   
                                                echo "<td>".$applicant['username']."</td>";
                                                if ($applicant['status'] == 2  && $applicant['purpose'] == 1){
                                                     echo "<td>Done Screening</td>";
                                                }
                                                else if ($applicant['status'] == 3  && $applicant['purpose'] == 2){
                                                    echo "<td>Done Orientation</td>";

                                                }
                                                 else if ($applicant['status'] == 5  && $applicant['purpose'] == 3){
                                                    echo "<td>Complete Requirements</td>";

                                                }
                                                 else if ($applicant['status'] == 8  && $applicant['purpose'] == 4){
                                                    echo "<td>Done Releasing Pay Card</td>";

                                                }
                                                 else if ($applicant['status'] == 2  && $applicant['purpose'] == 2){
                                                  echo "<td>Done Screening</td>";
                                                }
                                                 else if ($applicant['status'] == 3  && $applicant['purpose'] == 3){
                                                  echo "<td>Done Orientation</td>";
                                                }
                                                 else if ($applicant['status'] == 4  && $applicant['purpose'] == 3){
                                                  echo "<td>Lacking Requirement</td>";
                                                }  
                                                 else if ($applicant['status'] == 5  && $applicant['purpose'] == 4){
                                                  echo "<td>Complete Requirements</td>";
                                                }  
                                                else if ($applicant['status'] == 8  && $applicant['purpose'] == 5){
                                                  echo "<td>For Deploy</td>";
                                                }  
                                                 else if ($applicant['status'] == 1  && $applicant['purpose'] == 1){
                                                  echo "<td>Hired</td>";
                                                }
                                                 else if ($applicant['status'] == 7  && $applicant['purpose'] == 1){
                                                     echo "<td>Hired</td>";
                                                }
                                                  else if ($applicant['status'] == 7  && $applicant['purpose'] == 2 ){
                                                     echo "<td>Not Coming</td>";
                                                }
                                                  else if ($applicant['status'] == 7 && $applicant['purpose'] == 3 ){
                                                     echo "<td>Not Processed</td>";
                                                }
                                                  else if ($applicant['status'] == 7 && $applicant['purpose'] == 4 ){
                                                     echo "<td>Not Coming</td>";
                                                }

                                                  else if ($applicant['status'] == 6 && $applicant['purpose'] == 3 ){
                                                  echo "<td>Not Processed</td>";
                                                }
                                                  else{
                                                    echo "<td>Done Releasing Pay Card</td>";
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

 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/dataTables.bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/myscript.js' ?>"></script>
  <script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
