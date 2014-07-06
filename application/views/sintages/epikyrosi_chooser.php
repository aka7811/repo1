
<div  ng-app="sintages">
<my-alert message="Έγινε η Επικύρωση της Συνταγής" ></my-alert>
<div class="container">
 

	<div  ng-controller="Sintages_Epikyrosi_Chooser_Controller as sintagichoice">
 
  <my-top-nav  options='{   links:[	
 {title:"Συνταγές Φαρμακείου", address:"/sintages/farmakeiou", active:false},
  {title:"Επικύρωση Συνταγής", address:"#", active:true}
 ]  }'  >
 
 </my-top-nav>
 

 
 
	<div class="row" >
		
		<div class="col-md-9" >
 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"Επiλογή Συνταγής για Επικύρωση"
		  
		  }'
		  >
<h2 ng-show="sintagichoice.item==undefined" class="text-center">Επιλέξτε  τον κωδικό συνταγής  </h2>
<div class="seperator"></div>	
 <input class="form-control"  type="input" name="pattern" ng-model="sintagichoice.id" ng-change="sintagichoice.clear()" placeholder="Κωδικός Συνταγής" />
 <div class="seperator"></div>	
<div><input type="button" name="submit"  class="btn btn-primary btn-lg full-button"  ng-click= "sintagichoice.get_item(sintagichoice.id)" value="Υποβολή" /></div>
<div style="color:red;" ng-show="ajaxon"> Loading </div>
<div class="seperator"></div>		 

		 
		 	   
 

	 
	 <h2 style="color:red; border: thin solid red" class="text-center" ng-show="sintagichoice.not_commitable">Η συνταγή με αυτόν τον κωδικό δεν μπορεί να επικυρωθεί  </h2>
 
	
	 
	 </my-edit-panel>
	 
	 
	<div class="row"  ng-show="sintagichoice.item!=undefined">
		
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
		  <div class="col-sm-10"> <input name="kodikos" class="form-control"  readonly value="{{sintagichoice.item.sintagi.id}}"/>  </div>
		</div>
		
		<div class="form-group">
		  <label for="imerominia" class="col-sm-2 control-label" > Ημερομηνία</label>
		  <div class="col-sm-10"> <input name="imerominia" class="form-control"  readonly value="{{sintagichoice.item.sintagi.imerominia}}"/>  </div>
		</div>
		

		<div class="form-group">
		  <label for="asthenis" class="col-sm-2 control-label" > Όνομα Ασθενούς</label>
		  <div class="col-sm-10"> <input name="asthenis" class="form-control"  readonly value=" {{sintagichoice.item.sintagi.name}}"/>  </div>
		</div>
			
 

		<div class="form-group">
		  <label for="katastasi" class="col-sm-2 control-label" >Κατάσταση</label>
		  <div class="col-sm-10"> <input name="katastasi" class="form-control"  readonly value="{{sintagichoice.item.sintagi.katastasi | katastasiSintagis }}"/>  </div>
		</div>

		 
		  
		 <div class="form-group">
		  <label for="diagnoseis" class="col-sm-2 control-label" >Διαγνώσεις</label>
			 <div class="col-sm-10"> <select name="diagnoseis"  class="form-control" readonly size=5>		  
			 <option  ng-repeat="diagnosi in sintagichoice.item.diagnoseis">
			 	{{diagnosi.name}}
			 </option>
			 </select>
			</div></div>
		


		</form>
 <my-edit-panel  ng-repeat="sline in sintagichoice.item.slines"
		   
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
	<a class=" btn btn-info btn-lg pull-right full-button" ng-click="sintagichoice.epikyrose()" ng-disabled="sintagichoice.item.sintagi.katastasi!='0'">Επικύρωση  </a>
	
	</div>

	 




	</div>

	 </div>

	 
 


	</div>






</div>
 



 


</div></div> 
 

 <!--      script           -->
 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>