<?php 
   class EmployeeController extends CI_Controller {
   
      function __construct() { 
         parent::__construct(); 
 
         $this->load->database(); 
         $this->load->model('Employee_Model');
         $this->load->model('User_Model');
         $this->load->model('Client_Model');
         $this->load->model('Chat_Model');
         $this->load->model('Applicant_Model');
         $this->load->model('Attendance_Model');
         $this->load->model('Resignation_Model');
         $this->load->model('Scheduleemployee_Model');

      } 
      // view attendance for employee
      public function view_attendance() {    
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month;
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );    
        $firstDay = mktime(0,0,0,$month, 1, $year);
        $timestamp = $firstDay;
        $weekDays = array();
        for ($i = 0; $i < 31; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
          } 
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['weekDays']=$weekDays;
        $records['useradmin']=$this->User_Model->usertype();
        $records['employeeatendance']=$this->Attendance_Model->viewattendanceemployee($set_data['clientID'], $datenow);
        $this->load->view('attendanceemployee', $records);
      } 

      public function exportattendance(){
        date_default_timezone_set("Asia/Manila");
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $date= date("Y-m-d");
        $nowyear = date('Y', strtotime($date));
        $nowmonth = date('m', strtotime($date));
        $m = date('F', strtotime($date));
        $datenow = $nowyear ."-". $nowmonth; 
        $date2 = $year ."-". $month; 
        $m2 = date('F', strtotime($date2));

        $set_data = $this->session->userdata('userlogin'); //session data
        $noweemployee = $this->Attendance_Model->viewattendanceemployee($set_data['clientID'], $datenow);
        $selectattendance = $this->Attendance_Model->filterattendance($set_data['clientID'], $month, $year); 

        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
         //change the font size
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setSize(20);
        //make the font become bold
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:AG2')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A3:AG3')->getFont()->setBold(true);
        //merge cell A1 until D1
        $objPHPExcel->getActiveSheet()->mergeCells('G1:O1');
        //set aligment to center for that merged cell (A1 to D1)
        $objPHPExcel->getActiveSheet()->getStyle('G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'First Name');
        $objPHPExcel->getActiveSheet()->setCellValue('B3', 'Last Name');
        $objPHPExcel->getActiveSheet()->setCellValue('C3', '1');
        $objPHPExcel->getActiveSheet()->setCellValue('D3', '2');
        $objPHPExcel->getActiveSheet()->setCellValue('E3', '3');
        $objPHPExcel->getActiveSheet()->setCellValue('F3', '4');
        $objPHPExcel->getActiveSheet()->setCellValue('G3', '5');
        $objPHPExcel->getActiveSheet()->setCellValue('H3', '6');
        $objPHPExcel->getActiveSheet()->setCellValue('I3', '7');
        $objPHPExcel->getActiveSheet()->setCellValue('J3', '8');
        $objPHPExcel->getActiveSheet()->setCellValue('K3', '9');
        $objPHPExcel->getActiveSheet()->setCellValue('L3', '10');
        $objPHPExcel->getActiveSheet()->setCellValue('M3', '11');
        $objPHPExcel->getActiveSheet()->setCellValue('N3', '12');
        $objPHPExcel->getActiveSheet()->setCellValue('O3', '13');
        $objPHPExcel->getActiveSheet()->setCellValue('P3', '14');
        $objPHPExcel->getActiveSheet()->setCellValue('Q3', '15');
        $objPHPExcel->getActiveSheet()->setCellValue('R3', '16');
        $objPHPExcel->getActiveSheet()->setCellValue('S3', '17');
        $objPHPExcel->getActiveSheet()->setCellValue('T3', '18');
        $objPHPExcel->getActiveSheet()->setCellValue('U3', '19');
        $objPHPExcel->getActiveSheet()->setCellValue('V3', '20');
        $objPHPExcel->getActiveSheet()->setCellValue('W3', '21');
        $objPHPExcel->getActiveSheet()->setCellValue('X3', '22');
        $objPHPExcel->getActiveSheet()->setCellValue('Y3', '23');
         $objPHPExcel->getActiveSheet()->setCellValue('Z3', '24');
        $objPHPExcel->getActiveSheet()->setCellValue('AA3', '25');
        $objPHPExcel->getActiveSheet()->setCellValue('AB3', '26');
        $objPHPExcel->getActiveSheet()->setCellValue('AC3', '27');
        $objPHPExcel->getActiveSheet()->setCellValue('AD3', '28');
        $objPHPExcel->getActiveSheet()->setCellValue('AE3', '29');
        $objPHPExcel->getActiveSheet()->setCellValue('AF3', '30');
        $objPHPExcel->getActiveSheet()->setCellValue('AG3', '31');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        
        $na = array(
            'font'  => array(
            'color' => array('rgb' => '337ab7'),
        ));
        $present = array(
            'font'  => array(
            'color' => array('rgb' => '419641'),
        ));
        $absent = array(
            'font'  => array(
            'color' => array('rgb' => 'c12e2a'),
        ));
        $late = array(
            'font'  => array(
            'color' => array('rgb' => '4d5666'),
        ));
        $off = array(
            'font'  => array(
            'color' => array('rgb' => 'f0ad4e'),
        ));
        $holiday = array(
            'font'  => array(
            'color' => array('rgb' => '404548'),
        ));

        if ($month == "" && $year == ""){
        $firstDay = mktime(0,0,0,$nowmonth, 1, $nowyear);
        $timestamp = $firstDay;
        $weekDays = array();
        for ($i = 0; $i < 31; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
          } 

        $objPHPExcel->getProperties()->setTitle("Attendance")->setDescription("Attendance");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Employees Attendance'. " " .$m ." " .$nowyear);

        $col = 2;
        foreach($weekDays as $weekDay) 
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $weekDay);
            $col++;
        }
        $row = 4;
        foreach($noweemployee as $data){
                $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $data['firstname']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data['lastname']);
                $objPHPExcel->getActiveSheet()->setCellValue('AH'. $row, $data['attendanceID']);
                $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setVisible(false);
                //day1
                if ($data['day1']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day1']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day1']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day1']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day1']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day1']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('C' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day2
                if ($data['day2']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day2']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day2']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day2']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day2']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day2']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('D' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);  
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day3
                if ($data['day3']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day3']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day3']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day3']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                 else if ($data['day3']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day3']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('E' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day4
                if ($data['day4']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day4']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day4']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day4']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day4']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day4']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('F' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day5
               if ($data['day5']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day5']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day5']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day5']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day5']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day5']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('G' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day6
                if ($data['day6']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day6']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day6']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day6']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
               else if ($data['day6']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day6']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('H' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //DAY7
                if ($data['day7']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day7']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day7']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day7']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day7']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day7']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('I' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day8
                if ($data['day8']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day8']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day8']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day8']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day8']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day8']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('J' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day9
                if ($data['day9']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day9']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day9']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day9']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day9']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day9']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('K' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day10
                if ($data['day10']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day10']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day10']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day10']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day10']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day10']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{$objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('L' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day11
                if ($data['day11']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day11']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day11']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day11']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day11']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day11']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('M' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day12
                if ($data['day12']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day12']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day12']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day12']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day12']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day12']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('N' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day13
                if ($data['day13']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day13']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day13']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day13']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day13']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day13']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('O' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day14
                if ($data['day14']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day14']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day14']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day14']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day14']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day14']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('P' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day15
                if ($data['day15']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day15']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day15']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day15']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day15']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day15']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Q' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day16
                if ($data['day16']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day16']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day16']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day16']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day16']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day16']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('R' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day17
                if ($data['day17']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day17']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day17']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day17']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day17']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day17']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('S' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day18
                if ($data['day18']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day18']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day18']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day18']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day18']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day18']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('T' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day19
                if ($data['day19']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day19']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day19']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day19']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day19']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day19']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('U' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day20
                if ($data['day20']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day20']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day20']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day20']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day20']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day20']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{

                   $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('V' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day21
                if ($data['day21']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day21']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day21']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day21']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day21']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day21']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('W' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day22
                if ($data['day22']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day22']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day22']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day22']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day22']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day22']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('X' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day23
                if ($data['day23']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day23']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day23']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day23']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day23']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day23']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Y' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day24
                if ($data['day24']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day24']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day24']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day24']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day24']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day24']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Z' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day25
                if ($data['day25']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day25']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day25']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day25']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day25']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day25']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AA' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day26
               if ($data['day26']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day26']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day26']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day26']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day26']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day26']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AB' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day27
                if ($data['day27']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day27']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day27']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day27']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day27']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day27']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AC' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day28
                if ($data['day28']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day28']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day28']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day28']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day28']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day28']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AD' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day29
                if ($data['day29']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day29']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day29']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day29']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day29']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day29']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AE' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day30
                if ($data['day30']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day30']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day30']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day30']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day30']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day30']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AF' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day31
                if ($data['day31']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day31']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day31']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day31']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day31']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day31']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AG' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }

                 $row++;
            }
          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');;
        header('Content-Disposition: attachment;filename="Attendance'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
    /// for filter
    else
    {
        $firstDay = mktime(0,0,0,$month, 1, $year);
        $timestamp = $firstDay;
        $weekDays = array();
        for ($i = 0; $i < 31; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
          } 

        $objPHPExcel->getProperties()->setTitle("Attendance")->setDescription("Attendance");
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Employees Attendance'. " " .$m2 ." " .$year);

        $col = 2;
        foreach($weekDays as $weekDay) 
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 2, $weekDay);
            $col++;
        }
        $row = 4;
        foreach($selectattendance as $data){
                $objPHPExcel->getActiveSheet()->setCellValue('A'. $row, $data['firstname']);
                $objPHPExcel->getActiveSheet()->setCellValue('B'. $row, $data['lastname']);
                $objPHPExcel->getActiveSheet()->setCellValue('AH'. $row, $data['attendanceID']);
                $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setVisible(false);
                //day1
                if ($data['day1']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day1']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day1']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day1']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day1']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day1']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('C'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('C' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day2
                if ($data['day2']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day2']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day2']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day2']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day2']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day2']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('D'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('D' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);  
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day3
                if ($data['day3']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day3']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day3']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day3']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                 else if ($data['day3']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day3']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('E'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('E' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day4
                if ($data['day4']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day4']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day4']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day4']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day4']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day4']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('F'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('F' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day5
               if ($data['day5']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day5']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day5']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day5']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day5']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day5']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('G'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('G' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day6
                if ($data['day6']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day6']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day6']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day6']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
               else if ($data['day6']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day6']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('H'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('H' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //DAY7
                if ($data['day7']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day7']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day7']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day7']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day7']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day7']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('I'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('I' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day8
                if ($data['day8']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day8']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day8']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day8']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day8']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day8']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('J'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('J' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day9
                if ($data['day9']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day9']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day9']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day9']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day9']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day9']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('K'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('K' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day10
                if ($data['day10']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day10']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day10']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day10']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day10']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day10']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{$objPHPExcel->getActiveSheet()->getCell('L'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('L' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day11
                if ($data['day11']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day11']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day11']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day11']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day11']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day11']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('M' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day12
                if ($data['day12']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day12']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day12']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day12']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day12']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day12']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('N'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('N' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day13
                if ($data['day13']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day13']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day13']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day13']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day13']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day13']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('O'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('O' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day14
                if ($data['day14']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day14']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day14']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day14']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day14']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day14']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('P'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('P' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day15
                if ($data['day15']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day15']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day15']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day15']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day15']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day15']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('Q'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Q' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day16
                if ($data['day16']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day16']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day16']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day16']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day16']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day16']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('R'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('R' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day17
                if ($data['day17']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day17']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day17']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day17']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('M'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day17']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day17']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('S'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('S' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day18
                if ($data['day18']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day18']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day18']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day18']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day18']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day18']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('T'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('T' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day19
                if ($data['day19']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day19']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day19']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day19']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day19']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day19']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('U'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('U' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day20
                if ($data['day20']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day20']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day20']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day20']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day20']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day20']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{

                   $objPHPExcel->getActiveSheet()->getCell('V'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('V' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day21
                if ($data['day21']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day21']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day21']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day21']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day21']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day21']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('W'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('W' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day22
                if ($data['day22']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day22']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day22']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day22']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day22']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day22']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('X'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('X' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day23
                if ($data['day23']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day23']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day23']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day23']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day23']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day23']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('Y'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Y' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day24
                if ($data['day24']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day24']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day24']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day24']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day24']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day24']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('z'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('z'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('Z'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('Z' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day25
                if ($data['day25']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day25']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day25']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day25']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day25']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day25']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AA'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AA' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day26
               if ($data['day26']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day26']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day26']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day26']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day26']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day26']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objPHPExcel->getActiveSheet()->getCell('AB'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AB' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day27
                if ($data['day27']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day27']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day27']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day27']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day27']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day27']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AC'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AC' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day28
                if ($data['day28']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day28']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day28']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day28']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day28']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day28']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AD'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AD' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day29
                if ($data['day29']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day29']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day29']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day29']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day29']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day29']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AE'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AE' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day30
                if ($data['day30']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day30']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day30']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day30']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day30']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day30']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AF'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AF' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }
                //day31
                if ($data['day31']=="na"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('na')->getStyle()->applyFromArray($na);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('na')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('337ab7');
                }
                else if ($data['day31']=="P"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('P')->getStyle()->applyFromArray($present);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('P')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('419641');
                }
                else if ($data['day31']=="A"){ 
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('A')->getStyle()->applyFromArray($absent);
                $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('A')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('c12e2a');
                }
                else if ($data['day31']=="L"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('L')->getStyle()->applyFromArray($late);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('L')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('4d5666');
                }
                else if ($data['day31']=="H"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('H')->getStyle()->applyFromArray($holiday);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('H')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('404548');
                }
                else if ($data['day31']=="off"){ 
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('off')->getStyle()->applyFromArray($off);
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue('off')->getStyle()->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('f0ad4e');
                }
                else{
                  $objPHPExcel->getActiveSheet()->getCell('AG'. $row)->setValue()->getStyle()->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
                   $objValidation2 = $objPHPExcel->getActiveSheet()->getCell('AG' . $row)->getDataValidation();
                   $objValidation2->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                   $objValidation2->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_INFORMATION);
                   $objValidation2->setAllowBlank(false);
                   $objValidation2->setShowInputMessage(true);
                   $objValidation2->setShowDropDown(true);
                   $objValidation2->setPromptTitle('Pick from list');
                   $objValidation2->setPrompt('Please pick a value from the drop-down list. Note the Letter P, A, H, L and off is abbreviated to (Present, Absent, Holiday, Late and Day Off');
                   $objValidation2->setErrorTitle('Input error');
                   $objValidation2->setError('Value is not in list');
                   $objValidation2->setFormula1('"P,A,H,L,off"');
                }

                 $row++;
            }
          
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');;
        header('Content-Disposition: attachment;filename="Attendance'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

  }

        public function attendanceemployee() {  
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month; 
        $firstDay = mktime(0,0,0,$month, 1, $year);
        $timestamp = $firstDay;
        $weekDays = array();
        for ($i = 0; $i < 31; $i++) {
            $weekDays[] = strftime('%a', $timestamp);
            $timestamp = strtotime('+1 day', $timestamp);
          } 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['weekDays']=$weekDays;
        $records['useradmin']=$this->User_Model->usertype();
        $records['employeeatendance']=$this->Attendance_Model->viewattendanceemployee($set_data['clientID'], $datenow);
        $this->load->view('transattendance', $records);
      } 

      public function schedule_employee(){
       date_default_timezone_set("Asia/Manila");
       $date= date("Y-m-d");
       $year = date('Y', strtotime($date));
       $month = date('m', strtotime($date));
       $datenow = $year ."-". $month; 
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
       // $data2 = array("dateremain"  => $date
                      //);
       // $this->Employee_Model->employeeremainmonth($data2, 1);
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['deployapplicants']=$this->Employee_Model->view_scheduleemployee($data['clientID'], $datenow);
        $this->load->view('schedule', $records);
      }

      public function viewemployee() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
              );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['deployemployee']=$this->Employee_Model->viewalldeployapplicant();
       $this->load->view('deployemployee', $records);
      }  
       public function request() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['deployemployee']=$this->Employee_Model->viewalldeployapplicant();
       $this->load->view('employee', $records);
      }  

        //for add applicant plot
      public function add_employee() { 
        $set_data = $this->session->userdata('userlogin'); //session data

         $this->form_validation->set_rules('branchname','Branch Name','trim|required|xss_clean');
         $this->form_validation->set_rules('department','Department','trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');

             if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
                echo json_encode(array("response" => "error", "err" => validation_errors()));
             } 

          else{
                $data = array('userID'=> $set_data['userID'],
                              'applicantID'=> $this->input->post('applicantid'),
                              'branchID' => $this->input->post('branchname'),
                              'locationID' => $this->input->post('department'),
                              'status' => 'Activate'
                               );
                $statusapplicant =array('status' => 9,
                                        'datedeploy' => date('Y-m-d') 
                        );

                $this->Employee_Model->addemployee($data);
                $this->Applicant_Model->updateapplicantstatus($statusapplicant, $data['applicantID']);

                echo json_encode(array("response" => "success", "message" => "Successfully added to employee", "redirect" => "UserController/dashboard"));
                }

             }
              // select employ employee
            public function viewdeployemployee($employeeid){
              $employeeid = $this->input->get('employeeid');
              $data=array();
                $selectemployee = $this->Employee_Model->view_deployemployee($employeeid); 
                foreach ($selectemployee as $value) {
                  $data=$value;
                  echo json_encode($data); 
               }           
           }
            // select employ employee
            public function viewattendance_employee($attendanceid){
              $attendanceid = $this->input->get('attendanceid');
              $data=array();
                $selectattendance = $this->Attendance_Model->selectattendanceemployee($attendanceid); 
                foreach ($selectattendance as $value) {
                  $data=$value;
                  echo json_encode($data); 
               } 
              
           }

            public function filter_attendance(){
              date_default_timezone_set("Asia/Manila");
              $date= date("Y-m-d");
              $month = $this->input->post('month');
              $year = $this->input->post('year');
              $set_data = $this->session->userdata('userlogin'); //session data
              $data=array();
                $firstDay = mktime(0,0,0,$month, 1, $year);
                $timestamp = $firstDay;
                $weekDays = array();
                for ($i = 0; $i < 31; $i++) {
                  $weekDays[] = strftime('%a', $timestamp);
                  $timestamp = strtotime('+1 day', $timestamp);
                }
               $selectattendance = $this->Attendance_Model->filterattendance($set_data['clientID'], $month, $year); 
                $data= $selectattendance;
                echo json_encode(array("numberofdays" => $data, "weekDays" => $weekDays)); 
              } 


        //for add applicant plot
       public function addschedule_employee() { 

         $this->form_validation->set_rules('datestart','Date Start','trim|required|xss_clean');
         $this->form_validation->set_rules('starttime', 'Schedule for In time', 'trim|required|xss_clean');
         $this->form_validation->set_rules('endtime', 'Schedule for Out time', 'trim|required|xss_clean');
         $this->form_validation->set_rules('dayoff', 'Day off', 'trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');

          if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
              echo json_encode(array("response" => "error", "err" => validation_errors()));
            } 
          else{
               date_default_timezone_set("Asia/Manila");
               $date= date("Y-m-d");
               $year = date('Y', strtotime($date));
               $datenow = $year ."-". 12 ."-". 31;
               $set_data = $this->session->userdata('userlogin'); //session data
               $applicantid=$this->input->post('applicantid');
               $employeeid=$this->input->post('employeeid');
               $clientid=$this->input->post('clientid');
               $datestart =  $this->input->post('datestart');
               $dateremain = $this->input->post('datestart');
               $datecontract = $datenow;
               $starttime = $this->input->post('starttime');
               $endtime = $this->input->post('endtime');
               $dayoff = $this->input->post('dayoff');
               $na = 'na'; 
               $dateprocess = date("Y-m-d"); 

                $day = date("j", strtotime($datestart));
                $month = date('m', strtotime($datestart));
                $year = date('Y', strtotime($datestart));
                $firstDay = mktime(0,0,0,$month, $day, $year);
                $countday = 32 - $day;
                $timestamp = $firstDay;
                $weekDays = array();
                for ($i = 0; $i < $countday; $i++) {
                  $weekDays[] = strftime('%a', $timestamp);
                  $timestamp = strtotime('+1 day', $timestamp);
                }
                $start = array();
                    foreach($weekDays as $weekDay){
                    if ($weekDay == $dayoff){
                         $off ='off';
                      }
                    else{
                       $off = '';
                    }
                      $start[]=$off;
                  }

                $this->Employee_Model->addscheduleemployee($datestart, $dateremain, $datecontract, $starttime, $endtime, $dayoff, $employeeid);
                $this->Scheduleemployee_Model->addscheduleemployee($set_data['clientID'], $employeeid, $applicantid, $datestart, $starttime, $endtime, $dayoff, $dateprocess);

                if ($day == 2){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                     $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 3){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 4){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na,$start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 5){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 6){  
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 7){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $datestart, $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 8){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $datestart, $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 9){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 10){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 11){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 12){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 13){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 14){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                      $start[17], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 15){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 16){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 17){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 18){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 19){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 20){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 21){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 22){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 23){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 24){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 25){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 26){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 27){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 28){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 29){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 30){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 31){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else{
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                     $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29], $start[30], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                echo json_encode(array("response" => "success", "message" => "Successfully Added Employee", "redirect" => "CLientController/dashboard"));
                }
             }

      //for change schedule employeee
       public function changeschedule_employee() { 

         $this->form_validation->set_rules('datestart','Date Start','trim|required|xss_clean');
         $this->form_validation->set_rules('starttime', 'Schedule for In time', 'trim|required|xss_clean');
         $this->form_validation->set_rules('endtime', 'Schedule for Out time', 'trim|required|xss_clean');
         $this->form_validation->set_rules('dayoff', 'Day off', 'trim|required|xss_clean');
         $this->form_validation->set_error_delimiters('',   '');

          if ($this->form_validation->run() == FALSE){              
                        //catch to the errors
              echo json_encode(array("response" => "error", "message" => validation_errors()));
            } 
          else{
               $set_data = $this->session->userdata('userlogin'); //session data

               $applicantid = $this->input->post('applicantid');
               $employeeid = $this->input->post('employeeid');
               $clientid = $this->input->post('clientid');
               $attendanceid = $this->input->post('attendanceid');

               $datestart =  $this->input->post('datestart');
               $dateschedule =  $this->input->post('dateschedule');
               $starttime = $this->input->post('starttime');
               $endtime = $this->input->post('endtime');
               $dayoff = $this->input->post('dayoff');
               $day1 = $this->input->post('day1');
               $day2 = $this->input->post('day2');
               $day3 = $this->input->post('day3');
               $day4 = $this->input->post('day4');
               $day5 = $this->input->post('day5');
               $day6 = $this->input->post('day6');
               $day7 = $this->input->post('day7');
               $day8 = $this->input->post('day8');
               $day9 = $this->input->post('day9');
               $day10 = $this->input->post('day10');
               $day11 = $this->input->post('day11');
               $day12 = $this->input->post('day12');
               $day13 = $this->input->post('day13');
               $day14 = $this->input->post('day14');
               $day15 = $this->input->post('day15');
               $day16 = $this->input->post('day16');
               $day17 = $this->input->post('day17');
               $day18 = $this->input->post('day18');
               $day19 = $this->input->post('day19');
               $day20 = $this->input->post('day20');
               $day21 = $this->input->post('day21');
               $day22 = $this->input->post('day22');
               $day23 = $this->input->post('day23');
               $day24 = $this->input->post('day24');
               $day25 = $this->input->post('day25');
               $day26 = $this->input->post('day26');
               $day27 = $this->input->post('day27');
               $day28 = $this->input->post('day28');
               $day29 = $this->input->post('day29');
               $day30 = $this->input->post('day30');
               $day31 = $this->input->post('day31');
               $na = 'na'; 
               $dateprocess = date("Y-m-d"); 

                $day = date("j", strtotime($datestart));
                $month = date('m', strtotime($datestart));
                $year = date('Y', strtotime($datestart));
                $nowmonth = date('m', strtotime($dateschedule));
                
               if ($nowmonth < $month){

                $firstDay = mktime(0,0,0,$nowmonth, $day, $year);
                $countday = 32 - $day;
                $timestamp = $firstDay;
                $weekDays = array();
                for ($i = 0; $i < $countday; $i++) {
                    $weekDays[] = strftime('%a', $timestamp);
                    $timestamp = strtotime('+1 day', $timestamp);
                }
                 $start = array();
                   foreach($weekDays as $weekDay){
                    if ($weekDay == $dayoff){
                         $off ='off';
                      }
                    else{
                       $off = '';
                    }
                      $start[]=$off;
                  }
                $this->Scheduleemployee_Model->addscheduleemployee($set_data['clientID'], $employeeid, $applicantid,  $datestart, $starttime, $endtime, $dayoff, $dateprocess);

                if ($day == 2){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                     $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 3){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 4){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na,$start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 5){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 6){  
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 7){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $datestart, $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 8){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $datestart, $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 9){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 10){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 11){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 12){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 13){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 14){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                      $start[17], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 15){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 16){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 17){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 18){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 19){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 20){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 21){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 22){
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 23){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 24){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 25){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 26){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 27){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $start[4], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 28){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $start[3], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 29){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $start[2], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else if ($day == 30){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $start[1], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);

                }
                else if ($day == 31){
                   $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $na, $start[0], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                else{
                     $this->Attendance_Model->insertattendance($employeeid, $clientid, $applicantid, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                     $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29], $start[30], $datestart, $datestart, $starttime, $endtime, $starttime,  $endtime, $dayoff, $dayoff);
                }
                echo json_encode(array("response" => "success", "message" => "Successfully Updated Attendance", "redirect" => "EmployeeController/schedule_employee"));
                }
               else if ($month == $nowmonth){
               $firstDay = mktime(0,0,0,$month, $day, $year);
                $countday = 32 - $day;
                $timestamp = $firstDay;
                $weekDays = array();
                for ($i = 0; $i < $countday; $i++) {
                    $weekDays[] = strftime('%a', $timestamp);
                    $timestamp = strtotime('+1 day', $timestamp);
                }
                 $start = array();
                   foreach($weekDays as $weekDay){
                    if ($weekDay == $dayoff){
                         $off ='off';
                      }
                    else{
                       $off = '';
                    }
                      $start[]=$off;
                  }

                $this->Scheduleemployee_Model->addscheduleemployee($set_data['clientID'], $employeeid, $applicantid,  $datestart, $starttime, $endtime, $dayoff, $dateprocess);

                if ($day == 2){
                     $this->Attendance_Model->updateatendance($day1, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                     $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 3){
                     $this->Attendance_Model->updateatendance($day1, $day2, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 4){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3,$start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 5){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 6){  
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 7){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 8){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 9){
                     $this->Attendance_Model->updateatendance($employeeid, $clientid, $applicantid, $day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $start[22], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 10){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $start[21], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 11){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $start[20], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 12){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $start[19], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 13){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                     $start[17], $start[18], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 14){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16],
                      $start[17], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 15){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $start[16], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 16){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $start[15], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 17){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $start[14], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 18){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11],  $start[12], $start[13], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 19){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 20){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 21){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 22){
                     $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 23){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 24){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 25){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 26){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 27){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $start[0], $start[1], $start[2], $start[3], $start[4], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 28){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $day27, $start[0], $start[1], $start[2], $start[3], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 29){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $day27, $day28, $start[0], $start[1], $start[2], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 30){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $day27, $day28, $day29, $start[0], $start[1], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else if ($day == 31){
                   $this->Attendance_Model->updateatendance($day1, $day2, $day3, $day4, $day5, $day6, $day7, $day8, $day9, $day10, $day11, $day12, $day13, $day14, $day15, $day16, $day17, $day18, $day19, $day20, $day21, $day22, $day23, $day24, $day25, $day26, $day27, $day28, $day29, $day30, $start[0], $datestart, $starttime, $endtime, $dayoff, $attendanceid);
                }
                else{
                  $this->Attendance_Model->updateatendance($start[0], $start[1], $start[2], $start[3], $start[4], $start[5], $start[6], $start[7], $start[8], $start[9], $start[10], $start[11], $start[12],  $start[13], $start[14], $start[15], $start[16], $start[17],
                    $start[18], $start[19], $start[20], $start[21], $start[22], $start[23], $start[24], $start[25], $start[26], $start[27], $start[28], $start[29],$start[30], $datestart, $starttime, $endtime, $dayoff, $attendanceid);                }
                    echo json_encode(array("response" => "success", "message" => "Successfully change Attendance", "redirect" => "EmployeeController/schedule_employee"));
                }
             }


             }
  

       public function import_attendance(){
         $uploadOk = 1;
         $configUpload['upload_path'] = FCPATH.'uploads/';
         $configUpload['allowed_types'] = 'xls|xlsx|csv';
         $configUpload['file_name'] = 'Attendance' .uniqid() . '_' . date('Y-m-d');
         $configUpload['max_size'] = '5000';
         $this->load->library('upload', $configUpload);
         $this->load->library('excel');

          if (!$this->upload->do_upload('file')){
              echo json_encode(array("response" => "error", "message" => $this->upload->display_errors('','')));  
            }           
          else{
          //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
          $objReader= PHPExcel_IOFactory::createReader('Excel5'); // For excel 2007     
          //Set to read only
          $objReader->setReadDataOnly(true);          
        //Load excel file
          $media = $this->upload->data();
          $inputFileName = FCPATH.'./uploads/'.$media['file_name'];
          $objPHPExcel=$objReader->load($inputFileName);     
          $allDataInSheet=$objPHPExcel->getActiveSheet()->toArray(null,true,true,true);  
          $arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet       
          $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);  
                    //loop from first data untill last data
            for($i=2;$i<=$arrayCount;$i++)
            {
             $attendanceid = trim($allDataInSheet[$i]["AH"]);
             $day1 = trim($allDataInSheet[$i]["C"]);
             $day2 = trim($allDataInSheet[$i]["D"]);
             $day3 = trim($allDataInSheet[$i]["E"]);
             $day4 = trim($allDataInSheet[$i]["F"]);
             $day5 = trim($allDataInSheet[$i]["G"]);
             $day6 = trim($allDataInSheet[$i]["H"]);
             $day7 = trim($allDataInSheet[$i]["I"]);
             $day8 = trim($allDataInSheet[$i]["J"]);
             $day9 = trim($allDataInSheet[$i]["K"]);
             $day10 = trim($allDataInSheet[$i]["L"]);
             $day11 = trim($allDataInSheet[$i]["M"]);
             $day12 = trim($allDataInSheet[$i]["N"]);
             $day13 = trim($allDataInSheet[$i]["O"]);
             $day14 = trim($allDataInSheet[$i]["P"]);
             $day15 = trim($allDataInSheet[$i]["Q"]);
             $day16 = trim($allDataInSheet[$i]["R"]);
             $day17 = trim($allDataInSheet[$i]["S"]);
             $day18 = trim($allDataInSheet[$i]["T"]);
             $day19 = trim($allDataInSheet[$i]["U"]);
             $day20 = trim($allDataInSheet[$i]["V"]);
             $day21 = trim($allDataInSheet[$i]["W"]);
             $day22 = trim($allDataInSheet[$i]["X"]);
             $day23 = trim($allDataInSheet[$i]["Y"]);
             $day24 = trim($allDataInSheet[$i]["Z"]);
             $day25 = trim($allDataInSheet[$i]["AA"]);
             $day26 = trim($allDataInSheet[$i]["AB"]);
             $day27 = trim($allDataInSheet[$i]["AC"]);
             $day28 = trim($allDataInSheet[$i]["AD"]);
             $day29 = trim($allDataInSheet[$i]["AE"]);
             $day30 = trim($allDataInSheet[$i]["AF"]);
             $day31 = trim($allDataInSheet[$i]["AG"]);

             $data = array('attendanceID' => $attendanceid, 
                           'day1' => $day1,
                           'day2' => $day2,
                           'day3' => $day3,
                           'day4' => $day4,
                           'day5' => $day5,
                           'day6' => $day6,
                           'day7' => $day7,
                           'day8' => $day8,
                           'day9' => $day9,
                           'day10' => $day10,
                           'day11' => $day11,
                           'day12' => $day12,
                           'day13' => $day13,
                           'day14' => $day14,
                           'day15' => $day15,
                           'day16' => $day16,
                           'day17' => $day17,
                           'day18' => $day18,
                           'day19' => $day19,
                           'day20' => $day20,
                           'day21' => $day21,
                           'day22' => $day22,
                           'day23' => $day23,
                           'day24' => $day24,
                           'day25' => $day25,
                           'day26' => $day26,
                           'day27' => $day27,
                           'day28' => $day28,
                           'day29' => $day29,
                           'day30' => $day30,
                           'day31' => $day31
                          );
            $this->Attendance_Model->scheduleattendance($data, $data['attendanceID']);              
          }
           echo json_encode(array("response" => "success", "message" => "Successfully to Import attendance", "redirect" => "EmployeeController/attendanceemployee"));           
        }   
    }

      public function feedback_employee(){
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
       $datenow = date("Y-m-d");
       $status = "Activate";
       $year= date("Y", strtotime($datenow));
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['deployapplicants']=$this->Employee_Model->view_contract($data['clientID'], $year, $status);
        
        if  ($set_data['username']){
            $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('transcontract', $records); 
        }
        else {
                $this->load->view('login');
        }
      }

       // forr update status employee
      public function updatestatus_employee(){
           $this->form_validation->set_rules('status', 'Status' ,'trim|required|xss_clean');
           $this->form_validation->set_error_delimiters('','');

           if ($this->form_validation->run() == FALSE){
                echo json_encode(array("response" => "error" , "err" => validation_errors()));
           }
           else{
                $datenow = date("Y-m-d");
                $data = array("applicantID" => $this->input->post('applicantid'),
                              "employeeID" => $this->input->post('employeeid'), 
                              "status" => $this->input->post('status')
                        );
                 $data2 = array("applicantID" => $this->input->post('applicantid'),
                                "employeeID" => $this->input->post('employeeid'),
                                "clientID" => $this->input->post('clientid'),
                                "branchID" => $this->input->post('branchid'),
                                "locationID" => $this->input->post('locationid'), 
                                "dateterminate" => $datenow, 
                                "status" => $this->input->post('status')
                        );
                    $this->Employee_Model->updateemployeestatus($data, $data['employeeID']);
                    if ($data['status'] == 'Terminate'){
                        $this->Applicant_Model->updateapplicantstatuscontract(10, $data['applicantID']);
                        $this->Resignation_Model->insertregination($data2);
                    }
                    else{
                       $this->Applicant_Model->updateapplicantstatuscontract(11, $data['applicantID']); 
                       $this->Resignation_Model->insertregination($data2);
                    }
                    echo json_encode(array("response" => "success" , "message" => "Successfully updated Status", "redirect" => 'EmployeeController/feedback_employee'));
             }
         }
        public function status_employee() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
                       );       
        $records['userprofile']=$this->User_Model->userprofile($data);
        $records['employeeresignation']=$this->Resignation_Model->view_resignation();
        $this->load->view('terminate', $records);
      } 
        public function employee_status() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                       );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['employeeresignation']=$this->Resignation_Model->view_resignation();
        $this->load->view('terminate2', $records);       
      } 

      // view employeeattena
       public function view_employeeatendance(){
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['viewattendanceemployee']=$this->Employee_Model->view_attendanceemployee($data['clientID'], $year);
        
        if  ($set_data['username']){
              $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('attendancedetail', $records); 
        }
        else {
                $this->load->view('login');
        }
      }
        // filter employee Attendance detail
           public function filter_employeedetail(){
              date_default_timezone_set("Asia/Manila");
              $date= date("Y-m-d");
              $year = $this->input->post('year');
              $status = $this->input->post('status');
              $set_data = $this->session->userdata('userlogin'); //session data
              $data=array();
              $selectattendance = $this->Employee_Model->filterattendance_employee($set_data['clientID'], $year, $status); 
              $data= $selectattendance;
              echo json_encode($data); 
          }

        public function view_reportattendance() {    
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );
        $records['useradmin']=$this->User_Model->usertype();
        $employeeid = $this->uri->segment(3);
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['clientname'] = strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['employeereportatendance']=$this->Attendance_Model->viewreport_attendanceemployee($set_data['clientID'], $employeeid);
          if  ($set_data['username']){
              $this->load->view('reportattendance', $records); 
           }
        else{
              $this->load->view('login');
          }
        }
        //contract detail of employee
        public function viewcontract_reportemployee() {    
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );
        $records['useradmin']=$this->User_Model->usertype();
        $employeeid = $this->uri->segment(3);
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['clientname'] = strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['employeecontract']=$this->Client_Model->viewcontractemployee($set_data['clientID'], $employeeid);
          if  ($set_data['username']){
              $this->load->view('contractdetail', $records); 
           }
        else{
              $this->load->view('login');
          }
        }
    // view employeeattena
       public function view_deploymentattendance(){
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month;
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );

        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['username']=  strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['viewdeployapplicant']=$this->Employee_Model->viewdeployapplicant($data['clientID'], $datenow);
        
        if  ($set_data['username']){
              $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('reportdeploy', $records); 
        }
        else {
                $this->load->view('login');
        }
      }  

       // view employeeattena
       public function view_deploymentemployee(){
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $datenow = $year ."-". $month;
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('clientID' => $set_data['clientID']
                      );

        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['username']=  strtoupper($set_data['firstname']) ." ". strtoupper($set_data['lastname']);
        $records['viewdeployapplicant']=$this->Employee_Model->viewdeployapplicant($data['clientID'], $datenow);
        
        if  ($set_data['username']){
              $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('deployemployeeclient', $records); 
        }
        else {
                $this->load->view('login');
        }
      }    
        //filter employee deploy detail
           public function filter_deployemployee(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $status = $this->input->post('status');
              $set_data = $this->session->userdata('userlogin'); //session data
              $data=array();
              $selectdeployemployee = $this->Employee_Model->filterdeployemployee($set_data['clientID'], $month, $year, $status); 
              $data= $selectdeployemployee;
              echo json_encode($data); 
          }   
          //filter all employee deploy detail
           public function filter_alldeployemployee(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $set_data = $this->session->userdata('userlogin'); //session data
              $data=array();
              $selectdeployemployee = $this->Employee_Model->filteralldeployemployee($month, $year); 
              $data= $selectdeployemployee;
              echo json_encode($data); 
          }  

              //filter all employee deploy detail to staff
           public function filter_alldeployemployeestaff(){
              $year = $this->input->post('year');
              $month = $this->input->post('month');
              $data=array();
              $selectdeployemployee = $this->Employee_Model->filterdeployemployeestaff($month, $year); 
              $data= $selectdeployemployee;
              echo json_encode($data); 
          }  
      // view all contract admin
      public function viewcontract_employee() { 
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date("Y", strtotime($date));
        $status= "Activate";
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
              );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
       $records['employeecontract']=$this->Employee_Model->view_contractadmin($year, $status);
       $this->load->view('contractadmin', $records);
      }  
       public function filter_contractemployeeadmin(){
       $year = $this->input->post('year');
       $status = $this->input->post('status');
       $data = array();
       $selectcontract=$this->Employee_Model->view_contractadmin($year, $status);
       $data = $selectcontract;
       echo json_encode($data);

      }
        // view feedback
       public function viewfeedback_employee() { 
        $set_data = $this->session->userdata('userlogin'); //session data
        $data = array('userID' => $set_data['userID']
              );
        
       $records['userprofile']=$this->User_Model->userprofile($data);
        $records['employeefeedback']=$this->Resignation_Model->view_resignation();
        $this->load->view('feedbackemployee', $records);       
      } 
        public function filterfeedback_employee() { 
        $year = $this->input->post('year');
        $status = $this->input->post('status');
        $data = array();
        $selectfeedback = $this->Resignation_Model->filterfeedback($year, $status);
        $data = $selectfeedback;
        echo json_encode($data);    
      } 


      // view extend employee
      public function view_extendemployee(){
        date_default_timezone_set("Asia/Manila");
        $date= date("Y-m-d");
        $year = date("Y", strtotime($date));
       $set_data = $this->session->userdata('userlogin'); //session data
       $data = array('clientID' => $set_data['clientID']
                       );
        $records['clientprofile']=$this->Client_Model->clientprofile($data);
        $records['useradmin']=$this->User_Model->usertype();
        $records['extendemployee']=$this->Employee_Model->viewextendemployee($data['clientID'], $year);
        
        if  ($set_data['username']){
            $this->Chat_Model->updatenotificationadmin(0, $data['clientID']);
              $this->load->view('extendclient', $records); 
        }
        else {
                $this->load->view('login');
        }
      }

    public function filter_extendemployee(){
      $set_data = $this->session->userdata('userlogin'); //session data
       $year = $this->input->post('year');
       $data = array();
       $selectextend = $this->Employee_Model->viewextendemployee($set_data['clientID'], $year);
       $data = $selectextend;
       echo json_encode($data);

      }


    }
        
?>      