      // for view  client
    $(document).on("click", ".viewdeployapplicant", function(e){
        e.preventDefault();
        var employeeid= $(this).data('employeeid');
        dataEdit = 'employeeid='+ employeeid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'EmployeeController/viewdeployemployee/'+ employeeid ,
            dataType: 'json',
            success:function(data){
                  $('[name="applicantid"]').val(data.applicantID);
                  $('[name="fname"]').val(data.firstname);
                  $('[name="lname"]').val(data.lastname);
                  $('[name="employeeid"]').val(data.employeeID);
                  $('[name="clientid"]').val(data.clientID);
                  $('[name="branchid"]').val(data.branchID);
                  $('[name="locationid"]').val(data.locationID);
            }
          });

    });

      // for view  client
    $(document).on("click", ".viewattendance", function(e){
        e.preventDefault();
        var attendanceid= $(this).data('attendanceid');
        dataEdit = 'attendanceid='+ attendanceid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'EmployeeController/viewattendance_employee/'+ attendanceid ,
            dataType: 'json',
            success:function(data){
                  $('[name="day1"]').val(data.day1);
                  $('[name="day2"]').val(data.day2);
                  $('[name="day3"]').val(data.day3);
                  $('[name="day4"]').val(data.day4);
                  $('[name="day5"]').val(data.day5);
                  $('[name="day6"]').val(data.day6);
                  $('[name="day7"]').val(data.day7);
                  $('[name="day8"]').val(data.day8);
                  $('[name="day9"]').val(data.day9);
                  $('[name="day10"]').val(data.day10);
                  $('[name="day11"]').val(data.day11);
                  $('[name="day12"]').val(data.day12);
                  $('[name="day13"]').val(data.day13);
                  $('[name="day14"]').val(data.day14);
                  $('[name="day15"]').val(data.day15);
                  $('[name="day16"]').val(data.day16);
                  $('[name="day17"]').val(data.day17);
                  $('[name="day18"]').val(data.day18);
                  $('[name="day19"]').val(data.day19);
                  $('[name="day20"]').val(data.day20)
                  $('[name="day21"]').val(data.day21);
                  $('[name="day22"]').val(data.day22);
                  $('[name="day23"]').val(data.day23);
                  $('[name="day24"]').val(data.day24);
                  $('[name="day25"]').val(data.day25);
                  $('[name="day26"]').val(data.day26);
                  $('[name="day27"]').val(data.day27);
                  $('[name="day28"]').val(data.day28);
                  $('[name="day29"]').val(data.day29);
                  $('[name="day30"]').val(data.day30)
                  $('[name="day31"]').val(data.day31);
                  
                  $('[name="fname"]').val(data.firstname);
                  $('[name="lname"]').val(data.lastname);
                  $('[name="dateschedule"]').val(data.dateschedule);
                  
                  $('[name="employeeid"]').val(data.employeeID);
                  $('[name="clientid"]').val(data.clientID);
                  $('[name="applicantid"]').val(data.applicantID);
                  $('[name="attendanceid"]').val(data.attendanceID);
            }
          });

    });


  $(document).ready(function() {
        $("#addschedule_employee").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "EmployeeController/addschedule_employee",
                dataType: 'json',
                data: $("#scheduleform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#schedulemodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });

  $(document).ready(function() {
        $("#update_attendance").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "EmployeeController/update_attendance",
                dataType: 'json',
                data: $("#updateattendanceform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#attendancemodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });


  $(document).ready(function() {
        $("#change_schedule").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "EmployeeController/changeschedule_employee",
                dataType: 'json',
                data: $("#changescheduleform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#changeschedulemodal').modal('show');
                           alert(res.message);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });


$(function(){
$('[name="year"],[name="month"],[name="status"]').change(function() 
{ 
var year = $('[name="year"]').val();
var month = $('[name="month"]').val();
var status = $('[name="status"]').val();
var dataString = 'year='+ year  + '&month='+ month + '&status='+ status;
if(year!="" && month!="" && status!=="")
  {
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_attendance',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var column = "";
   for (var i = 0; i < data.weekDays.length; i++) {
    column += '<th>'+ data.weekDays[i] +'</th>';
    }
     $('.weekDays').html('<tr><th></th>'+ column + '</tr>');
    for (var i = 0; i < data.numberofdays.length; i++) {
    var day1= data.numberofdays[i].day1;
    var day2= data.numberofdays[i].day2;
    var day3= data.numberofdays[i].day3;
    var day4= data.numberofdays[i].day4;
    var day5= data.numberofdays[i].day5;
    var day6= data.numberofdays[i].day6;
    var day7= data.numberofdays[i].day7;
    var day8= data.numberofdays[i].day8;
    var day9= data.numberofdays[i].day9;
    var day10= data.numberofdays[i].day10;
    var day11= data.numberofdays[i].day11;
    var day12= data.numberofdays[i].day12;
    var day13= data.numberofdays[i].day13;
    var day14= data.numberofdays[i].day14;
    var day15= data.numberofdays[i].day15;
    var day16= data.numberofdays[i].day16;
    var day17= data.numberofdays[i].day17;
    var day18= data.numberofdays[i].day18;
    var day19= data.numberofdays[i].day19;
    var day20= data.numberofdays[i].day20;
    var day21= data.numberofdays[i].day21;
    var day22= data.numberofdays[i].day22;
    var day23= data.numberofdays[i].day23;
    var day24= data.numberofdays[i].day24;
    var day25= data.numberofdays[i].day25;
    var day26= data.numberofdays[i].day26;
    var day27= data.numberofdays[i].day27;
    var day28= data.numberofdays[i].day28;
    var day29= data.numberofdays[i].day29;
    var day30= data.numberofdays[i].day30;
    var day31= data.numberofdays[i].day31;

      //day1
      if (day1 == "na")
       var d1 = "<td style='background-color:#337ab7'></td>";
      else if (day1 == "P")
       var d1 = "<td style='background-color:#419641'></td>";
      else if (day1 == "A")
       var d1 = "<td style='background-color:#c12e2a'></td>";
     else if (day1 == "L")
       var d1 = "<td style='background-color:#4d5666'></td>";
     else if (day1 == "off")
       var d1 = "<td style='background-color:#f0ad4e'></td>";
     else if (day1 == "H")
       var d1 = "<td style='background-color:#404548'></td>";
      else
        var d1 = "<td>"+day1+"</td>";
      //day2
      if (day2 == "na")
       var d2 = "<td style='background-color:#337ab7'></td>";
      else if (day2 == "P")
       var d2 = "<td style='background-color:#419641'></td>";
      else if (day2 == "A")
       var d2 = "<td style='background-color:#c12e2a'></td>";
     else if (day2 == "L")
       var d2 = "<td style='background-color:#4d5666'></td>";
     else if (day2 == "off")
       var d2 = "<td style='background-color:#f0ad4e'></td>";
     else if (day2 == "H")
       var d2 = "<td style='background-color:#404548'></td>";
      else
       var d2 = "<td>"+day2+"</td>";
         //day3
      if (day3 == "na")
       var d3 = "<td style='background-color:#337ab7'></td>";
      else if (day3 == "P")
       var d3 = "<td style='background-color:#419641'></td>";
      else if (day3 == "A")
       var d3 = "<td style='background-color:#c12e2a'></td>";
     else if (day3 == "L")
       var d3 = "<td style='background-color:#4d5666'></td>";
     else if (day3 == "off")
       var d3 = "<td style='background-color:#f0ad4e'></td>";
     else if (day3 == "H")
       var d3 = "<td style='background-color:#404548'></td>";
      else
       var d3 = "<td>"+day3+"</td>";
         //day4
      if (day4 == "na")
       var d4 = "<td style='background-color:#337ab7'></td>";
      else if (day4 == "P")
       var d4 = "<td style='background-color:#419641'></td>";
      else if (day4 == "A")
       var d4 = "<td style='background-color:#c12e2a'></td>";
      else if (day4 == "L")
       var d4 = "<td style='background-color:#4d5666'></td>";
      else if (day4 == "off")
       var d4 = "<td style='background-color:#f0ad4e'></td>";
     else if (day4 == "H")
       var d4 = "<td style='background-color:#404548'></td>";
      else
       var d4 = "<td>"+day4+"</td>";
         //day5
      if (day5 == "na")
       var d5 = "<td style='background-color:#337ab7'></td>";
      else if (day5 == "P")
       var d5 = "<td style='background-color:#419641'></td>";
      else if (day5 == "A")
       var d5 = "<td style='background-color:#c12e2a'></td>";
     else if (day5 == "L")
       var d5 = "<td style='background-color:#4d5666'></td>";
     else if (day5 == "off")
       var d5 = "<td style='background-color:#f0ad4e'></td>";
     else if (day5 == "H")
       var d5 = "<td style='background-color:#404548'></td>";
      else
       var d5 = "<td>"+day5+"</td>";
         //day6
      if (day6 == "na")
       var d6 = "<td style='background-color:#337ab7'></td>";
      else if (day6 == "P")
       var d6 = "<td style='background-color:#419641'></td>";
      else if (day6 == "A")
       var d6 = "<td style='background-color:#c12e2a'></td>";
     else if (day6 == "L")
       var d6 = "<td style='background-color:#4d5666'></td>";
     else if (day6 == "off")
       var d6 = "<td style='background-color:#f0ad4e'></td>";
     else if (day6 == "H")
       var d6 = "<td style='background-color:#404548'></td>";
      else
       var d6 = "<td>"+day6+"</td>";
         //day7
      if (day7 == "na")
       var d7 = "<td style='background-color:#337ab7'></td>";
      else if (day7 == "P")
       var d7 = "<td style='background-color:#419641'></td>";
      else if (day7 == "A")
       var d7 = "<td style='background-color:#c12e2a'></td>";
     else if (day7 == "H")
       var d7 = "<td style='background-color:#404548'></td>";
      else
       var d7 = "<td>"+day7+"</td>";
         //day8
      if (day8 == "na")
       var d8 = "<td style='background-color:#337ab7'></td>";
      else if (day8 == "P")
       var d8 = "<td style='background-color:#419641'></td>";
      else if (day8 == "A")
       var d8 = "<td style='background-color:#c12e2a'></td>";
     else if (day8 == "L")
       var d8 = "<td style='background-color:#4d5666'></td>";
     else if (day8 == "off")
       var d8 = "<td style='background-color:#f0ad4e'></td>";
     else if (day8 == "H")
       var d8 = "<td style='background-color:#404548'></td>";
      else
       var d8 = "<td>"+day8+"</td>";

         //day9//ggggg
      if (day9 == "na")
       var d9 = "<td style='background-color:#337ab7'></td>";
      else if (day9 == "P")
       var d9 = "<td style='background-color:#419641'></td>";
      else if (day9 == "A")
       var d9 = "<td style='background-color:#c12e2a'></td>";
     else if (day9 == "L")
       var d9 = "<td style='background-color:#4d5666'></td>";
     else if (day9 == "off")
       var d9 = "<td style='background-color:#f0ad4e'></td>";
      else
       var d9 = "<td>"+day9+"</td>";
         //day10
      if (day10 == "na")
       var d10 = "<td style='background-color:#337ab7'></td>";
      else if (day10 == "P")
       var d10 = "<td style='background-color:#419641'></td>";
      else if (day10 == "A")
       var d10 = "<td style='background-color:#c12e2a'></td>";
     else if (day10 == "L")
       var d10 = "<td style='background-color:#4d5666'></td>";
     else if (day10 == "off")
       var d10 = "<td style='background-color:#f0ad4e'></td>";
     else if (day10 == "H")
       var d10 = "<td style='background-color:#404548'></td>";
      else
       var d10 = "<td>"+day10+"</td>";
         //day11
      if (day11 == "na")
       var d11 = "<td style='background-color:#337ab7'></td>";
      else if (day11 == "P")
       var d11 = "<td style='background-color:#419641'></td>";
      else if (day11 == "A")
       var d11 = "<td style='background-color:#c12e2a'></td>";
     else if (day11 == "L")
       var d11 = "<td style='background-color:#4d5666'></td>";
     else if (day11 == "off")
       var d11 = "<td style='background-color:#f0ad4e'></td>";
     else if (day11 == "H")
       var d11 = "<td style='background-color:#404548'></td>";
      else
       var d11 = "<td>"+day11+"</td>";
         //day12
      if (day12 == "na")
       var d12 = "<td style='background-color:#337ab7'></td>";
      else if (day12 == "P")
       var d12 = "<td style='background-color:#419641'></td>";
      else if (day12 == "A")
       var d12 = "<td style='background-color:#c12e2a'></td>";
     else if (day12 == "L")
       var d12 = "<td style='background-color:#4d5666'></td>";
     else if (day12 == "off")
       var d12 = "<td style='background-color:#f0ad4e'></td>";
     else if (day12 == "H")
       var d12 = "<td style='background-color:#404548'></td>";
      else
       var d12 = "<td>"+day12+"</td>";
         //day13
      if (day13 == "na")
       var d13 = "<td style='background-color:#337ab7'></td>";
      else if (day13 == "P")
       var d13 = "<td style='background-color:#419641'></td>";
      else if (day13 == "A")
       var d13 = "<td style='background-color:#c12e2a'></td>";
     else if (day13 == "L")
       var d13 = "<td style='background-color:#4d5666'></td>";
     else if (day13 == "off")
       var d13 = "<td style='background-color:#f0ad4e'></td>";
     else if (day13 == "H")
       var d13 = "<td style='background-color:#404548'></td>";
      else
       var d13 = "<td>"+day13+"</td>";
         //day14
      if (day14 == "na")
       var d14 = "<td style='background-color:#337ab7'></td>";
      else if (day14 == "P")
       var d14 = "<td style='background-color:#419641'></td>";
      else if (day14 == "A")
       var d14 = "<td style='background-color:#c12e2a'></td>";
     else if (day14 == "L")
       var d14 = "<td style='background-color:#4d5666'></td>";
     else if (day14 == "off")
       var d14 = "<td style='background-color:#f0ad4e'></td>";
     else if (day14 == "H")
       var d14 = "<td style='background-color:#404548'></td>";
      else
       var d14 = "<td>"+day14+"</td>";
         //day15
      if (day15 == "na")
       var d15 = "<td style='background-color:#337ab7'></td>";
      else if (day15 == "P")
       var d15 = "<td style='background-color:#419641'></td>";
      else if (day15 == "A")
       var d15 = "<td style='background-color:#c12e2a'></td>";
     else if (day15 == "L")
       var d15 = "<td style='background-color:#4d5666'></td>";
     else if (day15 == "off")
       var d15 = "<td style='background-color:#f0ad4e'></td>";
     else if (day15 == "H")
       var d15 = "<td style='background-color:#404548'></td>";
      else
       var d15 = "<td>"+day15+"</td>";
         //day16
      if (day16 == "na")
       var d16 = "<td style='background-color:#337ab7'></td>";
      else if (day16 == "P")
       var d16 = "<td style='background-color:#419641'></td>";
      else if (day16 == "A")
       var d16 = "<td style='background-color:#c12e2a'></td>";
     else if (day16 == "L")
       var d16 = "<td style='background-color:#4d5666'></td>";
     else if (day16 == "off")
       var d16 = "<td style='background-color:#f0ad4e'></td>";
     else if (day16 == "H")
       var d16 = "<td style='background-color:#404548'></td>";
      else
       var d16 = "<td>"+day16+"</td>";
         //day17
      if (day17 == "na")
       var d17 = "<td style='background-color:#337ab7'></td>";
      else if (day17 == "P")
       var d17 = "<td style='background-color:#419641'></td>";
      else if (day17 == "A")
       var d17 = "<td style='background-color:#c12e2a'></td>";
     else if (day17 == "L")
       var d17 = "<td style='background-color:#4d5666'></td>";
     else if (day17 == "off")
       var d17 = "<td style='background-color:#f0ad4e'></td>";
     else if (day17 == "H")
       var d17 = "<td style='background-color:#404548'></td>";
      else
       var d17 = "<td>"+day17+"</td>";
         //day18
      if (day18 == "na")
       var d18 = "<td style='background-color:#337ab7'></td>";
      else if (day18 == "P")
       var d18 = "<td style='background-color:#419641'></td>";
      else if (day18 == "A")
       var d18 = "<td style='background-color:#c12e2a'></td>";
     else if (day18 == "L")
       var d18 = "<td style='background-color:#4d5666'></td>";
     else if (day18 == "off")
       var d18 = "<td style='background-color:#f0ad4e'></td>";
     else if (day18 == "H")
       var d18 = "<td style='background-color:#404548'></td>";
      else
       var d18 = "<td>"+day18+"</td>";
         //day19
      if (day19== "na")
       var d19= "<td style='background-color:#337ab7'></td>";
      else if (day19== "P")
       var d19= "<td style='background-color:#419641'></td>";
      else if (day19== "A")
       var d19= "<td style='background-color:#c12e2a'></td>";
     else if (day19 == "L")
       var d19 = "<td style='background-color:#4d5666'></td>";
     else if (day19 == "off")
       var d19 = "<td style='background-color:#f0ad4e'></td>";
     else if (day19 == "H")
       var d19 = "<td style='background-color:#404548'></td>";
      else
       var d19 = "<td>"+day19+"</td>";
              //day20
      if (day20== "na")
       var d20= "<td style='background-color:#337ab7'></td>";
      else if (day20== "P")
       var d20= "<td style='background-color:#419641'></td>";
      else if (day20== "A")
       var d20= "<td style='background-color:#c12e2a'></td>";
     else if (day20 == "L")
       var d20 = "<td style='background-color:#4d5666'></td>";
     else if (day20 == "off")
       var d20 = "<td style='background-color:#f0ad4e'></td>";
     else if (day20 == "H")
       var d20 = "<td style='background-color:#404548'></td>";
      else
       var d20 = "<td>"+day20+"</td>";
              //day21
      if (day21== "na")
       var d21= "<td style='background-color:#337ab7'></td>";
      else if (day21== "P")
       var d21= "<td style='background-color:#419641'></td>";
      else if (day21== "A")
       var d21= "<td style='background-color:#c12e2a'></td>";
     else if (day1 == "L")
       var d21 = "<td style='background-color:#4d5666'></td>";
     else if (day21 == "off")
       var d21 = "<td style='background-color:#f0ad4e'></td>";
     else if (day21 == "H")
       var d21 = "<td style='background-color:#404548'></td>";
      else
       var d21 = "<td>"+day21+"</td>";
              //day22
      if (day22== "na")
       var d22= "<td style='background-color:#337ab7'></td>";
      else if (day22== "P")
       var d22= "<td style='background-color:#419641'></td>";
      else if (day22== "A")
       var d22= "<td style='background-color:#c12e2a'></td>";
     else if (day1 == "L")
       var d22 = "<td style='background-color:#4d5666'></td>";
     else if (day22 == "off")
       var d22 = "<td style='background-color:#f0ad4e'></td>";
     else if (day22 == "H")
       var d22 = "<td style='background-color:#404548'></td>";
      else
       var d22 = "<td>"+day22+"</td>";
              //day23
      if (day23== "na")
       var d23= "<td style='background-color:#337ab7'></td>";
      else if (day23== "P")
       var d23= "<td style='background-color:#419641'></td>";
      else if (day23== "A")
       var d23= "<td style='background-color:#c12e2a'></td>";
     else if (day23 == "L")
       var d23 = "<td style='background-color:#4d5666'></td>";
     else if (day23 == "off")
       var d23 = "<td style='background-color:#f0ad4e'></td>";
     else if (day23 == "H")
       var d23 = "<td style='background-color:#404548'></td>";
      else
       var d23 = "<td>"+day23+"</td>";
              //day24
      if (day24== "na")
       var d24= "<td style='background-color:#337ab7'></td>";
      else if (day24== "P")
       var d24= "<td style='background-color:#419641'></td>";
      else if (day24== "A")
       var d24= "<td style='background-color:#c12e2a'></td>";
     else if (day24 == "L")
       var d24 = "<td style='background-color:#4d5666'></td>";
     else if (day24 == "off")
       var d24 = "<td style='background-color:#f0ad4e'></td>";
     else if (day4 == "H")
       var d24 = "<td style='background-color:#404548'></td>";
      else
       var d24 = "<td>"+day24+"</td>";
              //day25
      if (day25== "na")
       var d25= "<td style='background-color:#337ab7'></td>";
      else if (day25== "P")
       var d25= "<td style='background-color:#419641'></td>";
      else if (day25== "A")
       var d25= "<td style='background-color:#c12e2a'></td>";
     else if (day25 == "L")
       var d25 = "<td style='background-color:#4d5666'></td>";
     else if (day25 == "off")
       var d25 = "<td style='background-color:#f0ad4e'></td>";
     else if (day25 == "H")
       var d25 = "<td style='background-color:#404548'></td>";
      else
       var d25 = "<td>"+day25+"</td>";
              //day26
      if (day26== "na")
       var d26= "<td style='background-color:#337ab7'></td>";
      else if (day26== "P")
       var d26= "<td style='background-color:#419641'></td>";
      else if (day26== "A")
       var d26= "<td style='background-color:#c12e2a'></td>";
     else if (day26 == "L")
       var d26 = "<td style='background-color:#4d5666'></td>";
     else if (day26 == "off")
       var d26 = "<td style='background-color:#f0ad4e'></td>";
     else if (day26 == "H")
       var d26 = "<td style='background-color:#404548'></td>";
      else
       var d26 = "<td>"+day26+"</td>";
              //day27
      if (day27== "na")
       var d27= "<td style='background-color:#337ab7'></td>";
      else if (day27== "P")
       var d27= "<td style='background-color:#419641'></td>";
      else if (day27== "A")
       var d27= "<td style='background-color:#c12e2a'></td>";
     else if (day27 == "L")
       var d27 = "<td style='background-color:#4d5666'></td>";
     else if (day27 == "off")
       var d27 = "<td style='background-color:#f0ad4e'></td>";
     else if (day27 == "H")
       var d27 = "<td style='background-color:#404548'></td>";
      else
       var d27 = "<td>"+day27+"</td>";
             //day28
      if (day28== "na")
       var d28= "<td style='background-color:#337ab7'></td>";
      else if (day28== "P")
       var d27= "<td style='background-color:#419641'></td>";
      else if (day28== "A")
       var d28= "<td style='background-color:#c12e2a'></td>";
     else if (day28 == "L")
       var d28 = "<td style='background-color:#4d5666'></td>";
     else if (day28 == "off")
       var d28 = "<td style='background-color:#f0ad4e'></td>";
     else if (day28 == "H")
       var d28 = "<td style='background-color:#404548'></td>";
      else
       var d28 = "<td>"+day28+"</td>";
             //day29
      if (day29== "na")
       var d29= "<td style='background-color:#337ab7'></td>";
      else if (day29== "P")
       var d29= "<td style='background-color:#419641'></td>";
      else if (day29== "A")
       var d29= "<td style='background-color:#c12e2a'></td>";
     else if (day29 == "L")
       var d29 = "<td style='background-color:#4d5666'></td>";
     else if (day29 == "off")
       var d29 = "<td style='background-color:#f0ad4e'></td>";
     else if (day29 == "H")
       var d29 = "<td style='background-color:#404548'></td>";
      else
       var d29 = "<td>"+day29+"</td>";
             //day30
      if (day30== "na")
       var d30= "<td style='background-color:#337ab7'></td>";
      else if (day30== "P")
       var d27= "<td style='background-color:#419641'></td>";
      else if (day30== "A")
       var d30= "<td style='background-color:#c12e2a'></td>";
     else if (day30 == "L")
       var d30 = "<td style='background-color:#4d5666'></td>";
     else if (day30 == "off")
       var d30 = "<td style='background-color:#f0ad4e'></td>";
     else if (day30 == "H")
       var d30 = "<td style='background-color:#404548'></td>";
      else
       var d30 = "<td>"+day30+"</td>";
             //day31
      if (day31== "na")
       var d31= "<td style='background-color:#337ab7'></td>";
      else if (day31== "P")
       var d31= "<td style='background-color:#419641'></td>";
      else if (day31== "A")
       var d31= "<td style='background-color:#c12e2a'></td>";
     else if (day31 == "L")
       var d31 = "<td style='background-color:#4d5666'></td>";
     else if (day31 == "off")
       var d31 = "<td style='background-color:#f0ad4e'></td>";
     else if (day31 == "H")
       var d31 = "<td style='background-color:#404548'></td>";
      else
       var d31 = "<td>"+day31+"</td>";

        table += '<tr><td>'+ data.numberofdays[i].firstname + ' ' + data.numberofdays[i].lastname + '</td>'+
                  ''+d1+''+
                  ''+d2+''+
                  ''+d3+''+
                  ''+d4+''+
                  ''+d5+''+
                  ''+d6+''+
                  ''+d7+''+
                  ''+d8+''+
                  ''+d9+''+
                  ''+d10+''+
                  ''+d11+''+
                  ''+d12+''+
                  ''+d13+''+
                  ''+d14+''+
                  ''+d15+''+
                  ''+d16+''+
                  ''+d17+''+
                  ''+d18+''+
                  ''+d19+''+
                  ''+d20+''+
                  ''+d21+''+
                  ''+d22+''+
                  ''+d23+''+
                  ''+d24+''+
                  ''+d25+''+
                  ''+d26+''+
                  ''+d27+''+
                  ''+d28+''+
                  ''+d29+''+
                  ''+d30+''+
                  ''+d31+''+
                  '</tr>';
    }
     $('.searchattendance').html(table);
  } 

  });
}
});
});


 $(function() {
  $('#import_attendance').click(function(e) {
    e.preventDefault();
     var data = new FormData($('#importattendanceform')[0]);
           $.ajax({
              type:"POST",
              url: base_url +'EmployeeController/import_attendance/',
              secureuri   :false,
               mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                data: data,
                dataType: 'json',
            success: function(res){            
                    if(res.response =='success'){
                      alert(res.message);
                      window.location= base_url + res.redirect;
             
               } else{
                     alert(res.message);
                     $('#importattendancemodal').modal('show');                       
              }
        }
    });
    return false;
  });
});

  $(document).ready(function() {
        $("#changestatus").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "EmployeeController/updatestatus_employee",
                dataType: 'json',
                data: $("#changestatusform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#changestatusmodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });

$(function(){
$('[name="year"], [name="status"]').change(function() 
{ 
var year = $('[name="year"]').val();
var status = $('[name="status"]').val();
var dataString = 'year='+ year + '&status=' + status;
if(year!="" && status!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_employeedetail',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var url = ""
    var table = "";
    var text= "";
     for (var i = 0; i < data.length; i++) {
      url = base_url + 'EmployeeController/view_reportattendance/' +data[i].employeeID;
      text = "<td><a href='"+url+"'  class='btn btn-primary btm-sm'>View Detail</a></td>";

          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].status+'</td>'+
                  ''+text+''+
                  '</tr>';
              }
        $('.attendancedetail').html(table);
     }
  });
}
});
});
// filter deploy employeeid

$(function(){
$('[name="month"],[name="year"],[name="status"]').change(function() 
{ 
var month = $('[name="month"]').val();
var year = $('[name="year"]').val();
var status = $('[name="status"]').val();
var dataString = 'month='+ month + '&year='+ year + '&status=' + status; 
if(year!="" && month!="" && status!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_deployemployee',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
     for (var i = 0; i < data.length; i++) {
          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].status+'</td>'+
                  '</tr>';
              }
        $('.reportdeployemployeedetail').html(table);
     }
  });
}
});
});

