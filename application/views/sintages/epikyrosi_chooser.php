
<div  ng-app="sintages">
<my-alert message="����� � ��������� ��� ��������" ></my-alert>
<div class="container">
 

	<div  ng-controller="Sintages_Epikyrosi_Chooser_Controller as sintagichoice">
 
  <my-top-nav  options='{   links:[	
 {title:"�������� ����������", address:"/sintages/farmakeiou", active:false},
  {title:"��������� ��������", address:"#", active:true}
 ]  }'  >
 
 </my-top-nav>
 

 
 
	<div class="row" >
		
		<div class="col-md-9" >
 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"��i���� �������� ��� ���������"
		  
		  }'
		  >
<h2 ng-show="sintagichoice.item==undefined" class="text-center">��������  ��� ������ ��������  </h2>
<div class="seperator"></div>	
 <input class="form-control"  type="input" name="pattern" ng-model="sintagichoice.id" ng-change="sintagichoice.clear()" placeholder="������� ��������" />
 <div class="seperator"></div>	
<div><input type="button" name="submit"  class="btn btn-primary btn-lg full-button"  ng-click= "sintagichoice.get_item(sintagichoice.id)" value="�������" /></div>
<div style="color:red;" ng-show="ajaxon"> Loading </div>
<div class="seperator"></div>		 

		 
		 	   
 

	 
	 <h2 style="color:red; border: thin solid red" class="text-center" ng-show="sintagichoice.not_commitable">� ������� �� ����� ��� ������ ��� ������ �� ����������  </h2>
 
	
	 
	 </my-edit-panel>
	 
	 
	<div class="row"  ng-show="sintagichoice.item!=undefined">
		
		<div class="col-md-12" >
		 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"�������� ��������"
		   
		  }'
		  >
		<form  class="form-horizontal">	
		
		<div class="form-group">
		  <label for="kodikos" class="col-sm-2 control-label" > �������</label>
		  <div class="col-sm-10"> <input name="kodikos" class="form-control"  readonly value="{{sintagichoice.item.sintagi.id}}"/>  </div>
		</div>
		
		<div class="form-group">
		  <label for="imerominia" class="col-sm-2 control-label" > ����������</label>
		  <div class="col-sm-10"> <input name="imerominia" class="form-control"  readonly value="{{sintagichoice.item.sintagi.imerominia}}"/>  </div>
		</div>
		

		<div class="form-group">
		  <label for="asthenis" class="col-sm-2 control-label" > ����� ��������</label>
		  <div class="col-sm-10"> <input name="asthenis" class="form-control"  readonly value=" {{sintagichoice.item.sintagi.name}}"/>  </div>
		</div>
			
 

		<div class="form-group">
		  <label for="katastasi" class="col-sm-2 control-label" >���������</label>
		  <div class="col-sm-10"> <input name="katastasi" class="form-control"  readonly value="{{sintagichoice.item.sintagi.katastasi | katastasiSintagis }}"/>  </div>
		</div>

		 
		  
		 <div class="form-group">
		  <label for="diagnoseis" class="col-sm-2 control-label" >����������</label>
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
		   
		  
		    headingText:"��������",
		  
		  nonprimary:true
		   
		  }'
		  >
   <form  class="form-horizontal" >
	 
	  
	 <div class="form-group">
		  <label for="sline-name" class="col-sm-2 control-label" >����� ��������</label>
		  <div class="col-sm-10"> <input name="sline-name" class="form-control"  readonly value="{{sline.name}}"/>  </div>
	</div>
	<div class="form-group">
		  <label for="sline-amount" class="col-sm-2 control-label" >��������</label>
		  <div class="col-sm-10"> <input name="sline-amount" class="form-control"  readonly value="{{sline.amount}}"/>  </div>
	</div>
	<div class="form-group">
		  <label for="sline-dosologia" class="col-sm-2 control-label" >���������</label>
		  <div class="col-sm-10"> <input name="sline-dosologia" class="form-control"  readonly value="{{sline.dosologia}}"/>  </div>
	</div>

	 
	
	</form>	
</my-edit-panel>
</my-edit-panel>
	<a class=" btn btn-info btn-lg pull-right full-button" ng-click="sintagichoice.epikyrose()" ng-disabled="sintagichoice.item.sintagi.katastasi!='0'">���������  </a>
	
	</div>

	 




	</div>

	 </div>

	 
 


	</div>






</div>
 



 


</div></div> 
 

 <!--      script           -->
 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>