 
<div class="container   ">
<div class="row">
<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>
</div class="row">
 
<?php $attributes = array( 'id' => 'theForm');?>

 

 
<div class="row">
<?php echo form_open("#",$attributes);?>
<div class="messageajxform"><p>fefwe</p>
	</div>
   <div class="ajxform">
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
	<div><a href="/">Επιτυχία, επιστροφή </a></div>
	</div>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
</div></div>
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
  var posting = $.post( "http://localhost/auth/login_json", form_data , function( data ) {
  
	alert( "Data Loaded: " + JSON.stringify(data) );
     
	
	if(data.status=="OK")
	{
	 $( ".successajxform" ).show();
    
	$( ".ajxform" ).hide();
	$( ".messageajxform" ).hide();
	setTimeout(800,function(){window.location = window.location.pathname;});
	}
	else
	if(data.message)
	{
	$( ".messageajxform" ).show();
    $( ".messageajxform" ).empty().append( "<p>"+data.message +"</p>" );
	}
	
  } );
   
  
  posting.fail(function(jqXHR, textStatus, errorThrown) {
  
  alert(textStatus +" "+ errorThrown);
   $( ".messageajxform" ).show();
    $( ".messageajxform" ).empty().append( "<p>"+"Σφάλμα: "+ errorThrown+"</p>" );
  });
  
  
  
  
});
 

</script>
























