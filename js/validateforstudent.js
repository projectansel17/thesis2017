$(document).ready(function() { 
$('[name="file"]').change(function() 
{ 
var data = new FormData($('#uploadForm')[0]);
  $.ajax({
  type: "POST",
  url: base_url + 'HomeController/upload_file',
  secureuri   :false,
  mimeType: "multipart/form-data",
  contentType: false,
  cache: false,
  processData: false,
  data: data,
  dataType: 'json',
  success: function(res){
  if (res.response == "success") { // so atong gi gamit ang response property pang check sa value if success ba or error
            $(".errorMsg").show();
            $(".errorMsg").css("color", "green");
            $(".errorMsg").html(res.message); // diba ang err nga propery kay ang details sa error?
          }
          else {
            // nya kung error
            $(".errorMsg").show();
            $(".errorMsg").html(res.message); // diba ang err nga propery kay ang details sa error?
            $(".errorMsg").css("color", "red");
            // char char diri
          }
     }
  });
});
});

  $(document).ready(function() {
        $("#add_student").click(function(event) {
        event.preventDefault();
        var data = new FormData($('#uploadForm')[0]);
        $.ajax({
                type: "POST",
                url: base_url + 'HomeController/add_student',
                secureuri   :false,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                data: data,
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else if (res.response=="erroruploading"){
                         $(".errorMsg").show();
                         $(".errorMsg").html(res.message); // diba ang err nga propery kay ang details sa error?
                         $(".errorMsg").css("color", "red");
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

$(document).ready(function() {
 var url= base_url + "HomeController/notify_applicant";
  window.setInterval(function(){
  $.getJSON(url,function(data){
    $('.badge').html(data.numberofapplicant);
 })
 }, 1000);
});
