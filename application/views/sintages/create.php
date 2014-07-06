<div  ng-app="sintages">

<my-alert message="Έγινε η καταγραφή της Συνταγής" ></my-alert>
<my-error-alert message="Σφάλμα κατά την καταγραφή της Συνταγής" ></my-error-alert>

<div class="container">
 
<my-top-nav 
  
  options='{
		   links:[
		   {title:"Συνταγές Γιατρού", address:"/sintages/giatrou", active:false} ,
		   {title:"Νέα Συνταγή", address:"#", active:true} 
		   ]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>
	<div ng-controller="Sintagi_Create_Controller as sintagi">
 
 

<div ng-switch on="sintagi.mode">


<!--  asfalismenos  /  diagnoseis  /  farmaka  / sline view -->

 <!--      ROW 1            -->
 <div ng-switch-when="diagnoseis" ng-controller="Diagnoseis_Index_Controller as diagnoseis_view"> 
 

	<div class="row" >
		
		<div class="col-md-9" >

		  <my-Index-Panel
		  indexer="diagnoseis_view.indexer"
		  options='
		  {
		  noneText:"No items to show" ,
		  errorClass:"my-error", 
		  headingText:"Διαγνώσεις",
		  footerText:"Επιλογή διαγνώσεων"
		  }'
		  >
		  
		   <table class="table table-striped table-hover table-bordered table-condensed"  >
			<tr>
            <th class="col-md-7">  Όνομα</th>
   	        <th class="col-md-3">  Κωδικός ICD</th>
			<th class="col-md-2">       </th>
					     
			</tr>
			<tbody>
			<tr  ng-repeat="diagnosi in diagnoseis_view.indexer.items">
			<td>  {{diagnosi.name}}</td>
			<td>  {{diagnosi.icd}}</td>
			<td><a class=" btn btn-info btn-sm" ng-click="sintagi.add_diagnosi(diagnosi)">Προσθήκη Διάγνωσης</a></td > 
			</tr> 
			</tbody>
			</table>
		  
		  </my-Index-Panel>
		  
		 
	</div>

		<div class="col-md-3">
			 
					<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"Φίλτρο"
					   
					  }'
					> 
					<div class="row">
						
						 
						<div class="form-group">
						 
						<my-clearable-input model="diagnoseis_view.indexer.pattern_tmp_md.name" options='{placeholder:"Όνομα"}' >
						</my-clearable-input>
						
						<my-clearable-input model="diagnoseis_view.indexer.pattern_tmp_md.icd" options='{placeholder:"ICD"}' >
						</my-clearable-input>
					 	
						 
						</div>


						<div><input type="button" name="submit"  class="btn btn-primary full-button"  ng-click= "diagnoseis_view.indexer.get_items(0,diagnoseis_view.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
					    <div style="color:red;" ng-show="diagnoseis_view.indexer.ajaxon"> Loading </div>
					 

					 
				 
				 
					</div>
					</my-filter-panel> 
					 <quick-nav options='{ headingText:"Πλοήγηση", footerText:" "}'> 
				<a class="btn  full-button btn-primary" href=""  ng-click="sintagi.mode='teliko'"> Επιστροφή Πίσω</a>
				</quick-nav>
		</div>




	</div>
</div>

<!--      ROW 1            -->
 <div ng-switch-when="asfalismenoi" ng-controller="Asfalismenoi_Index_Controller as asfalismenoi_view"> 
	 

	<div class="row" >
		
		<div class="col-md-9" >
			 <my-Index-Panel
		  indexer="asfalismenoi_view.indexer"
		  options='
		  {
		  noneText:"Δεν υπάρχουν δεδομένα" ,
		  errorClass:"", 
		  headingText:"Ασφαλισμένοι",
		  footerText:"Επιλογή ασφαλισμένου"
		  }'
		  >
		  
		  <table class="table table-striped table-bordered ">
			<tr>

			            <th class="col-md-5">  Όνομα</th>
					    
					     <th class="col-md-3">  ID</th>
					     <th class="col-md-3">  Ημερομηνία Γέννησης</th>
						 <th class="col-md-1"> </th>
					     
					     
			</tr>
					<tbody>
					 
						<tr  ng-repeat="asfalismenos in asfalismenoi_view.indexer.items">
						 <td>  {{asfalismenos.name}}</td>
					    
					     <td>  {{asfalismenos.id}}</td>
					      <td>  {{asfalismenos.imerominia_genisis}}</td>
					     
					    
					    <td><a class=" btn btn-info btn-sm" ng-click="sintagi.add_asfalismenos(asfalismenos)">Αλλαγή σε αυτόν τον Αφαλισμένο </a></td > 
					    	 
					    
						</tr> 
				 
						</tbody>
			</table>
		</my-Index-Panel>
		 

	</div>

		<div class="col-md-3">
			 
			     
				<my-filter-panel options='{ headingText:"Φίλτρα"}'>
				<div class="container-fluid">
					 
					<div class="row">
						
						 
						<div class="form-group">
						<my-clearable-input model="asfalismenoi_view.indexer.pattern_tmp_md.id" options='{placeholder:"Κωδικός"}' >
						</my-clearable-input>
					 <my-clearable-input model="asfalismenoi_view.indexer.pattern_tmp_md.name" options='{placeholder:"Όνομα"}' >
						</my-clearable-input>
						
						 
						 
						</div>


						<div><input type="button" name="submit"  class="btn btn-primary pull-right full-button"  ng-click= "asfalismenoi_view.indexer.get_items(0,asfalismenoi_view.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
					    <div style="color:red;" ng-show="asfalismenoi_view.indexer.ajaxon"> Loading </div>
					 

					 
					</div>
				</div>
			 </my-filter-panel>
			 
			 <quick-nav options='{ headingText:"Πλοήγηση", footerText:" "}'> 
				<a class="btn  full-button btn-primary" href=""  ng-click="sintagi.mode='teliko'"> Επιστροφή Πίσω</a>
				</quick-nav>
		</div>




	</div>
