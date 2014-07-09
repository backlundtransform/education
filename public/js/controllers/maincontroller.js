app.controller("MainController", function($scope, $rootScope) {
	
	
	 $rootScope.order={ value: "desc"};
             $rootScope.sort= { value: "created_at"};
          $rootScope.image= { value: 'images/Arrow-up-navmenu.png'};
          
      
	
	$rootScope.numbers=[{
    	value: 3,
    	label: 'Visa 3 rader per sida',
    	
  	}, {
    	value: 6,
    	label: 'Visa 6 rader per sida'
  	},
  
  	{
    	value: 10,
    	label: 'Visa 10 rader per sida'
  	},
  
  	{
   		 value: 15,
   		 label: 'Visa 15 rader per sida'
  	}
  
  
  ];   
  
  
   $rootScope.main = {
                page: 1
          
            };
            
            
                        
         $rootScope.clickpage = function(id) {
               $scope.main.page =id;
              
            };
            
            $rootScope.nextPage = function() {
                if ($scope.main.page < $scope.main.pages) {
                    $scope.main.page++;
                   
                }
            };
            
            $rootScope.previousPage = function() {
                if ($scope.main.page > 1) {
                    $scope.main.page--;
                  
                }
            };
            
            $rootScope.orderclick = function(sort) {
             	
             	$scope.sort.value=sort;
             	
             	if ($scope.order.value=="asc") {
             		
             		$scope.order.value="desc";
             		 $scope.image.value= 'images/Arrow-down-navmenu.png';
             	
             		
             	}
             	else if($scope.order.value="desc"){
             		
             		$scope.order.value="asc";
             			$scope.image.value='images/Arrow-up-navmenu.png';
             		
             	}
     
             	
             	  };
            
               
         

	
});




app.controller("QuestionController", function($scope, $rootScope, $window, $filter, Option, Question, fileUpload, Pagination) {

	$scope.exercise_id=$('#editable').data('id');
	$scope.items = [];
  	$scope.avatars = [];
 	$scope.pagenumbers  = [];
 	$scope.main = $rootScope.main;
	
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
   	$scope.numbers= $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
    
            $scope.loadPage = function() {
            	
             	Question.get($scope.exercise_id, $scope.main.page, $scope.sort.value, $scope.order.value, number).success(function(data){
             		
                		$scope.questions = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
            			
            			
				
				for (var i = 0; i < number; i++) { 
						
						extension=$scope.questions[i].files;
						
			 			if(extension.indexOf("jpg") > -1 || extension.indexOf("png") > -1 || extension.indexOf("gif") > -1){

						$scope.avatars.push('image' );
						}else if(extension.indexOf("mp4") > -1 || extension.indexOf("flv") > -1 || extension.indexOf("aac") > -1 || extension.indexOf("mp3") > -1 || extension.indexOf("vorbis") > -1){
						$scope.avatars.push('video');

						
						}else{
			  			$scope.avatars.push('nothing');
						};
			 	
		};

                
			 
                });
                
              
              };
 
 $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 $scope.$watch('image.value', function() {  $scope.loadPage();  });
              $scope.loadPage();
 $scope.getnumber = function() {
		 number=$scope.numberList.value;
	$scope.loadPage(); 

	};    
          
    	$scope.addItem = function () {

       	 	$scope.items.push({
           
            option: $scope.itemOption
      	 	 });
      	  $scope.itemOption = "";

    };


   $scope.removeItem = function (index) {

       $scope.items.splice(index, 1);
        };

	$scope.update = function (index, id, question, answer) {
			var upload=eval("$scope.file"+id+ '');
			fileUpload.uploadFileToUrl(upload);
			 $scope.main.page=$(".active").html();
			   
		Question.update(id, question, answer, "files/"+upload.name ).success(function(data){
			Question.get($scope.exercise_id, $scope.main.page, $scope.sort.value, $scope.order.value, number).success(function(data){
             		$scope.questions = data.data;
             	
               $('img#'+index).attr("src", 'http://localhost/sfi/public/'+$scope.questions[index].files);
              
               $('.'+index).text($filter('timeago')($scope.questions[index].updated_at));  
            
			});
              
        });
    };    
		
$scope.goto = function (category_id, exercise_id, question_number) {
	
	window.location.href = '../../categories/'+category_id+'/exercises/'+exercise_id+'?question='+question_number;
};
$scope.create = function (id) {

		
		var file; 
		
 	
		if($scope.myFile){
		file= $scope.myFile;
        fileUpload.uploadFileToUrl(file);
        $.each( $scope.items, function( index, value ) {
			Option.save(value.option, 0);
			});
		
		Question.save($scope.question, $scope.answer,id, "files/"+file.name).success(function(data) {
					$scope.loadPage();
					$scope.question="";
					$scope.answer="";
					$scope.items = [];
   					sort="created_at";
		});
					
					
			
	
	}else{
		$.each( $scope.items, function( index, value ) {
			Option.save(value.option, 0);
		});
		Question.save($scope.question, $scope.answer,id, "").success(function(data) {
					$scope.loadPage();
					$scope.question="";
					$scope.answer="";
					$scope.items = [];
   					sort="created_at";
					
			});;
	};
	
		

};
	$scope.del = function (id) {
	
		$scope.id =id;
	};
	
	
	$('.delete').click(function() {
	
	Question.destroy($scope.id)
				.success(function(data) {

					$scope.loadPage();
			});

	
});


$scope.getindex = function (id, question, answer,files, index) {
		$scope.getid = id;
		$scope.getquestion = question;
		$scope.getanswer = answer;
		$scope.getfiles = files;
		$scope.index = index;
};

$('.text').click(function() {
 	  
 	 $(this).addClass("editable");
     $(this).focusout(function() {
      
			$(this).removeClass("editable");
			 
   			
   			if($(this).data('param')=="answer"){
   			  $scope.getanswer = $(this).text();
   			 	}
   			else if($(this).data('param')=="question"){
   			  $scope.getquestion = $(this).text();
   			}
   			  $scope.main.page=$(".active").html();
   			
   			
			Question.update($scope.getid, $scope.getquestion, $scope.getanswer, $scope.getfiles).success(function(data){
				Question.get($scope.exercise_id, $scope.main.page, $scope.sort, $scope.order,number).success(function(data){
             		$scope.questions = data.data;
           			$('.'+$scope.index).text($filter('timeago')($scope.questions[$scope.index].updated_at)); 
          });
   			
   		});
   	});	
		
		
   
 });

});

