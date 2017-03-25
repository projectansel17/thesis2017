  <?php 
   class ChatController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Chat_Model'); 

      } 

                  // forr update client
      public function add_chat(){
           date_default_timezone_set("Asia/Manila");
           $this->form_validation->set_rules('message', 'Message' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
                  $set_data = $this->session->userdata('userlogin'); //session data
                  $userid = $this->input->post('userid');
                  $message = $this->input->post('message');
                  $seton = date('Y-m-d h:i:sa');
                  $unread = 2;
        
                  $this->Chat_Model->insertchat($userid, $set_data['clientID'], strtolower($set_data['username']),  $message, $seton, $unread, 0); 
                  $viewchat = $this->Chat_Model->viewchat($userid, $set_data['clientID']); 
                  $data= array();
                  foreach ($viewchat as $value) {
                    $data= $value;
                  }
                   echo json_encode(array("response" => "success", "chat" => $data));                   

           }
         }

      // select id for user admin
      public function viewuserid($userid) { 
             $userid =$this->input->get('userid');
             $clientid =$this->input->get('clientid');
             $set_data = $this->session->userdata('userlogin'); //session data
             $data=array();
                $selectid =$this->Chat_Model->viewchat($userid, $set_data['clientID']);
                $data=$selectid;
                echo json_encode($data); 
      } 

            // select id for user admin
      public function viewclientid($clientid) { 
             $clientid =$this->input->get('clientid');
             $set_data = $this->session->userdata('userlogin'); //session data
             $data=array();
                $selectid =$this->Chat_Model->viewchat($set_data['userID'], $clientid);
                $data=$selectid;
                echo json_encode($data); 
      } 

      // chat admin
      public function admin_chat(){
          date_default_timezone_set("Asia/Manila");
           $this->form_validation->set_rules('message', 'Message' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
                  $set_data = $this->session->userdata('userlogin'); //session data
                  $clientid = $this->input->post('clientid');
                  $message = $this->input->post('message');
                  $seton = date('Y-m-d h:i:sa');
                  $unreadfrom = 2;
        
                  $this->Chat_Model->insertchat($set_data['userID'], $clientid, strtolower($set_data['username']), $message, $seton, 0, $unreadfrom); 
                  $viewchat = $this->Chat_Model->viewchat($set_data['userID'], $clientid); 
                  $data= array();
                  foreach ($viewchat as $value) {
                    $data= $value;
                  }
                   echo json_encode(array("response" => "success", "chat" => $data));                   

           }
         }


         public function message_notification() { 
                $set_data = $this->session->userdata('userlogin'); //session data
                $data=array();
                $notificationmessage =$this->Chat_Model->notificationmessage($set_data['userID']);
                $data=$notificationmessage;
                echo json_encode(array("numberofmessage" =>$data)); 
      }

         public function message_notificationadmin() { 
               $set_data = $this->session->userdata('userlogin'); //session data
                $data=array();
                $notificationmessageadmin =$this->Chat_Model->notificationmessagetoadmin($set_data['clientID']);
                $data=$notificationmessageadmin;
                echo json_encode(array("numberofmessageadmin" =>$data)); 
      }  

   }
?>  