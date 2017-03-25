
  $(document).ready(function() {
        $("#add_applicantplot").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "ApplicantController/add_applicantplot",
                dataType: 'json',
                data: $("#addapplicantplotform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#adduserplotmodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });

  $(document).ready(function() {
        $("#update_applicantplot").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "ApplicantController/update_applicantplot",
                dataType: 'json',
                data: $("#updateapplicantform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                        alert(res.message);
                        window.location= base_url + res.redirect;
                    }
                    else{
                         $('#updateappactionmodal').modal('show');
                            alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });

$(document).ready(function(){
    $('#status').change(function() {
        if($(this).val() =="14")  {
            $("#inputrequirement").show();
             $("input[name='requirement[]']").prop( "checked", false );
                $('#numberofUnchecked').val("Processed");

        }    
          else if($(this).val() =="7")  {
            $("input[name='requirement[]']").prop( "checked", true );
             $("#inputrequirement").hide();
             $('#lackingrequirement').val("")
             $('#completerequirement').val("")

        }    
         else{
            $("input[name='requirement[]']").prop( "checked", true );
             $("#inputrequirement").hide();
             $('#lackingrequirement').val("");
             $('#completerequirement').val("");
             $('#numberofUnchecked').val("Processed");
         }
    });
});

 $(function () {

    $("input[name='requirement[]']").on("change", function () {
            var lenghtOfchecked = $("input[name='requirement[]']:checked").length;
            var lenghtOfUnchecked = $("input[name='requirement[]']:not(:checked)").length;
            var lackingrequirement = [];
                $.each($("input[name='requirement[]']:not(:checked)"), function(){ 
                        lackingrequirement.push($(this).val());   
         });
           var completerequirement = [];
              $.each($("input[name='requirement[]']:checked"), function(){ 
                    completerequirement.push($(this).val());   
         });
            $('#lackingrequirement').val(lackingrequirement.join(", "))
            $('#completerequirement').val(completerequirement.join(", "))
            $('#numberofUnchecked').val("Lacking : " + lenghtOfUnchecked);

            if (lenghtOfUnchecked == 0){
                   $('#status').html('<option value="5">Complete</option>');
                   $('#numberofUnchecked').val('Completed');
                   $('#lackingrequirement').val('Completed')

            }
            else if (lenghtOfchecked == 0){
               $('#status').html('<option value="14" selected="selected">Processed</option><option value="6">Not Processed</option>');
            }

            else{
                  $('#status').html('<option value="4">Lacking : ' +lackingrequirement.join(", ") +'</option>');
            }
    });

})


    $(document).on("click", ".viewapplicant", function(e){
        e.preventDefault();
       $("input[name='requirement[]']").prop( "checked", true );

        var applicantid= $(this).data('applicantid');
        dataEdit = 'applicantid='+ applicantid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ApplicantController/viewapplicant_detail/'+ applicantid,
            dataType: 'json',
            success:function(data){
                $('[name="applicantid"]').val(data.applicantID);
                $('[name="scheduleplot"]').val(data.schedule);
                $('[name="schedulerelease"]').val(data.releasesched);
                $('[name="oldstatus"]').val(data.status);
                $('[name="fname"]').val(data.firstname);
                $('[name="lname"]').val(data.lastname);
                $('[name="purpose"]').val(data.purpose);
                $('[name="plotschedule"]').val(data.schedule);
                $('[name="emailaddress"]').val(data.emailadd);


               if (data.status == 2){
                  $('#purpose').html('<option value="2">For Orientation</option>');
                 }
               else if (data.status == 3  || data.status == 4 ) {
                $('#purpose').html('<option value="3">For Process Requirement</option>');
                }

               else if (data.status == 5) {
                $('#purpose').html('<option value="4">For Releasing Paycard</option>');
               
                }
               else if (data.status == 8) {
                $('#purpose').html('<option value="5">For Deploy</option>');
               
                }
               else if (data.status == 7 && data.purpose == 2 ) {
                $('#purpose').html('<option value="1">For Screening</option><option value="2">For Orientation</option>');
               
                }
               else if (data.status == 7 && data.purpose == 3 ) {
                $('#purpose').html('<option value="1">For Screening</option><option value="3">For Process Requirement</option>');
               
                }
               else if (data.status == 6 && data.purpose == 3 ) {
                $('#purpose').html('<option value="1">For Screening</option><option value="3">For Process Requirement</option>');               
                }

                else if (data.status == 7 && data.purpose == 4 ) {
                $('#purpose').html('<option value="1">For Screening</option><option value="4">For Releasing Paycard</option>');
               
                }
               else{
                   $('#purpose').html('<option value="1">For Screening</option>');
                }
               if (data.purpose == 1){
                  $('#status').html('<option value="2" selected="selected">Done Screening</option><option value="7">Not Coming</option><option value="15">Not Qualified</option>');
                }
               else if (data.purpose == 2){
                  $('#status').html('<option value="3" selected="selected">Done Orientation</option><option value="7">Not Coming</option>');
                 }

                else if (data.purpose == 3){
                    $('#status').html('<option value="7" selected="selected">Not Processed</option><option value="14">Processed</option>');
                    $('#numberofUnchecked').val("Not Processed");
                }

                else if (data.purpose == 4){
                  $('#status').html('<option value="8" selected="selected">Done Releasing Paycard</option><option value="7">Not Coming</option>');
                 $('#numberofUnchecked').val("Completed");
                 }
                 else if (data.purpose == 5){
                  $('#status').html('<option value="7">Deploy</option>');
                    $('#numberofUnchecked').val("Completed");
                 }

                  else{
                  $('#status').html('<option value="5" selected="selected">Complete Requirement</option><option value="6">Lacking Requirement</option><option value="7">Not Processed</option>');
            }
                                 
         }
          });

    });

  $(document).ready(function() {
        $("#update_applicantstatus").click(function(event) {
        event.preventDefault();

        var $nonempty = $('.requirement').filter(function() {
              return this.checked != false;
           });
            if ($nonempty.length == 0) {
              alert('Please checked requirement atleast once');
          }
         else{ 
             $.ajax({
                type: "POST",
                url: base_url + "ApplicantController/update_applicantstatus",
                dataType: 'json',
                data: $("#updateapplicantstatusform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                        alert(res.message);
                        window.location= base_url + res.redirect;
                    }
                    else{
                         $('#updateapplicantstatusmodal').modal('show');
                            alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
               }

              });
        });

$(document).ready(function(){
    $('#status2').change(function() {
        if($(this).val() =="14")  {
            $("#inputlackingrequirement").show();
             $(".lfrequirement").prop( "checked", false );

        }    
          else if($(this).val() =="6")  {
            $(".lfrequirement").prop( "checked", true );
             $("#inputlackingrequirement").hide();
             $('#lackingrequirement2').val("")
             $('#completerequirement2').val("")
             $('#numberofUnchecked2').val("Not Processed"); 

        }    
         else{
            $(".lfrequirement").prop( "checked", true );
             $("#inputlackingrequirement").hide();
             $('#lackingrequirement2').val("")
             $('#completerequirement2').val("")
             $('#numberofUnchecked2').val("Processed");
         }
    });
});


//viewapplicantrequirement
   $(document).on("click", ".viewarequirementapplicant", function(e){
        e.preventDefault();
        var applicantid= $(this).data('appid');
        dataEdit = 'appid='+ applicantid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ApplicantController/viewapplicantrequirement/'+ applicantid,
            dataType: 'json',
            success:function(data){
            $('[name="applicantid"]').val(data.applicantID);
            $('[name="requirementapplicantid"]').val(data.rappID);
            $('[name="oldrequirement"]').val(data.completerequirement);
            $('[name="lackingrequirement"]').val(data.lackingrequirement);
            $('[name="purpose"]').val(data.purpose);
            $('[name="plotschedule"]').val(data.schedule);



            var arr = data.lackingrequirement.split(",");
            var i;
            var lrequirement='';
            for (i = 0; i < arr.length; i++) { 
                     lrequirement += '<input type="checkbox" class="lfrequirement"  value="'+arr[i]+'" name="lackrequirement[]"> '+arr[i]+'</label><br>';
                    } 
                    if (data.status == 4 && data.purpose ==3 ){ 
                     $('#status2').html('<option value="14" selected="selected">Processed</option><option value="6"> Not Processed</option>');
                     $('.lfrequirement').html(lrequirement);     
                     $('#numberofUnchecked2').val("Processed");      
                     $(".lfrequirement").prop( "checked", false);
                    }
                    else{

                    $('#status2').html('<option value="6" selected="selected">Not Processed</option><option value="14">Processed</option>');
                    $("#inputlackingrequirement").hide();
                    $(".lfrequirement").prop( "checked", true);
                    $('.lfrequirement').html(lrequirement);     
                    $('#numberofUnchecked2').val("Not Processed");      


                    }
                
                }
          });

    });

//lacking requirement
 $(function () {
    $(".lfrequirement").on("change", function () {
            var lenghtOfchecked = $("input[name='lackrequirement[]']:checked").length;
            var lenghtOfUnchecked = $("input[name='lackrequirement[]']:not(:checked)").length;
            var lackingrequirement = [];
                $.each($("input[name='lackrequirement[]']:not(:checked)"), function(){ 
                        lackingrequirement.push($(this).val());   
         });
           var completerequirement = [];
              $.each($("input[name='lackrequirement[]']:checked"), function(){ 
                    completerequirement.push($(this).val()); 

         });

            $('#lackingrequirement2').val(lackingrequirement.join(", "))
            $('#completerequirement2').val(completerequirement.join(", "))
            $('#numberofUnchecked2').val("Lacking : " + lenghtOfUnchecked);

            if (lenghtOfUnchecked == 0){
                   $('#status2').html('<option value="5">Complete</option>');
                   $('#numberofUnchecked2').val('Completed');
                   $('#lackingrequirement2').val('Completed')

            }
            else if (lenghtOfchecked == 0){
               $('#status2').html('<option value="14" selected="selected">Processed</option><option value="6">Not Processed</option>');
            }

            else{
                  $('#status2').html('<option value="4">Lacking : ' +lackingrequirement.join(", ") +'</option>');
            }
    });

})


  $(document).ready(function() {
        $("#update_applicantlackingstatus").click(function(event) {
        event.preventDefault();

        var $nonempty = $('.lfrequirement').filter(function() {
              return this.checked != false;
           });
            if ($nonempty.length == 0) {
              alert('Please checked requirement atleast once');
          }
         else{ 
             $.ajax({
                type: "POST",
                url: base_url + "ApplicantController/update_applicantlackingstatus",
                dataType: 'json',
                data: $("#updateapplicantlackingstatusform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                        alert(res.message);
                        window.location= base_url + res.redirect;
                    }
                    else{
                         $('#updatelackingmodal').modal('show');
                            alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
               }

              });
        });

$(function(){
$("#branch").change(function() 
{ 
var branchid= $(this).val();
var dataString = 'branchname='+ branchid;
if(branchid!="")
{
  $.ajax({
  type: "POST",
  url: base_url +'ClientController/viewdepartmentdetail/'+ branchid ,
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data) {
  $('#department').empty();
  $.each(data, function(key, value){
           $('#department').append( '<option value="'+value.locationID+'">'+value.locationname+'</option>' );
          });
        }
      });
    }
    else{
        $('#department').html('<option value="" selected="selected">Select department......</option>' );
    }   
 });
});

  $(document).ready(function() {
        $("#add_employee").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "EmployeeController/add_employee",
                dataType: 'json',
                data: $("#addemployeeform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#addemployeemodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });
    // for view  client
    $(document).on("click", ".viewcontractemployee", function(e){
        e.preventDefault();
        var employeeid= $(this).data('employeeid');
        dataEdit = 'employeeid='+ employeeid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ApplicantController/viewcontract_employee/'+ employeeid ,
            dataType: 'json',
            success:function(data){
                  $('[name="applicantid"]').val(data.applicantID);
                  $('[name="employeeid"]').val(data.employeeID);
                  $('[name="branchid"]').val(data.branchID);
                  $('[name="locationid"]').val(data.locationID);
                  $('[name="extend"]').val(data.extend);
            }
          });
    });

  $(document).ready(function() {
        $("#extend_employee").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "ApplicantController/extend_employee",
                dataType: 'json',
                data: $("#extendemployeeform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         $('#extendmodal').modal('show');
                           alert(res.err);
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });
$(function(){
$('[name="month"], [name="day"], [name="year"], [name="purpose"]').change(function() 
{ 
var year = $('[name="year"]').val();
var month = $('[name="month"]').val();
var day = $('[name="day"]').val();
var purpose = $('[name="purpose"]').val();
var dataString = 'month='+ month + '&day='+ day + '&year='+ year + '&purpose='+ purpose;
if(year!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ApplicantController/filter_scheduleapplicant',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var purpose= "";
    var status = "";
     for (var i = 0; i < data.length; i++) {
        if (data[i].purpose == 1  && data[i].status == 2){
              purpose = "For Screening";
              status =  "Done Screening";
         }
        else if (data[i].purpose ==  1  && data[i].status == 7){
                  purpose = "For Screening";
                  status =  "Done Coming";
         }
         else if (data[i].purpose ==  1  && data[i].status == 15){
                  purpose = "For Screening";
                  status =  "Not  Qualified";
         }
        else if (data[i].purpose == 2  && data[i].status == 3){
            purpose = "For Orientation";
            status =  "Done Orientation";
         }
        else if (data[i].purpose == 2  && data[i].status == 7){
            purpose = "For Orientation";
            status =  "Not Coming";
         }
         else if (data[i].purpose == 3  && data[i].status == 4){
            purpose = "For Process Requirement";
            status =  "Lacking Requirement";
         }
         else if (data[i].purpose == 3  && data[i].status == 7 || data[i].status == 6 ){
            purpose = "For Process Requirement";
            status =  "Not Processed";
         }
         else if (data[i].purpose == 3  && data[i].status == 5){
            purpose = "For Orientation";
            status =  "Complete Requirement";
         }
         else if (data[i].purpose == 4  && data[i].status == 9){
            purpose = "For Releasing Pay Card";
            status =  "Deploy";
         }
          else if (data[i].purpose == 4  && data[i].status == 8){
            purpose = "For Releasing Pay Card";
            status =  "Done Releasing Pay Card";
         }

          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+purpose+'</td>'+
                  '<td>'+status+'</td>'+
                  '<td>'+data[i].schedule+'</td>'+
                  '</tr>';
              }
         $('.scheduleemployee').html(table);
     }
  });
}
});
});
// filter schedule employee
$(function(){
$('[name="month"],[name="year"], [name="purpose"]').change(function() 
{ 
var year = $('[name="year"]').val();
var month = $('[name="month"]').val();
var purpose = $('[name="purpose"]').val();
var dataString = 'month='+ month + '&year='+ year + '&purpose='+ purpose;
if(year!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ApplicantController/filter_scheduleapplicantview',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var purpose= "";
    var status = "";
     for (var i = 0; i < data.length; i++) {
        if (data[i].purpose == 1  && data[i].status == 2){
              purpose = "For Screening";
              status =  "Done Screening";
         }
        else if (data[i].purpose ==  1  && data[i].status == 7){
                  purpose = "For Screening";
                  status =  "Done Coming";
         }
         else if (data[i].purpose ==  1  && data[i].status == 15){
                  purpose = "For Screening";
                  status =  "Not  Qualified";
         }
        else if (data[i].purpose == 2  && data[i].status == 3){
            purpose = "For Orientation";
            status =  "Done Orientation";
         }
        else if (data[i].purpose == 2  && data[i].status == 7){
            purpose = "For Orientation";
            status =  "Not Coming";
         }
         else if (data[i].purpose == 3  && data[i].status == 4){
            purpose = "For Process Requirement";
            status =  "Lacking Requirement";
         }
         else if (data[i].purpose == 3  && data[i].status == 7 || data[i].status == 6 ){
            purpose = "For Process Requirement";
            status =  "Not Processed";
         }
         else if (data[i].purpose == 3  && data[i].status == 5){
            purpose = "For Orientation";
            status =  "Complete Requirement";
         }
         else if (data[i].purpose == 4  && data[i].status == 9){
            purpose = "For Releasing Pay Card";
            status =  "Deploy";
         }
          else if (data[i].purpose == 4  && data[i].status == 8){
            purpose = "For Releasing Pay Card";
            status =  "Done Releasing Pay Card";
         }

          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+purpose+'</td>'+
                  '<td>'+status+'</td>'+
                  '<td>'+data[i].schedule+'</td>'+
                  '</tr>';
              }
         $('.filterscheduleemployee').html(table);
     }
  });
}
});
});
// filter requirement
$(function(){
$('[name="month"],[name="year"]').change(function() 
{ 
var year = $('[name="year"]').val();
var month = $('[name="month"]').val();
var dataString = 'month='+ month + '&year='+ year;
if(year!="" && month!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ApplicantController/filter_requirementapplicant',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var text = "";
     for (var i = 0; i < data.length; i++) {
          if (data[i].lackingrequirement == "Completed"){
            text = "None";
          }
          else{
            text = data[i].lackingrequirement;
          }
          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].completerequirement+'</td>'+
                  '<td>'+text+'</td>'+
                  '<td>'+data[i].dateprocess+'</td>'+
                  '<td>'+data[i].file+'</td>'+
                  '</tr>';
              }
             $('.requirementdetail').html(table);
     }
  });
}
});
});

