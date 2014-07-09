$(document).ready(function(){
	 

var question = function() {
		var category= $(".answer").data('category_id');
      var exercise = $(".answer").data('exercise');
      var question = $(".answer").data('question');
      var done = $(".answer").data('done');
      
    $.ajax({
        type : "POST",
        url : "http://localhost/sfi/public/level",
        data : 
        {
            done : done,
            category_id : category,
            exerciselevel : exercise,
           	questionlevel: question
            
        }
    });


};  

$("#answer").click(function(){
	
	$("#answer").css({"background": "#fff"});
	
});
	
	$("#a_1").click(function(){
		
			var answer;
	if($('input[type="radio"]:checked').val()){
		answer=$('input[type="radio"]:checked').val().toLowerCase();
		
	}else{
		answer=$("#answer").val().toLowerCase();
	
		
	}
	  
  	 var id = $(this).data('id');
  	
    $.ajax({
        type : "GET",
        url : "http://localhost/sfi/public/answer_a1",
        data : 
        {
            answer: answer,
            id: id
            
            
        },
  success:function(data){
  	
    if(data=="RÄTT"){
    	  $("#answer").css({"background": "#32ED3E"});
    	  $(".hidden").css({"display": "block"});
    	  $(".skip").css({"display": "none"});
    	  $(".result").css({"display": "block", "border-color":"#32ED3E"});
    	  $(".result").text("Du svarade rätt!");
    	  $("#border").load(document.URL  + ' #border');
    	  question();
    }
    else{
    	
    	
    	
    	  $("#answer").css({"background": "#ED3232"});
    	  $(".result").css({"display": "block","border-color":"#ED3232"});
    	  $(".skip").css({"display": "block"});
    	  $(".result").text("Du svarade Fel!");
    	  $("#border").load(document.URL  + ' #border');
    	   question();
    	
    }
   
   
  }
    });

  });
  	
  
});


