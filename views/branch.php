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
    <link href="<?php echo base_url().'assets/datatables/css/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css"></head>
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
						<h1>Store Info</h1>
						<div class="row">
							<div class="col-lg-12">
								<form method="post" id="searched" action="client">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addbranchmodal">Add Branch</button>
								</form>
							</div>
						</div>
					</div>

					
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


                        <div class="modal fade" id="addbranchmodal" tabindex="-1" role="dialog" aria-labelledby="roomClabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="roomClabel">Add Client / <input type="button" name="Add" value="+ Add More" id="addbranch" class="btn btn-primary" ></h4>
                                        </div>
                                        <form method="post" id="addbranchform" action="<?php echo base_url();?>BranchController/add_branch">
                                            <table class="table table-sm table-inverse">
                                                <thead>
                                                    <tr>
                                                     <th>Branch Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="branchdetail">
                                                  <tr>
                                                    <td><input class="form-control branchname" name="branchname[]" id="branchname"  type="text"></td>
													<td><button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>
                                                  </tr>
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                                            <input type="button" id="validatebranch" class="btn btn-success" value="Save">
                                            </div>
                                        </form>
                        
                                    </div>
                                    <!-- /.modal-content -->
                                </div>  
                                <!-- /.modal-dialog -->
                            </div>
<!--end-->
				</div><br>

	 <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Store Name 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
  					<div class="dataTable_wrapper" style="overflow:auto">
  					      <table class="table table-striped table-bordered table-hover" id="dataTables-example">
					 	<thead>
					 		<tr>
					 			<th>Branch Name</th>
					 			<th>Edit</th>
					 			<th>Delete</th>
					 		</tr>

					    </thead>					 
					    <?php foreach ($branchs as $branch){?>
					     <tr>
					     	<td><?php echo $branch['branchname']; ?></td>
					     	<td><a href="#"  style="color:#23527C;background-color:transparent;border:transparent"  class="viewbranch fa fa-gear" data-toggle="modal" data-target="#updatebranchmodal" data-branchid="<?php echo $branch['branchID']; ?>"> Edit</a></td>
					  	    <td><a href="#"  style="color:#23527C;background-color:transparent;border:transparent"  class="viewbranch fa fa-times" data-toggle="modal" data-target="#deletebranchmodal" data-branchid="<?php echo $branch['branchID']; ?>"> Delete</a></td>

					  	 </tr>
					    <?php } ?>
					 

					 	</tbody>
					 </table>
				</div>
			</div>
		</div>
    </div>
</div>

     <div class="row">
                <div class="col-lg-13">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Current Branch Location / <a href="#" style="color:#23527C;" data-toggle="modal" data-target="#addlocationmodal">New Branch Location </a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                    <div class="dataTable_wrapper" style="overflow:auto">
                          <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                        <thead>
                            <tr>
                                <th>Location Name</th>
                                <th>Branch Name</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>

                        </thead>                     
                        <?php foreach ($locations as $location){?>
                         <tr>
                            <td><?php echo $location['locationname']; ?></td>
                            <td><?php echo $location['branchname']; ?></td>
                            <td><a href="#"  style="color:#23527C;background-color:transparent;border:transparent"  class="viewlocation fa fa-gear" data-toggle="modal" data-target="#updatelocationmodal" data-locationid="<?php echo $location['locationID']; ?>"> Edit</a></td>
                            <td><a href="#"  style="color:#23527C;background-color:transparent;border:transparent"  class="viewlocation fa fa-gear" data-toggle="modal" data-target="#deletelocationmodal" data-locationid="<?php echo $location['locationID']; ?>"> Delete</a></td>
                         </tr>
                        <?php } ?>
                     

                        </tbody>
                     </table>
                </div>
            </div>
        </div>
     </div>
 </div>

                        <div class="modal fade" id="addlocationmodal" tabindex="-1" role="dialog" aria-labelledby="roomClabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="roomClabel">Add Location/ <input type="button" name="Add" value="+ Add More" id="addlocation" class="btn btn-primary" ></h4>
                                        </div>
                                        <form method="post" id="addlocationform" action="<?php echo base_url();?>BranchController/add_location">
                                            <table class="table table-sm table-inverse">
                                                <thead>
                                                    <tr>
                                                     <th>Location Name</th>
                                                     <th>Branch Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody class="locationdetail" >
                                                  <tr>
                                                    <td><input class="form-control locationname" name="locationname[]" id="locationame"  type="text"></td>
                                                    <td><select class="form-control" name="branchname">
                                                         <?php foreach ($branchs as $branch){?>
                                                         <option value="<?php echo $branch['branchID']; ?>"><?php echo $branch['branchname']; ?></option>
                                                         <?php } ?>
                                                         </select>
                                                     </td>
                                                    <td><button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>
                                                  </tr>
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                                            <button type="button" id="validatelocation" name="addlocaton" class="btn btn-success">Save</button>
                                            </div>
                                            </form>             
                                    </div>
                                    <!-- /.modal-content -->
                                </div>  
                                <!-- /.modal-dialog -->
                            </div>
