
 <nav class="navbar navbar-default    navbar-static-top  navbar-inverse yamm"  >
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nc1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/pages/">Εφαρμογή ΓΤΠ</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="nc1">
       
    
   
      <ul class="nav navbar-nav ">
       
        <li class="dropdown   <?php if($this->uri->segment(2)=="bycat") echo " active";   ?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Κατηγορίες Ειδήσεων <b class="caret"></b></a>
          <ul class="dropdown-menu">
					<?php foreach ($categories as $cat): ?>

						<li><a href='<?php echo  "/pages/bycat/".$cat['name']?>'><?php echo $cat['name'] ?></a></li>
						 

					<?php endforeach ?>
					  <li class="divider"></li>
					 <li><a href="/pages/bycat/">Όλες</a></li>
            <li class="divider"></li>
            <li><div class="container"><div class="row"> <div class="col-md-2" >Tria poulakia <a> kathontan</a></div></div></div></li>
			
          </ul>
        </li>
		
		<li class="<?php if($this->uri->uri_string()=="pages/create") echo "active"; ?>"><a href="/pages/create" >Δημιουργία</a></li>
      </ul>
	  
	    <ul class="nav navbar-nav navbar-right">
        
						  
						 
						<?php if (!$this->ion_auth->logged_in()){?>

						<li  >
						 
						  <a id='login-modal-toggle' data-toggle="modal" data-target="#login-modal"> Login </a>  


						</li>
						<li class="seperator"></li>
						<li  >
						 
						  <a   href="/index.php/auth/create_user"> Register </a>  


						</li>

						<?php } else { ?>
						 
					 



 
						 
						<li><a href=''>Logged In as : <?php  echo  $this->ion_auth->user()->row()->username ?></a></li> 
						
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Επιλογές <b class="caret"></b></a>
						  <ul class="dropdown-menu">
									<?php foreach ($user_options as $option): ?>

										<li><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></li>
										 

									<?php endforeach ?>
									 <li class="divider"></li>
									 
									<?php 
									if(isset($admin_options))
									foreach ($admin_options as $option): ?>

										<li><a href='<?php echo $option[1]?>'><?php echo $option[0] ?></a></li>
										 

									<?php endforeach ?>
									 
							 	
							
						  </ul>
						</li>
		
						<li> <a href='/auth/logout'> Logout </a> </li> 


					 




						<?php } ?>

 
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
 </nav>
 
 
 
 
 
 
 
 
 <div id='login-modal' class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid"  >
		<div class="row-fluid"  >
		
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
			<div><a href="/">Επιτυχία, επιστροφή</a></div>
			</div>

			<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
		</div>
		</div>
	</div> <!-- /.modal-body -->
        
      
	  <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
		
    $( ".messageajxform" ).html( "	<button type='button' class='close'  >&times;</button><p>Server response: </p><p> "+data.message +'htr'+"</p>" );
	$( ".messageajxform button" ).on("click",function(e){$('.alert').hide();});
	}
	
  } );
  //posting.setRequestHeader('Accept','application/json; charset=utf-8');
  
  
  posting.fail(function(jqXHR, textStatus, errorThrown) {
  
  alert(textStatus +" "+ errorThrown);
   $( ".messageajxform" ).show();
    $( ".messageajxform" ).empty().append( "<p>"+"dokimaste xana: "+ errorThrown+"</p>" );
  });
  
  
  $( "#login-modal-toggle" ).on("click", function(e){ });
  
});
 

</script>


