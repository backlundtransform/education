app.factory("Option", function($http) {
	return {
        save: function(option, id) {
           
          return $http.post('http://localhost/sfi/public/options/store', {'option' : option, 'id' : id});
		}
    };
});




app.factory("Question", function($http) {
	return {
		
		get : function(id, page,sort,order,number) {
			return $http.get('http://localhost/sfi/public/api/'+id+'/questions?page='+page+'&sort='+sort+'&order='+order+'&index='+number);
			},
        save: function(question, answer,exercise, file) {
           
          return $http.post('http://localhost/sfi/public/questions/store', {'question' : question, 'answer' : answer, 'exercise' : exercise, 'file' : file});
		},
		
		update: function(id, question, answer, file) {
           
          return $http.post('http://localhost/sfi/public/questionupdate', {'id' : id, 'question' : question, 'answer' : answer, 'file' : file});
		},
		destroy : function(id) {
				return $http.get('http://localhost/sfi/public/questions/destroy/' + id);
			}
    };
});


app.factory("Exercise", function($http) {
	return {
		
		get : function(page,sort,order,number) {
			return $http.get('http://localhost/sfi/public/api/exercises?page='+page+'&sort='+sort+'&order='+order+'&index='+number);
			},
        save: function(title, category_id) {
           
          return $http.post('http://localhost/sfi/public/exercises/store', {'title' : title, 'category_id' : category_id});
		},
		
		update: function(id, title, locked, category_id) {
           
          return $http.post('http://localhost/sfi/public/exerciseupdate', {'id' : id, 'title' : title, 'locked' : locked, 'category_id' : category_id});
		},
		destroy : function(id) {
				return $http.get('http://localhost/sfi/public/exercises/destroy/' + id);
			}
    };
});


app.factory("Category", function($http) {
	return {
		
		getselect : function() {
			return $http.get('http://localhost/sfi/public/api/categories');
		}, 
		get : function(page,sort,order,number) {
			
			return $http.get('http://localhost/sfi/public/api/categories?page='+page+'&sort='+sort+'&order='+order+'&index='+number);
			},
        save: function(title) {
           
          return $http.post('http://localhost/sfi/public/categories/store', {'title' : title});
		},
		
		update: function(id, title) {
		
           
          return $http.post('http://localhost/sfi/public/categoryupdate', {'id' : id, 'title' : title});
		},
		destroy : function(id) {
				return $http.get('http://localhost/sfi/public/categories/destroy/' + id);
			}
        
    };
});


app.factory("User", function($http) {
	return {
		
		 
		promote : function(email) {
			
			 return $http.get('http://localhost/sfi/public/nylarare?email='+email);
			},
		get : function(page,sort,order,number, role) {
			
			return $http.get('http://localhost/sfi/public/api/users?page='+page+'&sort='+sort+'&order='+order+'&index='+number+'&role='+role);
		},
          
         update: function(id, category_id, aktiverad) {
		
           
          return $http.post('http://localhost/sfi/public/userupdate', {'id' : id, 'category_id' : category_id, 'aktiverad': aktiverad });
	
		},
		 destroy : function(id) {
				return $http.get('http://localhost/sfi/public/users/destroy/' + id);
			}
        
    };
});

app.factory("Exam", function($http) {
	return {
		
		profile: function(page,sort,order,number, category_id) {
			return $http.get('http://localhost/sfi/public/api/exams?page='+page+'&sort='+sort+'&order='+order+'&index='+number+'&category_id='+category_id);
			},
		
		get: function(page,sort,order,number) {
			return $http.get('http://localhost/sfi/public/api/exams?page='+page+'&sort='+sort+'&order='+order+'&index='+number);
			},
        save: function(title, files, category_id) {
           
          return $http.post('http://localhost/sfi/public/upload/file', {'title' : title, "files": files, 'category_id' : category_id});
		},
		
		update: function(id, title, category_id) {
          
          return $http.post('http://localhost/sfi/public/examsupdate', {'id' : id, 'title' : title, 'category_id' : category_id});
		},
		destroy : function(id) {
				return $http.get('http://localhost/sfi/public/exams/destroy/' + id);
			}
    };
});

app.factory("Message", function($http) {
	return {
		send : function(subject,message,receiver,sender) {
			
			 return $http.post('http://localhost/sfi/public/send/messages', {'subject' : subject, 'message': message, 'receiver' : receiver,'sender' : sender});
		
		},
		sendtogroup : function(subject,message,sender, group) {
			
			 return $http.post('http://localhost/sfi/public/send/messages', {'subject' : subject, 'message': message,'sender' : sender, 'group' : group });
		
			},
		read: function(page,sort,order,number, sent) {
			
			return $http.get('http://localhost/sfi/public/api/messages?page='+page+'&sort='+sort+'&order='+order+'&index='+number+'&sent='+sent);
		},
		find: function(id) {
			
			return $http.get('http://localhost/sfi/public/name/'+id);
		},
          
         
		 destroy : function(id) {
		 
				return $http.get('http://localhost/sfi/public/messages/destroy/' + id);
			}
        
    };
});


app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.idModel);
            var modelSetter = model.assign;
          
            
            element.bind('change', function(){
                scope.$apply(function(){
                	
                    modelSetter(scope, element[0].files[0]);
                       
                });
            });
        }
    };
}]);
app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file){
    	
        var fd = new FormData();
        fd.append('file', file);
        var uploadUrl = "http://localhost/sfi/public/questions/upload";
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(){
        })
        .error(function(){
        });
    };
}]);

app.factory("Pagination", function() {
	return {
		
		click : function(page, lastpage) {
			 	 var active;
              	 var start;
              	  var stop;  
              	  var pagenumbers = [];
            	lastpage=lastpage+1;
              
              if (page>=6 && page<=lastpage-5) {
              	start=page-5;
              	stop=page+5;
              } else if(page>=lastpage-5 && page>5)
              {
              	
              	start=page-5;
              	stop=lastpage;
              }
              else if(lastpage<=10){
              	
              	start=1;
              	stop=lastpage;
              }else{
              	
              	start=1;
              	stop=10;
              };
 	for (var i=start;i<stop;i++)
	{
		    
		    if(i==page){
		    	active="active"; }
		    else{
		    	active="notactive";};
		      
		      pagenumbers.push({
           		 number: i,
            	 listclass: active
        		});
	}
	 return pagenumbers;
	
 }

    };
});


