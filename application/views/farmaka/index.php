<div ng-app="sintages" >
<my-alert message="Επιτυχής Διαγραφή" ></my-alert>	
<div class="container">

<my-top-nav 
  
  options='{
		   links:[
		   {title:"Φάρμακα", address:"/farmaka", active:true}
		   ]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>


 

<div ng-controller="Farmaka_Index_Controller as farmaka_i_c">

<my-deleter indexer="farmaka_i_c.indexer" ></my-deleter>	

<div class="row">

<div class="col-md-9">
 <my-Index-Panel
		  indexer="farmaka_i_c.indexer"
		  options='
		  {
		  noneText:"Δεν υπάρχουν δεδομένα" ,
		  errorClass:"", 
		  headingText:"Φαρμακα",
		  footerText:"Επιλογή φαρμάκου"
		  }'
		  >
<table class="table">

		<tbody>
		 <tr>
		 
		 <th class="col-md-6">  Ονομασία</th>
		    
		      
		     <th class="col-md-2">  Τιμή </th>
			    <th class="col-md-2">  Διαθεσιμότητα </th>
		    <th class="col-md-1"></th > 
		    <th class="col-md-1"></th > 
		 
		 </tr>
			<tr  ng-repeat="farmako in farmaka_i_c.indexer.items">
			 <td>  {{farmako.name}}</td>
		    
		     <td>  {{farmako.price}}</td>
		     <td>  {{farmako.available==1?"Διαθέσιμο":"Μη Διαθέσιμο"}} </td>
		    <td><a class="btn btn-info btn-sm" href="/farmaka/edit/{{farmako.id}}">Επεξεργασία</a></td > 
		    <td><a class="btn btn-danger btn-sm" ng-click="farmaka_i_c.indexer.make_delete_candidate(farmako.id)">Διαγραφή</a></td > 
			</tr> 
	 
			</tbody>
</table>

</my-Index-Panel > 

 

 
</div>

	<div class="col-md-3">

	<options-panel options='{ headingText:"Επιλογές"}'>
	     <a href="/farmaka/create" class="btn btn-primary full-button">Νέο Φάρμακο  </a>
	</options-panel> 
	
		<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"Φίλτρο"
					  
					   
					  }'
					>  
			 
			<div class="row">
				
				 
				<div class="form-group    ">
				 	
		 
				<my-clearable-input model="farmaka_i_c.indexer.pattern_tmp_md.name" options='{placeholder:"Όνομα"}' >
			</my-clearable-input>
				 
				</div>


				<div><input type="button" name="submit"  class="btn btn-primary pull-right full-button"  ng-click= "farmaka_i_c.indexer.get_items(0,farmaka_i_c.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
			    <div style="color:red;" ng-show="farmaka_i_c.indexer.ajaxon"> Loading </div>
			 

			 
			</div>
		 
		</my-filter-panel>
	</div>

</div>



</div></div>
 </div>
 
   <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>
