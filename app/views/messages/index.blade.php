@section('container')

<div ng-controller="MessageController" id="Messages" >
	
	
		<div data-role="fieldcontain">
    <fieldset data-role="controlgroup" data-type="horizontal">
    	
         	<input type="radio" name="radio-choice-1" id="radio-choice-1" value="false" checked="checked"  ng-click="change()"/>
         	<label for="radio-choice-1">Mottagna</label>

         	<input type="radio" name="radio-choice-1" id="radio-choice-2" value="true"  ng-click="change()"/>
         	<label for="radio-choice-2">Skickade</label>

         	
    </fieldset>
</div> 	
 		 
	
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
			
				<span class="show-page-loading-msg" ng-click="orderclick('read')">Läst</span> 
				<span> {{HTML::image('<% image.value %>')}}</span>
				
			
			
				</th>
			<th>
			
				<span class="show-page-loading-msg" ng-click="orderclick('subject')">Ämne</span> 
				<span> {{HTML::image('<% image.value %>')}}</span>
				
			
			
				</th>
					
				<th>
			   <span class="show-page-loading-msg" ng-click="orderclick('sender')">Avsändare</span> 
				<span class="show-page-loading-msg" > {{HTML::image('<% image.value %>')}}</span>
				
				
					</th>
			
			<th>
					
			  <span class="show-page-loading-msg" ng-click="orderclick('created_at')"  >Uppdaterad</span> 
					<span> {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th></th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="message in messages" >
				
					<td>
						<div  ng-if= "message.read==1">
						  {{HTML::image("images/read.png")}}
						  </div>
						  <div  ng-if= "message.read==0">
						   {{HTML::image("images/unread.png")}}
						  </div>
						
						</td>
						<td >
						 {{HTML::link("messages/<% message.id %>" , "<% message.subject %>", array('data-ajax'=>'false'))}}
						</td>
  					
  						 
  						
						
						
						</td>
							
						<td>
							<div  ng-if= "sent=='true'"><%  user_arr[message.receiver] %></div>
						
							<div  ng-if= "sent=='false'"><%  user_arr[message.sender] %></div>
						
						
					
					
				 <td >
				 	<span class="<% $index %>"><% message.created_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(message.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
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