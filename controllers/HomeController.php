<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Student_Model');
         $this->load->model('User_Model');
      } 
  
	public function index()
	{
		$this->load->view('home');
	}
	public function apply()
	{
		$this->load->view('apply');
	}
    public function location()
  {
    $this->load->view('location2');
  }
	public function upload_file(){
         $uploadOk = 1;
         $configUpload['upload_path'] = FCPATH.'resume/';
         $configUpload['allowed_types'] = 'doc|docx|pdf';
         $configUpload['file_name'] = 'Resume' .uniqid() . '_' . date('Y-m-d');
         $this->load->library('upload', $configUpload);

          if (!$this->upload->do_upload('file')){
              echo json_encode(array("response" => "error", "message" => "format is invalid. It must be an Doc, Docx or Pdf."));  
         } 
         else{
                echo json_encode(array("response" => "success", "message" => "format is valid."));  

         } 
     }
         public function add_student() { 
         	$this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
          $this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
         	$this->form_validation->set_rules('contact','Phone Number','trim|required|xss_clean|min_length[11]|max_length[11]');
         	$this->form_validation->set_rules('email','Email Address','trim|required|xss_clean');
         	$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
         	$this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
         	$this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
         	$this->form_validation->set_error_delimiters('',   '');

         	$configUpload['upload_path'] = FCPATH.'resume/';
        	$configUpload['allowed_types'] = 'doc|docx|pdf';
            $configUpload['file_name'] = 'Resume' .uniqid() . '_' . date('Y-m-d');
            $this->load->library('upload', $configUpload);

             if ($this->form_validation->run() == FALSE){                                  
                   //catch to the errors
                 echo json_encode(array("response" => "error", "message" => validation_errors()));
             } 
             else  if (!$this->upload->do_upload('file')){
                 echo json_encode(array("response" => "erroruploading", "message" => "format is invalid or Empty. It must be an Doc, Docx or Pdf."));  
        	 } 
          else{
          		$media = $this->upload->data();
            	$inputFileName = 'resume/'.$media['file_name'];
                $data = array( 
                              'firstname'=> $this->input->post('firstname'),
                              'lastname'=> $this->input->post('lastname'),
                              'contact' => $this->input->post('contact'),
                              'email'  => $this->input->post('email'),
                              'address'     => $this->input->post('address'),
                              'state'   =>  $this->input->post('state'),
                              'description'=> $this->input->post('description'),
                              'file' => $inputFileName,
                              'dateapply' => date("Y-m-d"),
                              'unread' => 1
                            );                          
                 $this->Student_Model->insertstudent($data);
                  echo json_encode(array("response" => "success", "message" => "You are done to apply and Congratulations", "redirect" => "HomeController/index"));
                }

           }
           // new applicant
         public function notify_applicant() { 
            $data=array();
            $notificationapplicant =$this->Student_Model->notifyapplicant();
            $data=$notificationapplicant;
            echo json_encode(array("numberofapplicant" =>$data)); 
    	  }  
      // for view apply applicant record if where student id
       public function viewapplyapplicant($applyapplicantid) { 
             $applyapplicantid =$this->input->get('studentid');
             $selectstudentid=array("studentid" =>  $applyapplicantid);
             $data=array();
                $selectapplyapplicant = $this->Student_Model->selectapplyapplicant($selectstudentid);
                foreach ($selectapplyapplicant as $value) { 
                 $data= $value;  
                  echo json_encode($data);               
             }
        }
}
