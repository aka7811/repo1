
	<?php if($this->session->flashdata('redirect_message')  || ($this->session->flashdata('redirect_coded') )){?>
	<div class="container">
	<div class="row">
	<div class = "col-md-12">
	<div class=" alert alert-info  alert-dismissable">

	<button type='button' data-dismiss="alert" class='close '  >&times;</button>
	<p>Μήνυμα Server: 
	 <?php 
	 if($this->session->flashdata('redirect_message')){  echo $this->session->flashdata('redirect_message'); }
     if($this->session->flashdata('redirect_coded')) 
     {
     	 if($this->session->flashdata('redirect_coded')=="del") echo "Διαγραφή";
     }
	 ?>  </p>
	
	</div>
	</div>	
	</div> 

	<?php } ?>
	
	