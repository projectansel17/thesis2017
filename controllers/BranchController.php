<?php 
   class BranchController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Branch_Model');
         $this->load->model('Location_Model');
         $this->load->model('User_Model');
      } 
  

      public function branch() { 
          $set_data = $this->session->userdata('userlogin'); //session data
          $data = array('userID' => $set_data['userID']
                       );       
          $records['userprofile']=$this->User_Model->userprofile($data);
          $records['branchs']=$this->Branch_Model->viewbranch();
          $records['locations']=$this->Location_Model->viewlocation();
          $this->load->view('branch', $records);

      } 
            public function viewbranchname() { 
                $data=array();
                $selectbranchname = $this->Branch_Model->viewbranch();
                $data=$selectbranchname;  
                echo json_encode(array('viewbranch' => $data));             
      } 

       public function viewbranchdetail($branchid) { 
             $branchid =$this->input->get('branchid');
             $selectid=array("branchID" =>  $branchid);
             $data=array();
                $selectbranch =$this->Branch_Model->selectbranch($selectid);
                foreach ($selectbranch as $value) { 
                $data=$value;  
                echo json_encode($data);  
           }
      } 

      //for add client name
      public function add_branch() { 
              $branchname=$this->input->post('branchname');
              $this->form_validation->set_rules('branchname[]', 'Branch Name','trim|xss_clean|is_unique[tblbranch.branchname]', array("is_unique" => "This %s is already exists."));
              
              $this->form_validation->set_error_delimiters('', '');

             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             }
              else  if(count($branchname) != count(array_unique($branchname))){
                                 echo json_encode(array("response" => "error", "err" => "Must be unique input value"  ));
                        }
              else{ 
                       for ($i=0;  $i < count($branchname); $i++){
                          $data= array('branchname' => $branchname[$i]
                       );

                          if (!empty($data['branchname'])){
                            $this->Branch_Model->insertbranch($data);
                    }
               }
                    echo json_encode(array("response" => "success", "message" => "Successfully Added Branch", "redirect" => "BranchController/branch"));

            }
        }
      // forr update client
      public function update_branch(){

          $data = array("branchID" => $this->input->post('branchid'),
                        "branchname" => $this->input->post('branchname')
                        );

           $this->form_validation->set_rules('branchname', 'Branch Name' ,'trim|required|xss_clean|is_unique[tblbranch.branchname]');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
               else{
                    $this->Branch_Model->updatebranch($data, $data['branchID']);
                    echo json_encode(array("response" => "success" , "message" => "Successfully updated Branch", "redirect" => 'BranchController/branch'));
           }
         }
        // for delete client
        public function delete_branch() { 
         $branchid = $this->input->post('branchid');  
         $branchname = $this->Branch_Model->branchEmpty($branchid);
         if (!$branchname){
           echo json_encode(array("response" => "err" , "message" => "This Branch has still Department Name. please delete all Department before this", "redirect" => 'BranchController/branch'));
         }
         else{
          $this->Branch_Model->deletebranch($branchid); 
         echo json_encode(array("response" => "success" , "message" => "Successfully deleted Branch", "redirect" => 'BranchController/branch'));
         }
      }
        //addlocation
        public function location() { 
          $set_data = $this->session->userdata('userlogin'); //session data
          $data = array('userID' => $set_data['userID']
                       );
        
          $records['userprofile']=$this->User_Model->userprofile($data);
          $records['locations']=$this->Location_Model->viewlocation();
          $this->load->view('location', $records);


      } 

       public function viewlocationdetail($locationid) { 

             $locationid =$this->input->get('locationid');
             $selectid=array("locationID" =>  $locationid);
             $data=array();
                $selectlocation =$this->Location_Model->selectlocation($selectid);
                foreach ($selectlocation as $value) { 
                $data=$value;  
                echo json_encode($data); 
              }
          } 

      //for add location name
      public function add_location() { 
              $locationname=$this->input->post('locationname');
              $this->form_validation->set_rules('locationname[]', 'Department and Branch','callback_location_check');
              $this->form_validation->set_error_delimiters('', '');

             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             }
              else  if(count($locationname) != count(array_unique($locationname))){
                                 echo json_encode(array("response" => "error", "err" => "Must be unique input value"  ));
                        }
                else{ 
                       for ($i=0;  $i < count($locationname); $i++){
                           $data= array('locationname' => $locationname[$i],
                                         'branchID' => $this->input->post('branchname')
                              );

                          if (!empty($data['locationname'])){
                            $this->Location_Model->insertlocation($data);
                    }
               }
                    echo json_encode(array("response" => "success", "message" => "Successfully Added Department", "redirect" => "BranchController/branch"));

            }
        }

        public function location_check($locationname){

             for ($i=0;  $i < count($this->input->post('locationname')); $i++){
                   $locationname=$this->input->post('locationname')[$i];
                   $branchid = $this->input->post('branchname');

                $location = $this->Location_Model->locationcheck($locationname, $branchid);

                if ($location){
                     $this->form_validation->set_message('location_check', 'The {field} is already exists');
                     return false;
                }
                else{
                     return true;
                }
            }
        }
               // forr update client
      public function update_location(){

        $this->form_validation->set_rules('locationname', 'Location' ,'trim|required|xss_clean|is_unique[tbllocation.locationname]');
        $this->form_validation->set_error_delimiters('','');

        if ($this->form_validation->run() == FALSE){
            echo json_encode(array("response" => "error" , "err" => validation_errors()));
        }
           else{

            $data = array("locationID" => $this->input->post('locationid'),
                          "locationname" => $this->input->post('locationname'),
                          "branchID" => $this->input->post('branchname')
                          );

            $this->Location_Model->updatelocation($data, $data['locationID']);
            echo json_encode(array("response" => "success" , "message" => "Successfully updated Location", "redirect" => "BranchController/branch"));

           }
      }
              // for delete client
        public function delete_location() { 
         $locationid = $this->input->post('locationid');  
         $locationname = $this->Location_Model->locationEmpty($locationid);
         if (!$locationname){
           echo json_encode(array("response" => "err" , "message" => "This Department has still use Client or  Employee Deploy.", "redirect" => 'BranchController/branch'));
         }
         else{
             $this->Location_Model->deletelocation($locationid); 
             echo json_encode(array("response" => "success" , "message" => "Successfully deleted Location", "redirect" => 'BranchController/branch'));
         }
       } 
   }
?>  