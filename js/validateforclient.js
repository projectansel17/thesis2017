
//for registerter form client
$(document).ready(function() {
$("#add_client").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "ClientController/add_client",
dataType: 'json',
data: $("#addclientform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
window.location= base_url + res.redirect;
}
else{
alert(res.err);
   $('#addclientmodal').modal('show');
  
}
},
  resetForm: true 
});
  return false;
});
});


// update request applicant
$(document).ready(function() {
$("#update_request").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "ClientController/update_request",
dataType: 'json',
data: $("#updaterequestform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
window.location= base_url + res.redirect;
}
else{
alert(res.err);
   $('#updaterequestmodal').modal('show');
  
}
},
  resetForm: true 
});
  return false;
});
});
      // for view  client
    $(document).on("click", ".viewclient", function(e){
        e.preventDefault();
        var clientid= $(this).data('clientid');
        dataEdit = 'clientid='+ clientid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ClientController/viewclientdetail/'+ clientid ,
            dataType: 'json',
            success:function(data){
              $('[name="clientid"]').val(data.clientID);
              $('[name="clientname"]').val(data.clientname); 
                          
            }
          });

    });

$(function(){
$('[name="branchname"]').change(function() 
{ 
var branchid= $(this).val();
var dataString = 'branchname='+ branchid;
if(branchid!="")
  {
  $.ajax({
  type: "POST",
  url: base_url + 'ClientController/viewdepartmentdetail/'+ branchid ,
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data) {
  $('[name="department"]').empty();
  $.each(data, function(key, value){
           $('[name="department"]').append( '<option value="'+value.locationID+'">'+value.locationname+'</option>' );
          });
        }
      });
    }
        else{
          $('[name="department"]').html('<option value="" selected="selected">Select department......</option>' );
    }
 });
});

    // for login form  validation
    $(document).ready(function() {
    $("[name='updateclient']" ).click(function(event) {
    event.preventDefault();
    $.ajax({
    type: "POST",
    url: base_url + "ClientController/update_client",
    dataType: 'json',
    data: $("#updateclientform").serialize(),
    success: function(res) {
    if (res.response=="success"){
// Show Entered Value
    alert(res.message);
    console.log(res);
    window.location= base_url + res.redirect;
    }
    else{
    alert(res.err);
        $('#updateclientmodal').modal('show');
    }
  },
      resetForm: true 
  });
  return false;
  });
});


  $(document).ready(function() {
        $("#delete_client").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "ClientController/delete_client",
                dataType: 'json',
                data: $("#deleteclientform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                           alert(res.err);
                           window.location= base_url + res.redirect;

                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });

    $(document).ready(function() {
        $("#updateclient_location").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "ClientController/update_location",
                dataType: 'json',
                data: $("#updatelocationform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                         alert(res.err);
                         $('#editlocationmodal').modal('show');
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });


  
$(document).ready(function() {
 var url= base_url + "ChatController/message_notification";
  window.setInterval(function(){
  $.getJSON(url,function(data){
  if (data.numberofmessage == 0){
    $('.userclient').html();
      }
  else{
    $('.userclient').html(data.numberofmessage);
  }
 })
 }, 1000);
});

$(document).ready(function() {
  $(".messagetoclient").click(function (e) {
      $('.shout_box').show(); 
      $('.toggle_chat').show();

      var clientid= $(this).data('clientid');
          dataEdit = 'clientid='+ clientid;
          $('[name="clientid"]').val(clientid); 
          var username = $('[name="username"]').val(); 
          window.setInterval(function(){
            $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ChatController/viewclientid/'+ clientid,
            dataType: 'json',
            success:function(data){
              var chatbox = '';
              for (var i = 0; i < data.length; i++) {
                $('#clientname').text(data[i].clientfname + ' ' + data[i].clientlname);
               if (data[i].sendername == username ){
                   chatbox += '<div class="shout_msg"><time><b>'+data[i].seton+'</b></time><span class="message" style="color:white; background-color:#2e628e;"><b>'+data[i].message+'</b></span></div>';
                  }
                else{
                    chatbox += '<div class="shout_msg"><time><b>'+data[i].seton+'</b></time><span class="message" style="color:b"><b>'+data[i].message+'</b></span></div>';

                }
                }
                $('.message_box').html(chatbox);
                var scrolltoh = $('.message_box')[0].scrollHeight;
                $('.message_box').scrollTop(scrolltoh);
              
            }
          });
          }, 1000);  
  
  });

  $(".close_btn").click(function (e) {
      $('.shout_box').hide(); 
      $('.toggle_chat').hide(); 

  });

    $(".header").click(function (e) {
      $('.toggle_chat').slideToggle();  

  });

});


