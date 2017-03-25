<?php 
   class ExtendEmployee_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertextendemployee($data) { 
         if ($this->db->insert("tblextendemployee", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
       // for view all  resignation
      public function view_extendemployee($year){   
        $sql= "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblextendemployee.dateextend, tbluser.username from tblextendemployee
        INNER JOIN  tblapplicant ON tblextendemployee.applicantID = tblapplicant.applicantID
        INNER JOIN  tblbranch ON tblextendemployee.branchID = tblbranch.branchID
        INNER JOIN  tbluser ON tblextendemployee.userID = tbluser.userID
        INNER JOIN tbllocation ON tblextendemployee.locationID = tbllocation.locationID where tblextendemployee.extendID IN (SELECT MAX(extendID) from tblextendemployee WHERE YEAR(dateextend)='".$year."'  GROUP BY applicantID)";
         $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }

      
   } 
?> 