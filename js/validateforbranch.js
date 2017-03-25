
 $(function(){
      $('#addbranch').click(function(){
    addnewrow();

    });
    $('body').delegate('#remove','click', function(){
              var count= $('table').find('.branchdetail').children().length;
              if (count!=1){
              $(this).closest ('tr').remove();
         }
 });

function addnewrow(){
     var n= ($('.branchdetail tr').length -0)+1;
     var tr= '<tr>'+
             '<td><input class="form-control branchname" name="branchname[]"  type="text"></td>'+  
              '<td>  <button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>' +
              '</tr>';
            $('.branchdetail').append(tr);
                }
         });


 $(function(){
  $('body').delegate('#validatebranch','click', function(){
           var $nonempty = $('.branchname').filter(function() {
           return this.value != ''
          });
           if ($nonempty.length == 0) {
              alert('Please input this failed');
              $('#addbranchmodal').modal('show');
            }
               else{
                  $.ajax({
                  type: "POST",
                  url: base_url + "BranchController/add_branch",
                 dataType: 'json' ,
                  data: $("#addbranchform").serialize(),
                  success: function(res) {
                  if (res.response=="success"){
                     //Show Entered Value
                    alert(res.message);
                    window.location= base_url + res.redirect;
                  }
                  else{
                    alert(res.err);
                    $('#addbranchmodal').modal('show');


                  }
               },
                 resetForm: true
            });
              return false;
          }
      });
  });


    $(document).on("click", ".viewbranch", function(e){
        e.preventDefault();
        var branchid= $(this).data('branchid');
        dataEdit = 'branchid='+ branchid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'BranchController/viewbranchdetail/'+ branchid ,
            dataType: 'json',
            success:function(data){
              $('[name="branchid"]').val(data.branchID);
              $('[name="branchname"]').val(data.branchname); 
                          
            }
          });

    });

    // for login form  validation
    $(document).ready(function() {
    $("[name='updatebranch']" ).click(function(event) {
    event.preventDefault();
    $.ajax({
    type: "POST",
    url: base_url + "BranchController/update_branch",
    dataType: 'json',
    data: $("#updatebranchform").serialize(),
    success: function(res) {
    if (res.response=="success"){
// Show Entered Value
    alert(res.message);
    console.log(res);
    window.location= base_url + res.redirect;
    }
    else{
    alert(res.err);
        $('#updatebranchmodal').modal('show');
    }
  },
      resetForm: true 
  });
  return false;
  });
});



    $('body').delegate('#remove','click', function(){
              var count= $('table').find('.locationdetail').children().length;
              if (count!=1){
              $(this).closest ('tr').remove();
         }
 });
 $(function(){
      $('#addlocation').click(function(){
         addnewrow();

    });
      
function addnewrow(){
                var tr= '<tr>'+
                '<td><input class="form-control locationname" name="locationname[]" id="locationame"  type="text"></td>'+  
                '<td><select class="vbranch form-control" id="vbranch" name="branchname"></select></td>'+
                '<td> <button type="button" class="btn btn-danger remove" name="remove" id="remove">Remove</button></td>' +
                '</tr>';
                 $('.locationdetail').append(tr);
                     var exist = {};
                     $('.locationdetail, select > option').each(function() {
                        if (exist[$(this).val()]){
                              $(this).remove();
                            }
                            else{
                                exist[$(this).val()] = true;
                              }
                            });
                  var url= base_url + 'BranchController/viewbranchname';
                  $.getJSON(url,function(data){
                  $.each(data.viewbranch, function(i,post){
                  $('.vbranch').append( '<option value="'+post.branchID+'">'+post.branchname+'</option>' );
                  });
              });

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
            url: base_url +'BranchController/viewlocationdetail/'+ locationid ,
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
                  url: base_url + "BranchController/add_location",
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
    url: base_url + "BranchController/update_location",
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
  $(document).ready(function() {
        $("#delete_branch").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "BranchController/delete_branch",
                dataType: 'json',
                data: $("#deletebranchform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                           alert(res.message);
                           window.location= base_url + res.redirect;
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });
    $(document).ready(function() {
        $("#delete_location").click(function(event) {
        event.preventDefault();
        $.ajax({
                type: "POST",
                url: base_url + "BranchController/delete_location",
                dataType: 'json',
                data: $("#deletelocationform").serialize(),
                success: function(res) {
                    if (res.response=="success"){
                         alert(res.message);
                         window.location= base_url + res.redirect;
                    }
                    else{
                           alert(res.message);
                           window.location= base_url + res.redirect;
                        }
                    },
                        resetForm: true 
                    });
                       return false;
              });
        });
