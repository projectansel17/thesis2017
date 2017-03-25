<?php 
   class ApplicantRequirement_Model extends CI_Model {
	
      function __construct() { 
         parent::__construct(); 
         $this->load->database(); 

      } 
      // for insert client
      public function insertapplicantrequirement($data) { 
         if ($this->db->insert("tblapplicantrequirement", $data)) { 
            return true; 
         } 
      } 
      // for view all location record
      public function viewapprequirement($applicantid){ 
        $this->db->select('r.*, a.applicantID, a.status , a.purpose, DATE_FORMAT(a.plotschedule, "%Y-%m-%d %h:%i %p") as schedule')->from('tblapplicantrequirement as r')->join('tblapplicant as a', 'r.applicantID = a.applicantID', 'inner')->where('a.applicantID', $applicantid)
        ->where('r.requirementstatus', 1);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

       // for view all requirements of applicant
       public function viewapprequirementall(){ 
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.applicantID, tblapplicantrequirement.completerequirement, tblapplicantrequirement.lackingrequirement')->from('tblapplicantrequirement')
        ->join('tblapplicant', 'tblapplicantrequirement.applicantID = tblapplicant.applicantID', 'inner')->where('tblapplicantrequirement.requirementstatus', 1);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

      // for view all reportrequirement
       public function viewrequirementdetail($datenow){ 
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.applicantID, tblapplicantrequirement.completerequirement, tblapplicantrequirement.lackingrequirement, tblapplicantrequirement.file, tblapplicantrequirement.dateprocess')->from('tblapplicantrequirement')
        ->join('tblapplicant', 'tblapplicantrequirement.applicantID = tblapplicant.applicantID', 'inner')->where('tblapplicantrequirement.requirementstatus', 1)->where('dateprocess =', $datenow);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }

       // for view all reportrequirement
       public function filterrequirement($month, $year){ 
        $this->db->select('tblapplicant.firstname, tblapplicant.lastname, tblapplicant.contact, tblapplicant.emailadd, tblapplicant.address, tblapplicant.applicantID, tblapplicantrequirement.completerequirement, tblapplicantrequirement.lackingrequirement, tblapplicantrequirement.file, tblapplicantrequirement.dateprocess')->from('tblapplicantrequirement')
        ->join('tblapplicant', 'tblapplicantrequirement.applicantID = tblapplicant.applicantID', 'inner')->where('tblapplicantrequirement.requirementstatus', 1)->where('MONTH(dateprocess) =', $month)->where('YEAR(dateprocess) =', $year);
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }


        // for view department name
      public function selectlocation($data){ 
        $this->db->select('*')->from('tbllocation')->where(array('locationID'=> $data['locationID']));;
        $query=$this->db->get();
        return $query->result_array();
        $db->close();
      }
        // for update client name
        public function updateapplicantrequirement($data, $applicantid) { 
         $this->db->set($data); 
         $this->db->where("applicantID", $applicantid); 
         $this->db->update("tblapplicantrequirement"); 
      } 
          // for delete location
        public function deletelocation($locationid) { 
         if ($this->db->delete("tbllocation", "locationID = ".$locationid)) { 
            return true; 
         } 
      }
   } 
?> 