app.controller("ExerciseController", function($scope, $rootScope, $window, $filter, Exercise, fileUpload, Pagination, Category) {
	
	$scope.categories = [];
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
   $scope.numbers= $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };


$scope.loadSelect = function(order) {
	Category.getselect().success(function(data){
             		
            $scope.categories = data;
             $scope.cat_arr=new Array();
 			$.each($scope.categories, function( index, value ) {
			 $scope.cat_arr[value.id]=value.title;
			 	

		});
                      
               
                });
              };
 
	$scope.loadPage = function(order) {
             	Exercise.get($scope.main.page, $scope.sort.value, $scope.order.value, number).success(function(data){
             		
                      	$scope.exercises = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
            			
                
			 
                });
                
              
              };
              
    	$scope.$watch('main.page', function() { $scope.loadPage(); }); 
		$scope.$watch('image.value', function() {  $scope.loadPage();  });
              $scope.loadPage();
              $scope.loadSelect();
 		$scope.getnumber = function() {
		 	number=$scope.numberList.value;
		$scope.loadPage(); 

	}; 
	 
    	$scope.del = function (id) {
	
		$scope.id = id;
	};
	
	
	$('.delete').click(function() {
	
	Exercise.destroy($scope.id)
				.success(function(data) {

					$scope.loadPage();
			});
});   





$scope.getindex = function (id, title, locked, category_id, index) {
		$scope.getid = id;
		$scope.gettitle = title;
		$scope.getlocked = locked;
		$scope.getcategory_id = category_id;
		$scope.index = index;
		
		
			$scope.updatepage = function () {
				
				Exercise.update($scope.getid,$scope.gettitle, $scope.getlocked, $scope.getcategory_id).success(function(data){
				 
				    $scope.loadPage();   			
   			});
	
		
	};
	

		$('.cat'+$scope.index).click(function() {
	
			$scope.updatepage();
			
			});
		
	
		
			$('td').on('click', '.lock', function () {
				
				if($scope.getlocked == '0'){
					
					$scope.getlocked = '1';
				}
				else if($scope.getlocked == '1')
				{
					$scope.getlocked = '0';
				};
 		
 		$scope.updatepage();
 		 });
		
		$('.text').click(function() {
		 	 $(this).addClass("editable");
             $(this).focusout(function() {
             $(this).removeClass("editable");
			
			if($(this).data('param')=="title"){
				$scope.gettitle = $(this).text();
   			 };
   			
   			  $scope.main.page=$(".active").html();
   			 
   			$scope.updatepage();
   	});});
};



$scope.create = function () {
	var category_id=$('select[name=category_id]  :selected').val();
	
	Exercise.save($scope.title, category_id).success(function(data) {
					$scope.loadPage();
			});
	
};

 
          
	
});

