<?php 
   class UserController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('User_Model');
         $this->load->model('Applicant_Model');
         $this->load->model('Employee_Model');
         $this->load->model('Client_Model');
         $this->load->model('Requirement_Model');
         $this->load->model('ApplicantRequirement_Model');
      } 
  
      public function index() {   
         $this->load->view('login');
      } 
         public function login() {   
         $this->load->view('login');
      } 
        
        //for add user member
      public function add_user() { 
          // for required and check properly input failed
         $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
         $this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
         $this->form_validation->set_rules('username','UserName','trim|required|xss_clean|is_unique[tbluser.username]', array('required => You have not provide %s.', 'is_unique => this %s already exists'));
         $this->form_validation->set_rules('contact','Phone Number','trim|required|xss_clean|min_length[11]|max_length[11]');
         $this->form_validation->set_rules('emailadd','Email Address','trim|required|xss_clean|valid_email|is_unique[tbluser.emailaddress]');
         $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
         $this->form_validation->set_rules('gender','gender','trim|required|xss_clean');
         $this->form_validation->set_rules('state','State','trim|required|xss_clean');
         $this->form_validation->set_rules('type','Position','trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');

             if ($this->form_validation->run() == FALSE){                                  
                   //catch to the errors
                  echo json_encode(array("response" => "error", "validate_errors" => validation_errors()));
             } 
          else{
                $hash = md5(uniqid(rand(), true));
                $key = $this->config->item('encryption_key');
                $salt1 = hash('sha512', $key . $this->input->post('lastname'));
                $salt2 = hash('sha512', $this->input->post('lastname') . $key);
                $hashed_password = hash('sha512', $salt1 . $this->input->post('lastname') . $salt2);
                $data = array( 
                              'firstname'=> $this->input->post('firstname'),
                              'lastname' => $this->input->post('lastname'),
                              'username' => $this->input->post('username'),
                              'password' => $hashed_password,
                              'emailaddress'  => $this->input->post('emailadd'),
                              'gender'    => $this->input->post('gender'),
                              'contact'   => $this->input->post('contact'),
                              'address'   => $this->input->post('address'),
                              'country'   => 'Philippines',
                              'state' => $this->input->post('state'),
                              'position'=> $this->input->post('type'),
                              'status' => 'Activate'
                            );
                                  
                  $this->User_Model->insert($data);
                  echo json_encode(array("response" => "success", "message" => "Successfully registered user", "redirect" => "UserController/users"));
                }

             }
     // for homepage view
      public function dashboard(){
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('userID' => $set_data['userID']
                       );
        
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['viewemployee']=$this->Employee_Model->viewemployee();
        if  ($set_data['position'] == "Administrator"){
             $this->load->view('homepage', $records); 
        }
       else if  ($set_data['position'] == "Staff"){
                $records['applicantplot']=$this->Applicant_Model->viewplotapplicant();
                $records['contractemployee']=$this->Applicant_Model->selectcontract();
                $records['requirements']=$this->Requirement_Model->viewrequirement();
                $records['locations']=$this->Client_Model->viewbranch();
                $records['applicantrequirements']=$this->Requirement_Model->viewrequirement();
                $this->load->view('index-hr', $records); 
        }
        else {
                $this->load->view('login');
        }
      }
      // for user view
      public function users(){

       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('userID' => $set_data['userID']
                       );
        
          $records['userprofile']=$this->User_Model->userprofile($data);
          $records['users']=$this->User_Model->all_users();
          $this->load->view('users', $records);
      }


      //for login user
       public function login_user(){

         $this->form_validation->set_rules('username','UserName','trim|required');
         $this->form_validation->set_rules('password','Password','trim|required');
         $this->form_validation->set_error_delimiters('', '');


             if ($this->form_validation->run() == FALSE){
 
                  echo json_encode(array("response" => "error", "message" => validation_errors()));

             } 

             else{

                  $username =strtolower($this->input->post('username'));
                  $password = $this->input->post('password');
                  $user=$this->User_Model->login($username, $password);
                  $clientuser=$this->Client_Model->login($username, $password);
                  if ($user){
                      foreach ($user as  $result) {
                      $sessiondata=array('username' => ucfirst($result->username),
                                          'userID' => $result->userID,
                                          'position' => $result->position,
                                          'firstname' => $result->firstname,
                                          'lastname' => $result->lastname,
                                          'emailaddress' =>$result->emailaddress
                                    );    
                       $this->session->set_userdata('userlogin',$sessiondata);            
                        if ($result->position == "Administrator"){
                             if ($result->status == "Activate"){
                                echo json_encode(array("response" => "success", "message" => "Welcome '".ucfirst($result->username)."'", "redirect" => "UserController/dashboard"));
                                 }
                             else{
                                 echo json_encode(array("response" => "error", "message" => "Account has been disable please contact the Administrator"));
                              }
                            }
                            else if ($result->position == "Staff"){
                                   if ($result->status == "Activate"){

                                    echo json_encode(array("response" => "success", "message" => "Welcome '".ucfirst($result->username)."'", "redirect" => "UserController/dashboard"));

                                    }
                                   else   
                                    echo json_encode(array("response" => "error", "message" => "Account has been disable please contact the Administrator"));
                                    }
                                }
                              }
                               else if ($clientuser){
                                    foreach ($clientuser as  $result) {
                                        $sessiondata=array('username' => ucfirst($result->username),
                                                           'clientID' => $result->clientID,
                                                           'firstname' => $result->firstname,
                                                           'lastname' => $result->lastname
                                                               );    
                                        $this->session->set_userdata('userlogin',$sessiondata);   
                                 if ($result->status == "Activate"){
                                       echo json_encode(array("response" => "success", "message" => "Welcome '".ucfirst($result->username)."'", "redirect" => "ClientController/dashboard"));
                                     }
                                 else{
                                       echo json_encode(array("response" => "error", "message" => "Account has been disable please contact the Administrator"));
                                     }
                                } 
                             }      
                                
                            else{
                                 echo json_encode(array("response" => "error", "message" => "Invalid your username and password", "redirect" => "home"));
                                }
                             }
                          }

  
      //update user status
      public function update_status() { 
        $userID = $this->uri->segment(3);
        $data = array('userID' => $userID
                );
        $user = $this->User_Model->select_user($userID);
            foreach ($user as $row){
              if ($row['status'] == "Activate"){
                    $this->User_Model->update('Deactivate', $data['userID']);
                }
              else{
                     $this->User_Model->update('Activate', $data['userID']);
                  }
                                    
               }  
             $data['users']=$this->User_Model->all_users();
             $this->load->view('users', $data); 
           }

     //for update user account
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
                              'position'=> $this->input->post('type')
                            );
                  $set_data = $this->session->userdata('userlogin');          
                  $this->User_Model->updateaccount($data,$set_data['userID']);
                  echo json_encode(array("response" => "success", "message" => "Successfully updated your account", "redirect" => "UserController/dashboard"));
           }
      
        }   
             
          //for update password user
      public function update_password(){  

         $set_data = $this->session->userdata('userlogin'); //session data
         $userid=$set_data['userID'];
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

                $user = $this->User_Model->selectoldpassword($userid);

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
                              'userID' => $set_data['userID'], 
                              'password' => $newpass
                            );   
                       $this->User_Model->updatepassword($data,$data['userID']); 
                       echo json_encode(array("response" => "success", "message" => "Successfully updated your password", "redirect" => "UserController/dashboard"));
                      } 
                  else{
                       echo json_encode(array("response" => "error", "err" =>  "Invalid input your old password"));
                      }
                  }
                }

            }
        public function forgot_password(){
          $this->form_validation->set_rules('username','UserName', 'trim|required|xss_clean');
          $this->form_validation->set_rules('emailaddress', 'Email Address', 'trim|required|xss_clean|valid_email');
          $this->form_validation->set_error_delimiters('', '');

            $config = array(
              'protocol' => 'smtp',
              'smtp_host' => 'ssl://smtp.gmail.com',
              'smtp_port' => 465,
              'smtp_user' => 'tekton2017@gmail.com ', // change it to yours
              'smtp_pass' => 'thesispamore17', // change it to yours
              'mailtype' => 'html',
              'charset' => 'UTF-8',
              'wordwrap' => TRUE
             ); 

          $data = array('username' => strtolower($this->input->post('username')),
                        'emailaddress' => $this->input->post('emailaddress')
                             );
          $user = $this->User_Model->user_password($data); 
          $client = $this->Client_Model->client_password($data); 

          if ($this->form_validation->run() == FALSE){
              echo json_encode(array("response" => "error", "message" => validation_errors()));
          }

          else if ($user){

                    $subject = 'Activate Your Email';
                    $headers = "tekton2017@gmail.com";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $url= base_url("UserController/resetuser_password/".urlencode($data['username'])."/".urlencode($data['emailaddress'])."");
                    $message =  '<h1>Forgot Password</h1>';
                    $message .= '<p>Your Username: '. $data['username'] .'</p>';
                    $message .= '<p>Your Email address: '. $data['emailaddress'] .'</p>';
                    $message .= '<p>This Username '. $data['username'] .' was trying to reset your password</p>';
                    $message .= '<p>Click this link to reset your password <a href="'.$url.'">Click Here</a></p>';              
                     $this->load->library('email',$config);


                      $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($data['emailaddress']);
                      $this->email->subject($subject)->set_mailtype('html'); 
                      $this->email->message($message); 
   
         //Send mail 
                if($this->email->send()){
                     echo json_encode(array("response" => "success", "message" => "A reset password has been sent"));
                  }
                else{ 
                      echo json_encode(array("response" => "errorsend", "message" => "Failure: Email was not sent"));
                    }
                  }  
                else if ($client){
                    $subject = 'Activate Your Email';
                    $headers = "tekton2017@gmail.com";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $url= base_url("UserController/resetclient_password/".urlencode($data['username'])."/".urlencode($data['emailaddress'])."");
                    $message =  '<h1>Forgot Password</h1>';
                    $message .= '<p>Your Username: '. $data['username'] .'</p>';
                    $message .= '<p>Your Email address: '. $data['emailaddress'] .'</p>';
                    $message .= '<p>This Username '. $data['username'] .' was trying to reset your password</p>';
                    $message .= '<p>Click this link to reset your password <a href="'.$url.'">Click Here</a></p>';

                 
                       $this->load->library('email', $config);


                      $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($data['emailaddress']);
                      $this->email->subject($subject)->set_mailtype('html'); 
                      $this->email->message($message); 
   
         //Send mail 
                if($this->email->send()){
                     echo json_encode(array("response" => "success", "message" => "A reset password has been sent", "redirect" => "UserController/index"));
                  }
                else{ 
                      echo json_encode(array("response" => "errorsend", "message" => "Failure: Email was not sent"));
                    }
                }
                else{
                  echo json_encode(array("response" => "errorsend", "message" => "Your Username or Email address  doesnt Exist."));

                }
              }
