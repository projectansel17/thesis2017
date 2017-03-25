<?php 
   class Chat_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertchat($userid, $clientid, $sendername, $message, $seton, $unread ,$unreadfrom) { 
          $sql = "INSERT into tblchat (userID, clientID, sendername, message, seton, unread, unreadfrom) VALUES ('".$this->db->escape_str($userid)."', '".$this->db->escape_str($clientid)."', '".$this->db->escape_str($sendername)."', '".$this->db->escape_str($message)."',
                  STR_TO_DATE('".$this->db->escape_str($seton)."','%Y-%m-%d %h:%i:%s %p'), '".$this->db->escape_str($unread)."', '".$this->db->escape_str($unreadfrom)."')";

         if ($this->db->query($sql) === TRUE) { 
            return true; 
         }  
      } 
      // for view all chat
      public function viewchat($userid,$clientid){ 
        $this->db->select('tblchat.message, tblchat.sendername, tblchat.userID, tblchat.clientID, DATE_FORMAT(tblchat.seton, "%Y-%m-%d %h:%i:%s %p") as seton, tbluser.username, tbluser.firstname, tbluser.lastname, tblclient.username, tblclient.firstname as clientfname , tblclient.lastname as clientlname')->from('tblchat')->join('tbluser', 'tblchat.userID = tbluser.userID', 'inner')
        ->join('tblclient', 'tblchat.clientID = tblclient.clientID', 'inner')->where('tbluser.userID', $userid)->where('tblclient.clientID', $clientid)->order_by('tblchat.seton');
          $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
      //for view all message client
      public function viewchatforclient($userid, $username){ 
        $this->db->select('tblchat.message, DATE_FORMAT(tblchat.seton, "%Y-%m-%d %r") as seton, tblclient.firstname, tblclient.clientID, tblclient.lastname, tblclient.emailaddress, tblclient.contact, tblbranch.branchname, tbllocation.locationname')->from('tblchat')
        ->join('tblclient', 'tblchat.clientID=tblclient.clientID', 'inner')->join('tbllocation', 'tblclient.locationID=tbllocation.locationID', 'inner')
        ->join('tblbranch', 'tblclient.branchID=tblbranch.branchID', 'inner')
        ->where('tblchat.userID', $userid)->where('tblchat.chatID IN (SELECT MAX(chatID) from tblchat WHERE sendername!="admin" GROUP BY clientID ORDER BY chatID DESC)');
          $query=$this->db->get();
          return $query->result_array();
        $db->close();
      }  

        //for view request client
      public function viewrequestemployee($userid,$username, $datenow){ 
        $sql = "SELECT tblchat.message, DATE_FORMAT(tblchat.seton, '%Y-%m-%d %r') as seton, tblclient.firstname, tblclient.clientID, tblclient.lastname, tblclient.emailaddress, tblclient.contact, tblbranch.branchname, tbllocation.locationname from tblchat
        INNER JOIN tblclient ON tblchat.clientID=tblclient.clientID INNER JOIN tbllocation ON tblclient.locationID=tbllocation.locationID
        INNER JOIN tblbranch ON tblclient.branchID=tblbranch.branchID where tblchat.userID = '".$userid."' AND 
        tblchat.chatID IN (SELECT MAX(chatID) from tblchat WHERE DATE_FORMAT(seton, '%Y-%m') = '".$datenow."' AND sendername!='admin' GROUP BY clientID ORDER BY chatID DESC)";
        $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }  
       public function filterrequestclient($userid ,$username, $month, $year){ 
        $sql = "SELECT tblchat.message, DATE_FORMAT(tblchat.seton, '%Y-%m-%d %r') as seton, tblclient.firstname, tblclient.clientID, tblclient.lastname, tblclient.emailaddress, tblclient.contact, tblbranch.branchname, tbllocation.locationname from tblchat
        INNER JOIN tblclient ON tblchat.clientID=tblclient.clientID INNER JOIN tbllocation ON tblclient.locationID=tbllocation.locationID
        INNER JOIN tblbranch ON tblclient.branchID=tblbranch.branchID where tblchat.userID = '".$userid."' AND 
        tblchat.chatID IN (SELECT MAX(chatID) from tblchat WHERE MONTH(seton) = '".$month."' AND YEAR(seton) = '".$year."' AND sendername!='admin' GROUP BY clientID)";
        $query=$this->db->query($sql);
          return $query->result_array();
        $db->close();
      }  


        // select for user id
      public function selectuseradmin($userid){ 
        $this->db->select('*')->from('tbluser')->where('userID', $userid);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        //select counts of message to client ->where('tblchat.userID', $userid)
        public function notificationmessage($userid){ 
        $this->db->select('*')->from('tblchat')->where('userID', $userid)->where('unread', 2);
        $query=$this->db->get();
        return $query->num_rows();
        $db->close();
      }

      //select counts of message to admin
        public function notificationmessagetoadmin($clientid){ 
        $this->db->select('*')->from('tblchat')->where('clientID', $clientid)->where('unreadfrom', 2);
        $query=$this->db->get();
        return $query->num_rows();
        $db->close();
      }


       // for update notification
        public function updatenotification($unread, $userid) { 
         $this->db->set("unread", $unread); 
         $this->db->where("userID", $userid); 
         $this->db->update("tblchat"); 
      } 

      public function updatenotificationadmin($unreadfrom, $clientid) { 
         $this->db->set("unreadfrom", $unreadfrom); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblchat"); 
      } 
  
  
   } 
?> 