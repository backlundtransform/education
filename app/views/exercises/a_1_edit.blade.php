@section('container')



<br /><div class="border"> 
	
	
	<br /><b>Beskrivning:</b><br />
	
	<div id="editable" contenteditable="true" class="editor" data-id="{{$exercise->id}}" data-param="description">
							
  						{{$exercise->description}}
  						 
  						</div>
	
	</div><br />

<div ng-controller="QuestionController" id="Question">
	
	   
  
        <div id="AddItem">
        	<br /><b>Fråga:</b><br />
        	
        	<input value="" type="text" ng-model="question">
        	<br /><b>Svar:</b><br />
        	
        	<input value="" type="text" ng-model="answer">
        	<br /><b>Fil:</b><br />
			<input type="file" file-model="myFile" id-model="myFile" />
		 	<br/>
		 	<br /><b>Alterativ:</b><br />
			<input value="" type="text" ng-model="itemOption">
            <br/>
            <button ng-click="addItem()">Lägg till alternativ</button>
  
        <div id="CheckedList">
         <table>
                <tr ng-repeat="item in items">
                 
                    <td><b><% item.option %></b></td>
                    <td>
                        <button class="answer show-page-loading-msg"  ng-click="removeItem($index)">Ta bort!</button>
                    </td>
                </tr>
            </table>
 		  <button class="answer show-page-loading-msg"  ng-click="create({{$exercise->id}})" >Lägg till</button>

	</div>
			</div>
		
				<br />		
				<br />
		
		
	
	<hr>Sidan <% main.page %> av <% main.pages %> 
       <div style="width:40%">
     
 <select ng-model="numberList"  ng-change="getnumber()" name="select" id="myselect" ng-options="number as number.label for number in numbers"> 
 	
 	 <option value="3" selected="selected">Visa 3 rader per sida</option>
   
        
    </select>
   </div>
		
		
	<ul class="pagination">
	<li class="show-page-loading-msg" ng-click='previousPage()'>Tidigare</li>
	<span ng-repeat="page in pagenumbers" >
<li  class="<% page.listclass %>  show-page-loading-msg" ng-click="clickpage(page.number)"><% page.number %></li></span>	<li class="show-page-loading-msg" ng-click='nextPage()'>Nästa</li></ul>

           
   	
					
			

	<table data-role="table" class="my-custom-breakpoint" id="content" ng-table="tableParams">
		<thead>
			<tr>
				<th></th>
			<th>
			
				<span class="show-page-loading-msg" ng-click="orderclick('question')"  >Frågor</span> 
				<span> {{HTML::image('<% image.value %>')}}</span>
				
			
			
				</th>
				
				<th>
			   <span class="show-page-loading-msg" ng-click="orderclick('answer')"  >Svar</span> 
				<span class="show-page-loading-msg" > {{HTML::image('<% image.value %>')}}</span>
				
				
					</th>
				<th></th>
			<th>
					
			  <span class="show-page-loading-msg" ng-click="orderclick('updated_at')"  >Uppdaterad</span> 
					<span> {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="question in questions" >
				<td>
						
						 
						  <button class="answer show-page-loading-msg"  data-ajax="false" ng-click="goto({{$exercise->category_id}}, {{$exercise->id}}, question.number)";> {{HTML::image('images/arrow.png')}}
  						 </button >
						 
						
  						
						
						
						</td>
					<td>
						
						<div id="editable" contenteditable="true" class="text"  ng-click="getindex(question.id, question.question, question.answer,question.files, $index)" data-param="question" >
							
  						 <% question.question %>
  						 
  						</div>
						
						
						</td>
							
						<td>
						
						<div id="editable" contenteditable="true" class="text"  ng-click="getindex(question.id, question.question, question.answer,question.files, $index)" data-param="answer" >
							
  						 <% question.answer %> 
  						 
  						</div>
						
						
						</td>
						<td >
							
								<div ng-if="avatars[$index]=='image'">
							
 							<img id="<% $index %>" src="{{asset('<% question.files %>')}}" height="90"></br></div>
 							
 							<div ng-if="avatars[$index]=='video'">
							
 						
								<img id="video<% $index %>" src="{{asset('images/audio.png')}}" height="90"></br></div>
 							
 							<div ng-app="myapp" ng-controller="QuestionController" >
 							 <input type="file" file-model="myFile"  id-model="file<% question.id %>"  />
    		  <button class="show-page-loading-msg" ng-click="update($index, question.id, question.question, question.answer)">Uppdatera</button>
 						</div>	
 					</td>
				 <td >
				 	<span class="<% $index %>"><% question.updated_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(question.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
					<div data-role="popup" id="popupDialog" data-overlay-theme="b" data-theme="b" data-dismissible="false" style="max-width:400px;">
   					<div data-role="header" data-theme="a">
   				 <h1>Ta bort?</h1>
   					 </div>
  				  <div role="main" class="ui-content">
      			  <h3 class="ui-title">Är du säker på att du vill ta bort frågan?</h3>
   				 <p>Vad som är gjort kan inte göras ogjort.</p>
       			 <a href="#" class="ui-btn" data-rel="back">Avbryt</a><br />
       			 <a href="#"  class="ui-btn delete show-page-loading-msg"  data-rel="back">Ta bort</a><br />
       			       
       			 
       			  </div>
					</div>
                       
                      
                    </td>
				</tr>
		
		</tbody>
	</table>
	<ul class="pagination">
	<li class="show-page-loading-msg" ng-click='previousPage()'>Tidigare</li>
	<span ng-repeat="page in pagenumbers" >
	<li  class="<% page.listclass %>  show-page-loading-msg" ng-click="clickpage(page.number)"><% page.number %></li></span>	<li class="show-page-loading-msg" ng-click='nextPage()'>Nästa</li></ul>
        </div>

@stop