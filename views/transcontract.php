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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/style.css'; ?>">
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
      if (isset($this->session->userdata['userlogin']['clientID'])) { ?>
            <a href="" class="navbar-brand" href="<?php echo site_url('ClientController/dashboard'); ?>">Tekton Employee and File Management System - <?php echo ucfirst($this->session->userdata['userlogin']['username']);?></a>
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
                <a href="<?php echo site_url('ClientController/logout'); ?>"><i class="fa fa-power-off"></i> Logout</a>
              </li>
            </ul>
          </li>
        </ul>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="active">
              <a href="<?php echo site_url('ClientController/dashboard'); ?>"><i class="fa fa-fw fa-dashboard"></i> Home</a>
            </li>
                        <li>
                            <a class="gg"   data-toggle="collapse" data-target="#request"><i class=" fa fa-cogs"></i> Request Applicants <span class="useradmin badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> <span class="caret"></span></a>
                            <ul id="request" class="collapse">
                                 <?php foreach ($useradmin as $user) {?>
                                <li>
                                  <a href="#" class="messageto" data-target='#usermodal' data-userid="<?php echo $user['userID'];?>" data-clientid="<?php echo $this->session->userdata['userlogin']['clientID'];?>"><i class="fa fa-user"></i> <?php echo ucfirst($user['username']); ?></a>
                                </li><?php } ?>
                            </ul>
                       </li> 
                        <li>
                            <a data-toggle="collapse" data-target="#attendance"><i class=" fa fa-cogs"></i> Monitoring <span class="badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> <span class="caret"></span></a>
                            <ul id="attendance" class="collapse">
                               <li>
                                  <a href="<?php echo site_url("EmployeeController/view_deploymentemployee"); ?>" ><i class="fa fa-user"></i> Deployment Employees</a>
                                </li>
                                <li>
                                  <a href="<?php echo site_url("EmployeeController/view_attendance"); ?>" ><i class="fa fa-user"></i> Attendance</a>
                                </li>
                                <li>
                                  <a href="<?php echo site_url("ScheduleController/viewschedule_employee"); ?>" ><i class="fa fa-user"></i> Schedule</a>
                                </li>
                                <li>
                                  <a href="<?php echo site_url("ClientController/employeecontract"); ?>" ><i class="fa fa-user"></i> Contract</a>
                                </li>
                                 <li>
                                  <a href="<?php echo site_url("EmployeeController/employee_status"); ?>"><i class="fa fa-fw fa-user"></i> Feedback for Employees</a>
                                 </li>
                                 <li>
                                  <a href="<?php echo site_url("EmployeeController/view_extendemployee"); ?>"><i class="fa fa-fw fa-user"></i> Extend Employee</a>
                                 </li>
                             </ul>
                       </li>
                         <li>
                            <a data-toggle="collapse" data-target="#transaction"><i class=" fa fa-cogs"></i> Transaction <span class="badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> <span class="caret"></span></a>
                            <ul id="transaction" class="collapse">
                              <li>
                               <a href="<?php echo site_url("EmployeeController/attendanceemployee"); ?>"><i class="fa fa-fw fa-dashboard"></i> Attendance employee</a>
                              </li>  
                              <li>
                               <a href="<?php echo site_url("EmployeeController/schedule_employee"); ?>"><i class="fa fa-fw fa-user"></i> Schedule Employee</a>
                              </li> 
                               <li>
                               <a href="<?php echo site_url("EmployeeController/feedback_employee"); ?>"><i class="fa fa-fw fa-user"></i> FeedBack for Employee</a>
                              </li> 
                            </ul>
                          </li>
                           <li>
                            <a data-toggle="collapse" data-target="#report"><i class=" fa fa-cogs"></i> Report <span class="badge" style="background-color:#ad0c0c; color:#fcf8e3;"></span> <span class="caret"></span></a>
                            <ul id="report" class="collapse">
                              <li>
                               <a href="<?php echo site_url("EmployeeController/view_deploymentattendance"); ?>"><i class="fa fa-fw fa-dashboard"></i> Deployment Employee</a>
                              </li> 
                              <li>
                               <a href="<?php echo site_url("EmployeeController/view_employeeatendance"); ?>"><i class="fa fa-fw fa-dashboard"></i> Attendance Employee</a>
                              </li>   
                               <li>
                               <a href="<?php echo site_url("ClientController/contract_reportemployee"); ?>"><i class="fa fa-fw fa-user"></i> Contract Employee</a>
                              </li> 
                            </ul>
                          </li>
         
          </ul>
        </div>
      </div>
    </nav>
                        <!-- client profile modal -->
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
                                           <form role="form" id="updateprofileform" action="<?php echo base_url(); ?>ClientController/update_account"  method="POST">
                                            <?php 
                                              foreach ($clientprofile as $profile) 
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
                                        <form id="changepasswordform" action="<?php echo base_url();?>ClientController/update_password" method="POST"> 
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
                              

    <div id="page-wrapper">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
              <li>
                  <i class="fa fa-dashboard"></i> <a href="<?php echo site_url('ClientController/dashboard'); ?>">Dashboard</a>
              </li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <h1>Terminate/Resignation</h1>
          </div>
        </div><br>


                                
<div class="shout_box" style="display:none;">
<div class="header"><span class="adminuser"></span><div class="close_btn">&nbsp;</div></div>
  <div class="toggle_chat">
  <form id="chatform" action="<?php echo base_url(); ?>ChatController/admin_chat"  method="POST">
  <div class="message_box">
    </div>

    <div class="user_info" id="usermodal">
    <input name="userid" type="hidden">
    <input name="username" type="hidden" value="<?php echo strtolower($this->session->userdata['userlogin']['username']) ?>">
    <input name="message" id="message" type="text" placeholder="Type Message Hit Enter" maxlength="100" /> 
    </div>

    </div>
  </form>
</div>
             <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current deploy Employee
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" style="overflow:auto">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                           <th>EmployeeName</th>
                                            <th>Contact</th>
                                            <th>Email Address</th>
                                            <th>Address</th>
                                            <th>BranchName</th>
                                            <th>Department</th>
                                            <th>Status</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                      date_default_timezone_set("Asia/Manila");
                                        $datenow = date('Y-m-d');
                                        $currentmonth = date('n', strtotime($datenow));
                                        $currentyear = date('Y', strtotime($datenow));
                                        $currentday= date("j", strtotime($datenow));
                                        foreach ($deployapplicants as $employee){
                                                $dateremain = date($employee['dateremain']);
                                                $datecontract =date($employee['datecontract']);
                                                $frommonth = date('m', strtotime($dateremain));
                                                $tomonth = date('m', strtotime($datecontract));
                                                $dayr= date("j", strtotime($dateremain));
                                                $dayc= date("j", strtotime($datecontract));
                                                //remaining month
                                                $remainingmonth = $tomonth - $frommonth;
                                                $remainingday = $dayc - $dayr;
                                                $yearcontract = date('Y', strtotime($datecontract));
                                                $yearremain = date('Y', strtotime($dateremain));
                                                // remaining day

                                          echo "<tr>";
                                                echo "<td style='width:90px;'>".$employee['firstname']. " " .$employee['lastname']. "</td>";
                                                echo "<td>".$employee['contact']."</td>";
                                                echo "<td>".$employee['emailadd']."</td>";
                                                echo "<td>".$employee['address']."</td>";
                                                echo "<td>".$employee['branchname']."</td>";
                                                echo "<td>".$employee['locationname']."</td>";
                                               switch ($employee['status']) {
                                                  case 'Activate':
                                                    echo "<td><a href='#'  data-toggle='modal' data-target='#changestatusmodal' class='viewdeployapplicant btn btn-primary btm-sm' data-employeeid='".$employee['employeeID']."'>".$employee['status']."</a></td>";
                                                    break;
                                                    case 'End':
                                                    echo "<td><a href='#' class='viewdeployapplicant btn btn-success btm-sm'>".$employee['status']."</a></td>";
                                                     break;
                                                      default:
                                                    echo "<td><a href='#' class='btn btn-danger btm-sm' >".$employee['status']."</a></td>";
                                                    break;
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

                                  <div class="modal fade" id="changestatusmodal" tabindex="-1" role="dialog" aria-labelledby="add employee" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="addRoom">Change Status</h4>
                                        </div>
                                        <div class="modal-body">
                                       <div class="row">
                                        <div class="col-lg-10 col-lg-offset-1">
                                         <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <form  id="changestatusform" action="<?php echo base_url();?>EmployeeController/updatestatus_employee" method="POST"> 
                                            <input type="hidden" name="applicantid">
                                            <input type="hidden" name="employeeid">
                                            <input type="hidden" name="clientid">
                                            <input type="hidden" name="branchid">
                                            <input type="hidden" name="locationid">
                                           <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                  <option value="Terminate">Terminate</option>
                                                  <option value="Resign">Resign</option>
                                                </select>
                                            </div>  
                                        </div>
                                        <div class="modal-footer">
                                        <div class="col-lg-4 pull-right">
                                         <input type="submit" id="changestatus" name="changestatus"  class="btn btn-primary" value="Change">
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
 <script src="<?php echo base_url().'js/chatmessage.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforemployee.js' ?>"></script>
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
