 
 <div ng-app="sintages">
 	<my-alert message="�������� ����������" ></my-alert>
 
<div class="container">
 <my-top-nav 
  
  options='{
		   links:[
		   {title:"�������", address:"/farmaka", active:false},
		   {title:"��� ����������", address:"#", active:true}]
		   
		  
		  }'
  >
 
 
  
 
 </my-top-nav>


<div class="row">	
<div class="col-md-10" >

 <div ng-controller="Farmaka_Create_Controller as f_c_c">						 
						 
 
 <my-edit-panel
		   
		  options='
		  {
		   
		  
		  headingText:"���������� ���� ��������",
		  footerText:" "
		  }'
		  >
<form name='the_form' novalidate>
<div ng-init="f_c_c.set_form(the_form)"></div>
			<div class="form-group" ng-class="{'has-error':the_form.name.$invalid&&the_form.name.$dirty}">
			<label for="name"><?php echo "����� ��������" ?></label>
			 <!--?php echo form_error('name'); ?-->
			
			<input class="form-control"
			  type="input"
			  name="name"
			  placeholder="�����"
			  ng-model="f_c_c.item.name"
			  required		   />
			    <div class="control-label" ng-show="the_form.name.$dirty && the_form.name.$invalid"> 
    		 		 <div class="control-label" ng-show="the_form.name.$error.required">����������� �� �����.</div>
    		  
    		    </div>

			</div>

			<div class="form-group" ng-class="{'has-error':the_form.price.$invalid&&the_form.price.$dirty}">
			<label for="price"><?php echo "���� ��������" ?></label>
    		<!--?php echo form_error('price'); ?-->
			<input class="form-control"
			  type="number"
			  name="price"
			  placeholder="����"
			  required
			  number
			  min='0'
			  step='any'
			  ng-model="f_c_c.item.price"	  />

			    <div class="control-label" ng-show="the_form.price.$dirty && the_form.price.$invalid"> 
	    		<div class="control-label" ng-show="the_form.price.$error.required">�� ����</div>
	    		<div class="control-label" ng-show="the_form.price.$error.min">������</div>
	    		<div class="control-label" ng-show="the_form.price.$error.number">�������</div>
	    		
    		 </div>
			
			</div>

			<div class="form-group">
			<label for="available"><?php echo "���������" ?>
			  <input class="form-control"
			  type="checkbox"
			  name="available"
			  ng-model="f_c_c.item.available"	
			  ng-true-value="1"
			  ng-false-value="0"  />

					<!--?php echo form_checkbox(['name'=>'available', 'value'=>'1', 'checked'=>$farmako->available?"true":""  ] )  ;?-->
			</label>
			
			</div>


			<div><input type="submit" name="submit"  class="btn btn-primary" ng-click="f_c_c.submit()" ng-disabled="the_form.$invalid"  value="�������" /></div>

</form>
 </my-edit-panel>

 


</div>
</div>
<!--div class="col-md-2">
<quick-nav options='{ headingText:"��������"  }'> 
<a class="btn  full-button btn-primary" href="/farmaka"> ��������� ����</a>
</quick-nav>
</div-->

</div>
</div>
</div>
<script type="text/javascript" src="/scripts/sintagi-script.js">
		 
		</script>
