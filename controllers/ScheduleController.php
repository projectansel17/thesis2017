  <?php 
   class ScheduleController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Scheduleemployee_Model'); 
         $this->load->model('Client_Model'); 
      } 
  
      public function viewschedule_employee() { 
         date_default_timezone_set("Asia/Manila");
         $date= date("Y-m-d");
         $year = date('Y', strtotime($date));
         $set_data = $this->session->userdata('userlogin'); //session data
         $data = array('clientID' => $set_data['clientID']
                       );       
          $records['clientprofile']=$this->Client_Model->clientprofile($data);
          $records['scheduleemployee']=$this->Scheduleemployee_Model->viewscheduleemployee($set_data['clientID'], $year);
          $this->load->view('scheduleemployee', $records);
      } 
        public function viewschedule_datail($employeeid) { 
          $employeeid =$this->input->get('employeeid');
          $data=array();
           $selectschedule =$this->Scheduleemployee_Model->viewlistchedule($employeeid);
           $data=$selectschedule;  
           echo json_encode($data); 
        }
   }
?>  