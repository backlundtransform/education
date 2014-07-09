@section('container')

<div ng-controller="UserController" >	
	
<input type="hidden" value="user" id='role' class='role'>

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
			
				<span class="show-page-loading-msg" ng-click="orderclick('fornamn')" ng-model="order" >Namn</span> 
				<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
				
			
			
				<th></th><th> <span class="show-page-loading-msg" ng-click="orderclick('category_id')" ng-model="order" >Grupp</span> 
					<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span></th></th>
				<th>  <span class="show-page-loading-msg" ng-click="orderclick('active')" ng-model="order" >Aktiverad</span> 
					<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span></th>
				
			<th>
					
			  <span class="show-page-loading-msg" ng-click="orderclick('updated_at')" ng-model="order" >Uppdaterad</span> 
					<span ng-model="image" > {{HTML::image('<% image.value %>')}}</span>
			 	
					</th>
				<th> </th>
			</tr>
		</thead>

		<tbody>
			
    
			<tr ng-repeat="user in users" >
					<td >	
		
						
							
  						
  						 
  					<% user.fornamn %>   <% user.efternamn %>
						
						<td class="download">
											
								 {{HTML::link('users/<% user.id %>' , "Besök Profil", array('title'=>'Besök Profil', 'data-ajax'=>'false'))}}<br><br>
						  {{HTML::link('users/<% user.id %>/sendmessage', "Skicka meddelande", array('title'=>'Skicka Mail', 'data-ajax'=>'false'))}}			
											
													</td>
													
													<td >
										
       <div class="selectdiv" >
								
								
						<div class="ui-select" >
<div id="select-5-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow">
<span id='<% $index %>'><% cat_arr[user.category_id] %></span>
			<select name='<% $index %>' data-role="none" class="cat<% $index %>"  ng-options="c.title for c in categories"  ng-model="selected" ng-change="getindex(user.id, selected.id, user.aktiverad, $index)" >
								
      		</select>
</div>
</div>
										
													</td>
														<td >
															
									 <div class="selectdiv" >
								
								
						<div class="ui-select" >
					<div id="select-5-button" class="ui-btn ui-icon-carat-d ui-btn-icon-right ui-corner-all ui-shadow">
					<span ng-if="user.aktiverad == '1'">Aktiv</span>
					<span ng-if="user.aktiverad != '1'">Inaktiv</span>
	<select data-role="none" ng-model="selected"  class="act<% $index %>" ng-options="a.label for a in actives" ng-change="getindex(user.id, user.category_id, selected.id, $index)">
											
  		
      
  										</select>
										</div>
										</div>
													</td>
							
						
				 <td >
				 	<span class="<% $index %>"><% user.updated_at|timeago %></span>
				 	</td>
                    <td>
                    <a  ng-click="del(user.id)"  href="#popupDialog" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-icon-delete ui-btn-icon-left ui-btn-b">Ta bort</a>
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