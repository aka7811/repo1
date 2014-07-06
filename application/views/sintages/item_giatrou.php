 <div  ng-app="sintages">
 <my-alert message="Έγινε η ακύρωση της συνταγής" ></my-alert>	

<div class="container">
 
 <my-top-nav  options='{   links:[	
 {title:"Συνταγές", address:"/sintages/giatrou", active:false},
  {title:"Προβολή συνταγών", address:"#", active:true}
 ]  }'  >
 
 </my-top-nav>

	<div  ng-init="init_sintagi_item(<?php echo $id?>)" ng-controller="Sintagi_Item_From_Giatros_Controller as sintagi">
 
  
 

 
	

	<div class="row" >
		
		<div class="col-md-12" >
	
	 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"Στοιχεία Συνταγής"
		   
		  }'
		  >
	
		<form  class="form-horizontal">	
		
		<div class="form-group">
		  <label for="kodikos" class="col-sm-2 control-label" > Κωδικός</label>
		  <div class="col-sm-10"> <input name="kodikos" class="form-control"  readonly value="{{sintagi.item.sintagi.id}}"/>  </div>
		</div>
		
		<div class="form-group">
		  <label for="imerominia" class="col-sm-2 control-label" > Ημερομηνία</label>
		  <div class="col-sm-10"> <input name="imerominia" class="form-control"  readonly value="{{sintagi.item.sintagi.imerominia}}"/>  </div>
		</div>
		

		<div class="form-group">
		  <label for="asthenis" class="col-sm-2 control-label" > Όνομα Ασθενούς</label>
		  <div class="col-sm-10"> <input name="asthenis" class="form-control"  readonly value=" {{sintagi.item.sintagi.name}}"/>  </div>
		</div>
			
 

		<div class="form-group">
		  <label for="katastasi" class="col-sm-2 control-label" >Κατάσταση</label>
		  <div class="col-sm-10"> <input name="katastasi" class="form-control"  readonly value="{{sintagi.item.sintagi.katastasi | katastasiSintagis   }}"/>  </div>
		</div>

		 
		  
		 <div class="form-group">
		  <label for="diagnoseis" class="col-sm-2 control-label" >Διαγνώσεις</label>
			 <div class="col-sm-10"> <select name="diagnoseis"  class="form-control" readonly size=5>		  
			 <option  ng-repeat="diagnosi in sintagi.item.diagnoseis">
			 	{{diagnosi.name}}
			 </option>
			 </select>
			</div></div>
		


		</form>

		
		
		 <my-edit-panel  ng-repeat="sline in sintagi.item.slines"
		   
		  options='
		  {
		   
		  
		  headingText:"Σκεύασμα",
		  
		  nonprimary:true
		  }'
		  >
   <form  class="form-horizontal" >
	 
	 
	 <div class="form-group">
		  <label for="sline-name" class="col-sm-2 control-label" >Όνομα Φαρμάκου</label>
		  <div class="col-sm-10"> <input name="sline-name" class="form-control"  readonly value="{{sline.name}}"/>  </div>
	</div>
	<div class="form-group">
		  <label for="sline-amount" class="col-sm-2 control-label" >Ποσότητα</label>
		  <div class="col-sm-10"> <input name="sline-amount" class="form-control"  readonly value="{{sline.amount}}"/>  </div>
	</div>
	<div class="form-group">
		  <label for="sline-dosologia" class="col-sm-2 control-label" >Δοσολογία</label>
		  <div class="col-sm-10"> <input name="sline-dosologia" class="form-control"  readonly value="{{sline.dosologia}}"/>  </div>
	</div>

	 
	
	</form>	
 </my-edit-panel>
	
	 </my-edit-panel>
	
	<a class=" btn btn-info pull-right btn-lg full-button seperator-up"  ng-click="sintagi.akyrose()" ng-disabled="sintagi.item.sintagi.katastasi!='0'">Ακύρωση της Συνταγής </a>
	
	</div>

	 




	</div>
</div>
 



 


</div></div> 
 

 <!--      script           -->
 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>