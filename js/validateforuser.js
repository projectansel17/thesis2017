
//for registerter form validation
$(document).ready(function() {
$("#add_user").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "UserController/add_user",
dataType: 'json',
data: $("#adduserform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
window.location= base_url + res.redirect;
}
else{
alert(res.validate_errors);
	
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
$('#password').val('');
}
},
  resetForm: true 
});
  return false;
});
});

//for change user profile
$(document).ready(function() {
$("#changeprofile").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "UserController/update_account",
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
url: base_url + "UserController/update_password",
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
//for forgot form validation
$(document).ready(function() {
$("#forgot_pass").click(function(event) {
event.preventDefault();
$.ajax({
type: "POST",
url: base_url + "UserController/forgot_password",
dataType: 'json',
data: $("#forgotpasswordform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
alert(res.message);
$('#forgotpasswordmodal').modal('hide');
$('[name="username"],[name="emailaddress"]').val('');
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
url: base_url + "UserController/updateuser_password",
dataType: 'json',
data: $("#resetform").serialize(),
success: function(res) {
if (res.response=="success"){
// Show Entered Value
$('p.result').html(res.message);
$("#username").val('');
$("#emailaddress").val('');
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



