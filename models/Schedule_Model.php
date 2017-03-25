<?php 
   class Schedule_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertscheduleappicant($data) { 
         if ($this->db->insert("tblscheduleapplicant", $data)) { 
            return true; 
         } 
      } 
      // for view all report emport plotting schedule
       // for view all  resignation

       public function viewreportschedule($datenow){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, 
          tbluser.username, tblscheduleapplicant.purpose, tblscheduleapplicant.status, DATE_FORMAT(tblapplicant.plotschedule, '%Y-%m-%d %h:%i %p') as schedule from tblscheduleapplicant
          INNER JOIN  tblapplicant on  tblscheduleapplicant.applicantID = tblapplicant.applicantID
          INNER JOIN  tbluser ON tblscheduleapplicant.userID = tbluser.userID  WHERE DATE_FORMAT(tblapplicant.plotschedule, '%Y-%m') = '".$datenow."'
          AND tblscheduleapplicant.scheduleID IN (SELECT MAX(scheduleID) from tblscheduleapplicant GROUP BY applicantID)";
          $query=$this->db->query($sql); 
          return $query->result_array();
          $db->close();
      }

       public function filterscheduleapplicant($month, $day, $year, $purpose){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, 
          tbluser.username, tblscheduleapplicant.purpose, tblscheduleapplicant.status, DATE_FORMAT(tblapplicant.plotschedule, '%Y-%m-%d %h:%i %p') as schedule from tblscheduleapplicant
          INNER JOIN  tblapplicant on  tblscheduleapplicant.applicantID = tblapplicant.applicantID
          INNER JOIN  tbluser ON tblscheduleapplicant.userID = tbluser.userID WHERE MONTH(tblapplicant.plotschedule) = '".$month."' AND DAY(tblapplicant.plotschedule) = '".$day."'
          AND YEAR(tblapplicant.plotschedule) = '".$year."' 
          AND tblscheduleapplicant.scheduleID IN (SELECT MAX(scheduleID) from tblscheduleapplicant WHERE  purpose = '".$purpose."' GROUP BY applicantID)";
          $query=$this->db->query($sql); 
          return $query->result_array();
          $db->close();
      }
      public function filterscheduleapplicantforview($month, $year, $purpose){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, 
          tbluser.username, tblscheduleapplicant.purpose, tblscheduleapplicant.status, DATE_FORMAT(tblapplicant.plotschedule, '%Y-%m-%d %h:%i %p') as schedule from tblscheduleapplicant
          INNER JOIN  tblapplicant on  tblscheduleapplicant.applicantID = tblapplicant.applicantID
          INNER JOIN  tbluser ON tblscheduleapplicant.userID = tbluser.userID WHERE MONTH(tblapplicant.plotschedule) = '".$month."'
          AND YEAR(tblapplicant.plotschedule) = '".$year."' 
          AND tblscheduleapplicant.scheduleID IN (SELECT MAX(scheduleID) from tblscheduleapplicant WHERE  purpose = '".$purpose."' GROUP BY applicantID)";
          $query=$this->db->query($sql); 
          return $query->result_array();
          $db->close();
      }
   } 
?> 