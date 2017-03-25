<?php 
   class Resignation_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertregination($data) { 
         if ($this->db->insert("tblresignation", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
       // for view all  resignation
      public function view_resignation(){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblresignation.dateterminate, tblresignation.status, tblclient.username from tblresignation INNER JOIN tblapplicant ON tblresignation.applicantID = tblapplicant.applicantID INNER JOIN tblclient ON tblresignation.clientID = tblclient.clientID INNER JOIN tblbranch on tblresignation.branchID = tblbranch.branchID 
        INNER JOIN tbllocation ON tblresignation.locationID = tbllocation.locationID where tblresignation.terminateID IN (SELECT MAX(terminateID) from tblresignation GROUP BY employeeID)";
         $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }

       public function filterfeedback($year, $status){   
        $sql = "SELECT tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblbranch.branchname, tbllocation.locationname, tblresignation.dateterminate, tblresignation.status, tblclient.username from tblresignation INNER JOIN tblapplicant ON tblresignation.applicantID = tblapplicant.applicantID INNER JOIN tblclient ON tblresignation.clientID = tblclient.clientID INNER JOIN tblbranch on tblresignation.branchID = tblbranch.branchID 
        INNER JOIN tbllocation ON tblresignation.locationID = tbllocation.locationID where tblresignation.status ='".$status."' AND 
        tblresignation.terminateID IN (SELECT MAX(terminateID) from tblresignation where  YEAR(dateterminate) = '".$year."'  GROUP BY employeeID)";
         $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }

   } 
?> 