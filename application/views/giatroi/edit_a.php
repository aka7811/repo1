 <div ng-app="sintages">
<my-alert message="Οι αλλαγές αποθηκεύτηκαν" ></my-alert>

<div class="container">

  

  <my-top-nav 
  
  options='{
		   links:[
		   {title:"Γιατροί", address:"/giatroi", active:false},
		   {title:"Επεξεργασία Στοιχείων", address:"#", active:true}]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>
 
 
 <div ng-controller="Giatroi_Edit_Controller as g_e_c">						 
<div ng-init="g_e_c.editor.init_editor('<?php echo $id ?>')"/>	
<div class="row">	 <div class="col-md-10" >
		 		 
 
  <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"Επεξεργασία Στοιχείων Γιατρού",
		  footerText:" "
		  }'
		  >
<form name='the_form' novalidate>


			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.name.$invalid&&the_form.name.$dirty}">
				<label for="name">Όνομα Γιατρείου </label>
			 
			
				<input class="form-control"
				  type="input"
				  name="name"
				  placeholder="Όνομα Ιδιοκτήτη"
				  ng-model="g_e_c.editor.item.name"
				   		   />
			     

			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.address.$invalid&&the_form.address.$dirty}">
				<label for="">Διεύθυνση</label>
    			
				<input class="form-control"
				  type="address"
				  name="address"
				  placeholder="Διεύθυνση"
				  required
				  
				  ng-model="g_e_c.editor.item.address"	  />
				 
				<div class="control-label" ng-show="the_form.address.$dirty && the_form.address.$invalid"> 
		    		<div class="control-label" ng-show="the_form.address.$error.required">Μη κενό</div>
		    		 
		    		
	    		 </div>
			
			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.phone.$invalid&&the_form.phone.$dirty}">
				<label for="phone">Τηλέφωνο </label>
			 
			
				<input class="form-control"
				  type="phone"
				  name="phone"
				  placeholder="Τηλέφωνο"
				  ng-model="g_e_c.editor.item.phone"
				  />
			     

			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.eidikotita.$invalid&&the_form.eidikotita.$dirty}">
				<label for="eidikotita">Ειδικότητα </label>
			 
			
				<input class="form-control"
				  type="input"
				  name="eidikotita"
				  placeholder="Ειδικότητα"
				  ng-model="g_e_c.editor.item.eidikotita"
				  />
			     

			</div>
			 


			<div><input type="submit" name="submit"  class="btn btn-primary pull-right" ng-disabled="the_form.$invalid" ng-click="g_e_c.editor.submit()" value="Υποβολή Αλλαγών" /></div>

</form>
 
  </my-edit-panel>

 

 


</div>
<!--div class="col-md-2">
<quick-nav options='{ headingText:"Πλοήγηση", footerText:" "}'> 
<a class="btn  full-button btn-primary" href="/giatroi"> Επιστροφή Πίσω</a>
</quick-nav>
</div-->
</div>
</div>
</div>
</div>

 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>
