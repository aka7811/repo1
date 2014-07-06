 <div ng-app="sintages"  >
<my-alert message="Επιτυχής ενημέρωση" ></my-alert>
<div class="container">

 <my-top-nav 
  
  options='{
		   links:[
		   {title:"Φαρμάκα", address:"/farmaka", active:false},
		   {title:"Επεξεργασία Στοιχείων", address:"#", active:true}]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>


 <div ng-controller="Farmaka_Edit_Controller as farmako_e_c">	
 <div ng-init="farmako_e_c.editor.init_editor('<?php echo $id?>')"/>

 <div class="row">	
 <div class="col-md-10" >

						 
 
 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"Επεξεργασία Φαρμάκου",
		  footerText:"Επεξεργασία Φαρμάκου"
		  }'
		  >
<form name='the_form' novalidate>

			<div class="form-group" ng-class="{'has-error':the_form.name.$invalid&&the_form.name.$dirty}">
			<label for="name"><?php echo "Ονομασία" ?></label>
			 <!--?php echo form_error('name'); ?-->
			
			<input class="form-control"
			  type="input"
			  name="name"
			  placeholder="Όνομασία"
			  ng-model="farmako_e_c.editor.item.name"
			  required		   />
			    <div class="control-label" ng-show="the_form.name.$dirty && the_form.name.$invalid"> 
    		 		 <div class="control-label" ng-show="the_form.name.$error.required">Μη Κενό</div>
    		  
    		    </div>

			</div>

			<div class="form-group" ng-class="{'has-error':the_form.price.$invalid&&the_form.price.$dirty}">
			<label for="price"><?php echo "Τιμή" ?></label>
    		<!--?php echo form_error('price'); ?-->
			<input class="form-control"
			  type="number"
			  name="price"
			  placeholder="Τιμή"
			  required
			  number
			  min='0'
			  step='any'
			  ng-model="farmako_e_c.editor.item.price"	  />

			    <div class="control-label" ng-show="the_form.price.$dirty && the_form.price.$invalid"> 
	    		<div class="control-label" ng-show="the_form.price.$error.required">Μη Κενό</div>
	    		<div class="control-label" ng-show="the_form.price.$error.min">Θετικό</div>
	    		<div class="control-label" ng-show="the_form.price.$error.number">Αριθμός</div>
	    		
    		 </div>
			
			</div>

			<div class="form-group">
			<label for="available"><?php echo "Διαθέσιμο" ?>
			  <input class="form-control"
			  type="checkbox"
			  name="available"
			  ng-model="farmako_e_c.editor.item.available"	
			  ng-true-value="1"
			  ng-false-value="0"  />

					<!--?php echo form_checkbox(['name'=>'available', 'value'=>'1', 'checked'=>$farmako->available?"true":""  ] )  ;?-->
			</label>
			
			</div>


			<div><input type="submit" name="submit"  class="btn btn-primary" ng-click="farmako_e_c.editor.submit()" ng-disabled="the_form.$invalid"  value="Υποβολή" /></div>

</form>
 
 
</my-edit-panel>
 


</div>
<!--div class="col-md-2">
<quick-nav options='{ headingText:"Πλοήγηση", footerText:" "}'> 
<a class="btn  full-button btn-primary" href="/farmaka"> Επιστροφή Πίσω</a>
</quick-nav>
</div-->


</div>

 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>
</div>
</div>
</div>