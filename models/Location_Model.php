<?php 
   class Location_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertlocation($data) { 
         if ($this->db->insert("tbllocation", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
      public function viewlocation(){ 
        $this->db->select('a.*, b.branchname')->from('tbllocation as a')->join('tblbranch as b', 'a.branchID = b.branchID', 'inner');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

        // for view department name
      public function selectlocation($data){ 
        $this->db->select('*')->from('tbllocation')->where(array('locationID'=> $data['locationID']));;
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        // for update client name
        public function updatelocation($data, $locationid) { 
         $this->db->set($data); 
         $this->db->where("locationID", $locationid); 
         $this->db->update("tbllocation"); 
      } 
          // for delete location
        public function deletelocation($locationid) { 
         if ($this->db->delete("tbllocation", "locationID = ".$locationid)) { 
            return true; 
         } 
      }

      public function getlocationid($locationid){
        $id="not found";
        $this->db->select('locationID')->where('locationID ='.$locationid);
        $query=$this->db->get('tbllocation');
          if ($row = $query->row_array()) {
               $id=$row['locationID'];
          }
          else
          {
            $id=null;
            $this->db->close();
          }
           return $id;
        } 
      public function locationEmpty($locationid){
        $this->db->select('locationID')->where('locationID ='. $this->getlocationid($locationid));
        $query=$this->db->get('tblclient');
         $row=$query->row_array();
          $num=$row['locationID'];

          if ($num > 0){
              $isEmpty=false;
            } 
          else{
              $isEmpty=true;
              $this->db->close();
         }
          return $isEmpty;
    
      }

      public function locationcheck($locationname, $branchid){

        $this->db->select('*')->from('tbllocation')->where(array('locationname' => $locationname, 'branchID' => $branchid));
        $query=$this->db->get();

        if ($query->num_rows() == 1)
        {
            return true;
        }
        else{
            return false;
        }
        $this->db->close();

      }
   } 
?> 