</div>


<!--      ROW 1            -->
 <div ng-switch-when="farmaka" ng-controller="Farmaka_Index_Available_Controller as farmaka_view"> 
	 

	<div class="row" >
		
		<div class="col-md-9" >

		 <my-Index-Panel
		  indexer="farmaka_view.indexer"
		  options='
		  {
		  noneText:"No items to show" ,
		  errorClass:"my-error", 
		  headingText:"Σκευάσματα",
		  footerText:"Επιλογή σκευάσματος"
		  }'
		  >
		  <table class="table table-striped table-bordered table-condensed">
			<tr>

			            <th class="col-md-7">  Όνομα</th>
					    
					     <th class="col-md-3">  Τιμή</th>
					     <th class="col-md-1"></th>
					     
					     
			</tr>
					<tbody>
					 
						<tr  ng-repeat="farmako in farmaka_view.indexer.items">
						 <td>  {{farmako.name}}</td>
					    
					     <td>  {{farmako.price}}</td>
					    
					     
					    
					    <td class="vert-align"><a class=" btn btn-info btn-sm" ng-click="sintagi.add_sline(farmako)">Βάλε φάρμακο </a></td > 
					    	 
					    
						</tr> 
				 
						</tbody>
			</table>
 </my-Index-Panel>
		 
		 

	</div>

		<div class="col-md-3">
			 
			     	 <my-filter-Panel
		  
		  options='
		  {
		 
		  
		  headingText:"Φίλτρα"
		  
		  }'
		  >

				 
					 
					<div class="row">
						
						 
						<div class="form-group">
						 
						 <my-clearable-input model="farmaka_view.indexer.pattern_tmp_md.name" options='{placeholder:"Όνομα"}' >
						</my-clearable-input>
						  
						 
						</div>


						<div><input type="button" name="submit"  class="btn btn-primary full-button"  ng-click= "farmaka_view.indexer.get_items(0,farmaka_view.indexer.pattern_tmp_md)" value="Υποβολή" /></div>
					    <div style="color:red;" ng-show="farmaka_view.indexer.ajaxon"> Loading </div>
					 

					 
					</div>
				 
			 </my-filter-Panel>
			
			 <quick-nav options='{ headingText:"Πλοήγηση", footerText:" "}'> 
				<a class="btn  full-button btn-primary" href=""  ng-click="sintagi.mode='teliko'"> Επιστροφή Πίσω</a>
				</quick-nav>
		</div>




	</div>
</div>





