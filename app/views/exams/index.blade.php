@section('container')

<div ng-controller="ExamsController" id="Exam">
	
	   
  
        
        	<br /><b>Titel:</b><br />
        	
        	<input value="" type="text" ng-model="title">
        	

        	<br /><b>Fil:</b><br />
			<input type="file" file-model="myFile" id-model="myFile" />
			<br /><b>Grupp:</b><br />
        		{{ Form::select('category_id', $catarray, 1)}}
	<br />
		
					
				<br />
		
		 	
 		  <button class="answer show-page-loading-msg"  ng-click="create()" >Ladda upp</button>


		
	
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
			
			<th>
			
				<span class="show-page-loading-msg" ng-click="orderclick('title')">Titel</span> 
				<span> {{HTML::image('<% image.value %>')}}</span>
				
			
			
				</th>
					<th></th>
				<th>
			   <span class="show-page-loading-msg" ng-click="orderclick('grupp')">Grupp</span> 
				<span class="show-page-loading-msg" > {{HTML::image('<% image.value %>')}}</span>
				
				
					</th>
			
			<th>
					
			  <span class="show-page-loading-msg" ng-click="orderclick('updated_at')"  >Uppdaterad</span> 
					<span> {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="exam in exams" >
				
					<td>
						
						<div id="editable" contenteditable="true" class="text"  ng-click="gettitle(exam.id, exam.category_id, exam.title, $index)" data-param="question" >
							
  						 <% exam.title %>
  						 
  						</div>
						
						
						</td>
							
						<td class="download">
						 {{HTML::link('<% exam.files %>' , "Ladda ner", array('download' =>'<% exam.files %>', 'data-ajax'=>'false'))}}
						</td>
						
					<td>
						 <div class="selectdiv" >
								
								
						<div class="ui-select" >
<div id="select-5-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow">
<span id='<% $index %>'><% cat_arr[exam.category_id] %></span>
			<select name='<% $index %>' data-role="none" class="cat<% $index %>"  ng-options="c.title for c in categories"  ng-model="selected" ng-change="getindex(exam.id, selected.id, exam.title, $index)" >
								
      		</select>
</div>
</div>
						
						</td>
					
				 <td >
				 	<span class="<% $index %>"><% exam.updated_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(exam.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
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