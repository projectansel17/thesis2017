<?php
	class LoginModel extends CI_Model
	{
		public function checkUser($data)
		{
			$this->db->select('*');
			$this->db->from('tbladmin');
			$this->db->where(array('Username' => $data['username'],
									'Password' => $data['password']));
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				return true;
			}else{
				return false;
			}
		}
		public function getUsers()
		{
			$queryforusers = $this->db->get('tblusers');
			return $queryforusers;
		}
		public function getusersearch($search)
		{
			$this->db->select('*');
			$this->db->from('tblusers');
			$this->db->like('Firstname',$search)
					 ->or_like('Lastname',$search)
					 ->or_like('Username',$search);
			$querysearch = $this->db->get();
			if($querysearch->num_rows() > 0){
				return $querysearch;
			}else{
				return $querysearch;
			}
		}
		public function getemployeesearch($search)
		{
			$this->db->select('*');
			$this->db->from('tblemployee');
			$this->db->like('Firstname',$search)
					 ->or_like('Lastname',$search)
					 ->or_like('Username',$search);
			$queryforemployeesearch = $this->db->get();
			if($queryforemployeesearch->num_rows()>0){
				return $queryforemployeesearch;
			}else{
				return $queryforemployeesearch;
			}
		}
		public function getclientSearch($search)
		{
			$this->db->select('*');
			$this->db->from('tblclient');
			$this->db->like('ClientName',$search);
			$queryforclient = $this->db->get();
			if($queryforclient->num_rows()>0){
				return $queryforclient;
			}else{
				return $queryforclient;
			}
		}
		public function insertUser($data)
		{
			$this->db->insert('tblusers',$data);
		}
		public function insertEmployee($data)
		{
			$this->db->insert('tblemployee',$data);
		}
		public function insertClient($data)
		{
			$this->db->insert('tblclient',$data);
		}
		public function updateUser($id,$data)
		{
			$this->db->where('UserId',$id);
			$this->db->update('tblusers',$data);
		}
		public function updateClient($id,$data)
		{
			$this->db->where('ClientId',$id);
			$this->db->update('tblclient',$data);
		}
		public function deleteuserrecords()
		{
			$this->db->where('UserId',$this->uri->segment(3));
			$this->db->delete('tblusers');
		}
		public function deleteemployeeRecord()
		{
			$this->db->where('EmpId',$this->uri->segment(3));
			$this->db->delete('tblemployee'); 
		}
		public function deleteclientRecord()
		{
			$this->db->where('ClientId',$this->uri->segment(3));
			$this->db->delete('tblclient');
		}
		public function getuserrecord($id)
		{
			$this->db->where('UserId',$id);
			$queryrecord = $this->db->get('tblusers');
			return $queryrecord->result();
		}
		public function getemployee()
		{
			$queryforemployee = $this->db->get('tblemployee');
			return $queryforemployee;
		}
		public function getemployeeRecord($id)
		{
			$this->db->where('EmpId',$id);
			$queryrecord = $this->db->get('tblemployee');
			return $queryrecord->result();
		}
		public function getclientRecord($id)
		{
			$this->db->where('ClientId',$id);
			$queryrecord = $this->db->get('tblclient');
			return $queryrecord->result();
		}
		public function updateEmployee($id,$data)
		{
			$this->db->where('EmpId',$id);
			$this->db->update('tblemployee',$data);
		}
		public function getClient()
		{
			$queryforclient = $this->db->get('tblclient');
			return $queryforclient;
		}
	} 
 ?>