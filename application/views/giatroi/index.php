<div ng-app="sintages">
<my-alert message="�������� ��������" ></my-alert>	
<div class="container">
<my-top-nav 
  
  options='{
		   links:[
		   {title:"�������", address:"#", active:true}
		   ]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>


<div ng-controller="Giatroi_Index_Controller as g_i_c">
<my-deleter indexer="g_i_c.indexer" ></my-deleter>	

<div class="row">
<div class="col-md-9 ">
  <my-Index-Panel
		  indexer="g_i_c.indexer"
		  options='
		  {
		  noneText:"��� �������� ��������" ,
		  errorClass:"", 
		  headingText:"�������",
		  footerText:"������� �������"
		  }'
		  >
<table class="table table-striped table-bordered ">

		<tbody>
		 <tr>
		     <th class="col-md-3">  ����� </th>
		    
		     <th class="col-md-3">  ���������</th>
		     
		     <th class="col-md-1">  ��������</th>
		     <th class="col-md-1">  ����������</th>
		     <th class="col-md-2">  E-mail</th>
			 <th class="col-md-1">  </th>
			 <th class="col-md-1"> </th>
		 </tr>
			<tr  ng-repeat="giatros in g_i_c.indexer.items">
			 <td>  {{giatros.name}}</td>
		    
		     <td>  {{giatros.address}}</td>
		     
		     <td>  {{giatros.phone}}</td>
		     <td>  {{giatros.eidikotita}}</td>
		     <td>  {{giatros.email}}</td>
		    
		    <td><a class="btn btn-info btn-sm" href="/giatroi/edit/{{giatros.id}}">�����������</a></td > 
		    
		    <td><a class="btn btn-danger btn-sm" ng-click="g_i_c.indexer.make_delete_candidate(giatros.id)">��������</a></td > 
			
			</tr> 
	 
			</tbody>
</table>
</my-Index-Panel>
 


 
</div><!-- end left column -->

<div class="col-md-3">
	<options-panel options='{ headingText:"��������"}'>
	     <a href="/giatroi/create" class="btn btn-primary full-button">���� �������  </a>
	</options-panel> 
	<my-filter-panel
					options='
					  {
					   
					  
					  headingText:"������"
					  
					   
					  }'
					> 
		
		<div class="row">
			
			 
			<div class="form-group     ">
			
			<my-clearable-input model="g_i_c.indexer.pattern_tmp_md.name" options='{placeholder:"�����"}' >
			</my-clearable-input>
			
			<my-clearable-input model="g_i_c.indexer.pattern_tmp_md.address" options='{placeholder:"���������"}' >
			</my-clearable-input>
			
			<my-clearable-input model="g_i_c.indexer.pattern_tmp_md.email" options='{placeholder:"e-mail"}' >
			</my-clearable-input>
			
			<my-clearable-input model="g_i_c.indexer.pattern_tmp_md.eidikotia" options='{placeholder:"����������"}' >
			</my-clearable-input>
			
			
	
			
			</div>


			<div><input type="button" name="submit"  class="btn btn-primary pull-right"  ng-click= "g_i_c.indexer.get_items(0,g_i_c.indexer.pattern_tmp_md)" value="�������" /></div>
		    <div style="color:red;" ng-show="g_i_c.indexer.pattern_tmp_md.ajaxon"> Loading </div>
		 

		 
	     </div>
	  </my-filter-panel>
	
</div>
</div>

 


</div></div>
 </div>

   <script type="text/javascript" src="/scripts/sintagi-script.js"></script>
 