//for user reset password
          public function resetuser_password(){
          
            $records['data'] =array('username' => utf8_decode(urldecode(strtolower($this->uri->segment(3)))),
                                    'emailaddress' => utf8_decode(urldecode(strtolower($this->uri->segment(4))))                              
                                   );
              $this->load->view('resetpassword', $records);

        }
    //for client reset password
         public function resetclient_password(){
            
            $records['data'] =array('username' => utf8_decode(urldecode(strtolower($this->uri->segment(3)))),
                                    'emailaddress' => utf8_decode(urldecode(strtolower($this->uri->segment(4))))                              
                                   );
              $this->load->view('resetpassword', $records);

        }
   public function updateuser_password() { 
          $this->form_validation->set_rules('password','Password', 'trim|required|xss_clean|min_length[8]');
          $this->form_validation->set_rules('retypepass', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

          if ($this->form_validation->run() == FALSE){
              echo json_encode(array("response" => "error", "message" => validation_errors()));
          }
          else{
                $key = $this->config->item('encryption_key');
                $salt1 = hash('sha512', $key . $this->input->post('password'));
                $salt2 = hash('sha512', $this->input->post('password'). $key);
                $hashed_password = hash('sha512', $salt1 . $this->input->post('password') . $salt2);

                $data = array('username' => $this->input->post('username'),
                              'emailaddress' => $this->input->post('emailaddress')
                              );
                $updatedata =array('password' => $hashed_password
                                );
           $user = $this->User_Model->userpassword_reset($data, $updatedata, $data['username'], $data['emailaddress']);
           $client = $this->Client_Model->clientpassword_reset($data, $updatedata, $data['username'], $data['emailaddress']);

           if ($user){
                echo json_encode(array("response" => "success", "message" => "Password has been changed. <a href='".base_url()."UserController/login'>Click here to Login</a>"));

           }
           else if ($client){
                echo json_encode(array("response" => "success", "message" => "Password has been changed. <a href='".base_url()."UserController/login'>Click here to Login</a>"));
           }
           else{
              echo json_encode(array("response" => "error", "message" => "Password could not be reset"));
           }

        }
      }

         public function logout() { 
            $this->session->unset_userdata('userlogin'); 
            $this->load->view('login'); 
          } 

   } 
?>  