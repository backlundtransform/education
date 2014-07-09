$(document).ready(function(){
	

	
	
	var sanitize = function(input) {
		var output = input.replace(/<script[^>]*?>.*?<\/script>/gi, '').
					 replace(/<[\/\!]*?[^<>]*?>/gi, '').
					 replace(/<style[^>]*?>.*?<\/style>/gi, '').
					 replace(/<![\s\S]*?--[ \t\n\r]*>/gi, '');
	    return $.trim(output);
	};
	  $('.editor').click(function() {
 	
 	
       $(this).addClass("editable");
       
     
       $(this).focusout(function() {
   
			$(this).removeClass("editable");
			if($(this).data('param')=="description"){
				
   			 $.ajax({url:"http://localhost/sfi/public/exerciseupdate", data : {description : $(this).html(), id : $(this).data('id')}});
   			}
   			
   		
   			});
   			
		
		
   
 });

 
	 });
    
    
