/*<![CDATA[*/$(document).ready( 
	function  ()
	{
		var button = $('#fileselector'), interval;
		var feedback = $("#thisfile");
		new AjaxUpload(button,{
			action: 'server-side/upload-handler.php', 
			name: 'uploadfile',
			onSubmit : function(file, ext){
				var temp = $('#expire_time').val();					
				button.addClass('hidden');				
				this.setData({
						'expirevalue': temp
				});	
				feedback.removeClass('hidden');
				feedback.html('<img src="../images/ajax-loader.gif" />');
			},
			onComplete: function(file, response){
				$("#filekey").val(response);
				feedback.html(file + "<span id='changefile'>Change</span>");	
				$("#changefile").click(function(){
						feedback.addClass('hidden');
						button.removeClass('hidden');
						$("#filekey").val('');
				});			
			}
		});		
		
		$("#uploadbutton").click(function(){
			 if($("#filekey").val() == '')
			 {
				 $("#error").html("X Please select a file first.");
			 }
			 else
			 {
				 loadFile($("#filekey").val());
			 }
		});	
		
	}	
);
			   
function loadFile(filekey)
{
	$.ajax({
			type: "POST",
			cache: false, 
			url: "server-side/activate.php",
			dataType : 'json',
			data: {
					filekey : filekey
			},
			success: function(data)
				 {
					 if(data)
					 {
						 if (data.success_state) 
						 {
							$("#filelink").attr("href", data.fileurl);
							$("#filelink").text(data.fileurl);							
							$("#upload").html($("#uploaded").html());
						 }
						 else
						 {
							$("#error").html("<span class='error'>Sorry, there was an error. Please try again.</span>");
						 }
					 }
					 else
					 {
						$("#error").html("<span class='error'>Sorry, there was an error. Please try again.</span>");
					 }						 
			}
		});
}
			   
/*]]>*/