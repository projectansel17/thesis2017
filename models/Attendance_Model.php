<?php 
   class Attendance_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert attendance
      public function insertattendance($employeeid ,$clientid, $applicantid, $d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $d13, $d14, $d15, $d16,
                                       $d17, $d18, $d19, $d20, $d21, $d22, $d23, $d24, $d25, $d26, $d27, $d28, $d29, $d30, $d31, $oldateschedule, $dateschedule, $oldintime, $oldoutime, $intime, $outime, $oldayoff, $dayoff){ 

        $sql="INSERT INTO tblattendance (employeeID, clientID, applicantID, day1, day2, day3, day4, day5, day6, day7, day8, day9, day10, day11, day12, day13, day14, day15, day16, day17, day18, day19, day20, day21, day22, day23, day24, day25, day26, day27, day28, day29, day30, day31, olddateschedule, dateschedule, oldintime, oldouttime, intime, outtime, olddayoff, dayoff) 
        VALUES ('".$this->db->escape_str($employeeid)."', '".$this->db->escape_str($clientid)."', '".$this->db->escape_str($applicantid)."', '".$this->db->escape_str($d1)."', '".$this->db->escape_str($d2)."', '".$this->db->escape_str($d3)."', '".$this->db->escape_str($d4)."', '".$this->db->escape_str($d5)."',
          '".$this->db->escape_str($d6)."', '".$this->db->escape_str($d7)."', '".$this->db->escape_str($d8)."', '".$this->db->escape_str($d9)."', '".$this->db->escape_str($d10)."', '".$this->db->escape_str($d11)."', '".$this->db->escape_str($d12)."', '".$this->db->escape_str($d13)."',
          '".$this->db->escape_str($d14)."', '".$this->db->escape_str($d15)."', '".$this->db->escape_str($d16)."', '".$this->db->escape_str($d17)."', '".$this->db->escape_str($d18)."', '".$this->db->escape_str($d19)."', '".$this->db->escape_str($d20)."', '".$this->db->escape_str($d21)."',
          '".$this->db->escape_str($d22)."', '".$this->db->escape_str($d23)."', '".$this->db->escape_str($d24)."', '".$this->db->escape_str($d25)."', '".$this->db->escape_str($d26)."', '".$this->db->escape_str($d27)."', '".$this->db->escape_str($d28)."', '".$this->db->escape_str($d29)."', '".$this->db->escape_str($d30)."', 
          '".$this->db->escape_str($d31)."', '".$this->db->escape_str($oldateschedule)."', '".$this->db->escape_str($dateschedule)."', '".$this->db->escape_str($oldintime)."','".$this->db->escape_str($oldoutime)."', '".$this->db->escape_str($intime)."', '".$this->db->escape_str($outime)."', '".$this->db->escape_str($oldayoff)."', '".$this->db->escape_str($dayoff)."')";         
         if ($this->db->query($sql)) { 
            return true; 
         } 
      } 
     // for update attendance
      public function updateatendance($d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $d13, $d14, $d15, $d16,
                                       $d17, $d18, $d19, $d20, $d21, $d22, $d23, $d24, $d25, $d26, $d27, $d28, $d29, $d30, $d31, $dateschedule, $intime, $outime, $dayoff, $attendanceid){ 

        $sql=" UPDATE  tblattendance SET  day1 = '".$this->db->escape_str($d1)."', day2 = '".$this->db->escape_str($d2)."', day3 = '".$this->db->escape_str($d3)."', day4 = '".$this->db->escape_str($d4)."', day5 = '".$this->db->escape_str($d5)."',
         day6 = '".$this->db->escape_str($d6)."', day7 = '".$this->db->escape_str($d7)."', day8 = '".$this->db->escape_str($d8)."', day9 = '".$this->db->escape_str($d9)."', day10 ='".$this->db->escape_str($d10)."', day11 = '".$this->db->escape_str($d11)."', day12 = '".$this->db->escape_str($d12)."', day13 = '".$this->db->escape_str($d13)."',
         day14 = '".$this->db->escape_str($d14)."', day15 = '".$this->db->escape_str($d15)."', day16 = '".$this->db->escape_str($d16)."', day17 = '".$this->db->escape_str($d17)."', day18 = '".$this->db->escape_str($d18)."', day19 = '".$this->db->escape_str($d19)."', day20 = '".$this->db->escape_str($d20)."', day21 = '".$this->db->escape_str($d21)."',
         day22 = '".$this->db->escape_str($d22)."', day23 = '".$this->db->escape_str($d23)."', day24 = '".$this->db->escape_str($d24)."', day25 = '".$this->db->escape_str($d25)."', day26 = '".$this->db->escape_str($d26)."', day27 = '".$this->db->escape_str($d27)."', day28 ='".$this->db->escape_str($d28)."', day29 = '".$this->db->escape_str($d29)."', day30 ='".$this->db->escape_str($d30)."', 
         day31 = '".$this->db->escape_str($d31)."', dateschedule = '".$this->db->escape_str($dateschedule)."', intime = '".$this->db->escape_str($intime)."', outtime = '".$this->db->escape_str($outime)."', dayoff = '".$this->db->escape_str($dayoff)."' where  attendanceID = '".$this->db->escape_str($attendanceid)."'";         
         if ($this->db->query($sql)) { 
            return true; 
         } 
      } 

      public function viewattendanceemployee($clientid, $datenow){    
        $sql= "SELECT a.*, e.firstname, e.lastname, em.dateremain, em.dayoff FROM tblattendance as a INNER JOIN tblapplicant as e ON a.applicantID = e.applicantID
        INNER JOIN tblemployee as em ON a.employeeID = em.employeeID INNER JOIN tblclient as c ON  a.clientID = c.clientID where c.clientID ='".$clientid."' AND
        DATE_FORMAT(a.olddateschedule, '%Y-%m')= '".$datenow."' AND a.attendanceID IN (SELECT MAX(attendanceID) from tblattendance  GROUP BY applicantID)";
         $query=$this->db->query($sql);
         return $query->result_array();
         $db->close();
      }

       public function viewreport_attendanceemployee($clientid, $employeeid){    
        $sql= "SELECT a.*, ap.firstname, ap.lastname, em.datestart, em.datecontract, l.locationname, b.branchname, c.username FROM tblattendance as a 
        INNER JOIN tblapplicant as ap ON a.applicantID = ap.applicantID
        INNER JOIN tblemployee as em ON a.employeeID = em.employeeID 
        INNER JOIN tblclient as c ON  a.clientID = c.clientID
        INNER JOIN tbllocation as l ON c.locationID= l.locationID
        INNER JOIN tblbranch as b ON c.branchID= b.branchID
        WHERE  c.clientID ='".$clientid."' AND em.employeeID ='".$employeeid."' ";
         $query=$this->db->query($sql);
         return $query->result_array();
         $db->close();
      }


     public function filterattendance($clientid, $month, $year){ 
      $sql= "SELECT a.*, e.firstname, e.lastname, MONTH(a.dateschedule) as month, YEAR(a.dateschedule) as year FROM tblattendance as a INNER JOIN tblapplicant as e ON a.applicantID = e.applicantID
            INNER JOIN tblemployee as em ON a.employeeID = em.employeeID INNER JOIN tblclient as c ON  a.clientID = c.clientID where c.clientID ='".$clientid."' AND
            MONTH(a.olddateschedule)= '".$month."' AND YEAR(a.olddateschedule)= '".$year."' AND a.attendanceID IN (SELECT MAX(attendanceID) from tblattendance  GROUP BY applicantID)";
            $query=$this->db->query($sql);
            return $query->result_array();          
             $db->close();
      }


      public function selectattendanceemployee($attendanceid){ 
        $this->db->select('a.*, e.firstname, e.lastname, em.employeeID, c.clientID, e.applicantID')->from('tblattendance as a')
        ->join('tblapplicant as e', 'a.applicantID = e.applicantID', 'inner')
        ->join('tblemployee as em', 'a.employeeID = em.employeeID', 'inner')
        ->join('tblclient as c', 'a.clientID = c.clientID', 'inner')->where('a.attendanceID', $attendanceid);
         $query=$this->db->get();
         return $query->result_array();
         $db->close();
      }
      public function scheduleattendance($data, $attendanceid) { 
           $this->db->set($data);   
           $this->db->where("attendanceID", $attendanceid); 
           $this->db->update("tblattendance"); 
      } 

        public function viewallatendance(){
          $this->db->select('*')->from('tblattendance');
          $query =$this->db->get();

         if ($query->num_rows() > 0){
                return $query->result_array();
          }
          else{
            return false;
          }
         $this->db->close();
      }
       

   } 
?> 