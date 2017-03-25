  <?php 
   class Employee_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 

      // for insert employee
      public function addemployee($data) { 
         if ($this->db->insert("tblemployee", $data)) { 
            return true; 
         } 
      } 

       public function addscheduleemployee($datestart, $dateremain, $datecontract, $intime, $outtime, $dayoff, $employeeid) { 
        $sql="UPDATE tblemployee set datestart = '".$this->db->escape_str($datestart)."', dateremain = '".$this->db->escape_str($dateremain)."', datecontract= '".$this->db->escape_str($datecontract)."', intime = STR_TO_DATE('".$this->db->escape_str($intime)."','%h:%i %p'), outtime = STR_TO_DATE('".$this->db->escape_str($outtime)."','%h:%i %p'), dayoff = '".$this->db->escape_str($dayoff)."'
          WHERE employeeID ='".$this->db->escape_str($employeeid)."'";  
         if ($this->db->query($sql) === TRUE) { 
            return true; 
         } 
     
      }   

    // for view all deploy applicant record
      public function viewalldeployapplicant(){   
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblapplicant.status, tblbranch.branchname, tbllocation.locationname, tblclient.username as userclient')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tblbranch', 'tblemployee.branchID = tblbranch.branchID', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID')
        ->join('tblclient', 'tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID', 'inner')
        ->join('tbluser', 'tblapplicant.userID = tbluser.userID')->where('tblapplicant.status >=', 9)->where('tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

        // filter all deployapplicant to staff
      public function filterdeployemployeestaff($month, $year){   
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblapplicant.status, tblbranch.branchname, tbllocation.locationname')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')->join('tblbranch', 'tblemployee.branchID = tblbranch.branchID', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID')->join('tbluser', 'tblapplicant.userID = tbluser.userID')
        ->where('MONTH(tblapplicant.datedeploy)', $month)->where('YEAR(tblapplicant.datedeploy)', $year)
        ->where('tblapplicant.status >=', 9)->where('tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
      public function viewallcontract(){   
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tblclient.firstname as fname, tblclient.lastname as lname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblemployee.status, tblapplicant.extend, tblbranch.branchname, tbllocation.locationname,tblapplicant.applicantID, tbllocation.locationID, tblbranch.branchID, tblemployee.employeeID')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')->join('tblbranch', 'tblemployee.branchID = tblbranch.branchID', 'inner')
        ->join('tblclient', 'tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID')->join('tbluser', 'tblapplicant.userID = tbluser.userID')->where('tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
       // for view all deploy applicant record where client manage
      public function view_deploy($clientid){   
        $this->db->select('tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.extend, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.employeeID, tblemployee.status as employeestatus')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tblclient', 'tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID', 'inner')
        ->join('tblbranch', 'tblemployee.branchID = tblbranch.branchID', 'inner', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID', 'inner')
        ->join('tbluser', 'tblemployee.userID = tbluser.userID')->where('tblclient.clientID', $clientid)->where('tblapplicant.status >=', 9)->where('tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

      public function viewextendemployee($clientid, $year){   
        $this->db->select('tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.extend,   tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblextendemployee.dateextend')->from('tblextendemployee')
        ->join('tblapplicant', 'tblextendemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tblclient', 'tblextendemployee.branchID = tblclient.branchID AND  tblextendemployee.locationID = tblclient.locationID', 'inner')
        ->join('tblbranch', 'tblextendemployee.branchID = tblbranch.branchID', 'inner', 'inner')
        ->join('tbllocation', 'tblextendemployee.locationID = tbllocation.locationID', 'inner')
        ->join('tbluser', 'tblextendemployee.userID = tbluser.userID')->where('tblclient.clientID', $clientid)->where('tblextendemployee.extendID IN (SELECT MAX(extendID) from tblextendemployee WHERE YEAR(dateextend) = "'.$year.'" GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
    //  for view attendance report
      public function view_attendanceemployee($clientid, $year){
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID FROM tblemployee
          INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
          INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID
          INNER JOIN  tblbranch ON tblemployee.branchID = tblbranch.branchID
          INNER JOIN  tbllocation ON tblemployee.locationID = tbllocation.locationID
          INNER JOIN  tbluser ON  tblemployee.userID = tbluser.userID  WHERE tblclient.clientID = '".$clientid."' AND
         tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE status='Activate' OR status='End' AND YEAR(datestart)  = '".$year."'  GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();          
      }
       //  for filter attendance;
      public function filterattendance_employee($clientid, $year, $status){
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID FROM tblemployee
          INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
          INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID
          INNER JOIN  tblbranch ON tblemployee.branchID = tblbranch.branchID
          INNER JOIN  tbllocation ON tblemployee.locationID = tbllocation.locationID
          INNER JOIN  tbluser ON  tblemployee.userID = tbluser.userID  WHERE tblclient.clientID = '".$clientid."' AND
         tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE YEAR(datestart)  = '".$year."' AND status = '".$status."' GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();          
      }
    // for view deployment employee
      public function viewdeployapplicant($clientid, $datenow){   
       $this->db->select('tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tblclient', 'tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID', 'inner')
        ->join('tblbranch', 'tblemployee.branchID = tblbranch.branchID', 'inner', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID', 'inner')
        ->join('tbluser', 'tblemployee.userID = tbluser.userID')->where('tblclient.clientID', $clientid)->where('tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE  DATE_FORMAT(datestart, "%Y-%m")= "'.$datenow.'" GROUP BY applicantID)');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();   
      }

      public function filterdeployemployee($clientid, $month, $year, $status){
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID from tblemployee
        INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
        INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND tblemployee.locationID = tblclient.locationID
        INNER JOIN tblbranch  ON tblemployee.branchID = tblbranch.branchID 
        INNER JOIN tbllocation ON tblemployee.locationID = tbllocation.locationID
        INNER JOIN tbluser ON tblemployee.userID = tbluser.userID WHERE tblclient.clientID = '".$clientid."' 
        AND tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE MONTH(datestart) =  '".$month."' AND YEAR(datestart) =  '".$year."' AND status = '".$status."' GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();          
      }
      
       public function filteralldeployemployee($month, $year){
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.employeeID, tblclient.clientID, tblclient.username as userclient from tblemployee
        INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
        INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND tblemployee.locationID = tblclient.locationID
        INNER JOIN tblbranch  ON tblemployee.branchID = tblbranch.branchID 
        INNER JOIN tbllocation ON tblemployee.locationID = tbllocation.locationID
        INNER JOIN tbluser ON tblemployee.userID = tbluser.userID WHERE tblapplicant.status >= 9 AND tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE MONTH(datedeploy) =  '".$month."' AND YEAR(datedeploy) =  '".$year."'  GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();          
      }
      public function view_contractadmin($year, $status){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID, tblclient.firstname as fname, tblclient.lastname as lname from tblemployee 
                INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID 
                INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID
                INNER JOIN tblbranch ON tblemployee.branchID = tblbranch.branchID 
                INNER JOIN tbllocation ON tblemployee.locationID = tbllocation.locationID 
                INNER JOIN tbluser ON tblemployee.userID = tbluser.userID where tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE  YEAR(datestart) = '".$year."' AND status= '".$status."' GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();
      }
       public function view_contract($clientid, $year, $status){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.status, tblapplicant.applicantID, tblapplicant.lastname, tbluser.username, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, tblbranch.branchname, tbllocation.locationname, tblemployee.datestart, tblemployee.dateremain, tblemployee.datecontract, tblemployee.status, tblemployee.employeeID, tblclient.clientID from tblemployee 
                INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
                INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID
                INNER JOIN tblbranch ON tblemployee.branchID = tblbranch.branchID
                INNER JOIN tbllocation ON tblemployee.locationID = tbllocation.locationID
                INNER JOIN tbluser ON tblemployee.userID = tbluser.userID where tblclient.clientID = '".$clientid."' AND 
                tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE YEAR(datestart) = '".$year."' AND status ='".$status."'  GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();
      }

       public function view_deployemployee($employeeid){   
         $this->db->select('tblapplicant.firstname, tblapplicant.applicantID, tblapplicant.lastname, tblemployee.employeeID, tblclient.clientID, tblemployee.branchID, tblemployee.locationID')->from('tblemployee')
        ->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tblclient', 'tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID', 'inner')->where('tblemployee.employeeID', $employeeid);
         $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

       // for view all deploy applicant record where client manage
      public function view_scheduleemployee($clientid, $datenow){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblemployee.datecontract, tblemployee.dateremain, tblattendance.attendanceID, tblattendance.olddateschedule, tblattendance.dateschedule, tblattendance.intime as start, 
        tblattendance.outtime as end, DATE_FORMAT(tblattendance.oldintime, '%r') as intime,  DATE_FORMAT(tblattendance.oldouttime, '%r') as outtime, tblattendance.olddayoff, tblattendance.dayoff, tblemployee.status, tblemployee.employeeID, tblclient.clientID FROM tblemployee
        INNER JOIN tblapplicant ON tblemployee.applicantID = tblapplicant.applicantID
        INNER JOIN tblclient ON tblemployee.branchID = tblclient.branchID AND  tblemployee.locationID = tblclient.locationID
        INNER JOIN tblbranch ON  tblemployee.branchID = tblbranch.branchID
        INNER JOIN tbllocation ON  tblemployee.locationID = tbllocation.locationID
        INNER JOIN tblattendance ON tblemployee.employeeID = tblattendance.employeeID WHERE tblclient.clientID = '".$clientid."' AND tblemployee.datestart!= '0000-00-00' AND
        tblemployee.employeeID IN (SELECT MAX(employeeID) from tblemployee WHERE  status='Activate' AND DATE_FORMAT(olddateschedule, '%Y-%m') = '".$datenow."'  GROUP BY applicantID)";
        $query=$this->db->query($sql);
        return $query->result_array();
        $db->close();
      }

      public function viewemployee(){ 
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname')->from('tblemployee')->join('tblapplicant', 'tblemployee.applicantID = tblapplicant.applicantID', 'inner')
        ->join('tbllocation', 'tblemployee.locationID = tbllocation.locationID', 'inner')->order_by('tblemployee.datestart', 'DESC');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }


            // for view all applicant record
      public function viewplotapplicant(){ 
        $this->db->select('applicantID, firstname, lastname, contact, emailadd, address, DATE_FORMAT(plotschedule, "%Y-%m-%d %r") as schedule, purpose, status, datehired, requirement')->from('tblapplicant');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }


      public function selectapplicant($data){ 
        $this->db->select('applicantID ,DATE_FORMAT(plotschedule, "%Y-%m-%d %h:%i %p") as schedule, DATE_FORMAT(releaseschedule, "%Y-%m-%d %h:%i %p") as releasesched, purpose')->from('tblapplicant')->where(array('applicantID'=> $data['applicantID']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        // for update schedule for applicant
        public function updateschedule($plotsched, $releasesched, $purpose,  $applicantid) { 
        $sql="UPDATE tblapplicant set plotschedule = STR_TO_DATE('".$this->db->escape_str($plotsched)."','%Y-%m-%d %h:%i %p'), releaseschedule = STR_TO_DATE('".$this->db->escape_str($releasesched)."','%Y-%m-%d %h:%i %p'), purpose= '".$this->db->escape_str($purpose)."' WHERE applicantID='".$this->db->escape_str($applicantid)."'";  
         if ($this->db->query($sql) === TRUE) { 
            return true; 
         } 
     
      } 
         public function updateapplicantstatus($data, $applicantid) { 
           $this->db->set($data); 
           $this->db->where("applicantID", $applicantid); 
           $this->db->update("tblapplicant"); 
      } 
     public function scheduleattendance($data, $applicantid) { 
           $this->db->set($data); 
           $this->db->where("applicantID", $applicantid); 
           $this->db->update("tblapplicant"); 
      } 
      //status for employee
     public function updateemployeestatus($data, $employeeid) { 
           $this->db->set($data); 
           $this->db->where("employeeID", $employeeid); 
           $this->db->update("tblemployee"); 
      } 

       public function employeeideremainmonth($data, $datenow) { 
           $this->db->set($data); 
           $this->db->where("MONTH(dateremain) >=", $datenow); 
           $this->db->update("tblemployee"); 
      } 
  
  
  
   } 
?> 