

  //notification to admin
$(document).ready(function() {
 var url= base_url + "ChatController/message_notificationadmin";
  window.setInterval(function(){
  $.getJSON(url,function(data){
  if (data.numberofmessageadmin == 0){
    $('.useradmin').html();
    $('.gg').removeAttr('href');

  
  }
  else{
    $('.useradmin').html(data.numberofmessageadmin);
    var url = base_url + "ClientController/dashboard"; 
    $('.gg').attr('href', url);

  }
 })
 }, 1000);
});



//send to admin
$(document).ready(function() {
	$(".messageto").click(function (e) {
			$('.shout_box').show();	
			$('.toggle_chat').show();
		 	var userid= $(this).data('userid');
        	dataEdit = 'userid='+ userid;
            $('[name="userid"]').val(userid); 
            $('.adminuser').text($(this).text()); 
            var username = $('[name="username"]').val(); 
        	window.setInterval(function(){
       	    $.ajax({
            type:'GET',
            data:dataEdit,
            url: base_url +'ChatController/viewuserid/'+ userid,
            dataType: 'json',
            success:function(data){
            	var chatbox = '';
            	for (var i = 0; i < data.length; i++) {
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
	$("#message").keypress(function(evt) {
		if(evt.which == 13) {
			$.ajax({
			type: "POST",
			url: base_url + "ChatController/add_chat",
			dataType: 'json',
			data: $("#chatform").serialize(),
			success: function(res) {
			if (res.response=="success"){
				 $('.message_box').append('<div class="shout_msg"><time><b>'+res.chat.seton+'</b></time><span class="message"><b>'+res.chat.message+'</b></span></div>');
					var scrolltoh = $('.message_box')[0].scrollHeight;
					$('.message_box').scrollTop(scrolltoh);
					$('#message').val('');
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
	

