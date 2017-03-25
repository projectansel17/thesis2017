  <?php 
   class LocationController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Location_Model'); 
         $this->load->model('User_Model');

      } 
  
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
              $this->form_validation->set_rules('locationname[]', 'Department ','trim|xss_clean|is_unique[tbllocation.locationname]', array('required => You have not provide %s.', 'this %s already exists'));
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
                          $data= array('locationname' => $locationname[$i]
                       );

                          if (!empty($data['locationname'])){
                            $this->Location_Model->insertlocation($data);
                    }
               }
                    echo json_encode(array("response" => "success", "message" => "Successfully Added Department", "redirect" => "location"));

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
                          "locationname" => $this->input->post('locationname')
                          );

            $this->Location_Model->updatelocation($data, $data['locationID']);
            echo json_encode(array("response" => "success" , "message" => "Successfully updated Location", "redirect" => "LocationController/location"));

           }
      }
              // for delete client
        public function delete_location() { 
         $locationid = $this->input->post('locationid'); 
         $this->Location_Model->deletelocation($locationid); 
         $data['locations']=$this->Location_Model->viewlocation();
         $this->load->view('location', $data);
      } 

   }
?>  