app.controller("CategoryController", function($scope, $rootScope, $window, $filter, Category, fileUpload, Pagination) {
	
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
    $scope.numbers= $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
    
   
            $scope.loadPage = function() {
            	
             	Category.get($scope.main.page, $scope.sort.value, $scope.order.value, number).success(function(data){
             	
                		$scope.categories = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
                
			 
                });
                
              
              };
 
 $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 $scope.$watch('image.value', function() {  $scope.loadPage();  });
              $scope.loadPage();
 $scope.getnumber = function() {
		 number=$scope.numberList.value;
	$scope.loadPage(); 

	};    
	$scope.getindex = function (id, index) {
		$scope.getid = id;
		$scope.index = index;
		$('.text').click(function() {
			
			$(this).addClass("editable");
			$(this).focusout(function() {
      
			$(this).removeClass("editable");
			 
   			
   			
   			  $scope.gettitle = $(this).text();
   			 	
   			
			Category.update($scope.getid, $scope.gettitle).success(function(data){
				
				 $scope.loadPage();
                
   				});
   				
   					
  
  
  		 	});	
		});
};


   	$scope.del = function (id) {
	
		$scope.id = id;
	};
	
	
	$('.delete').click(function() {
	
	Category.destroy($scope.id)
				.success(function(data) {
					$scope.loadPage();
			}).error(function(data) {
					alert("Du kan inte ta bort gruppen eftersom den har användare");
				});	});
	$scope.create = function () {
		
	Category.save($scope.title).success(function(data) {
					$scope.loadPage();
			});
};
	
	});
	
app.controller("UserController", function($scope, $rootScope, $window, $filter, User, Category, fileUpload, Pagination) {
	  var role = $('#role').val();
	 
	$scope.categories = [];
	$scope.actives = [{"id":1,"label":"Aktiv"},{"id":0,"label":"Inaktiv"}];
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order = $rootScope.order;
    $scope.sort = $rootScope.sort;
    $scope.image = $rootScope.image;
    $scope.numbers = $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
    
    
     $scope.loadSelect = function() {
	Category.getselect().success(function(data){
             		
            $scope.categories = data;
             $scope.cat_arr=new Array();
 			$.each($scope.categories, function( index, value ) {
			 $scope.cat_arr[value.id]=value.title;
			 	

		});
                      
               
                });
              };
            $scope.loadPage = function() {
            	
             	User.get($scope.main.page, $scope.sort.value, $scope.order.value, number, role).success(function(data){
             	
                		$scope.users = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
                
			 
                });
                
              
              };
 
 $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 $scope.$watch('image.value', function() {  $scope.loadPage();  });
              $scope.loadPage();
                $scope.loadSelect();
 $scope.getnumber = function() {
		 number=$scope.numberList.value;
	$scope.loadPage(); 

	};
	
	
	
	
			$scope.updatepage = function () {
				
				User.update($scope.getid,$scope.getcategory_id, $scope.getactive).success(function(data){
			$scope.loadPage(); 
   			
   			});
	
		};
		
	$scope.getindex = function (id, category_id, active, index) {
		$scope.getid = id;
		$scope.getcategory_id = category_id;
		$scope.getactive= active;
		$scope.index = index;	
		$scope.getcategory_id;
		$scope.updatepage();
			
		
		};
			$scope.del = function (id) {
	
		$scope.id = id;
	};
	
		
		$('.delete').click(function() {
	
	User.destroy($scope.id)
				.success(function(data) {
					$scope.loadPage();
			});	});


	
	$scope.teach = function () {
		
		
		User.promote($scope.email)
				.success(function(data) {
					if(data.success){
					$scope.loadPage();
					}else{
						
						alert("Användaren finns inte");
					}
			});	
		
	};
		

});


app.controller("ExamsController", function($scope, $rootScope,Exam, $filter, fileUpload, Pagination, Category) {
	
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
    $scope.numbers= $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
    
   $scope.loadSelect = function(order) {
	Category.getselect().success(function(data){
             		
            $scope.categories = data;
             $scope.cat_arr=new Array();
 			$.each($scope.categories, function( index, value ) {
			 $scope.cat_arr[value.id]=value.title;
			 	

		});
                      
               
                });
              };
            $scope.loadPage = function() {
            	
             	Exam.get($scope.main.page, $scope.sort.value, $scope.order.value, number).success(function(data){
             	
                		$scope.exams = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
                
			 
                });
                
              
              };
 
 $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 $scope.$watch('image.value', function() {  $scope.loadPage();  });
              $scope.loadPage();
               $scope.loadSelect();
 $scope.getnumber = function() {
		 number=$scope.numberList.value;
	$scope.loadPage(); 

	};   
	
	
     $scope.create = function () {

		var category_id=$('select[name=category_id]  :selected').val();
		var file; 
		
 	
		file= $scope.myFile;
        fileUpload.uploadFileToUrl(file);
       
		Exam.save($scope.title,"files/"+file.name, category_id).success(function(data) {
					$scope.loadPage();
					$scope.title="";
				
   					sort="created_at";
		});
					
					
			
	
};
$scope.updatepage = function () {
				
				Exam.update($scope.getid,$scope.gettitle, $scope.getcategory_id).success(function(data){
			
				   $scope.loadPage();
   			
   			});
	
		};
		
$scope.gettitle = function (id, category_id, title, index) {
	
		$scope.getid = id;
		$scope.getcategory_id = category_id;
		$scope.gettitle= title;
		$scope.index = index;	
		$('.text').click(function() {
			
			$(this).addClass("editable");
			$(this).focusout(function() {
      
			$(this).removeClass("editable");
			 
   			
   			
   			  $scope.gettitle = $(this).text();
   			 	$scope.updatepage();
   			
			
                
   				});});
		
	
			
		
		};
		$scope.getindex = function (id, category_id, title, index) {
	
		$scope.getid = id;
		$scope.getcategory_id = category_id;
		$scope.gettitle= title;
		$scope.index = index;	
		
   			 	$scope.updatepage();
   		
		};
		
		
			$scope.del = function (id) {
	
		$scope.id = id;
	};
	
		
		$('.delete').click(function() {
	
	Exam.destroy($scope.id)
				.success(function(data) {
					$scope.loadPage();
			});	});

       
      
	
	
	
	 });
	 