<!--      ROW 2            -->
<div class="row" ng-switch-when="teliko" ng-form="the_form" >
		<div class="col-md-9">
		
		<div class="panel panel-primary" style="margin-bottom:60px">
		<div class="panel-heading">Ασφαλισμένος</div>

  		<div class="panel-body" >
		<div ng-show="sintagi.asfalismenos==undefined" style="color:lightpink" >Πρέπει να επιλέξετε Ασφαλισμένο </div>
		<div class="container-fluid" ng-show="sintagi.asfalismenos!=undefined"><div class="row">
		<div class="col-md-8" >
		<div> Επιλεγμένος Ασφαλισμένος:  <strong>{{sintagi.asfalismenos.name}} </strong></div>
		<div> Κωδικός Ασφαλισμένου:  <strong>{{sintagi.asfalismenos.id}}</strong> </div>
		</div   >
		<div class="col-md-2 col-md-offset-2" >
		<div> <a class="btn btn-danger btn-sm" ng-click="sintagi.sub_asfalismenos(sintagi.asfalismenos)">Αφαίρεση</a> </div>
		</div>
		</div>
		</div>		
		</div><!--panel-body-->
  		 
  		 
  		 
		</div><!--panel -->


		 <my-edit-Panel
		  indexer="farmaka_view.indexer"
		  options='
		  {
		  
		   
		  headingText:"Διαγνώσεις"
		   
		  }'
		  >
		  <div ng-show="sintagi.diagnoseis.length<1" style="color:lightpink" >Πρέπει να καταχωρήσετε διαγνώσεις </div>
		<table class="table table-striped table-bordered" ng-show="sintagi.diagnoseis.length>=1">
		<tr>

		            <th class="col-md-8">  Όνομα</th>
				    
				     <th class="col-md-3">  Κωδικός ICD</th>
				      <th class="col-md-1">  </th>
				     
				     
		</tr>
				<tbody>
				 
					<tr  ng-repeat="diagnosi2 in sintagi.diagnoseis track by $index">
					 <td>  {{diagnosi2.name}}</td>
				    
				     <td>  {{diagnosi2.icd}}</td>
				     
				    
				    <td class="vert-align"><a class="btn btn-danger btn-sm" ng-click="sintagi.sub_diagnosi(diagnosi2)">Αφαίρεση</a></td > 
				   
					</tr> 
			 
					</tbody>
		</table>
			 
	</my-edit-Panel>

		 <my-edit-Panel
		  indexer="farmaka_view.indexer"
		  options='
		  {
		  
		   
		  headingText:"Σκευάσματα"
		   
		  }'
		  >
  		<div ng-show="sintagi.slines.length<1"  style="color:lightpink" >Πρέπει να καταχωρήσετε σκευάσματα </div>	
		<table class="table table-striped table-bordered " ng-show="sintagi.slines.length>=1">
		<tr>

		            <th>  Όνομα</th>
				      <th>  Τιμή </th>
				     <th>  Πλήθος</th>
				     <th>  Δοσολογία</th> 
				     
				     
		</tr>
				<tbody>
				 
					<tr  ng-repeat="sline in sintagi.slines track by $index" ng-form="sf" novalidate>
					 <td>  {{sline.farmako.name}}</td>
					 <td>  {{sline.farmako.price}}</td>
				    
				     <td>  
				     		<div class="form-group" ng-class="{'has-error':sf.amount.$invalid&&sf.amount.$dirty}">
							 
				    		<!--?php echo form_error('price'); ?-->
							<input class="form-control"
							  type="number"
							  
							  placeholder="Πλήθος"
							  name="amount"
							  required
							  number
							  min='0'
							  step='1'
							  ng-model="sline.amount"
							  value="{{sline.amount}}"	  />

							    <div class="control-label" ng-show="sf.amount.$dirty && sf.amount.$invalid"> 
					    		<div class="control-label" ng-show="sf.amount.$error.required">Μη κενό</div>
					    		<div class="control-label" ng-show="sf.amount.$error.min">Θετικό</div>
					    		<div class="control-label" ng-show="sf.amount.$error.number">Αριθμός</div>
					    		
				    		 </div>
							
							</div>


				     </td>
				     <td>  
				     		<div class="form-group" ng-class="{'has-error':sf.dosologia.$invalid&&sf.dosologia.$dirty}">
							 
				    		<!--?php echo form_error('price'); ?-->
							<input class="form-control"
							  type="number"
							  
							  placeholder="Δοσολογία"
							  name="dosologia"
							  required
							  number
							  min='0'
							  step='0.3'
							  ng-model="sline.dosologia"
							  value="{{sline.dosologia}}"	  />

							<div class="control-label" ng-show="sf.dosologia.$dirty && sf.dosologia.$invalid"> 
					    		<div class="control-label" ng-show="sf.dosologia.$error.required">Μη κενό</div>
					    		<div class="control-label" ng-show="sf.dosologia.$error.min">Θετικό</div>
					    		<div class="control-label" ng-show="sf.dosologia.$error.number">Αριθμός</div>
					    		
				    		 </div>
							
							</div>


				     </td>
				 
				    
				    <td class="vert-align"><a class="btn btn-danger btn-sm" ng-click="sintagi.sub_sline(sline)">Αφαίρεση</a></td > 
				   
					</tr> 
			 
					</tbody>
		</table>
		
		<p ng-show="sintagi.slines.length>=1" class="text-right" style="color:grey"><span class="glyphicon glyphicon-asterisk"></span> {{sintagi.total_price()}}<p>
		  </my-edit-Panel >
		 <button class="btn btn-primary  pull-right btn-lg full-button" ng-disabled="sintagi.diagnoseis.length<1||sintagi.slines.length<1||sintagi.asfalismenos==undefined||the_form.$invalid" ng-click="sintagi.apply()"> 
		 	Καταχώρηση Συνταγής</button>

		 


		 
		</div><!-- end left column -->
	<div class="col-md-3">

		 
			     
		 <options-panel options='{ headingText:"Λειτουργείες"}'>
	     
	
				 
				 	 
					 
						
					
					<button  class="btn btn-info full-button "  style="margin-bottom:15px"
							 ng-click= "sintagi.mode='asfalismenoi'"   />Αλλαγή Ασφαλισμένου</button>
							   
						
					 	
					
					
							<button  class="btn btn-info full-button " style="margin-bottom:15px"
							 ng-click= "sintagi.mode='diagnoseis'"   >Προσθήκη διάγνωσης</button>
							  
					 
					
							<button  class="btn btn-info full-button  " style="margin-bottom:15px"
							 ng-click= "sintagi.mode='farmaka'"   />Προσθήκη Σκευάσματος</button>
							   
					
					    </options-panel> 

					 
					 
		</div><!--  2nd row -->


</div><!--  switch -->

 



</div></div></div><!--      controller/app/ bootstrap container           -->
 

 <!--      script           -->
 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>