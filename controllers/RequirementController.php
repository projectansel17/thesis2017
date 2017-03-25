  <?php 
   class RequirementController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Requirement_Model'); 
         $this->load->model('User_Model');

      } 
  
      public function requirement() { 
          $set_data = $this->session->userdata('userlogin'); //session data
          $data = array('userID' => $set_data['userID']
                       );
        
          $records['userprofile']=$this->User_Model->userprofile($data);
          $records['requirements']=$this->Requirement_Model->viewrequirement();
          $this->load->view('requirement', $records);


      } 
      //select id  for requirement

      public function viewrequirementdetail($requirementid) { 

             $requirementid =$this->input->get('requirementid');
             $selectid=array("requirementID" =>  $requirementid);
             $data=array();
                $selectlocation =$this->Requirement_Model->selectrequirement($selectid);
                foreach ($selectlocation as $value) { 
                $data=$value;  
                echo json_encode($data); 
              }
          } 


      //for add location name
      public function add_requirement() { 
              $requirement=$this->input->post('requirement');
              $this->form_validation->set_rules('requirement[]', 'Requirement ','trim|xss_clean|is_unique[tblrequirement.requirement]', array('required => You have not provide %s.', 'this %s already exists'));
              $this->form_validation->set_error_delimiters('', '');

             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                       echo json_encode(array("response" => "error", "err" => validation_errors()));

             }
              else  if(count($requirement) != count(array_unique($requirement))){
                                 echo json_encode(array("response" => "error", "err" => "Must be unique input value"  ));
                        }
                else{ 
                       for ($i=0;  $i < count($requirement); $i++){
                          $data= array('requirement' => $requirement[$i]
                       );

                          if (!empty($data['requirement'])){
                            $this->Requirement_Model->insertrequirement($data);
                    }
               }
                    echo json_encode(array("response" => "success", "message" => "Successfully Added Requirement", "redirect" => "RequirementController/requirement"));

            }
        }
               // forr update client
      public function update_requirement(){

        $this->form_validation->set_rules('requirement', 'Requirement' ,'trim|required|xss_clean|is_unique[tblrequirement.requirement]');
        $this->form_validation->set_error_delimiters('','');

        if ($this->form_validation->run() == FALSE){
            echo json_encode(array("response" => "error" , "err" => validation_errors()));
        }
           else{

            $data = array("requirementID" => $this->input->post('requirementid'),
                          "requirement" => $this->input->post('requirement')
                          );

            $this->Requirement_Model->updaterequirement($data, $data['requirementID']);
            echo json_encode(array("response" => "success" , "message" => "Successfully updated Requirement", "redirect" => "RequirementController/requirement"));

           }
      }
              // for delete client
        public function delete_requirement() { 
         $requirementid = $this->input->post('requirementid'); 
                   $set_data = $this->session->userdata('userlogin'); //session data
          $data = array('userID' => $set_data['userID']
                       );
          $this->Requirement_Model->deleterequirement($requirementid); 
         $records['userprofile']=$this->User_Model->userprofile($data);
         $records['requirements']=$this->Requirement_Model->viewrequirement();
         $this->load->view('requirement', $records);
      } 

   }
?>  