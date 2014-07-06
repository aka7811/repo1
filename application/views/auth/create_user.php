<h3><?php echo lang('create_user_heading');?></h3>
<p><?php echo lang('create_user_subheading');?></p>


 

<div class="container" >

<div class="row">
					   
<div class="col-md-12" >
	<?php if ($message) {?>
<div id="infoMessage" class=" alert alert-danger alert-dismissable" >
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<h4>Αποτυχία Εγγραφής </h4>
</br>
<?php echo $message; ?>
</div>
<?php } ?>	

</div></div>

<div class="row">
							   
<div class="col-md-12" >
<?php echo form_open("auth/create_user");?>


      <div class="form-group <?php echo  (form_error('first_name')? 'has-error' : '');  ?>">
           <label for='first_name'>  <?php echo lang('create_user_fname_label', 'first_name');?> </label>
            <?php echo form_input($first_name);?>
      </div>

      <div class="form-group <?php echo  (form_error('last_name')? 'has-error' : '');  ?>">
           <label for='last_name'>  <?php echo lang('create_user_lname_label', 'last_name');?> </label>
            <?php echo form_input($last_name);?>
      </div>



      <div class="form-group  <?php echo  (form_error('email')? 'has-error' : '');  ?>">
           <label for='email'>  <?php echo lang('create_user_email_label', 'email');?> </label>
            <?php echo form_input($email);?>
      </div>


      <div class="form-group  <?php echo  (form_error('password')? 'has-error' : '');  ?>">
           <label for='password'>  <?php echo lang('create_user_password_label', 'password');?> </label>
            <?php echo form_input($password);?>
      </div>

      <div class="form-group  <?php echo  (form_error('password_confirm')? 'has-error' : '');  ?>">
           <label for='password_confirm'>  <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> </label>
            <?php echo form_input($password_confirm);?>
      </div>


      <p>
	  <?php echo form_submit(["name"=>'submit', "value"=> lang('create_user_submit_btn'), "class"=>"btn btn-primary btn-lg pull-right" ,"style"=>"margin-top:30px;"]);?>
	  </p>

<?php echo form_close();?>
</div></div>