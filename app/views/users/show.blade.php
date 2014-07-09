    @section('container')

  <div class="profile">
   			
   			<h1>Välkommen {{$user->fornamn }} {{$user->efternamn }}</h1> 
   			
   			<h1>Du läser {{Category::find($user->category_id)->title }} </h1><h2>Andel övningar avklarat på kursen:</h2>
   			<div class="meter">
	<span style="width: {{$percent}}%"></span>
</div>


<a href="{{URL::to('users/'.$user->id.'?statistics=true')}}"  data-ajax = 'false' title="Visa resultat"><img src={{asset('images/blue.png')}} alt="Diagram"></a>

<br>

  
  {{ HTML::link('categories#'.$user->category_id, 'GÅ TILL DINA ÖVNINGAR', array('class'=>'button','data-ajax'=>'false'))}}

 
            
           
   			
 <div ng-controller="ProfileController" id="Exam" >
   			
   	
   				<input type="hidden" value="{{$user->category_id}}" id='category' class='category'>
   				<h2>Du har följande test:</h2>
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
			
			<th>
			
				<span class="show-page-loading-msg" ng-click="orderclick('title')">Titel</span> 
				<span> {{HTML::image('<% image.value %>')}}</span>
				
			
			
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
						 <% exam.title %>
  					</td>
							
						<td class="download">
						 {{HTML::link('<% exam.files %>' , "Ladda ner", array('download' =>'<% exam.files %>', 'data-ajax'=>'false'))}}
						</td>
						
					
				 <td >
				 	<span class="<% $index %>"><% exam.updated_at|timeago %></span>
				 	</td>
                   
				</tr>
		
		</tbody>
	</table>
	<ul class="pagination">
	<li class="show-page-loading-msg" ng-click='previousPage()'>Tidigare</li>
	<span ng-repeat="page in pagenumbers" >
	<li  class="<% page.listclass %>  show-page-loading-msg" ng-click="clickpage(page.number)"><% page.number %></li></span>	<li class="show-page-loading-msg" ng-click='nextPage()'>Nästa</li></ul>
        
	</div>
		

 </div>
<table><td>{{ HTML::link('users/'.$user->id.'/edit', 'REDIGERA DINA UPPGIFTER', array('data-ajax'=>'false'))}}</td></table>
	@stop