app.controller("ProfileController", function($scope, $rootScope,Exam, $filter, Pagination) {
	
	
  var category_id = $('#category').val();

	
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
    $scope.numbers= $rootScope.numbers; 
     var number;
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
  
            $scope.loadPage = function() {
            	
             	Exam.profile($scope.main.page, $scope.sort.value, $scope.order.value, number, category_id).success(function(data){
             			category_id = $('#category').val();
                		$scope.exams = data.data;
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
                
			 
                });
                
              
              };
 
 $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 $scope.$watch('image.value', function() {$scope.loadPage();});
              $scope.loadPage();
 $scope.getnumber = function() {
		 number=$scope.numberList.value;
	$scope.loadPage(); 

	};   
 });
 
app.controller("MessageController", function($scope, $rootScope, Message, $filter, Pagination) {
	
	$scope.main = $rootScope.main;
	$scope.pagenumbers  = [];
    $scope.order=$rootScope.order;
    $scope.sort=$rootScope.sort;
    $scope.image=$rootScope.image;
    $scope.numbers= $rootScope.numbers; 
    var number;
    
    
    
   
    $scope.sent='false';
   
   try
  {
  		number=$scope.numberList.value;
  }
		catch(err)
  {
		 number=$scope.numbers[0].value;
  };
   $scope.user_arr=new Array();
            $scope.loadPage = function() {
            
             	Message.read($scope.main.page, $scope.sort.value, $scope.order.value, number,$scope.sent).success(function(data){
             			
                		$scope.messages = data.data;
                		
                		
 			$.each($scope.messages , function(index, value) {
 				
 				

 					 Message.find(value.sender).success(function(user){
             				 $scope.user_arr[value.sender]=user.replace(/^"(.+(?="$))"$/, '$1');;
             	
 					});
 					 
 					 Message.find(value.receiver).success(function(user){
             				 $scope.user_arr[value.receiver]=user.replace(/^"(.+(?="$))"$/, '$1');;
              
 					

 				});
 				
		
			 	

		});
                        	
                     	$scope.main.pages = data.last_page;
                     	$scope.pagenumbers  = [];
                  
            			$scope.pagenumbers  = Pagination.click($scope.main.page, data.last_page);
                
			 
                });
                
              
              };
               $scope.$watch('main.page', function() { $scope.loadPage(); }); 

 					$scope.$watch('image.value', function() { $scope.loadPage();  });
             	 $scope.loadPage();
 				$scope.getnumber = function() {
		 			number=$scope.numberList.value;
					$scope.loadPage(); 

	};   
  $scope.change = function() {
    $scope.sent=$('input[type="radio"]:checked').val();
   
    $scope.loadPage(); 
        };

  $scope.send = function (sender, receiver){

	
       
    
		Message.send($scope.subject,$scope.message,receiver,sender).success(function(data) {
				
					if(data.success){
						alert("Meddelande sänt!");
						$scope.subject="";
							$scope.message="";
					}else{
						
						alert("Meddelande sändes inte!");
					}
		}); };
		 $scope.sendtogroup = function (sender, group){
		Message.sendtogroup($scope.subject,$scope.message,sender,group).success(function(data) {
				
					if(data.success){
						alert("Meddelande sänt!");
							$scope.subject="";
							$scope.message="";
					}else{
						
						alert("Inga användare i denna grupp");
					}
		}); };
		
		$scope.del = function (id) {
	
		$scope.id = id;
	};
	
		
		$('.delete').click(function() {
			
	
	Message.destroy($scope.id)
				.success(function(data) {
					$scope.loadPage();
			});	});

		
 });	

