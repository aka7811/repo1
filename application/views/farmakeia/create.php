
<div ng-app="sintages">
<my-alert message="�������� ����������" ></my-alert>

<div class="container" >

<my-top-nav 
  
  options='{
		   links:[
		   {title:"���������", address:"/farmakeia", active:false},
		   {title:"��� ����������", address:"#", active:true}]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>

<div class="row" ng-controller="Farmakeia_Create_Controller as f_c_c">	
<div class="col-md-10" >


	 	  <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"��������� ���� ����������",
		  footerText:" "
		  }'
		  >
	 

		<form name="the_form"   novalidate>
			<div ng-init="f_c_c.checker.setForm(the_form)"></div>	

			<div class="form-group " ng-class="{'has-error':the_form.user_email.$invalid&&the_form.user_email.$dirty}">
				<label for="user_email" class="control-label"><?php echo "���������� ���� ����������" ?></label>
			
				<input
				  class="form-control"
				  type="email"
				  
				  required
				  name="user_email"
				  ng-model="f_c_c.checker.user_email"
				  placeholder="e-mail"
				   
				  ng-change="f_c_c.checker.hide_failure()"
	 
				  />
				

				<div  class="control-label" ng-show="the_form.user_email.$dirty && the_form.user_email.$invalid"> 
		    		<div class="control-label" ng-show="the_form.user_email.$error.required">����� email</div>
		    		<div class="control-label" ng-show="the_form.user_email.$error.email">��� ����� email</div>
		    		
		    		
	    		</div>

			 
			</div>
			
			 
			<div class="form-group" ng-show="f_c_c.checker.failure" ng-class="{'has-error':true}" >
			
				<div  class="control-label" > 
					<div class="control-label">��������</div>
		    		<div class="control-label" ng-show="!is_user">�� email ��� ����������� �� ������</div>
		    		<div class="control-label" ng-show="is_already">�� ��������� ���� ��� �����������</div>
		    		<div class="control-label" ng-show="is_other_role">� ������� �� ���� ����</div>
		    		
		    		
	    		</div> 
			
			</div>


			<div><input type="submit" name="submit" ng-click="f_c_c.checker.submit(f_c_c.checker.user_email)"   ng-disabled="the_form.$invalid"   class="btn btn-primary btn-lg full-button " value="���������� ���������� ��� ����� ��� ��������� email" /></div>
		</form>
 

  </my-edit-panel>
	 
</div>
<!--div class="col-md-2">
<quick-nav options='{ headingText:"��������"}'> 
<a class="btn  full-button btn-primary" href="/farmakeia"> ��������� ����</a>
</quick-nav>
</div-->
	
	</div>

 
 
</div>
</div>
 <script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>