<?php 
   class ApplicantController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Applicant_Model');
         $this->load->model('Client_Model');
         $this->load->model('Employee_Model');
         $this->load->model('Location_Model');
         $this->load->model('User_Model');
         $this->load->model('Chat_Model');
         $this->load->model('ApplicantRequirement_Model');
         $this->load->model('ExtendEmployee_Model');
         $this->load->model('Schedule_Model');
         $this->load->model('Student_Model');
         $this->load->model('Request_Model');
      } 
  
      public function index() {    
          $this->load->view('index-hr');
      } 

     public function viewplotapplicantadmin() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['applicantplot']=$this->Applicant_Model->viewplotapplicant();
       $this->load->view('plotapplicant', $records);
      }  
      public function view_extend() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['deployemployee']=$this->Employee_Model->viewallcontract();
       $this->load->view('extendemployee', $records);
      }  
       public function request() { 
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('userID' => $set_data['userID']
                       );
       $this->Chat_Model->updatenotification(0, $data['userID']);
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['clients']=$this->Client_Model->viewclient();
       $records['clientmessages']=$this->Chat_Model->viewchatforclient($data["userID"], strtolower($set_data['username']));
       $records['locations']=$this->Location_Model->viewlocation();
       $this->load->view('requestclient', $records);
       
      }
      public function view_requestclient() { 
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month;
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );
       $this->Chat_Model->updatenotification(0, $data['userID']);
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['clients']=$this->Client_Model->viewclient();
       $records['username'] = strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
       $records['reportrequest']=$this->Request_Model->viewrequestemployee($data["userID"],$datenow);
       $records['locations']=$this->Location_Model->viewlocation();
       $this->load->view('reportrequestclient', $records);
       
      }  
        //for add applicant plot
      public function add_applicantplot() { 
          // for required and check properly input failed
         $this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
         $this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
         $this->form_validation->set_rules('contact','Phone Number','trim|required|regex_match[/^[0-9]{11}$/]|xss_clean|min_length[11]|max_length[11]');
         $this->form_validation->set_rules('emailadd','Email Address','trim|required|xss_clean|valid_email');
         $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
         $this->form_validation->set_rules('schedule', 'Schedule Incoming', 'trim|required|xss_clean');
         $this->form_validation->set_rules('purpose', 'purpose required', 'trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');

             if ($this->form_validation->run() == FALSE){              
                        //catch to the  errors
                echo json_encode(array("response" => "error", "err" => validation_errors()));
             } 

          else{

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

               $set_data=$this->session->userdata('userlogin');
               $userid=$set_data['userID'];
               $fname = $this->input->post('firstname');
               $lname = $this->input->post('lastname');
               $contact = $this->input->post('contact');
               $emailadd = $this->input->post('emailadd');
               $address = $this->input->post('address');
               $schedule = $this->input->post('schedule');
               $purpose = $this->input->post('purpose');
               $status = 1;
               $datehired=date('Y-m-d');
               $requirement = "Processed";

                $this->Applicant_Model->insertapplicantschedule($userid, $fname, $lname, $contact, $emailadd,  $address, $schedule, $requirement, $purpose, $status, $datehired);
                $this->Student_Model->updatereadapplicant(2, $fname, $lname, $emailadd);
           
                    $subject = 'For screening';

                    $headers = "".$set_data['emailaddress']."";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $message =  '<p>Hi! this is '.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).' from tekton. I just to inform you that your schedule for screening on '.$schedule.'. Thank you.</p>';
                  
                    $message .= '<h3>Sincerely yours,</h3>';
                    $message .= '<p>'.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).'<p>';           
                    $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($emailadd);
                      $this->email->subject($subject)->set_mailtype('html'); 

                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                          
                     $this->email->message($message); 
                     $this->email->send();
                  echo json_encode(array("response" => "success", "message" => "Successfully added for plotting schedule for applicant", "redirect" => "ApplicantController/viewapply_applicant"));
                }

             }
              // for view applicant record if where applicantid
       public function viewapplicant_detail($applicantid) { 

             $applicantid =$this->input->get('applicantid');
             $selectid=array("applicantID" =>  $applicantid);
             $data=array();
                $selectapplicant = $this->Applicant_Model->selectapplicant($selectid);
                foreach ($selectapplicant as $value) { 
                $data=$value;  
                echo json_encode($data); 
              
                }
            }

      // for view applicant record if where applicantid
       public function viewapplicantrequirement($applicantid) { 
             $applicantid =$this->input->get('appid');
             $data=array();
                $selectapplicantrequirement = $this->ApplicantRequirement_Model->viewapprequirement($applicantid);
                foreach ($selectapplicantrequirement as $value) { 
                 $data= $value;  
                  echo json_encode($data); 
              
                }
            }

           public function viewapplicant_requirementall() { 
                   
               $set_data = $this->session->userdata('userlogin'); //session data
               $data = array('userID' => $set_data['userID']
                       );
        
                $records['userprofile'] = $this->User_Model->userprofile($data);
                $records['applicantrequirement'] = $this->ApplicantRequirement_Model->viewapprequirementall();
                $this->load->view('applicantrequirement', $records);
            }
           // for update schedule
        public function update_applicantplot(){
           $set_data=$this->session->userdata('userlogin');
           $userid=$set_data['userID'];
           $this->form_validation->set_rules('scheduleplot', 'Schedule Date And Time' ,'trim|required|xss_clean');
           $this->form_validation->set_rules('purpose', 'Information' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                  echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
               $applicantid = $this->input->post('applicantid');
               $scheduleplot = $this->input->post('scheduleplot');
               $purpose = $this->input->post('purpose');    
               $oldstatus = $this->input->post('oldstatus');
               $emailadd = $this->input->post('emailaddress');

                    $data = array("userID" => $userid,
                                  "applicantID" => $applicantid,
                                  "requirement" => "Processed",
                                  "status" => 1
                        ); 
                         
                      $requirement = array( "applicantID" => $applicantid,
                                            "requirementstatus" =>  0
                                            );
               $this->Applicant_Model->updateschedule($userid,$scheduleplot, $scheduleplot, $purpose, $applicantid);

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
                if ($purpose == 1){
                     $this->Applicant_Model->updateapplicantstatus($data, $data["applicantID"]);
                     $this->ApplicantRequirement_Model->updateapplicantrequirement($requirement, $requirement['applicantID']);

                    $subject = 'For screening';

                    $headers = "".$set_data['emailaddress']." ";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $message =  '<p>Hi! this is '.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).' from tekton. I just to inform you that your schedule for screening on '.$scheduleplot.'. Thank you.</p>';
                  
                    $message .= '<h3>Sincerely yours,</h3>';
                    $message .= '<p>'.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).'<p>';           
                    $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($emailadd);
                      $this->email->subject($subject)->set_mailtype('html'); 

                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                          
                     $this->email->message($message); 
                      $this->email->send();
                }
                else if ($purpose == 2){
                    $subject = 'For Orientation';

                    $headers = "".$set_data['emailaddress']."";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $message =  '<p>Hi! this is '.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).' from tekton. I just to inform you that your schedule for Orientation on '.$scheduleplot.'. Thank you.</p>';
                  
                    $message .= '<h3>Sincerely yours,</h3>';
                    $message .= '<p>'.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).'<p>';           
                    $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($emailadd);
                      $this->email->subject($subject)->set_mailtype('html'); 

                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                          
                     $this->email->message($message); 
                     $this->email->send();

                }
                else if ($purpose == 3){
                  $subject = 'For Processed Requirement';

                    $headers = "".$set_data['emailaddress']." ";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $message =  '<p>Hi! this is '.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).' from tekton. I just to inform you that your schedule for Processed Requirement on '.$scheduleplot.'. Thank you.</p>';
                  
                    $message .= '<h3>Sincerely yours,</h3>';
                    $message .= '<p>'.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).'<p>';           
                    $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($emailadd);
                      $this->email->subject($subject)->set_mailtype('html'); 

                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                          
                     $this->email->message($message); 
                     $this->email->send();
                }
                else if ($purpose == 4){
                  $subject = 'For Releasing Pay Card';

                    $headers = "".$set_data['emailaddress']."";
                      //$url= BASE_PATH . '/verify.php?emailaddress=' . urlencode($Email) . '&key='.$hash.'';
                    $message =  '<p>Hi! this is '.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).' from tekton. I just to inform you that your schedule for Releasing Pay Card on '.$scheduleplot.'. Thank you.</p>';
                  
                    $message .= '<h3>Sincerely yours,</h3>';
                    $message .= '<p>'.ucfirst($set_data['firstname']).' '.' '.ucfirst($set_data['lastname']).'<p>';           
                    $this->load->library('email', $config);

                     $this->email->set_newline("\r\n");

                      $this->email->from($headers); 
                      $this->email->to($emailadd);
                      $this->email->subject($subject)->set_mailtype('html'); 

                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                     $this->email->set_newline("\r\n");
                          
                     $this->email->message($message); 
                     $this->email->send();

                }
                echo json_encode(array("response" => "success" , "message" => "Successfully updated Plot Schedule", "redirect" => 'UserController/dashboard'));
           }

      }
            // update applicant status Applicant
           public function update_applicantstatus(){    
           $set_data=$this->session->userdata('userlogin');
           $userid=$set_data['userID'];
           $this->form_validation->set_rules('status', 'Status' ,'trim|required|xss_clean');
           $this->form_validation->set_rules('file', 'File' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{

               $data = array("userID" => $userid,
                             "applicantID" => $this->input->post('applicantid'),
                             "status" => $this->input->post('status'),
                              "requirement" => $this->input->post('requirement')   
                        );

                $data2= array("userID" => $userid,
                             "applicantID" => $this->input->post('applicantid'),
                             "status" => $this->input->post('status'),
                             "purpose" => $this->input->post('purpose')
                        );

                     $this->Applicant_Model->updateapplicantstatus($data, $data['applicantID']);
                     $this->Schedule_Model->insertscheduleappicant($data2);
                    echo json_encode(array("response" => "success" , "message" => " Successfully updated Status ", "redirect" => 'UserController/dashboard'));
                      $requirement = array("applicantID" => $this->input->post('applicantid'),
                                            "completerequirement" => $this->input->post('completerequirement'),
                                            "lackingrequirement" => $this->input->post('lackingrequirement'),
                                            "requirementstatus" => 1,
                                            "dateprocess" => date("Y-m-d"),
                                            "file" => $this->input->post('file')
                                              );
             
                if (!empty($requirement["completerequirement"])){
                      $this->ApplicantRequirement_Model->insertapplicantrequirement($requirement);
                }
            }
          }

       public function update_applicantlackingstatus(){    
           $set_data=$this->session->userdata('userlogin');
           $userid=$set_data['userID'];
           $this->form_validation->set_rules('status', 'Status' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{

               $data = array("userID" => $userid,
                             "applicantID" => $this->input->post('applicantid'),
                             "status" => $this->input->post('status'),
                             "requirement" => $this->input->post('requirement')
                        );
               $data2= array("userID" => $userid,
                             "applicantID" => $this->input->post('applicantid'),
                             "status" => $this->input->post('status'),
                             "purpose" => $this->input->post('purpose'),
                             "schedule" => $this->input->post('plotschedule')
                        );

                     $this->Applicant_Model->updateapplicantstatus($data, $data['applicantID']);
                     $this->Schedule_Model->insertscheduleappicant($data2);
                          echo json_encode(array("response" => "success" , "message" => " Successfully updated Status ", "redirect" => 'UserController/dashboard'));
               }
                     $oldrequirement = $this->input->post("oldrequirement");
                      $requirement = array( "applicantID" => $this->input->post('applicantid'),
                                            "completerequirement" =>  $oldrequirement .", ".  $this->input->post('completerequirement'),
                                            "lackingrequirement" => $this->input->post('lackingrequirement'),
                                            "dateprocess" =>date("Y-m-d")
                                              );
             
                if (!empty($requirement["lackingrequirement"])){
                      $this->ApplicantRequirement_Model->updateapplicantrequirement($requirement, $requirement['applicantID']);
                }
            } 
             // for view contract employee
           public function viewcontract_employee($employeeid) { 
             $employeeid =$this->input->get('employeeid');
             $selectemployeeid=array("employeeID" =>  $employeeid);
             $data=array();
                $selectcontractemployee = $this->Applicant_Model->selectemployeeid($selectemployeeid);
                foreach ($selectcontractemployee as $value) { 
                  $data= $value;  
                  echo json_encode($data); 
              
                }
            }
        public function extend_employee() { 
            $set_data = $this->session->userdata('userlogin'); //session data
            $data = array('userID'=> $set_data['userID'],
                          'applicantID'=> $this->input->post('applicantid'),
                          'branchID' => $this->input->post('branchid'),
                          'locationID' => $this->input->post('locationid'),
                          'status' => 'Activate'
                          );
            $data2 = array('userID'=> $set_data['userID'],
                          'applicantID'=> $this->input->post('applicantid'),
                          'branchID' => $this->input->post('branchid'),
                          'locationID' => $this->input->post('locationid'),
                          'dateextend' => date('Y-m-d') 
                          );
            $extend = $this->input->post('extend');
            $extend++;
            $statusapplicant =array('status' => 9,
                                    'extend' => $extend,
                                    'datedeploy' => date('Y-m-d') 
                                    );

          $this->Employee_Model->addemployee($data);
          $this->ExtendEmployee_Model->insertextendemployee($data2);
          $this->Applicant_Model->updateapplicantstatus($statusapplicant, $data['applicantID']);
          echo json_encode(array("response" => "success", "message" => "Successfully Extended Employee", "redirect" => "ApplicantController/view_extend"));
          }

      public function view_extendemployee() { 
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );       
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['employeeextend']=$this->ExtendEmployee_Model->view_extendemployee($year);
        $this->load->view('extend', $records);
      } 
        // for extend employee
       public function view_extendemployeeadmin() { 
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );       
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['employeeextend']=$this->ExtendEmployee_Model->view_extendemployee($year);
        $this->load->view('extendadmin', $records);
      } 
    //filter extend employee
       public function filter_extendemployee(){
            $year = $this->input->post('year');
            $data=array();
            $selectextend =$this->ExtendEmployee_Model->view_extendemployee($year);
            $data= $selectextend;
            echo json_encode($data); 
          }  
            // report plotting schedule
       public function report_plotschedule() { 
        date_default_timezone_set("Asia/Manila");
        $datenow= date("Y-m-d");
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );       
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['username']= strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['scheduleapplicant']=$this->Schedule_Model->viewreportschedule($datenow);
        $this->load->view('reportschedule', $records);
      } 

     // view  plotting schedule applicant
       public function schedule_plotapplicant() { 
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month;
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );       
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['username']= strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['scheduleapplicant']=$this->Schedule_Model->viewreportschedule($datenow);
        $this->load->view('plotapplicantschedule', $records);
      } 
         // filter employee Attendance detail
        public function filter_scheduleapplicant(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $day = $this->input->post('day');
              $purpose = $this->input->post('purpose');
              $data=array();
              $selectschedule = $this->Schedule_Model->filterscheduleapplicant($month, $day, $year, $purpose); 
              $data= $selectschedule;
              echo json_encode($data); 
          }
       // filter applicant for view Attendance detail
        public function filter_scheduleapplicantview(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $purpose = $this->input->post('purpose');
              $data=array();
              $selectschedule = $this->Schedule_Model->filterscheduleapplicantforview($month, $year, $purpose); 
              $data= $selectschedule;
              echo json_encode($data); 
          }
            //filter request client 
           public function filter_requestclient(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $set_data = $this->session->userdata('userlogin'); //session data
              $data2 = array('userID' => $set_data['userID']
                       );
              $data=array();
              $selectrequestclient =$this->Request_Model->filterrequestclient($data2["userID"], $month, $year);
              $data= $selectrequestclient;
              echo json_encode($data); 
          }   
           public function viewapplicant_requirement() {  
                 $datenow= date('Y-m-d');          
                 $set_data = $this->session->userdata('userlogin'); //session data
                 $data = array('userID' => $set_data['userID']
                         );  
                $records['userprofile'] = $this->User_Model->userprofile($data);
                $records['username'] = strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
                $records['applicantrequirement'] = $this->ApplicantRequirement_Model->viewrequirementdetail($datenow);
                $this->load->view('requirementdetail', $records);
            } 
             //filter requirement
           public function filter_requirementapplicant(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $data=array();
              $selectrequirement =$this->ApplicantRequirement_Model->filterrequirement($month, $year);
              $data= $selectrequirement;
              echo json_encode($data); 
          }  

          public function viewapply_applicant() { 
           $set_data = $this->session->userdata('userlogin'); //session data
           $data = array('userID' => $set_data['userID']
                       );
           $updateapplicantstatus= $this->Student_Model->notifyapplicant();
           if ($updateapplicantstatus == 1){
                 $updateapplicantstatus= $this->Student_Model->readapplicant(0);

           }  

           $records['userprofile']=$this->User_Model->userprofile($data);
           $records['applyapplicant']=$this->Student_Model->viewapplicant();
           $this->load->view('applyapplicant', $records);
        }  
          public function contract_employee() { 
            $data=array();
            $selectcontract =$this->Applicant_Model->selectcontract();
            $data=$selectcontract;
            echo json_encode($data); 
        }  
    } 
?>        