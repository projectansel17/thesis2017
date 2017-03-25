
//<!--Script datepicker-->


//for registerter form validation
$(document).ready(function() {
$("#submit").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "actions/User/add_customer",
dataType: 'json',
data: $("#registerform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.email_sent);
console.log(res);
window.location=base_url + "home";
}

else if (res.response=="error"){
alert(res.validate_errors);
$('p.error').show();
$('#registerform').modal('show');
}

else{
alert(res.error_email_sent);
$('#registerform').modal('show');

}
},
	resetForm: true 
});
	return false;
});
});
// for login form  validation
$(document).ready(function() {
$("#login").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "UserController/login_user",
dataType: 'json',
data: $("#frmlogin").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
console.log(res);
window.location= base_url + res.redirect;
}
else{
alert(res.message);
}
},
  resetForm: true 
});
  return false;
});
});
// for verify email form
$(document).ready(function() {
$("#verify").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "actions/User/resend_email",
dataType: 'json',
data: $("#resendemailform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);

}
else{
alert(res.message);
}
},
  resetForm: true 
});
  return false;
});
});
//for forgot form validation
$(document).ready(function() {
$("#forgotpass").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "actions/User/forgot_password",
dataType: 'json',
data: $("#forgotpasswordform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
}
else{
alert(res.message);
$('#forgotpasswordmodal').modal('show');
}
},
  resetForm: true 
});
  return false;
});
});

//for reset form validation
$(document).ready(function() {
$("#reset").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "actions/User/update_user_password",
dataType: 'json',
data: $("#resetform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
$('p.result').html(res.message);
$("#password").val('');
$("#retypepass").val('');

}
else{
$('p.result').html(res.message);
$("#password").val('');
$("#retypepass").val('');
}
},
  resetForm: true 
});
  return false;
});
});


$(function(){
  $('body').delegate('#validate','click', function(){
           var $row = $(this).closest("tr");    // Find the row
           var $tds = $row.find(".categoryname").val();
           var $nonempty = $('.categoryname').filter(function() {
           return this.value != ''
          });
           if ($nonempty.length == 0) {
              alert('empty');
              window.location="adminpage/room/manageroom";
             }   else if ($tds==""){        
               alert("error");     
                   window.location="<?php base_url(); ?>adminpage/room/manageroom";
                  }
               else{
                  $.ajax({
                  type: "POST",
                  url: base_url + "actions/Room/add_category",
                  dataType: 'json',
                  data: $("#addcategoryform").serialize(),
                  success: function(res) {
                  if (res.response=="success"){
                     //Show Entered Value
                  alert(res.response);
                  }
                  else{
                      alert("error");
                  }
               },
                 resetForm: true
            });
              return false;
          }
      });
  });