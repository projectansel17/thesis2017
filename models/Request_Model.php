<?php 
   class Request_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertrequestemployee($data) { 
         if ($this->db->insert("tblrequestemployee", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
      //for view request client
      public function viewrequestemployee($userid,$datenow){ 
        $sql = "SELECT tblclient.firstname, tblclient.clientID, tblclient.lastname, tblclient.emailaddress, tblclient.contact, tblbranch.branchname, tbllocation.locationname, tblrequestemployee.numberofrequest,tblrequestemployee.daterequest from tblrequestemployee
        INNER JOIN tblclient ON tblrequestemployee.clientID=tblclient.clientID INNER JOIN tbllocation ON tblclient.locationID=tbllocation.locationID
        INNER JOIN tbluser ON tblrequestemployee.userID = tbluser.userid
        INNER JOIN tblbranch ON tblclient.branchID=tblbranch.branchID where tbluser.userID = '".$userid."' AND 
        tblrequestemployee.requestID IN (SELECT MAX(requestID) from tblrequestemployee WHERE DATE_FORMAT(daterequest, '%Y-%m') = '".$datenow."' GROUP BY clientID)";
        $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }  
       public function filterrequestclient($userid, $month, $year){ 
        $sql = "SELECT tblclient.firstname, tblclient.clientID, tblclient.lastname, tblclient.emailaddress, tblclient.contact, tblbranch.branchname, tbllocation.locationname, tblrequestemployee.numberofrequest,tblrequestemployee.daterequest from tblrequestemployee
        INNER JOIN tblclient ON tblrequestemployee.clientID=tblclient.clientID INNER JOIN tbllocation ON tblclient.locationID=tbllocation.locationID
        INNER JOIN tbluser ON tblrequestemployee.userID = tbluser.userid
        INNER JOIN tblbranch ON tblclient.branchID=tblbranch.branchID where tbluser.userID = '".$userid."' AND 
        tblrequestemployee.requestID IN (SELECT MAX(requestID) from tblrequestemployee WHERE MONTH(daterequest) = '".$month."' AND YEAR(daterequest) = '".$year."' GROUP BY clientID)";
        $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }  
   } 
?> 