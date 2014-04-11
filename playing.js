function show()  
	{  
		$.ajax({  
		url: "index.php",  
		cache: false,  
		success: function(html){  
		$("#listeners").html(html);
								}  
				});  
    }  

$(document).ready(function(){  
	show();
	setInterval('show()',1000);
	}); 
	