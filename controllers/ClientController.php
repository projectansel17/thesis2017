<?php 
   class ClientController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Client_Model'); 
         $this->load->model('Branch_Model');
         $this->load->model('User_Model');
         $this->load->model('Employee_Model');
         $this->load->model('Chat_Model');
         $this->load->model('Request_Model');


      } 
  
      public function client() { 
          $set_data = $this->session->userdata('userlogin'); //session data
          $data = array('userID' => $set_data['userID']
                       );       
          $records['userprofile']=$this->User_Model->userprofile($data);
          $records['locations']=$this->Client_Model->viewbranch();
          $records['clients']=$this->Client_Model->viewclient();
          $this->load->view('client', $records);
      } 
        public function request() { 
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('userID' => $set_data['userID']
                       );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['clients']=$this->Client_Model->viewclient();
       $this->load->view('request', $records);
      }  

      public function dashboard(){
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['deployapplicants']=$this->Employee_Model->view_deploy($data['clientID']);
        if  ($set_data['username']){
            $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('index-client', $records); 
        }
        else {
                $this->load->view('login');
        }
      }

       public function employeecontract(){
       date_default_timezone_set("Asia/Manila");
       $date= date("Y-m-d");
       $status = "Activate";
       $year = date("Y", strtotime($date));
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['deployapplicants']=$this->Employee_Model->view_contract($data['clientID'], $year, $status);
        
        if  ($set_data['username']){
            $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('contract', $records); 
        }
        else {
                $this->load->view('login');
        }
      }

      public function contract_reportemployee(){
       date_default_timezone_set("Asia/Manila");
       $date= date("Y-m-d");
       $status = "Activate";
       $year = date("Y", strtotime($date));
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['deployapplicants']=$this->Employee_Model->view_contract($data['clientID'], $year, $status);
        
        if  ($set_data['username']){
            $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('contractreport', $records); 
        }
        else {
                $this->load->view('login');
        }
      }
    public function filter_contactemployee(){
       $year = $this->input->post('year');
       $status = $this->input->post('status');
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array();
       $selectcontract=$this->Employee_Model->view_contract($set_data['clientID'], $year, $status);
       $data = $selectcontract;
       echo json_encode($data);

      }

     public function filter_contactemployeemonitor(){
       $year = $this->input->post('year');
       $status = $this->input->post('status');
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array();
       $selectcontract=$this->Employee_Model->view_contract($set_data['clientID'], $year, $status);
       $data = $selectcontract;
       echo json_encode($data);

      }
        //for view client detail
       public function viewclientdetail($clientid) { 

             $clientid =$this->input->get('clientid');
             $selectid=array("clientID" =>  $clientid);
             $data=array();
                $selectclient =$this->Client_Model->selectclient($selectid);
                foreach ($selectclient as $value) { 
                $data=$value;  
                echo json_encode($data);  
              
              }
            }
              // view detail department
             public function viewdepartmentdetail($branchid) { 
             $branchid =$this->input->post('branchname');
             $data=array();
                $selectbranchid =$this->Client_Model->viewdepartment($branchid); 
                $data=$selectbranchid;  
                echo json_encode($data);           
      } 


      //for add client name
      public function add_client() { 
          // for required and check properly input failed
         $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
         $this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
         $this->form_validation->set_rules('username','UserName','trim|required|xss_clean|is_unique[tblclient.username]', array('required => You have not provide %s.', 'is_unique => this %s already exists'));
         $this->form_validation->set_rules('contact','Phone Number','trim|required|xss_clean|min_length[11]|max_length[11]');
         $this->form_validation->set_rules('emailadd','Email Address','trim|required|xss_clean|valid_email|is_unique[tblclient.emailaddress]');
         $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
         $this->form_validation->set_rules('gender','gender','trim|required|xss_clean');
         $this->form_validation->set_rules('state','State','trim|required|xss_clean');
         $this->form_validation->set_rules('branchname','Branch','trim|required|xss_clean');
         $this->form_validation->set_rules('department','Department','trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');


             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             } 

          else{
                $hash = md5(uniqid(rand(), true));
                $key = $this->config->item('encryption_key');
                $salt1 = hash('sha512', $key . $this->input->post('lastname'));
                $salt2 = hash('sha512', $this->input->post('lastname') . $key);
                $hashed_password = hash('sha512', $salt1 . $this->input->post('lastname') . $salt2);
                $data = array(
                              'branchID'=> $this->input->post('branchname'),
                              'locationID'=> $this->input->post('department'), 
                              'firstname'=> $this->input->post('firstname'),
                              'lastname' => $this->input->post('lastname'),
                              'username' => $this->input->post('username'),
                              'password' => $hashed_password,
                              'emailaddress'  => $this->input->post('emailadd'),
                              'gender'    => $this->input->post('gender'),
                              'contact'   => $this->input->post('contact'),
                              'address'     => $this->input->post('address'),
                              'country'   =>  'Philippines',
                              'state' => $this->input->post('state'),
                              'position'=> 'Admin',
                              'status' => 'Activate'
                            );
                                  
                  $this->Client_Model->insertclient($data);
                  echo json_encode(array("response" => "success", "message" => "Successfully registered client", "redirect" => "ClientController/client"));

      
                }
        }

             //for update client account
     public function update_account() { 

         $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
         $this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
         $this->form_validation->set_rules('username','UserName','trim|required|xss_clean');
         $this->form_validation->set_rules('contact','Phone Number','trim|required|xss_clean|min_length[10]|max_length[10]');
         $this->form_validation->set_rules('emailadd','Email Address','trim|required|xss_clean|valid_email');
         $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
         $this->form_validation->set_rules('gender','gender','trim|required|xss_clean');
         $this->form_validation->set_rules('state','State','trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('', '');


             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             } 

          else{

                $data = array( 
                              'firstname'=> $this->input->post('firstname'),
                              'lastname' => $this->input->post('lastname'),
                              'username' => $this->input->post('username'),
                              'emailaddress'  => $this->input->post('emailadd'),
                              'gender'    => $this->input->post('gender'),
                              'contact'   => $this->input->post('contact'),
                              'address'     => $this->input->post('address'),
                              'state' => $this->input->post('state'),
                            );
                  $set_data = $this->session->userdata('userlogin');          
                  $this->Client_Model->updateclientaccount($data,$set_data['clientID']);
                  echo json_encode(array("response" => "success", "message" => "Successfully updated your account", "redirect" => "ClientController/dashboard"));
           }
      
        }   
           public function update_password(){  

         $set_data = $this->session->userdata('userlogin'); //session data
         $clientid=$set_data['clientID'];
         $this->form_validation->set_rules('oldpassword','Password','trim|required|xss_clean');      
         $this->form_validation->set_rules('newpassword','New Password','trim|required|xss_clean|min_length[8]');
         $this->form_validation->set_rules('retypepassword','Confirmation Password','trim|required|xss_clean|matches[newpassword]');

         $this->form_validation->set_error_delimiters('', '');


             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             } 
             else{

                $currentpassword=$this->input->post('oldpassword');
                $hash = md5(uniqid(rand(), true));
                $key = $this->config->item('encryption_key');
                $salt1 = hash('sha512', $key . $currentpassword);
                $salt2 = hash('sha512', $currentpassword . $key);
                $hashed_password = hash('sha512', $salt1 . $currentpassword . $salt2);
                $currentpass= $hashed_password;

                $user = $this->Client_Model->selectoldpassword($clientid);

                foreach ($user as $oldpass) {
                  if ($currentpass == $oldpass['password']){

                          $newpassword=$this->input->post('newpassword');
                          $hash = md5(uniqid(rand(), true));
                          $key = $this->config->item('encryption_key');
                          $salt1 = hash('sha512', $key . $newpassword);
                          $salt2 = hash('sha512', $newpassword . $key);
                          $hashed_password = hash('sha512', $salt1 . $newpassword . $salt2);
                          $newpass= $hashed_password;

                          $data = array( 
                              'clientID' => $set_data['clientID'], 
                              'password' => $newpass
                            );   
                       $this->Client_Model->updatepassword($data,$data['clientID']); 
                       echo json_encode(array("response" => "success", "message" => "Successfully updated your password", "redirect" => "ClientController/dashboard"));
                      } 
                  else{
                       echo json_encode(array("response" => "error", "err" =>  "Invalid input your old password"));
                      }
                  }
                }

            }
        // update status client
        public function update_status() { 

        $set_data = $this->session->userdata('userlogin'); //session data
        $userid = array('userID' => $set_data['userID']);     
        $clientid = $this->uri->segment(3);
        $data = array('clientID' => $clientid
                );
        $client = $this->Client_Model->selectclient($data);
            foreach ($client as $row){
              if ($row['status'] == "Activate"){
                    $this->Client_Model->updatestatusclient('Deactivate', $data['clientID']);
                }
              else{
                     $this->Client_Model->updatestatusclient('Activate', $data['clientID']);
                  }
                                    
               }  
                 $records['userprofile']=$this->User_Model->userprofile($userid);
                 $records['clients']=$this->Client_Model->viewclient();
                 $this->load->view('client', $records); 
           }

            // forr update client
      public function update_request(){
          $set_data = $this->session->userdata('userlogin'); //session data
          $data = array("clientID" => $this->input->post('clientid'),
                        "numberapplicant" => $this->input->post('numberofapplicant')
                        );
          $data2 = array("userID" => $set_data['userID'],
                         "clientID" => $this->input->post('clientid'),
                         "numberofrequest" => $this->input->post('numberofapplicant'),
                         "daterequest" => date("Y-m-d")
                        );
           $this->form_validation->set_rules('numberofapplicant', 'Number of applicant' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
                  $this->Client_Model->updaterequest($data, $data['clientID']); 
                  $this->Request_Model->insertrequestemployee($data2);
                  echo json_encode(array("response" => "success" , "message" => "Successfully updated request applicant", "redirect" => 'ApplicantController/request'));
           }
      }
        // for delete client
        public function delete_client() { 
         $clientid = $this->input->post('clientid'); 
         $getclientemty=$this->Client_Model->clientEmpty($clientid); 
         if (!$getclientemty){
              echo json_encode(array("response" => "error" , "err" => "This Client name has still used. please deactivate all employee before removing the Client name", "redirect" => 'ClientController/client'));

         }
         else{
         $this->Client_Model->deleteclient($clientid); 
         $data['clients']=$this->Client_Model->viewclient();
         echo json_encode(array("response" => "success" , "message" => "Successfully deleted client", "redirect" => 'ClientController/client'));
 
          }
      } 
           public function location_check($locationid){

              $branchid = $this->input->post('branchname');
              $locationid=$this->input->post('department');

              $location = $this->Client_Model->locationcheck($branchid, $locationid);

            if ($location){
                  $this->form_validation->set_message('location_check', 'The {field} is already exists');
                  return false;
                  }
            else{
                  return true;
                }
            }

         public function update_location(){

           $this->form_validation->set_rules('branchname', 'Branch' ,'trim|required|xss_clean');
           $this->form_validation->set_rules('department', 'Department and Branch' ,'callback_location_check');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
                  $data = array("clientID" => $this->input->post('clientid'),
                                "branchID" => $this->input->post('branchname'),
                                "locationID" => $this->input->post('department')
                                );
                  $this->Client_Model->updatelocation($data, $data['clientID']); 
                  echo json_encode(array("response" => "success" , "message" => "Successfully updated Department", "redirect" => 'ClientController/client'));
           }
        }

          public function logout() { 
            $this->session->unset_userdata('userlogin'); 
            $this->load->view('login'); 
          } 
   }
?>  