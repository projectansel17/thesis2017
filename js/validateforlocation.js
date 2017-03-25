
 $(function(){
    $('#addlocation').click(function(){
    addnewrow();

    });
    $('body').delegate('#remove','click', function(){
              var count= $('table').find('.locationdetail').children().length;
              if (count!=1){
              $(this).closest ('tr').remove();
         }
 });

function addnewrow(){
     var n= ($('.locationdetail tr').length -0)+1;
     var tr= '<tr>'+
             '<td><input class="form-control locationname" name="locationname[]"  type="text"></td>'+  
              '<td>  <button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>' +
              '</tr>';
            $('.locationdetail').append(tr);
                }
         });

    // for view location
    $(document).on("click", ".viewlocation", function(e){
        e.preventDefault();
        var locationid= $(this).data('locationid');
        dataEdit = 'locationid='+ locationid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'LocationController/viewlocationdetail/'+ locationid ,
            dataType: 'json',
            success:function(data){
              $('[name="locationid"]').val(data.locationID);
              $('[name="locationname"]').val(data.locationname); 
                          
            }
          });

    });

$(function(){
  $('body').delegate('#validatelocation','click', function(){
           var $nonempty = $('.locationname').filter(function() {
           return this.value != ''
          });
           if ($nonempty.length == 0) {
              alert('Please input this failed');
              $('#addlocationmodal').modal('show');
            }   
               else{
                  $.ajax({
                  type: "POST",
                  url: base_url + "LocationController/add_location",
                 dataType: 'json' ,
                  data: $("#addlocationform").serialize(),
                  success: function(res) {
                  if (res.response=="success"){
                     //Show Entered Value
                    alert(res.message);
                    window.location = base_url + res.redirect;
                  }
                  else{
                    alert(res.err);
                    $('#addlocationmodal').modal('show');


                  }
               },
                 resetForm: true
            });
              return false;
          }
      });
  });

    // for login form  validation
    $(document).ready(function() {
    $("[name='updatelocation']" ).click(function(event) {
    event.preventDefault();
    $.ajax({
    type: "POST",
    url: base_url + "LocationController/update_location",
    dataType: 'json',
    data: $("#updatelocationform").serialize(),
    success: function(res) {
    if (res.response=="success"){
// Show Entered Value
    alert(res.message);
    window.location = base_url + res.redirect;
    }
    else{
    alert(res.err);
        $('#updateclocationmodal').modal('show');
    }
  },
      resetForm: true 
  });
  return false;
  });
});