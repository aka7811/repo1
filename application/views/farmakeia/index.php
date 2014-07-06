<div ng-app="sintages">
<my-alert message="Επιτυχής Διαγραφή" ></my-alert>	
<div class="container">
 
<my-top-nav 
  
  options='{
		   links:[
		   {title:"Φαρμακεία", address:"#", active:true}
		   ]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>

<div ng-controller="Farmakeia_Index_Controller as f_i_c">
<my-deleter indexer="f_i_c.indexer" ></my-deleter>	
<div class="row">

<div class="col-md-9">
 <my-Index-Panel
		  indexer="f_i_c.indexer"
		  options='
		  {
		  noneText:"Δεν υπάρχουν δεδομένα" ,
		  errorClass:"", 
		  headingText:"Φαρμακεία",
		  footerText:"Επιλογή φαρμακείου"
		  }'
		  >
<table class="table table-striped table-bordered ">
<tr>

            <th class="col-md-3">  Όνομα</th>
		    
		     <th class="col-md-3">  Διεύθυνση</th>
		     
		     <th class="col-md-1">  Τηλέφωνο</th>
		     <th class="col-md-3">  Email Χρήστη</th>
			 <th class="col-md-1"></th><th class="col-md-1"></th>
</tr>
		<tbody>
		 
			<tr  ng-repeat="farmakeio in f_i_c.indexer.items">
			 <td>  {{farmakeio.name}}</td>
		    
		     <td>  {{farmakeio.address}}</td>
		     
		     <td>  {{farmakeio.phone}}</td>
		     <td>  {{farmakeio.email}}</td>
		    <td><a class="btn btn-info btn-sm" href="/farmakeia/edit/{{farmakeio.id}}">Επεξεργασία</a></td > 
		    <td><a class="btn btn-danger btn-sm" ng-click="f_i_c.indexer.make_delete_candidate(farmakeio.id)">Διαγραφή</a></td > 
			</tr> 
	 
			</tbody>
</table>

<!--ul class="pagination">
   <li ng-repeat="offset in f_i_c.indexer.offset_array track by $index" class='{{offset.active?"active":""}}'>
      
      <a href="" ng-click= "f_i_c.indexer.get_items(offset.offset,f_i_c.indexer.current_pattern)"> {{$index+1}} </a> 
    </li>
</ul-->
  </my-Index-Panel  >

 


 
</div><!-- end left column -->

<div class="col-md-3">

	<options-panel options='{ headingText:"Επιλογές"}'>
	     <a href="/farmakeia/create" class="btn btn-primary full-button">Νέο Φαρμακείο  </a>
	</options-panel> 

	<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"Φίλτρο"
					  
					   
					  }'
					> 
		 
		<div class="row">
		
			
			 
			<div class="form-group     ">
		    <my-clearable-input model="f_i_c.indexer.pattern_tmp_md.name" options='{placeholder:"Όνομα"}' >
			</my-clearable-input>
			 <my-clearable-input model="f_i_c.indexer.pattern_tmp_md.address" options='{placeholder:"Διεύθυνση"}' >
			</my-clearable-input>
			<my-clearable-input model="f_i_c.indexer.pattern_tmp_md.email" options='{placeholder:"e-mail"}' >
			</my-clearable-input>
			
		 
			
			
			
			 
			</div>


			<div><input type="button" name="submit"  class="btn btn-primary full-button"  ng-click= "f_i_c.indexer.get_items(0,f_i_c.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
		    <div style="color:red;" ng-show="f_i_c.indexer.ajaxon"> Loading </div>
		 

		 
		</div>
	</my-filter-panel>
		</div>
</div> </div>
</div>
</div>
 

</div></div>
 </div>
   <script type="text/javascript" src="/scripts/sintagi-script.js"></script>
 
 