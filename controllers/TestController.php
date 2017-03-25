<?php 
   class TestController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('User_Model');
         $this->load->helper(array('form'));
         $this->load->helper(array('url'));
         $this->load->library('encrypt');
         $this->load->library('form_validation');
         $this->load->library('session');
         $this->load->helper('security');




      } 
  
      public function index() { 
      				  $password='admin';
      	              $hash = md5(uniqid(rand(), true));
                      $key = $this->config->item('encryption_key');
                      $salt1 = hash('sha512', $key . $password);
                      $salt2 = hash('sha512', $password . $key);
                      $hashed_password = hash('sha512', $salt1 . $password . $salt2);
        				$test['test']= $hashed_password;
                      $this->load->view('test', $test);

      } 
        //for add user member 
   } 
?>