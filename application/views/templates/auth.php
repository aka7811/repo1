	  <ul class="nav navbar-nav navbar-right">
        		 
			<?php if (!$this->ion_auth->logged_in()){?>
			
			  <li class="dropdown ">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
				  <ul class="dropdown-menu"> <li>
				   <div class="container-fluid" style="width:400px"><div class="row">
				   
				   <div class="col-md-12" >
						 
						 
							<div class="messageajxform alert alert-danger alert-dismissable">
						
							 
							
							</div>
						

							<div class="ajxform">
							<?php echo form_open("#",array( 'id' => 'theForm'));?>
							<p>
							<?php echo lang('login_identity_label', 'identity');?>
							<input class="form-control"  type="input" name="identity"  placeholder="Username/Email" value="<?php echo set_value('identity'); ?>"/><br />
							<?php /*echo form_input('identity');*/?>
							</p>

							<p>
							<?php echo lang('login_password_label', 'password');?>
							<input class="form-control"  type="input" name="password"  placeholder="Password" value="<?php echo set_value('password'); ?>"/><br />

							<?php /*echo form_input('password');*/?>
							</p>

							<p>
							<?php echo lang('login_remember_label', 'remember');?>
							<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
							</p>


							<p><input type="submit" name="submit"  class="btn btn-default  " value="Υποβολή" /></p>

							<?php echo form_close();?>
							</div>



							<div class="successajxform">
							<div></div>
							<div><a href="/">OK</a></div>
							</div>

							<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
						 
							 
							  
							 
					 

					
					
					</div>
					
					
					</div></div>

			</li></ul>
			</li>
			
			
		 
			<li class="seperator"></li>
			<li  >
			 
			  <a   href="/index.php/auth/create_user"> Register </a>  


			</li>

			<?php } else { ?>
			 
		 




			 
			<li><a href=''>Logged In as : <?php  echo  $this->ion_auth->user()->row()->username ?></a></li> 
			
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Επιλογές <b class="caret"></b></a>
			  <ul class="dropdown-menu"> <li>
						
				 <div class="container-fluid" style="width:600px"><div class="row">
				   
				   <div class="col-md-6" >
						<h5 style="color:gray;">Χρήστη</h5>
						<?php foreach ($user_options as $option): ?>

							<div class="pseudo-li"><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></div>
							 

						<?php endforeach ?>
					</div>	 
					<div class="col-md-6" > 
					
						<?php 
						if(isset($admin_options)){
						echo "<h5 style='color:gray;'>Διαχειριστή</h5>";
						foreach ($admin_options as $option): ?>

							<div class="pseudo-li"><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></div>
							 

						<?php endforeach ;
						}?>

						 

						<?php 
						if(isset($farmakeio_options)){
						echo "<h5 style='color:gray;'>Φαρμακείου</h5>";
						foreach ($farmakeio_options as $option): ?>

							<div class="pseudo-li"><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></div>
							 

						<?php endforeach ;
						}?>

						<?php 
						if(isset($giatros_options)){
						echo "<h5 style='color:gray;'>Γιατρού</h5>";
						foreach ($giatros_options as $option): ?>

							<div class="pseudo-li"><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></div>
							 

						<?php endforeach ;
						}?>

						<?php 
						if(isset($admin2_options)){
						echo "<h5 style='color:gray;'>Διαχειριστή 2</h5>";
						foreach ($admin2_options as $option): ?>

							<div class="pseudo-li"><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></div>
							 

						<?php endforeach ;}?>
					</div>
				 	
				</div></div> 
			  </li></ul>
			</li>

			<li> <a href='/auth/logout'> Logout </a> </li> 


		 




			<?php } ?>
      </ul>
    <script>
$( ".messageajxform" ).hide();
$( ".successajxform" ).hide();
$( "#theForm" ).submit(function( event ) {
 
  // Stop form from submitting normally
  event.preventDefault();
 
  // Get some values from elements on the page:
  /*var $form = $( this ),
    term = $form.find( "input[name='s']" ).val(),
    url = $form.attr( "action" );*/
 
  // Send the data using post
  var form_data= $("#theForm").serialize();
  //alert(form_data);
  var posting = $.post( "http://ka77575.eu/index.php/auth/login_json", form_data , function( data ) {
  //var dataj=$.parseJSON(data);
  //alert( "Data Loaded: " + JSON.stringify(data) );
    /*var content = $( data ).find( "#content" );*/
	
	
	if(data.status=="OK")
	{
		 $( ".successajxform" ).show();
    
	$( ".ajxform" ).hide();
	$( ".messageajxform" ).hide();
	setTimeout(function(){
	window.location = window.location.pathname;
	},800);
	}
	else
	if(data.message)
	{
	$( ".messageajxform" ).show();
	//$( ".messageajxform" ).replaceWith("<div class='messageajxform alert alert-danger alert-dismissable'>" +
	//"	<button type='button' class='close' data-dismiss='alert' >&times;</button><p>"+data.message +'htr'+"</p></div>") ;
		
    $( ".messageajxform" ).html( "	<button type='button' class='close'  >&times;</button><p>Server response: </p><p> "+data.message +"</p>" );
	$( ".messageajxform button" ).on("click",function(e){$('.alert').hide(); e.stopPropagation();});
	}
	
  } );
  //posting.setRequestHeader('Accept','application/json; charset=utf-8');
  
  
  posting.fail(function(jqXHR, textStatus, errorThrown) {
  
  alert(textStatus +" "+ errorThrown);
   $( ".messageajxform" ).show();
    $( ".messageajxform" ).empty().append( "<p>"+"dokimaste xana: "+ errorThrown+"</p>" );
  });
  
  
  //$( "#login-modal-toggle" ).on("click", function(e){ });
  
});
 

</script>