$(function(){
$('[name="month"],[name="year"]').change(function() 
{ 
var month = $('[name="month"]').val();
var year = $('[name="year"]').val();
var dataString = 'month='+ month + '&year='+ year; 
if(year!="" && month!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_alldeployemployee',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var text = "";
     for (var i = 0; i < data.length; i++) {

          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].datedeploy+'</td>'+
                  '<td>'+data[i].userclient+'</td>'+
                  '<td>'+data[i].username+'</td>'+
                  '<td>Deploy</td>'+
                  '</tr>';
              }
        $('.deployemployeedetail').html(table);
     }
  });
}
});
});

$(function(){
$('[name="month"],[name="year"]').change(function() 
{ 
var month = $('[name="month"]').val();
var year = $('[name="year"]').val();
var dataString = 'month='+ month + '&year='+ year; 
if(year!="" && month!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_alldeployemployeestaff',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var text = "";
     for (var i = 0; i < data.length; i++) {

          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].datedeploy+'</td>'+
                  '<td>Deploy</td>'+
                  '</tr>';
              }
        $('.deployemployeedetailstaff').html(table);
     }
  });
}
});
});


$(function(){
$('[name="year"],[name="status"]').change(function() 
{ 
var year = $('[name="year"]').val();
var status = $('[name="status"]').val();
var dataString = 'year='+ year + '&status='+ status;
if(year!="" && status!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_contractemployeeadmin',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var text = "";
     for (var i = 0; i < data.length; i++) {
      var dateremain  = new Date(data[i].dateremain);
      var datecontract  = new Date(data[i].datecontract);
      var frommonth =dateremain.getMonth();
      var tomonth = datecontract.getMonth();
      var dayr = dateremain.getDay();
      var dayc= datecontract.getDay();
      var remainingmonth = tomonth - frommonth;
      var remainingday = dayc - dayr;
      if (remainingmonth  == 0){
         text = remainingday;
      }
      else{
          text = remainingmonth;
      }
          table += '<tr><td>'+ data[i].fname + ' ' + data[i].lname + '</td>'+
                  '<td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].datestart+'</td>'+
                  '<td>'+data[i].datecontract+'</td>'+
                  '<td>'+text+'</td>'+
                  '<td>'+data[i].status+'</td>'+
                  '</tr>';
              }
             $('.reportcontract').html(table);
     }
  });
}
});
});