<!--end-->
                </div><br>

                                 <div class="modal fade" id="deletelocationmodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteLabel">Note: This will be deleted permanently.</h4>
                                        </div>
                                        <form method="post" id="deletelocationform" action="<?php echo base_url();?>BranchController/delete_location">
                                        <div class="modal-body">
                                        <center>
                                                <input name="locationid" type="hidden">
                                                Are you sure you want to proceed?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                           <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                             <button  type='submit' id="delete_location"  class='btn btn-primary' >Yes</button>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>

                                <div class="modal fade" id="updatelocationmodal" tabindex="-1" role="dialog" aria-labelledby="roomClabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="roomClabel">Update Client Name</h4>
                                        </div>
                                        <form method="post" id="updatelocationform" action="<?php echo base_url();?>BranchController/update_location">
                                            <table class="table table-sm table-inverse">
                                                <thead>
                                                    <tr>
                                                     <th>Branch Location</th>
                                                     <th>Store Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                    <input name="locationid" type="hidden">
                                                    <td><input class="form-control" name="locationname" type="text"></td>   
                                                    <td><select class="form-control" name="branchname">
                                                         <?php foreach ($branchs as $branch){?>
                                                         <option value="<?php echo $branch['branchID']; ?>"><?php echo $branch['branchname']; ?></option>
                                                         <?php } ?>
                                                         </select>
                                                     </td> 
                                                   </tr>                      
                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                                            <button type="button"  name="updatelocation" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                        
                                    </div>
                                    <!-- /.modal-content -->
                                </div>  
                                <!-- /.modal-dialog -->
                            </div>
<!--end-->
                </div>


		                         <div class="modal fade" id="deletebranchmodal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="deleteLabel">Note: This will be deleted permanently.</h4>
                                        </div>
                                        <form method="post" id="deletebranchform" action="<?php echo base_url();?>BranchController/delete_branch">
                                        <div class="modal-body">
                                        <center>
                                        		<input name="branchid" type="hidden">
                                            	Are you sure you want to proceed?
                                        </center>
                                        </div>
                                        <div class="modal-footer">
                                           <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                             <button  type='submit'  id="delete_branch" class='btn btn-primary' >Yes</button>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- /.modal-delete -->
                                </div>
                                <!-- /.modal-dialog -->
                                </div>

		                        <div class="modal fade" id="updatebranchmodal" tabindex="-1" role="dialog" aria-labelledby="roomClabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="roomClabel">Update Store Name</h4>
                                        </div>
                                        <form method="post" id="updatebranchform" action="<?php echo base_url();?>BranchController/update_branch">
                                            <table class="table table-sm table-inverse">
                                                <thead>
                                                    <tr>
                                                     <th>Store Name</th>
                                                    </tr>
                                                </thead>

                                                <tbody >
                                                	<input name="branchid" type="hidden">
                                                	<td><input class="form-control" name="branchname" type="text"></td>                     	

                                                </tbody>
                                            </table>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                                            <button type="submit"  name="updatebranch" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                        
                                    </div>
                                    <!-- /.modal-content -->
                                </div>  
                                <!-- /.modal-dialog -->
                            </div>		
<!--end-->
						</div>
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
 <script src="<?php echo base_url().'js/validateforbranch.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforuser.js' ?>"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        $('#dataTables-example2').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
