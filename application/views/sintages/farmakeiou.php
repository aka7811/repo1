<div class="container">



<div ng-app="sintages">
  <my-top-nav 
  
  options='{
		   links:[
		   {title:"�������� ����������", address:"#", active:true} 
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
		  noneText:"��� �������� ��������" ,
		   
		  headingText:"��������",
		  footerText:"������� ��������"
		  }'
		  >
<table class="table table-striped table-bordered ">
 
<tr><th class="col-md-2">�������</th><th class="col-md-3">����������</th><th class="col-md-5">������������</th><th class="col-md-1"></th>
 
		 
			<tr  ng-repeat="sintagi in sintages_view.indexer.items">
			<td>  {{sintagi.id}}</td>
			 <td>  {{sintagi.imerominia}}</td>
		    
		     <td>  {{sintagi.name}}</td>
		     
		     
		    <td><a class="btn btn-info btn-sm" href="/sintages/item_farmakeiou/{{sintagi.id}}">��������� �������</a></td > 
		    
		    
			
			</tr> 
	  
 
</table>
</my-Index-Panel>
</div>


 




 
<div class="col-md-3">

<options-panel options='{ headingText:"������������"}'>
	     <a href="/sintages/epikyrosi_chooser" class="btn btn-primary full-button"> ��������� ���� �������� </a>
	</options-panel> 
<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"������"
					  
					   
					  }'
					> 
	 
						 

		<div class="row">
			
			 
			<div class="form-group     ">
			 
				<my-clearable-input model="sintages_view.indexer.pattern_tmp_md.asfalismenos_id" options='{placeholder:"������� ������������"}' >
			</my-clearable-input>
			
			  
			<label for="datestart" class="control-label">���</label>
			<input class="form-control"  type="date" name="datestart" ng-model="sintages_view.indexer.pattern_tmp_md.date_start" placeholder="���" />
			<label for="dateend" class="control-label">���</label>
			<input class="form-control"  type="date" name="dateend" ng-model="sintages_view.indexer.pattern_tmp_md.date_end" placeholder="���" />
		
			</div>


			<div><input type="button" name="submit"  class="btn btn-primary pull-right full-button"  ng-click= "sintages_view.indexer.get_items(0,sintages_view.indexer.pattern_tmp_md)" value="�������" /></div>
		    <div style="color:red;" ng-show="sintages_view.indexer.ajaxon"> Loading </div>
		 

		 
		</div>
		<div class="seperator"></div>
		<div class="row"   >
			<div><input type="button" name="submit"   class="btn btn-default full-button"  ng-click= "sintages_view.lastdays(3)" value="���������� 3" /></div>
		    <div><input type="button" name="submit"   class="btn btn-default full-button"  ng-click= "sintages_view.indexer.lastdays(1)" value="������" /></div>
		  
		 
	 
</div> 
</my-filter-panel>
</div>
</div>
</div>

 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
</script>


</div></div>
 
 
 