<div class="container">



<div ng-app="sintages">
  <my-top-nav 
  
  options='{
		   links:[
		   {title:"Συνταγές Φαρμακείου", address:"#", active:true} 
		   ]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>
 
 
  
 
 </my-top-nav>
<div ng-controller="Sintages_Of_Farmakeio_Controller as sintages_view">
<div class="row">
 <div class="col-md-9">
  <my-Index-Panel
		  indexer="sintages_view.indexer"
		  options='
		  {
		  noneText:"Δεν υπάρχουν δεδομένα" ,
		   
		  headingText:"Συνταγές",
		  footerText:"Επιλογή συνταγής"
		  }'
		  >
<table class="table table-striped table-bordered ">
 
<tr><th class="col-md-2">Κωδικός</th><th class="col-md-3">Ημερομηνία</th><th class="col-md-5">Ασφαλισμένος</th><th class="col-md-1"></th>
 
		 
			<tr  ng-repeat="sintagi in sintages_view.indexer.items">
			<td>  {{sintagi.id}}</td>
			 <td>  {{sintagi.imerominia}}</td>
		    
		     <td>  {{sintagi.name}}</td>
		     
		     
		    <td><a class="btn btn-info btn-sm" href="/sintages/item_farmakeiou/{{sintagi.id}}">Περαιτέρω προβολή</a></td > 
		    
		    
			
			</tr> 
	  
 
</table>
</my-Index-Panel>
</div>


 




 
<div class="col-md-3">

<options-panel options='{ headingText:"Λειτουργείες"}'>
	     <a href="/sintages/epikyrosi_chooser" class="btn btn-primary full-button"> Επικύρωση Νέας Συνταγής </a>
	</options-panel> 
<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"Φίλτρα"
					  
					   
					  }'
					> 
	 
						 

		<div class="row">
			
			 
			<div class="form-group     ">
			 
				<my-clearable-input model="sintages_view.indexer.pattern_tmp_md.asfalismenos_id" options='{placeholder:"Κωδικός Ασφαλισμένου"}' >
			</my-clearable-input>
			
			  
			<label for="datestart" class="control-label">Από</label>
			<input class="form-control"  type="date" name="datestart" ng-model="sintages_view.indexer.pattern_tmp_md.date_start" placeholder="Από" />
			<label for="dateend" class="control-label">Εώς</label>
			<input class="form-control"  type="date" name="dateend" ng-model="sintages_view.indexer.pattern_tmp_md.date_end" placeholder="Εώς" />
		
			</div>


			<div><input type="button" name="submit"  class="btn btn-primary pull-right full-button"  ng-click= "sintages_view.indexer.get_items(0,sintages_view.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
		    <div style="color:red;" ng-show="sintages_view.indexer.ajaxon"> Loading </div>
		 

		 
		</div>
		<div class="seperator"></div>
		<div class="row"   >
			<div><input type="button" name="submit"   class="btn btn-default full-button"  ng-click= "sintages_view.lastdays(3)" value="Τελευταίες 3" /></div>
		    <div><input type="button" name="submit"   class="btn btn-default full-button"  ng-click= "sintages_view.indexer.lastdays(1)" value="Σήμερα" /></div>
		  
		 
	 
</div> 
</my-filter-panel>
</div>
</div>
</div>

 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
</script>


</div></div>
 
 
 