$(document).ready(function() {
 var url= base_url + "HomeController/notify_applicant";
  window.setInterval(function(){
  $.getJSON(url,function(data){
  if (data.numberofapplicant == 0 || data.numberofapplicant == 2){
    $('.applicant').html();
  }
  else{
    $('.applicant').html(data.numberofapplicant);
  }
 })
 }, 1000);
});

    $(document).on("click", ".viewapplyapplicant", function(e){
        e.preventDefault();
        var applyapplicantid = $(this).data('studentid');
        dataEdit = 'studentid='+ applyapplicantid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'HomeController/viewapplyapplicant/'+ applyapplicantid ,
            dataType: 'json',
            success:function(data){
           $('[name="firstname"]').val(data.firstname);
           $('[name="lastname"]').val(data.lastname);
           $('[name="contact"]').val(data.contact);
           $('[name="emailadd"]').val(data.email);   
           $('[name="address"]').val(data.address);              
            }
          });

    });

/*
$(document).ready(function() {
 var url= base_url + "ApplicantController/contract_employee";
     var table = "";
   $.getJSON(url,function(data){
    for (var i = 0; i < data.length; i++) {
    alert(data[i].employeeID);
    table += "<tr><td><a href='#' class='viewcontractemployee btn btn-danger btm-sm' data-toggle='modal'  data-target='#extendmodal' data-employeeid='"+data[i].employeeID+"'>Extend</a></td>";
  }
     $('#extendcontract').html(table);
  })
});
*/

