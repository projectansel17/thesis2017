<?php 
   class Student_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertstudent($data) { 
         if ($this->db->insert("tblstudent", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
      public function viewapplicant(){ 
        $this->db->select('*')->from('tblstudent');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
         //select counts of message to admin
        public function notifyapplicant(){ 
        $this->db->select('*')->from('tblstudent')->where('unread', 1);
        $query=$this->db->get();
        return $query->num_rows();
        $db->close();
      }

       public function readapplicant($unread) { 
         $this->db->set("unread", $unread); 
         $this->db->update("tblstudent"); 
      } 

       public function updatereadapplicant($unread, $firstname, $lastname, $emailadd) { 
         $this->db->set("unread", $unread); 
         $this->db->where("firstname", $firstname); 
         $this->db->where("lastname", $lastname); 
         $this->db->where("email", $emailadd); 
         $this->db->update("tblstudent"); 
      }
       public function updatestudent($data) { 
         $this->db->set("unread", $unread); 
         $this->db->update("tblstudent"); 
      } 
       public function selectapplyapplicant($data){ 
        $this->db->select('*')->from('tblstudent')->where(array('studentid'=> $data['studentid']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

   } 
?> 