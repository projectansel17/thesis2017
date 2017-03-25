<?php 
   class Applicant_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      public function insertapplicantschedule($userid, $fname, $lname, $contact, $emailadd, $address, $plotsched ,$requirement, $purpose, $active, $datehired) { 
        $sql="INSERT into tblapplicant (userID, firstname, lastname, contact, emailadd, address, plotschedule, requirement, purpose, status, datehired ) values 
        ('".$this->db->escape_str($userid)."','".$this->db->escape_str($fname)."','".$this->db->escape_str($lname)."', '".$this->db->escape_str($contact)."','".$this->db->escape_str($emailadd)."', '".$this->db->escape_str($address)."', STR_TO_DATE('".$this->db->escape_str($plotsched)."','%Y-%m-%d %h:%i %p'), '".$this->db->escape_str($requirement)."', '".$this->db->escape_str($purpose)."','".$this->db->escape_str($active)."', '".$this->db->escape_str($datehired)."')";
    
         if ($this->db->query($sql) === TRUE) { 
            return true; 
         } 
      } 
      public function viewplotapplicantadmin(){ 
        $this->db->select('tblapplicant.applicantID, tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, DATE_FORMAT(tblapplicant.plotschedule, "%Y-%m-%d %r") as schedule, DATE_FORMAT(tblapplicant.datedeploy, "%Y-%m-%d %r") as releasesched, tblapplicant.purpose, tblapplicant.status, tblapplicant.datehired, tblapplicant.requirement, tbluser.username')->from('tblapplicant')->join('tbluser', 'tblapplicant.userID = tbluser.userID', 'inner')
        ->where('tblapplicant.requirement', 'Completed')->group_by('tblapplicant.applicantID');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
    
     // for view all applicant record
      public function viewplotapplicant(){ 
        $this->db->select('tblapplicant.applicantID, tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.datedeploy, DATE_FORMAT(tblapplicant.plotschedule, "%Y-%m-%d %r") as schedule, tblapplicant.purpose, tblapplicant.status, tblapplicant.datehired, tblapplicant.requirement, tbluser.username, tblapplicant.extend')->from('tblapplicant')
        ->join('tbluser', 'tblapplicant.userID = tbluser.userID');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
       public function selectcontract(){ 
        $this->db->select('*')->from('tblemployee')->where('status=','End')->group_by('applicantID');
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
      public function selectemployeeid($data){ 
         $this->db->select('em.*, ap.extend')->from('tblemployee as em')->join('tblapplicant as ap ', 'em.applicantID = ap.applicantID')->where('em.status =', 'End')->where(array('em.employeeID'=> $data['employeeID']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
      public function selectapplicant($data){ 
        $this->db->select('firstname, lastname, status, applicantID, emailadd, requirement, DATE_FORMAT(plotschedule, "%Y-%m-%d %h:%i %p") as schedule, DATE_FORMAT(datedeploy, "%Y-%m-%d %h:%i %p") as releasesched, purpose')->from('tblapplicant')->where(array('applicantID'=> $data['applicantID']));
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        // for update schedule for applicant
        public function updateschedule($userid, $plotsched, $releasesched, $purpose,  $applicantid) { 
        $sql="UPDATE tblapplicant set userID = '".$this->db->escape_str($userid)."', plotschedule = STR_TO_DATE('".$this->db->escape_str($plotsched)."','%Y-%m-%d %h:%i %p'), datedeploy = STR_TO_DATE('".$this->db->escape_str($releasesched)."','%Y-%m-%d %h:%i %p'), purpose= '".$this->db->escape_str($purpose)."' WHERE applicantID='".$this->db->escape_str($applicantid)."'";  
         if ($this->db->query($sql) === TRUE) { 
            return true; 
         } 
     
      } 
         public function updateapplicantstatus($data, $applicantid) { 
           $this->db->set($data); 
           $this->db->where("applicantID", $applicantid); 
           $this->db->update("tblapplicant"); 
      } 
       public function updateapplicantstatuscontract($status, $applicantid) { 
           $this->db->set('status', $status); 
           $this->db->where("applicantID", $applicantid); 
           $this->db->update("tblapplicant"); 
      } 
  
   } 
?> 