<?php 
   class User_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 
        $this->load->library('encrypt');

      } 
   
      public function insert($data) { 
         if ($this->db->insert("tbluser", $data)) { 
            return true; 
         } 
      } 
        // update status
      public function update($data, $userid) { 
         $this->db->set("status", $data); 
         $this->db->where("userID", $userid); 
         $this->db->update("tbluser"); 
      } 
        // update user accountt
        public function updateaccount($data, $userid) { 
         $this->db->set($data); 
         $this->db->where("userID", $userid); 
         $this->db->update("tbluser"); 
      } 

        //update user password
        public function updatepassword($data, $userid) { 
         $this->db->set($data); 
         $this->db->where("userID", $userid); 
         $this->db->update("tbluser"); 
      } 

        // select user
       public function select_user($userid){
        $this->db->select('*')->from('tbluser')->where(array('userID' => $userid));
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

          // for select oldpassword
       public function selectoldpassword($userid){
        $this->db->select('*')->from('tbluser')->where(array('userID' => $userid));
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

      public function login($username, $password){
        $key = $this->config->item('encryption_key');
        $salt1 = hash('sha512', $key . $password);
        $salt2 = hash('sha512', $password . $key);
        $hashed_password = hash('sha512', $salt1 . $this->input->post('password') . $salt2);
        $this->db->select('*')->from('tbluser')->where(array('username' => $username, 'password' => $hashed_password));
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
        // for user frofile
       public function userprofile($data){
        $this->db->select('*')->from('tbluser')->where(array('userID'=> $data['userID']));
        $query =$this->db->get();
        return $query->result_array();
      }

       public function usertype(){
        $this->db->select('*')->from('tbluser')->where('position', 'Administrator');
        $query =$this->db->get();
        return $query->result_array();
      }


        public function all_users(){
        $this->db->select('*')->from('tbluser');
        $query =$this->db->get();

        if ($query->num_rows() > 0){
              return $query->result_array();
        }
        else{
          return false;
        }
        $this->db->close();
      }
      public function user_password($data){
        $this->db->select('*')->from('tbluser')->where(array('username' => $data['username'], 'emailaddress' => $data['emailaddress']));
        $query = $this->db->get();

        if ($query->num_rows() > 0){
              return $query->result_array();
        }
        else{
          return false;
        }
        $this->db->close();

      }
       //update user password
        public function resetpassword($data, $username, $emailaddress) { 
         $this->db->set($data); 
         $this->db->where("username", $username); 
         $this->db->where("emailaddress", $emailaddress); 
         $this->db->update("tbluser"); 
      }  
       public function userpassword_reset($data, $updatedata, $username, $emailaddress){

        $this->db->select('*')->from('tbluser')->where(array('username' => $data['username'], 'emailaddress' => $data['emailaddress']));
        $query = $this->db->get();
         if ($query->num_rows() > 0){
              return  $this->db->where(array('username'  => $username, 'emailaddress' => $emailaddress))->update('tbluser', $updatedata);
        }
        else{
          return false;
        }
        $this->db->close();

      }      
   } 
?> 