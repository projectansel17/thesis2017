<?php 
   class Scheduleemployee_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client

      public function addscheduleemployee($clientid, $employeeid, $applicantid, $dateschedule, $intime, $outtime, $dayoff, $datechange) { 
       
      $sql="INSERT into tblscheduleemployee (clientID, employeeID, applicantID, dateschedule, intime, outtime, dayoff, datechange) values 
        ('".$this->db->escape_str($clientid)."','".$this->db->escape_str($employeeid)."','".$this->db->escape_str($applicantid)."', '".$this->db->escape_str($dateschedule)."', STR_TO_DATE('".$this->db->escape_str($intime)."','%h:%i %p'), STR_TO_DATE('".$this->db->escape_str($outtime)."','%h:%i %p'), '".$this->db->escape_str($dayoff)."', '".$this->db->escape_str($datechange)."')";
    
         if ($this->db->query($sql) === TRUE) { 
            return true; 
         } 
      } 
      // viewall schedule employee
      public function viewscheduleemployee($clientid,$year){   
        $sql= "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblclient.firstname as fname, tblclient.lastname as lname, tblemployee.employeeID 
        from tblscheduleemployee INNER JOIN  tblapplicant ON tblscheduleemployee.applicantID = tblapplicant.applicantID
        INNER JOIN  tblclient ON tblscheduleemployee.clientID = tblclient.clientID
        INNER JOIN  tblemployee ON tblscheduleemployee.employeeID = tblemployee.employeeID WHERE tblclient.clientID = '".$clientid."' AND YEAR(tblscheduleemployee.datechange)='".$year."' AND
        tblscheduleemployee.scheduleemployeeID IN (SELECT MAX(scheduleemployeeID) from tblscheduleemployee GROUP BY applicantID)";
         $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }

  // viewall schedule employee
      public function viewlistchedule($employeeid){   
        $sql= "SELECT tblscheduleemployee.dateschedule, DATE_FORMAT(tblscheduleemployee.intime, '%h:%i %p') as intime,
               DATE_FORMAT(tblscheduleemployee.outtime, '%h:%i %p') as outtime, tblscheduleemployee.dayoff, tblscheduleemployee.datechange from tblscheduleemployee 
               INNER JOIN  tblapplicant ON tblscheduleemployee.applicantID = tblapplicant.applicantID
               INNER JOIN  tblclient ON tblscheduleemployee.clientID = tblclient.clientID
               INNER JOIN  tblemployee ON tblscheduleemployee.employeeID = tblemployee.employeeID WHERE tblscheduleemployee.employeeID = '".$employeeid."'";
               $query=$this->db->query($sql);
               return $query->result_array();
               $db->close();
      }

      
   } 
?> 