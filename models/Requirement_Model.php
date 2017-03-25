<?php 
   class Requirement_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertrequirement($data) { 
         if ($this->db->insert("tblrequirement", $data)) { 
            return true; 
         } 
      } 

        // for view all location record
      public function viewrequirement(){ 
        $this->db->select('*')->from('tblrequirement');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

      // for view all location record
      public function viewlocation(){ 
        $this->db->select('a.*, b.branchname')->from('tbllocation as a')->join('tblbranch as b', 'a.branchID = b.branchID', 'inner');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

        // for view requirement name
      public function selectrequirement($data){ 
        $this->db->select('*')->from('tblrequirement')->where(array('requirementID'=> $data['requirementID']));;
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        // for update requirement
        public function updaterequirement($data, $requirementid) { 
         $this->db->set($data); 
         $this->db->where("requirementID", $requirementid); 
         $this->db->update("tblrequirement"); 
      } 
          // for delete requiremenr
        public function deleterequirement($requirementid) { 
         if ($this->db->delete("tblrequirement", "requirementID = ".$requirementid)) { 
            return true; 
         } 
      }
   } 
?> 