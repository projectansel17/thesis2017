
 $(function(){
    $('#addrequirement').click(function(){
    addnewrow();

    });
    $('body').delegate('#remove','click', function(){
              var count= $('table').find('.requirementdetail').children().length;
              if (count!=1){
              $(this).closest ('tr').remove();
         }
 });

function addnewrow(){
     var n= ($('.requirementdetail tr').length -0)+1;
     var tr= '<tr>'+
             '<td><input class="form-control requirement" name="requirement[]"  type="text"></td>'+  
              '<td>  <button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>' +
              '</tr>';
            $('.requirementdetail').append(tr);
                }
         });

    // for view location
    $(document).on("click", ".viewrequirement", function(e){
        e.preventDefault();
        var requirementid= $(this).data('requirementid');
        dataEdit = 'requirementid='+ requirementid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'RequirementController/viewrequirementdetail/'+ requirementid ,
            dataType: 'json',
            success:function(data){
              $('[name="requirementid"]').val(data.requirementID);
              $('[name="requirement"]').val(data.requirement); 
                          
            }
          });

    });

$(function(){
  $('body').delegate('#validaterequirement','click', function(){
           var $nonempty = $('.requirement').filter(function() {
           return this.value != ''
          });
           if ($nonempty.length == 0) {
              alert('Please input this failed');
              $('#addrequirementmodal').modal('show');
            }   
               else{
                  $.ajax({
                  type: "POST",
                  url: base_url + "RequirementController/add_requirement",
                 dataType: 'json' ,
                  data: $("#addrequirementform").serialize(),
                  success: function(res) {
                  if (res.response=="success"){
                     //Show Entered Value
                    alert(res.message);
                    window.location = base_url + res.redirect;
                  }
                  else{
                    alert(res.err);
                    $('#addrequirementmodal').modal('show');


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
    $("[name='updaterequirement']" ).click(function(event) {
    event.preventDefault();
    $.ajax({
    type: "POST",
    url: base_url + "RequirementController/update_requirement",
    dataType: 'json',
    data: $("#updaterequirementform").serialize(),
    success: function(res) {
    if (res.response=="success"){
// Show Entered Value
    alert(res.message);
    window.location = base_url + res.redirect;
    }
    else{
    alert(res.err);
        $('#updaterequirementmodal').modal('show');
    }
  },
      resetForm: true 
  });
  return false;
  });
});