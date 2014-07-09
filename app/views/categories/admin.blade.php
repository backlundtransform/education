@section('container')
<div ng-controller="CategoryController" >	
	


<br /><b>Titel:</b><br />
	<input value="" type="text" ng-model="title"><br />
        		
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
					
			  <span class="show-page-loading-msg" ng-click="orderclick('updated_at')" ng-model="order" >Uppdaterad</span> 
					<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th> </th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="category in categories" >
					<td >	
		
						<div id="editable" contenteditable="true"  class="text" ng-click="getindex(category.id, $index)" data-param="title" >
							
  						 <% category.title %>
  						 
  						</div>
  						
  						
						
						
						
						<td class="download">
												<a href="{{asset('categories/<% category.id %>/sendmessage')}}" data-ajax="false">Skicka meddelande</a> 
						</td>
							
						
				 <td >
				 	<span class="<% $index %>"><% category.updated_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(category.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
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
