
    $(document).on("click", ".viewscheduleemployee", function(e){
        e.preventDefault();
        var employeeid= $(this).data('employeeid');
        dataEdit = 'employeeid='+ employeeid;
        $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ScheduleController/viewschedule_datail/'+ employeeid ,
            dataType: 'json',
            success:function(data){
            var table = "";
             for (var i = 0; i < data.length; i++) {
                  table += '<tr><td>'+data[i].dateschedule +'</td>'+
                  '<td>'+ data[i].intime + ' ' + data[i].outtime + '</td>'+
                  '<td>'+data[i].dayoff+'</td>'+
                  '<td>'+data[i].datechange+'</td>'+
                  '</tr>';
              }
               $('.scheduleemployee').html(table);
            }
          });

    });

    // filter extend employee
$(function(){
$('[name="year"], [name="status"]').change(function() 
{ 
var year = $('[name="year"]').val();
var status = $('[name="status"]').val();
var dataString = 'year='+ year + '&status='+ status;
if(year!="" ){
  $.ajax({
  type: "POST",
  url: base_url + 'EmployeeController/filterfeedback_employee',
  data: dataString,
  dataType: 'json',
  cache: false, 
  success: function(data){
    var table = "";
    var text = "";

     for (var i = 0; i < data.length; i++) {        
        if (data[i].status == "Terminate"){
           text = data[i].dateterminate + ' ' + 'Terminate';
        }
        else {
           text = data[i].dateterminate + ' ' + 'Resign';
        }

        table += '<tr><td>'+ data[i].firstname + ' ' + data[i].lastname + '</td>'+
                  '<td>'+data[i].contact+'</td>'+
                  '<td>'+data[i].emailadd+'</td>'+
                  '<td>'+data[i].address+'</td>'+
                  '<td>'+data[i].branchname+'</td>'+
                  '<td>'+data[i].locationname+'</td>'+
                  '<td>'+text+'</td>'+
                  '<td>'+data[i].username+'</td>'+
                  '<td>'+data[i].status+'</td>'+
                  '</tr>';
              }
             $('.monitorfeedback').html(table);
     }
  });
}
});
});
