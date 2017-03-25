<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class LoginController extends CI_Controller
	{
		public function __construct(){
			parent:: __construct();
			$this->load->model('LoginModel');
		}
		public function index(){
			$this->load->view('login');
		}
		public function dashboard(){
			if(!isset($_SESSION["username"])){
				redirect(base_url().'LoginController/index');
			}
			$this->load->view('homepage');
		}
		public function checkuser(){
			$data = array(
					'username' =>$this->input->post('username'),
					'password' =>$this->input->post('password')
					);
			$result = $this->LoginModel->checkUser($data);
			if($result == true){
				// $this->session->set_userdata("username");
				$_SESSION['username'] = $_POST['username'];
				redirect(base_url().'LoginController/dashboard');
			}else{				
				redirect(base_url());
			}
		}
		public function logout()
		{
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('password');
			$this->session->sess_destroy();
			redirect(base_url());
		}
		public function users()
		{
			$button = $this->input->post('btnsearch');
			if(isset($button)){
				$search = $this->input->post('search');
				$data['user'] = $this->LoginModel->getusersearch($search);
				$this->load->view('users',$data);
				$this->load->view('addusermodal');
				$this->load->view('updateusermodal');

			}else{
				$data['user'] = $this->LoginModel->getUsers();
				$this->load->view('users',$data);
				$this->load->view('addusermodal');
				$this->load->view('updateusermodal');
			}
		}
		public function employee()
		{
			$button = $this->input->post('btnsearchemp');
			if(isset($button)){
				$search = $this->input->post('searchemp');
				$data['employee'] = $this->LoginModel->getemployeesearch($search);
				$this->load->view('employee',$data);
				$this->load->view('addemployeemodal');
				$this->load->view('updateemployeemodal');
			}else{
				$data['employee'] = $this->LoginModel->getemployee();
				$this->load->view('employee',$data);
				$this->load->view('addemployeemodal');
				$this->load->view('updateemployeemodal');
			}
		}
		public function client()
		{
			$button = $this->input->post('btnsearchclient');
			if(isset($button)){
				$search = $this->input->post('searchclient');
				$data['client'] = $this->LoginModel->getclientSearch($search);
				$this->load->view('client',$data);
				$this->load->view('addclientmodal');
				$this->load->view('updateclientmodal');
			}else{
			$data['client'] = $this->LoginModel->getClient();
			$this->load->view('client',$data);
			$this->load->view('addclientmodal');
			$this->load->view('updateclientmodal');
			}
		}
		public function insertuser()
		{
			$datas['message'] = "success";
			$data = array(
				'Firstname' => $this->input->post('UserFname'),
				'Lastname' => $this->input->post('UserLname'),
				'Address' => $this->input->post('UserAddress'),
				'Birthdate' => $this->input->post('UserBdate'),
				'Gender' => $this->input->post('UserGender'),
				'Username' => $this->input->post('UserUname'),
				'Password' => $this->input->post('UserPass'),
				);
			$this->LoginModel->insertUser($data);
			echo json_encode($datas);
		}
		public function insertemployee()
		{
			$datas['message'] = "success";
			$data = array(
				'Lastname' => $this->input->post('lname'),
				'Firstname' => $this->input->post('fname'),
				'Address' => $this->input->post('address'),
				'Gender' => $this->input->post('gender'),
				'Birthdate' => $this->input->post('birthdate'),
				'Username' => $this->input->post('username'),
				'Password' => $this->input->post('password'),
				);
			$this->LoginModel->insertEmployee($data);
			echo json_encode($datas);
		}
		public function insertclient()
		{
			$datas['message'] = "success";
			$data = array(
				'ClientName' => $this->input->post('cname'),
				'ClientLocation' => $this->input->post('clocation'),
				);
			$this->LoginModel->insertClient($data);
			echo json_encode($datas);
		}
		public function updateuser()
		{
			$datas['message'] = "success";
			$id = $this->input->post('id');
			$data = array(
				'Firstname' => $this->input->post('fname'),
				'Lastname'	=> $this->input->post('lname'),
				'Address'	=> $this->input->post('address'),
				'Birthdate'	=> $this->input->post('bdate'),
				'Gender'	=> $this->input->post('gender'),
				);
			$this->LoginModel->updateUser($id,$data);
			echo json_encode($datas);
		}
		public function updateclient()
		{
			$datas['message'] = 'success';
			$id = $this->input->post('id');
			$data = array(
				'ClientName' => $this->input->post('cname'),
				'ClientLocation' => $this->input->post('clocation'),
				);
			$this->LoginModel->updateClient($id,$data);
			echo json_encode($datas);
		}
		public function deleteuser()
		{
			$this->LoginModel->deleteuserrecords();
			redirect('/logincontroller/users');
		}
		public function deleteemployee()
		{
			$this->LoginModel->deleteemployeeRecord();
			redirect('/LoginController/employee');
		}
		public function deleteclient()
		{
			$this->LoginModel->deleteclientRecord();
			redirect('/LoginController/client');
		}
		public function viewuser()
		{
			$id = $this->input->post('UserId');
			$data['records'] = $this->LoginModel->getuserrecord($id);
			echo json_encode($data);
		}
		public function viewclient()
		{
			$id = $this->input->post('ClientId');
			$data['records'] = $this->LoginModel->getclientRecord($id);
			echo json_encode($data);
		}
		public function viewemployee()
		{
			$id = $this->input->post('EmpId');
			$data['record'] = $this->LoginModel->getemployeeRecord($id);
			echo json_encode($data);
		}
		public function updateemployee()
		{
			$datas['message'] = "success";
			$id = $this->input->post('id');
			$data = array(
				'Firstname' => $this->input->post('fname'),
				'Lastname' => $this->input->post('lname'),
				'Address' => $this->input->post('address'),
				'Gender' => $this->input->post('gender'),
				'Birthdate' => $this->input->post('birthdate'),
				);
			$this->LoginModel->updateEmployee($id,$data);
			echo json_encode($datas);
 		}
	} 
 ?>