$(document).ready(function() {
  $("#messagefrom").keypress(function(evt) {
    if(evt.which == 13) {
      $.ajax({
      type: "POST",
      url: base_url + "ChatController/admin_chat",
      dataType: 'json',
      data: $("#chatformadmin").serialize(),
      success: function(res) {
      if (res.response=="success"){
         $('.message_box').append('<div class="shout_msg"><time><b>'+res.chat.seton+'</b></time><span class="message"><b>'+res.chat.message+'</b></span></div>');
          var scrolltoh = $('.message_box')[0].scrollHeight;
          $('.message_box').scrollTop(scrolltoh);
          $('#messagefrom').val('');
        }
      else{
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
$('[name="month"],[name="year"]').change(function() 
{ 
var year = $('[name="year"]').val();
var month = $('[name="month"]').val();
var dataString = 'month='+ month + '&year='+ year;
if(year!="" && month!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ApplicantController/filter_requestclient',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
     for (var i = 0; i < data.length; i++) {
          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailaddress+'</td>'+
                  '<td>'+data[i].numberofrequest+'</td>'+
                  '<td>'+data[i].daterequest+'</td>'+
                  '</tr>';
              }
             $('.requestclient').html(table);
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
var dataString = 'year='+ year + '&status=' + status;
if(year!="" && status!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ClientController/filter_contactemployee',
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
         text = remainingday ;
      }
      else{
          text = remainingmonth;
      }
          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].datestart+'</td>'+
                  '<td>'+data[i].datecontract+'</td>'+
                  '<td>'+text+' days</td>'+
                  '<td>'+data[i].status+'</td>'+
                  "<td><a href='"+base_url+"EmployeeController/viewcontract_reportemployee/"+data[i].employeeID+"' class='btn btn-primary btm-sm'>View Contract</a></td>"+
                  '</tr>';
              }
             $('.reportcontract').html(table);
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
var dataString = 'year='+ year + '&status=' + status;
if(year!="" && status!=""){
  $.ajax({
  type: "POST",
  url: base_url + 'ClientController/filter_contactemployeemonitor',
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
         text = remainingday ;
      }
      else{
          text = remainingmonth;
      }
          table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].datestart+'</td>'+
                  '<td>'+data[i].datecontract+'</td>'+
                  '<td>'+text+'</td>'+
                  '<td>'+data[i].status+'</td>'+
                  '</tr>';
              }
             $('.monitorcontract').html(table);
     }
  });
}
});
});


$(document).ready(function() {
$("#changeprofile").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "ClientController/update_account",
dataType: 'json',
data: $("#updateprofileform").serialize(),
success: function(res) {
if (res.response=="success"){
alert(res.message);
window.location= base_url + res.redirect; 
}
else{
alert(res.err);
$('#adminprofile').modal('show');
}
},
  resetForm: true 
});
  return false;
});
});

//for user change password
$(document).ready(function() {
$("#changepassword").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "ClientController/update_password",
dataType: 'json',
data: $("#changepasswordform").serialize(),
success: function(res) {
if (res.response=="success"){
alert(res.message);
window.location= base_url + res.redirect;

}
else{
alert(res.err);
$('#changepwd').modal('show');
$('[name="oldpassword"]').val('');
$('[name="newpassword"]').val('');
$('[name="retypepassword"]').val('');

}
},
  resetForm: true 
});
  return false;
});
});

//filter extend

$(function(){
$('[name="year"]').change(function() 
{ 
var year = $('[name="year"]').val();
var dataString = 'year='+ year ;
if(year!="" ){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filter_extendemployee',
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
                  '<td>'+data[i].username+'</td>'+
                  '<td>'+data[i].extend+'</td>'+
                  '<td>'+data[i].dateextend+'</td>'+
                  '</tr>';
              }
             $('.monitorextend').html(table);
     }
  });
}
});
});

// filter extend employee
$(function(){
$('[name="year"]').change(function() 
{ 
var year = $('[name="year"]').val();
var dataString = 'year='+ year ;
if(year!="" ){
  $.ajax({
  type: "POST",
  url: base_url + 'ApplicantController/filter_extendemployee',
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
                  '<td>'+data[i].dateextend+'</td>'+
                  '</tr>';
              }
             $('.monitorextend').html(table);
     }
  });
}
});
});


