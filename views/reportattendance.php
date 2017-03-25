<!DOCTYPE html>
<html>
<head>
    <title>Tekton Employee System</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript"> var base_url="<?php echo base_url(); ?>"</script>
    <link rel="stylesheet" type="text/css"  href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
    <link href="<?php echo base_url().'assets/css/sb-admin.css'?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap-theme.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/style.css'; ?>">
  <link href="<?php echo base_url().'assets/datatables/css/dataTables.bootstrap.css'?>" rel="stylesheet" type="text/css">
</head>
<body style="background-color:white;">
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
    </nav>
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
                            </div>        <div id="page-wrapper" style="margin-left:-200px; width:1250px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="nav-bar-head">
                <div class="head-logo">
                <div class=" logo">
                           <a href="#">
                                <img id="header-logo" src="<?php echo base_url(); ?>tektonimage/tekton.png">
                            </a>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                         <button class='btn btn-primary btm-sm' id="printbutton" onclick="Print()" >Print</button> 
                        <h1><center>Employee Attendance Record</center></h1>
                        <div style="font-size:15px; font-weight:bold; margin-left:900px; margin-top:-57px;">
                             <?php foreach ($employeereportatendance as $attendance){
                                            $year= date("Y", strtotime($attendance['dateschedule']));
                                 } 
                                        ?>
                        <h2>Year :<?php echo $year;?></h2>
                        </div>
                    </div>
                    <div class="col-xs-8 pull-left">
                        <span style="background-color: #337ab7 !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">No Starting</span>
                        <span style="background-color: #419641 !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">Present</span>
                        <span style="background-color: #c12e2a !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">Absent</span>
                        <span style="background-color: #4d5666 !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">Late</span>
                        <span style="background-color: #f0ad4e !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">Day off</span>
                        <span style="background-color: #404548 !important; width:100px; padding-left:25px;"></span><span style="margin-left:5px;">Holiday</span>
                    </div>                             
                </div>
              <br>
          </br>
           <div class="col-xs-10 pull-left">
            <div style="font-size:15px; font-weight:bold;">
                    <span style="margin-left:5px;">Employee Name : <?php echo ucfirst($attendance['firstname']) ." ". ucfirst($attendance['lastname']); ?></span>
                    <span style="margin-left:30px;">Branch : <?php echo ucfirst($attendance['branchname']); ?></span>
                    <span style="margin-left:30px;">Department : <?php echo ucfirst($attendance['locationname']); ?></span>
                    <span style="margin-left:30px;">Date Start : <?php echo ucfirst($attendance['datestart']); ?></span>

            </div>    
        </div>
          </br>
          </br>

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
                            Current Attendance Employee/ 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper" style="overflow:auto">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                     </tr>
                                  </thead>
                                    <thead>
                                        <tr>
                                            <th>Month</th>                             
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                            <th>4</th>
                                            <th>5</th>
                                            <th>6</th>
                                            <th>7</th>
                                            <th>8</th>
                                            <th>9</th>
                                            <th>10</th>
                                            <th>11</th>
                                            <th>12</th>
                                            <th>13</th>
                                            <th>14</th>
                                            <th>15</th>
                                            <th>16</th>
                                            <th>17</th>
                                            <th>18</th>
                                            <th>19</th>
                                            <th>20</th>
                                            <th>21</th>
                                            <th>22</th>
                                            <th>23</th>
                                            <th>24</th>
                                            <th>25</th>
                                            <th>26</th>
                                            <th>27</th>
                                            <th>28</th>
                                            <th>29</th>
                                            <th>30</th>
                                            <th>31</th>                                   
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $datenow = date('Y-m-d');
                                        $day = date("j", strtotime($datenow));
                                        $numberofabsent = 0;
                                        foreach ($employeereportatendance as $attendance){
                                            $month= date("F", strtotime($attendance['olddateschedule']));
                                            echo "<tr>";
                                                    echo "<td>".$month."</td>";
                                                //day1
                                                 if ($attendance['day1'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day1'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day1'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                        $numberofabsent++;
                                                   }
                                                 else if ($attendance['day1'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day1'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day1'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day1']."</td>";                                                 
                                                 //day2
                                                 if ($attendance['day2'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day2'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day2'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                        $numberofabsent++;
                                                    }
                                                 else if ($attendance['day2'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day2'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day2'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day2']."</td>";
                                                 //day3
                                                 if ($attendance['day3'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day3'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day3'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day3'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day3'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day3'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day3']."</td>";
                                                 //day 4
                                                 if ($attendance['day4'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day4'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day4'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day4'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day4'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day4'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day4']."</td>";
                                                 //day5
                                                 if ($attendance['day5'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day5'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day5'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day5'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day5'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day5'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day5']."</td>";
                                                 //day6
                                                 if ($attendance['day6'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day6'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day6'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day6'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day6'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day6'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day6']."</td>";
                                                 //day7
                                                 if ($attendance['day7'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day7'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day7'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day7'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day7'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day7'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                else
                                                     echo "<td>".$attendance['day7']."</td>";
                                                 //day8
                                                 if ($attendance['day8'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day8'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day8'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                    }
                                                 else if ($attendance['day8'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day8'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day8'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day8']."</td>";
                                                 //day9
                                                 if ($attendance['day9'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day9'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day9'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day9'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day9'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day9'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day9']."</td>";
                                                 //day10
                                                 if ($attendance['day10'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day10'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day10'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day10'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day10'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day10'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day10']."</td>";
                                                 //day11
                                                 if ($attendance['day11'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day11'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day11'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day11'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day11'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day11'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day11']."</td>";
                                                 //day12
                                                 if ($attendance['day12'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day12'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day12'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                    }
                                                 else if ($attendance['day12'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day12'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day12'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day12']."</td>";
                                                 //day13
                                                 if ($attendance['day13'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day13'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day13'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day13'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day13'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day13'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day13']."</td>";
                                                 //day14
                                                 if ($attendance['day14'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day14'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day14'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day14'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day14'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day14'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day14']."</td>";
                                                 // day15
                                                 if ($attendance['day15'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day15'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day15'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day15'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day15'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day15'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day15']."</td>";
                                                 //day16
                                                 if ($attendance['day16'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day16'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day16'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                     $numberofabsent++;
                                                 }
                                                 else if ($attendance['day16'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day16'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day16'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day16']."</td>";
                                                 //day17
                                                 if ($attendance['day17'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day17'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day17'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day17'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day17'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day17'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day17']."</td>";
                                                 //day18
                                                 if ($attendance['day18'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day18'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day18'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day18'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day18'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day18'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day18']."</td>";
                                                 //day19
                                                 if ($attendance['day19'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day19'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day19'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day19'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day19'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day19'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day19']."</td>";
                                                 //day20
                                                 if ($attendance['day20'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day20'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day20'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day20'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day20'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day20'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day20']."</td>";   
                                                 // day 21
                                                 if ($attendance['day21'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day21'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day21'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day21'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day21'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day21'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day21']."</td>";
                                                 //day 22
                                                 if ($attendance['day22'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day22'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day22'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day22'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day22'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day22'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day22']."</td>";
                                                 //day23
                                                 if ($attendance['day23'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day23'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day23'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day23'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day23'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day23'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day23']."</td>";
                                                 //day24
                                                 if ($attendance['day24'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day24'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day24'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day24'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day24'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day24'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day24']."</td>";
                                                 //day25
                                                 if ($attendance['day25'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day25'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day25'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day25'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day25'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day25'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day25']."</td>";
                                                 //day26
                                                 if ($attendance['day26'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day26'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day26'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                 }
                                                 else if ($attendance['day26'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day26'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day26'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day26']."</td>";
                                                 // day27
                                                 if ($attendance['day27'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day27'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day27'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day27'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day27'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day27'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day27']."</td>";
                                                 //day28
                                                 if ($attendance['day28'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day28'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day28'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day28'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day28'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day28'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day28']."</td>";
                                                 //day29
                                                 if ($attendance['day29'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day29'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day29'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day29'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day29'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day29'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day29']."</td>";
                                                 //day30
                                                 if ($attendance['day30'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day30'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day30'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day30'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day30'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day30'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day30']."</td>";
                                                 //day31
                                                 if ($attendance['day31'] == "na")
                                                     echo "<td style='background-color:#337ab7 !important;'></td>";
                                                 else if ($attendance['day31'] == "P")
                                                     echo "<td style='background-color:#419641 !important;'></td>";
                                                 else if ($attendance['day31'] == "A"){
                                                     echo "<td style='background-color:#c12e2a !important;'></td>";
                                                      $numberofabsent++;
                                                  }
                                                 else if ($attendance['day31'] == "L")
                                                     echo "<td style='background-color:#4d5666 !important;'></td>";
                                                 else if ($attendance['day31'] == "off")
                                                     echo "<td style='background-color:#f0ad4e !important;'></td>";
                                                 else if ($attendance['day31'] == "H")
                                                     echo "<td style='background-color:#404548 !important;'></td>";
                                                 else
                                                     echo "<td>".$attendance['day31']."</td>";
                                            echo "</tr>";                                     
                                            
                                    }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <label style="margin-left:900px;"><span></span></label>

                    </div>
                </div>       
                     <div>
                        <label style="margin-left:700px;">Prepared by : <?php echo $clientname; ?><span></span></label>
                    </div>     
            </div>
         </div>



 <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/jquery.dataTables.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/datatables/js/dataTables.bootstrap.min.js' ?>"></script>
 <script src="<?php echo base_url().'assets/js/myscript.js' ?>"></script>
 <script src="<?php echo base_url().'js/validateforemployee.js'?>"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
     <script type="text/javascript">
        function Print() {
        //Get the print button and put it into a variable
        var printbutton = document.getElementById("printbutton");
        //Set the print button visibility to 'hidden' 
        printbutton.style.visibility = 'hidden';

        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printbutton.style.visibility = 'visible';
    }
    </script>
  <script type="text/javascript">
    $('.numberofabsent').each(function () {
    var result = 0;
    $('.numberofabsent').each(function () {
        result +=+$(this).text();
    });
    $('#totalofabsent').text("Total of Absents " +result+);
}); 
    </script>
</body>
</html>
