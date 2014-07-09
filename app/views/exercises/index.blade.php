@section('container')
<div ng-controller="ExerciseController" >	
<br /><b>Titel:</b><br />
	<input value="" type="text" ng-model="title"><br /><b>Grupp:</b><br />
        		{{ Form::select('category_id', $catarray, 1)}}
	<br /><button class="answer show-page-loading-msg"  ng-click="create()" >Lägg till</button>
			<br />
<hr>Sidan <% main.page %> av <% main.pages %> 
       <div style="width:40%">
     
 <select ng-model="numberList"  ng-change="getnumber()" name="select"  ng-options="number as number.label for number in numbers"> 
 	
 	 <option value="3" selected="selected">Visa 3 rader per sida</option>
   
        
    </select>
   </div>
		
		
	<ul class="pagination">
	<li ng-click='previousPage()' class="show-page-loading-msg">Tidigare</li>
	<span ng-repeat="page in pagenumbers" >
<li  class="<% page.listclass %>  show-page-loading-msg" ng-click="clickpage(page.number)"><% page.number %></li></span>	<li class="show-page-loading-msg" ng-click='nextPage()'>Nästa</li></ul>

           
   	
					
			

	<table data-role="table" class="my-custom-breakpoint" id="content" ng-table="tableParams">
		<thead>
			<tr>
			<th>
			
				<span class="show-page-loading-msg" ng-click="orderclick('title')" ng-model="order" >Title</span> 
				<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
				
			
			
				
				<th></th>
				<th>
			   <span class="show-page-loading-msg" ng-click="orderclick('locked')" ng-model="order" >Låst</span> 
				<span class="show-page-loading-msg" ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
				
					<th>
						
						 <span class="show-page-loading-msg" ng-click="orderclick('category_id')" ng-model="order" >Grupp</span> 
				<span class="show-page-loading-msg" ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
						
					</th>
					</th>
				
			<th>
					
			  <span class="show-page-loading-msg" ng-click="orderclick('updated_at')" ng-model="order" >Uppdaterad</span> 
					<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th> </th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="exercise in exercises" >
					<td >	
		
						<div id="editable" contenteditable="true"  class="text" ng-click="getindex(exercise.id, exercise.title, exercise.locked,exercise.category_id, $index)" data-param="title" >
							
  						 <% exercise.title %>
  						 
  						</div>
  						
  						
						
						
						
						<td class="download">
						<a href="{{"exercises/<% exercise.id %>/edit"}}" data-ajax="false">Redigera</a> 
						</td>
							
						<td>
							
						
       						<div  ng-if="exercise.locked == '0'" ng-click="getindex(exercise.id, exercise.title, exercise.locked,exercise.category_id, $index)" class="lock show-page-loading-msg"  id="lock<% $index %>" ><img src="{{asset('images/unlocked.png')}}"></div>
      					
			
        						<div ng-if="exercise.locked == '1'" ng-click="getindex(exercise.id, exercise.title, exercise.locked,exercise.category_id, $index)" class="lock show-page-loading-msg"  id="lock<% $index %>" ><img src="{{asset('images/locked.png')}}">
						
							
  						
  						 
  						
						
						
						</td><td >
						


       <div class="selectdiv" >
								
								
						<div class="ui-select" >
<div id="select-5-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow">
<span id='<% $index %>'><% cat_arr[exercise.category_id] %></span>
			<select name='<% $index %>' data-role="none" class="cat<% $index %>"  ng-options="c.title for c in categories"  ng-model="selected" ng-change="getindex(exercise.id, exercise.title, exercise.locked, selected.id, $index)" >
								
      		</select>
</div>
</div>
<br>
			
								
								
				
								
				 <td >
				 	<span class="<% $index %>"><% exercise.updated_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(exercise.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
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
	<li  class="<% page.listclass %>  show-page-loading-msg" ng-click="clickpage(page.number)"><% page.number %></li></span><li class="show-page-loading-msg" ng-click='nextPage()'>Nästa</li></ul>
        </div>

@stop