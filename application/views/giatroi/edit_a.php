 <div ng-app="sintages">
<my-alert message="�� ������� �������������" ></my-alert>

<div class="container">

  

  <my-top-nav 
  
  options='{
		   links:[
		   {title:"�������", address:"/giatroi", active:false},
		   {title:"����������� ���������", address:"#", active:true}]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>
 
 
 <div ng-controller="Giatroi_Edit_Controller as g_e_c">						 
<div ng-init="g_e_c.editor.init_editor('<?php echo $id ?>')"/>	
<div class="row">	 <div class="col-md-10" >
		 		 
 
  <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"����������� ��������� �������",
		  footerText:" "
		  }'
		  >
<form name='the_form' novalidate>


			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.name.$invalid&&the_form.name.$dirty}">
				<label for="name">����� ��������� </label>
			 
			
				<input class="form-control"
				  type="input"
				  name="name"
				  placeholder="����� ���������"
				  ng-model="g_e_c.editor.item.name"
				   		   />
			     

			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.address.$invalid&&the_form.address.$dirty}">
				<label for="">���������</label>
    			
				<input class="form-control"
				  type="address"
				  name="address"
				  placeholder="���������"
				  required
				  
				  ng-model="g_e_c.editor.item.address"	  />
				 
				<div class="control-label" ng-show="the_form.address.$dirty && the_form.address.$invalid"> 
		    		<div class="control-label" ng-show="the_form.address.$error.required">�� ����</div>
		    		 
		    		
	    		 </div>
			
			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.phone.$invalid&&the_form.phone.$dirty}">
				<label for="phone">�������� </label>
			 
			
				<input class="form-control"
				  type="phone"
				  name="phone"
				  placeholder="��������"
				  ng-model="g_e_c.editor.item.phone"
				  />
			     

			</div>

			<!-- ***************************************************  -->
			<div class="form-group" ng-class="{'has-error':the_form.eidikotita.$invalid&&the_form.eidikotita.$dirty}">
				<label for="eidikotita">���������� </label>
			 
			
				<input class="form-control"
				  type="input"
				  name="eidikotita"
				  placeholder="����������"
				  ng-model="g_e_c.editor.item.eidikotita"
				  />
			     

			</div>
			 


			<div><input type="submit" name="submit"  class="btn btn-primary pull-right" ng-disabled="the_form.$invalid" ng-click="g_e_c.editor.submit()" value="������� �������" /></div>

</form>
 
  </my-edit-panel>

 

 


</div>
<!--div class="col-md-2">
<quick-nav options='{ headingText:"��������", footerText:" "}'> 
<a class="btn  full-button btn-primary" href="/giatroi"> ��������� ����</a>
</quick-nav>
</div-->
</div>
</div>
</div>
</div>

 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>
