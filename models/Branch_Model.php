<?php 
   class Branch_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertbranch($data) { 
         if ($this->db->insert("tblbranch", $data)) { 
            return true; 
         } 
      } 
      // for view all client record
      public function viewbranch(){ 
        $this->db->select('*')->from('tblbranch');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

      public function selectbranch($data){ 
        $this->db->select('*')->from('tblbranch')->where(array('branchID'=> $data['branchID']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

        // for update client name
        public function updatebranch($data, $branchid) { 
         $this->db->set($data); 
         $this->db->where("branchID", $branchid); 
         $this->db->update("tblbranch"); 
      } 
        // for delete client
        public function deletebranch($branchid) { 
         if ($this->db->delete("tblbranch", "branchID = ".$branchid)) { 
            return true; 
         } 
      } 

       public function getbranchid($branchid){
        $id="not found";
        $this->db->select('branchID')->where('branchID ='.$branchid);
        $query=$this->db->get('tblbranch');
          if ($row = $query->row_array()) {
               $id=$row['branchID'];
          }
          else
          {
            $id=null;
            $this->db->close();
          }
           return $id;
        } 
      public function branchEmpty($branchid){
        $this->db->select('branchID')->where('branchID ='. $this->getbranchid($branchid));
        $query=$this->db->get('tbllocation');
         $row=$query->row_array();
          $num=$row['branchID'];

          if ($num > 0){
              $isEmpty=false;
            } 
          else{
              $isEmpty=true;
              $this->db->close();
         }
          return $isEmpty;
    
      }
  
   } 
?> 