<?php 
   class Client_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertclient($data) { 
         if ($this->db->insert("tblclient", $data)) { 
            return true; 
         } 
      } 

      // for client frofile
       public function clientprofile($data){
        $this->db->select('*')->from('tblclient')->where(array('clientID'=> $data['clientID']));
        $query =$this->db->get();
        return $query->result_array();
      }

          // update client accountt
        public function updateclientaccount($data, $clientid) { 
         $this->db->set($data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 

      //update client password
        public function updatepassword($data, $clientid) { 
         $this->db->set($data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 

      public function selectoldpassword($clientid){
        $this->db->select('*')->from('tblclient')->where(array('clientID' => $clientid));
        $query=$this->db->get();
        if ($query->num_rows() == 1)
        {
            return $query->result_array();
        }
        else{
            return false;
        }
        $this->db->close();
      }

      // for view all client record
      public function viewclient(){ 
        $this->db->select('c.*, b.branchname, l.locationname ')->from('tblclient as c')->join('tblbranch as b', 'c.branchID =b.branchID', 'inner')
        ->join('tbllocation as l', 'c.locationID= l.locationID', 'inner')->join('tblbranch as p', 'l.branchID = p.branchID');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

      public function viewbranch(){ 
        $this->db->select('a.*, b.branchname')->from('tbllocation as a')->join('tblbranch as b', 'a.branchID = b.branchID', 'inner')->group_by('b.branchID');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }


      // for view department
      public function viewdepartment($branchid){ 
        $this->db->select('a.*, b.branchname')->from('tbllocation as a')->join('tblbranch as b', 'a.branchID = b.branchID', 'inner')->where('a.branchID = '.$branchid);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
      //login client
      public function login($username, $password){
        $key = $this->config->item('encryption_key');
        $salt1 = hash('sha512', $key . $password);
        $salt2 = hash('sha512', $password . $key);
        $hashed_password = hash('sha512', $salt1 . $this->input->post('password') . $salt2);
        $this->db->select('*')->from('tblclient')->where(array('username' => $username, 'password' => $hashed_password));
        $query=$this->db->get();

        if ($query->num_rows() == 1)
        {
            return $query->result();
        }
        else{
            return false;
        }
        $this->db->close();

      }


      public function selectclient($data){ 
        $this->db->select('*')->from('tblclient')->where(array('clientID'=> $data['clientID']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

        // update status client
      public function updatestatusclient($data, $clientid) { 
         $this->db->set("status", $data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 


        // for update client name
        public function updateclient($data, $clientid) { 
         $this->db->set($data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 
        //update location for employee 
        public function updatelocation($data, $clientid) { 
         $this->db->set($data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 

        public function locationcheck($branchid, $locationid){

        $this->db->select('*')->from('tblclient')->where(array('branchID' => $branchid, 'locationID' => $locationid));
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
          // for update request
         public function updaterequest($data, $clientid) { 
         $this->db->set($data); 
         $this->db->where("clientID", $clientid); 
         $this->db->update("tblclient"); 
      } 
        // for delete client
        public function deleteclient($clientid) { 
         if ($this->db->delete("tblclient", "clientID = ".$clientid)) { 
            return true; 
         } 
      } 

       public function getclientid($clientid){
        $this->db->select('clientID')->where('clientID = '.$clientid);
        $query=$this->db->get('tblclient');
          if ($row = $query->row_array()) {
               $id=$row['clientID'];
          }
          else
          {
            $id=null;
            $db->close();
          }
           return $id;
        } 
      public function clientEmpty($clientid){
        $this->db->select('clientID')->where('clientID ='. $this->getclientid($clientid));
        $query=$this->db->get('tblemployee');
         $row=$query->row_array();
          $num=$row['clientID'];

          if ($num > 0){
              $isEmpty=false;
            } 
          else{
              $isEmpty=true;
              $this->db->close();
         }
          return $isEmpty;
    
      }

       public function client_password($data){
        $this->db->select('*')->from('tblclient')->where(array('username' => $data['username'], 'emailaddress' => $data['emailaddress']));
        $query = $this->db->get();

        if ($query->num_rows() > 0){
              return $query->result_array();
        }
        else{
          return false;
        }
        $this->db->close();

      }
           public function clientpassword_reset($data, $updatedata, $username, $emailaddress){

        $this->db->select('*')->from('tblclient')->where(array('username' => $data['username'], 'emailaddress' => $data['emailaddress']));
        $query = $this->db->get();
         if ($query->num_rows() > 0){
              return  $this->db->where(array('username'  => $username, 'emailaddress' => $emailaddress))->update('tblclient', $updatedata);
        }
        else{
          return false;
        }
        $this->db->close();

      }      

       public function viewcontractemployee($clientid, $employeeid){    
        $sql= "SELECT em.*, ap.firstname, ap.lastname, u.firstname as ufname, u.lastname as ulname, l.locationname, b.branchname, c.firstname as fname, c.lastname as lname FROM tblemployee as em 
        INNER JOIN tblapplicant as ap ON em.applicantID = ap.applicantID
        INNER JOIN tblclient as c ON em.branchID = c.branchID AND  em.locationID = c.locationID
        INNER JOIN tbllocation as l ON c.locationID= l.locationID
        INNER JOIN tblbranch as b ON c.branchID= b.branchID
        INNER JOIN tbluser as u ON em.userID= u.userID
        WHERE  c.clientID ='".$clientid."' AND em.employeeID ='".$employeeid."' ";
         $query=$this->db->query($sql);
         return $query->result_array();
         $db->close();
      }  
  
   } 
?> 